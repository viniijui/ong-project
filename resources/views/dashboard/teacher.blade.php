@extends('layouts.admin.main')

@section('content')
	<div class="row">
		<div class="col-md-6">
			<div class="well">
				<h2 class="h2-dashboard">Olá Professor {!! setFirstName(\Auth::user()->name) !!}</h2>
				<hr class="hr-teacher"/>
				<?php $class = getClassToday();?>
				@if ($class != false)
					<p><i class="fa fa-calendar fa-fw"></i> Aula de hoje: <strong>{{$class[0]->subject}}</strong></p>
					<p><i class="fa fa-map-marker fa-fw"></i> Local: <strong>{{$class[0]->place}}</strong></p>
				@else
					<p>Agenda livre, você não tem nenhuma aula hoje!</p>
				@endif
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-graduation-cap fa-fw"></i>
					Suas Matérias
				</div>
				<div class="panel-body">
					<?php $i=0; ?>
					@if ($subject)
						@foreach ($subject as $row)
							{!! $row->name." - ".weekDay($row->day) !!}
							@if (sizeof($subject) > 1 and $i < sizeof($subject)-1)
								<hr />
							@endif
							<?php $i++; ?>
						@endforeach
					@else
						Nenhuma matéria cadastrada
					@endif
				</div>
			</div>
			<div class="panel panel-default">
				<div class="panel-heading">
					<i class="fa fa-file-text-o fa-fw"></i>
					Próximas Provas
				</div>
				<div class="panel-body">
					@if (sizeof($nextTests) >= 1)
						<?php $i=0; ?>
						@foreach ($nextTests as $row)
							{!! $row->subject.' - '.$row->name.' - '.date('d/m/Y', strtotime($row->day)) !!}
							@if (strtotime(date('d/m/Y')) == strtotime($row->day))
								<a href="#" class="btn btn-xs btn-default">
									<i class="fa fa-fw fa-plus"></i>
									Cadastrar Notas
								</a>
							@endif
							@if (sizeof($nextTests) > 1 and $i < sizeof($nextTests)-1)
								<hr />
							@endif
							<?php $i++; ?>
						@endforeach
					@else
						<div class="well">
							Nenhuma prova para os próximos dias.
						</div>
					@endif
				</div>
			</div>
		</div>
		<div class="col-md-6">
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
				<div class="modal-header">
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
	  //Random default events
	  events: {!! getEvents() !!},
	  lang: 'pt-BR',
	  editable: false,
	  droppable: false, // this allows things to be dropped onto the calendar !!!
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
		$('.modal-title').html('<i class="fa fa-calendar fa-fw"></i>'+calEvent.title);
		$('.modal-body').html('<strong>Local: </strong>'+calEvent.place+'<br /> <strong>Descrição: </strong>'+calEvent.description);
		$('#myModal').modal();
        // change the border color just for fun
        $(this).css('border-color', 'red');

    }
	});

	</script>
@endsection
