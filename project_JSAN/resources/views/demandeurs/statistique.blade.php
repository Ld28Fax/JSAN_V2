<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Calendrier</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="extern/plugins/fontawesome-free/css/all.min.css">
  <!-- fullCalendar -->
  <link rel="stylesheet" href="extern/plugins/fullcalendar/main.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="extern/dist/css/adminlte.min.css">
</head>
{{-- <body class="hold-transition sidebar-mini"> --}}


@extends('dashboard')
@section('content')
@php
$months = [
    1 => 'Janoary',
    2 => 'Febroary',
    3 => 'Martsa',
    4 => 'Aprily',
    5 => 'Mey',
    6 => 'Jona',
    7 => 'Jolay',
    8 => 'Aogositra',
    9 => 'Septambra',
    10 => 'Oktobra',
    11 => 'Novambra',
    12 => 'Desambra'
];
@endphp
<section class="content-header">
    <section class="content">
      <div class="container-fluid">
        {{-- Periode --}}
        <div>
            <h3>Période :</h3>
            <form action="/statistic" method="GET" class="text-center row mb-3" style="margin-left: 0.1%">
                @csrf
                <div class="form-group col-md-3">
                    <label for="debut">Début :</label>
                    <select name="debut_jour" class="form-control">
                        @for ($i = 1; $i <= 31; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                    <select name="debut_mois" class="form-control mt-2">
                        @foreach ($months as $num => $nom)
                            <option value="{{ $num }}">{{ $nom }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="form-group col-md-3">
                    <label for="fin">Fin :</label>
                    <select name="fin_jour" class="form-control">
                        @for ($i = 1; $i <= 31; $i++)
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                    <select name="fin_mois" class="form-control mt-2">
                        @foreach ($months as $num => $nom)
                            <option value="{{ $num }}">{{ $nom }}</option>
                        @endforeach
                    </select>
                </div>
        
                <button class="btn btn-success" style="margin-left: 2%;  " type="submit">Rechercher</button>
            </form>
        </div>
    
        <h4>Statistiques :</h4>
        <p>Nombre total de demandeurs : {{ $nombreDemandeurs }}</p>
        <p>Nombre de demandeurs actifs : {{ $nombreDemandeursActif }}</p>
        <p>Nombre de demandeurs inactifs : {{ $nombreDemandeursInactif }}</p>
        
        {{-- <h4>Demandes entre {{ $months[date('n', strtotime($debut))] }} {{ date('d', strtotime($debut)) }} et {{ $months[date('n', strtotime($fin))] }} {{ date('d', strtotime($fin)) }} :</h4> --}}
        <ul>
            @foreach($demandeurs as $demandeur)
                <li>{{ $demandeur->Nom }} - {{ $demandeur->created_at }}</li>
            @endforeach
        </ul>
    </section>




<!-- jQuery -->
<script src="extern/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="extern/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- jQuery UI -->
<script src="extern/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- AdminLTE App -->
<script src="extern/dist/js/adminlte.min.js"></script>
<!-- fullCalendar 2.2.5 -->
<script src="extern/plugins/moment/moment.min.js"></script>
<script src="extern/plugins/fullcalendar/main.js"></script>

<!-- Page specific script -->
<script>
  $(function () {

    /* initialize the external events
     -----------------------------------------------------------------*/
    function ini_events(ele) {
      ele.each(function () {

        // create an Event Object (https://fullcalendar.io/docs/event-object)
        // it doesn't need to have a start or end
        var eventObject = {
          title: $.trim($(this).text()) // use the element's text as the event title
        }

        // store the Event Object in the DOM element so we can get to it later
        $(this).data('eventObject', eventObject)

        // make the event draggable using jQuery UI
        $(this).draggable({
          zIndex        : 1070,
          revert        : true, // will cause the event to go back to its
          revertDuration: 0  //  original position after the drag
        })

      })
    }

    ini_events($('#external-events div.external-event'))

    /* initialize the calendar
     -----------------------------------------------------------------*/
    //Date for the calendar events (dummy data)
    var date = new Date()
    var d    = date.getDate(),
        m    = date.getMonth(),
        y    = date.getFullYear()

    var Calendar = FullCalendar.Calendar;
    var Draggable = FullCalendar.Draggable;

    var containerEl = document.getElementById('external-events');
    var checkbox = document.getElementById('drop-remove');
    var calendarEl = document.getElementById('calendar');

    // initialize the external events
    // -----------------------------------------------------------------

    new Draggable(containerEl, {
      locale: 'fr',
      itemSelector: '.external-event',
      eventData: function(eventEl) {
        return {
          title: eventEl.innerText,
          backgroundColor: window.getComputedStyle( eventEl ,null).getPropertyValue('background-color'),
          borderColor: window.getComputedStyle( eventEl ,null).getPropertyValue('background-color'),
          textColor: window.getComputedStyle( eventEl ,null).getPropertyValue('color'),
        };
      }
    });

    var calendar = new Calendar(calendarEl, {
      locale: 'fr',
      headerToolbar: {
        left  : 'prev,next today',
        center: 'title',
        right : 'dayGridMonth,timeGridWeek,timeGridDay'
      },
      themeSystem: 'bootstrap',
      //Random default events
      editable  : true,
      droppable : true, // this allows things to be dropped onto the calendar !!!
      drop      : function(info) {
        // is the "remove after drop" checkbox checked?
        if (checkbox.checked) {
          // if so, remove the element from the "Draggable Events" list
          info.draggedEl.parentNode.removeChild(info.draggedEl);
        }
      }
    });

    calendar.render();
    // $('#calendar').fullCalendar()

    /* ADDING EVENTS */
    var currColor = '#3c8dbc' //Red by default
    // Color chooser button
    $('#color-chooser > li > a').click(function (e) {
      e.preventDefault()
      // Save color
      currColor = $(this).css('color')
      // Add color effect to button
      $('#add-new-event').css({
        'background-color': currColor,
        'border-color'    : currColor
      })
    })
    $('#add-new-event').click(function (e) {
      e.preventDefault()
      // Get value and make sure it is not null
      var val = $('#new-event').val()
      if (val.length == 0) {
        return
      }

      // Create events
      var event = $('<div />')
      event.css({
        'background-color': currColor,
        'border-color'    : currColor,
        'color'           : '#fff'
      }).addClass('external-event')
      event.text(val)
      $('#external-events').prepend(event)

      // Add draggable funtionality
      ini_events(event)

      // Remove event from text input
      $('#new-event').val('')
    })
  })
</script>
@endsection
</body>
</html>
