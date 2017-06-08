@extends('layouts.admin.main')

@section('content')
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-calendar fa-fw"></i>
					Calendario Acadêmico
				</div>
				<div class="panel-body">
					<div id='calendar'></div>
				</div>
			</div>
		</div>
	</div>
	<!-- Modal -->
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header" style="color: #fff;background: #3c8dbc;">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel">Título do modal</h4>
				</div>
				<div class="modal-body">
				...
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
				</div>
			</div>
		</div>
	</div>
@endsection
@section('css')
	<link rel="stylesheet" href="{{elixir('assets/AdminLTE/plugins/fullcalendar/fullcalendar.min.css') }}">
	<link rel="stylesheet" href="{!! elixir('css/style.css') !!}">
@endsection

@section('js')
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.11.2/moment.min.js"></script>
	<script src="{{elixir('assets/AdminLTE/plugins/fullcalendar/fullcalendar.min.js')}}"></script>
	<script src="https://fullcalendar.io/js/fullcalendar-2.9.1/lang-all.js"></script>
	<script type="text/javascript">
	var date = new Date();
	var d = date.getDate(),
		m = date.getMonth(),
		y = date.getFullYear();

	$('#calendar').fullCalendar({
		header: {
		  left: 'anterior,proximo hoje',
		  center: 'title',
		  right: 'month,agendaWeek,agendaDay'
		},
		buttonText: {
		  today: 'Hoje',
		  month: 'mês',
		  week: 'semana',
		  day: 'hoje'
		},
	 lang: 'pt-BR',
	   //Random default events
	  events: {!! getEvents() !!},
	  editable: true,
	  droppable: true, // this allows things to be dropped onto the calendar !!!
	  drop: function (date, allDay) { // this function is called when something is dropped

		// retrieve the dropped element's stored Event Object
		var originalEventObject = $(this).data('eventObject');

		// we need to copy it, so that multiple events don't have a reference to the same object
		var copiedEventObject = $.extend({}, originalEventObject);

		// assign it the date that was reported
		copiedEventObject.start = date;
		copiedEventObject.allDay = allDay;
		copiedEventObject.backgroundColor = $(this).css("background-color");
		copiedEventObject.borderColor = $(this).css("border-color");

		// render the event on the calendar
		// the last `true` argument determines if the event "sticks" (http://arshaw.com/fullcalendar/docs/event_rendering/renderEvent/)
		$('#calendar').fullCalendar('renderEvent', copiedEventObject, true);

		// is the "remove after drop" checkbox checked?
		if ($('#drop-remove').is(':checked')) {
		  // if so, remove the element from the "Draggable Events" list
		  $(this).remove();
		}

		},
	  eventClick: function(calEvent, jsEvent, view) {

			//alert('Event: ' + calEvent.title);
		  $('.modal-title').html('<i class="fa fa-calendar fa-fw"></i> '+calEvent.title);
		  $('.modal-body').html('<strong>Local: </strong>'+calEvent.place+'<br /> <strong>Descrição: </strong>'+calEvent.description);
		  $('#myModal').modal();
			// change the border color just for fun
			$(this).css('border-color', 'red');

		}
	});

	</script>
@endsection
