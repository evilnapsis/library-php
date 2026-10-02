<?php
namespace App\Controller;

use ViewEngine;

/**
 * Controlador de reportes de préstamos y devoluciones en Library 2.
 */
class ReportController {

	public function index() {
		$start = $_GET['start'] ?? date('Y-m-01');
		$finish = $_GET['finish'] ?? date('Y-m-d');

		if (isset($_GET['export']) && $_GET['export'] === 'csv') {
			$this->exportCsv($start, $finish);
			return;
		}

		$operations = \OperationData::getByDateRange($start, $finish);
		$today = date('Y-m-d');
		$devueltos = 0;
		$prestados = 0;
		$vencidos = 0;

		foreach ($operations as $op) {
			if ($op->returned_at) {
				$devueltos++;
			} else {
				$prestados++;
				if ($op->finish_at < $today) {
					$vencidos++;
				}
			}
		}

		ViewEngine::render('reports/index.html.twig', [
			'operations' => $operations,
			'start' => $start,
			'finish' => $finish,
			'totalLoans' => count($operations),
			'devueltos' => $devueltos,
			'prestados' => $prestados,
			'vencidos' => $vencidos
		]);
	}

	public function exportCsv(?string $startDate = null, ?string $finishDate = null) {
		$start = $startDate ?? ($_GET['start'] ?? date('Y-m-01'));
		$finish = $finishDate ?? ($_GET['finish'] ?? date('Y-m-d'));

		$operations = \OperationData::getByDateRange($start, $finish);
		$filename = "reporte_prestamos_{$start}_al_{$finish}.csv";
		$today = date('Y-m-d');

		header('Content-Type: text/csv; charset=utf-8');
		header('Content-Disposition: attachment; filename="' . $filename . '"');
		header('Pragma: no-cache');
		header('Expires: 0');

		$output = fopen('php://output', 'w');
		fprintf($output, chr(0xEF).chr(0xBB).chr(0xBF));

		fputcsv($output, [
			'Folio',
			'Libro',
			'Código Ejemplar',
			'Lector / Socio',
			'Fecha Salida',
			'Fecha Límite',
			'Fecha Devolución',
			'Estado'
		]);

		foreach ($operations as $op) {
			$item = $op->getItem();
			$book = $item ? $item->getBook() : null;
			$client = $op->getClient();

			$estado = 'Prestado';
			if ($op->returned_at) {
				$estado = 'Devuelto';
			} elseif ($op->finish_at < $today) {
				$estado = 'Vencido / En Mora';
			}

			fputcsv($output, [
				$op->id,
				$book ? $book->title : 'Sin título',
				$item ? $item->code : ('Item #' . $op->item_id),
				$client ? ($client->name . ' ' . $client->lastname) : 'Lector General',
				$op->start_at,
				$op->finish_at,
				$op->returned_at ?: '-',
				$estado
			]);
		}

		fclose($output);
		exit;
	}
}
