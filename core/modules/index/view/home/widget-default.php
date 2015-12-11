<?php

$thejson = array();
$events = OperationData::getRents();
foreach($events as $event){
	$item = ItemData::getById($event->item_id);
	$book = $item->getBook();

	$thejson[] = array("title"=>$item->code." - ".$book->title,"url"=>"","start"=>$event->start_at,"end"=>$event->finish_at);

}
// print_r(json_encode($thejson));

?>
<script>


	$(document).ready(function() {

		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			defaultDate: '<?php echo date("Y-m-d");?>',
			editable: false,
			eventLimit: true, // allow "more" link when too many events
			events: <?php echo json_encode($thejson); ?>
		});
		
	});

</script>


<div class="row">
<div class="col-md-12">
<h1>Calendario</h1>
<div id="calendar"></div>

</div>
</div>
