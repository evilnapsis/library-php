<?php
include "../core/autoload.php";
include "../core/modules/index/model/ReservationData.php";
include "../core/modules/index/model/PacientData.php";
include "../core/modules/index/model/MedicData.php";
include "../core/modules/index/model/StatusData.php";
include "../core/modules/index/model/PaymentData.php";
session_start();

require_once '../PhpWord/Autoloader.php';
use PhpOffice\PhpWord\Autoloader;
use PhpOffice\PhpWord\Settings;

Autoloader::register();

$word = new  PhpOffice\PhpWord\PhpWord();

$reservation = ReservationData::getById($_GET["id"]);
$pacient = $reservation->getPacient();
$medic = $reservation->getMedic();

$section1 = $word->AddSection();
$section1->addText("CITA MEDICA",array("size"=>22,"bold"=>true,"align"=>"right"));


$styleTable = array('borderSize' => 6, 'borderColor' => '888888', 'cellMargin' => 40);
// $styleFirstRow = array('borderBottomColor' => '0000FF', 'bgColor' => 'AAAAAA');

$table1 = $section1->addTable("table1");
$table1->addRow();
$table1->addCell(4000)->addText("Asunto",array("bold"=>true));
$table1->addCell(8000)->addText($reservation->title);
$table1->addRow();
$table1->addCell()->addText("Paciente",array("bold"=>true));
$table1->addCell()->addText($pacient->name." ".$pacient->lastname);
$table1->addRow();
$table1->addCell()->addText("Medico",array("bold"=>true));
$table1->addCell()->addText($medic->name." ".$medic->lastname);
$table1->addRow();
$table1->addCell()->addText("Fecha y hora",array("bold"=>true));
$table1->addCell()->addText($reservation->date_at." - ".$reservation->time_at);

$table1->addRow();
$table1->addCell(4000)->addText("Nota",array("bold"=>true));
$table1->addCell(8000)->addText($reservation->note);
$table1->addRow();
$table1->addCell(4000)->addText("Enfermedad",array("bold"=>true));
$table1->addCell(8000)->addText($reservation->sick);
$table1->addRow();
$table1->addCell(4000)->addText("Sintomas",array("bold"=>true));
$table1->addCell(8000)->addText($reservation->symtoms);
$table1->addRow();
$table1->addCell(4000)->addText("Medicamentos",array("bold"=>true));
$table1->addCell(8000)->addText($reservation->medicaments);

$table1->addRow();
$table1->addCell()->addText("Estado",array("bold"=>true));
$table1->addCell()->addText($reservation->getStatus()->name);
$table1->addRow();
$table1->addCell()->addText("Pago",array("bold"=>true));
$table1->addCell()->addText($reservation->getPayment()->name);


$word->addTableStyle('table1', $styleTable);
/// datos bancarios
$section1->addText("");
$section1->addText("");
$section1->addText("");
$section1->addText("Generado por BookMedik v2.5");
$filename = "reservation-".time().".docx";
#$word->setReadDataOnly(true);
$word->save($filename,"Word2007");
//chmod($filename,0444);
header("Content-Disposition: attachment; filename='$filename'");
readfile($filename); // or echo file_get_contents($filename);
unlink($filename);  // remove temp file



?>