@extends('business.layouts.app')

@section('title', 'Calendar')

@section('content')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>Calendar</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{route('business.calendar',$institution->portal)}}">Home</a>
            </li>
            <li class="active">
                <strong>Calendar</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-4">
        <div class="title-action">
            <a href="#" data-toggle="modal" data-target="#toDoRegistration" aria-expanded="false" class="btn btn-primary btn-outline"><i class="fa fa-plus"></i> New </a>
        </div>
    </div>
</div>

<div class="wrapper wrapper-content">
    <div class="row animated fadeInDown">

        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>{{$institution->name}} Calendar  </h5>

                </div>
                <div class="ibox-content">
                    <div id="calendar"></div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@include('business.layouts.modals.to_do_create')
@include('business.layouts.modals.to_do_edit')
@section('js')

<!-- Mainly scripts -->
<script src="{{ asset('inspinia') }}/js/plugins/fullcalendar/moment.min.js"></script>
<script src="{{ asset('inspinia') }}/js/jquery-2.1.1.js"></script>
<script src="{{ asset('inspinia') }}/js/bootstrap.min.js"></script>
<script src="{{ asset('inspinia') }}/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="{{ asset('inspinia') }}/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="{{ asset('inspinia') }}/js/inspinia.js"></script>
<script src="{{ asset('inspinia') }}/js/plugins/pace/pace.min.js"></script>

<!-- Full Calendar -->
<script src="{{ asset('inspinia') }}/js/plugins/fullcalendar/fullcalendar.min.js"></script>

<!-- Date picker -->
<script src="{{ asset('inspinia') }}/js/plugins/datapicker/bootstrap-datepicker.js"></script>

<!-- iCheck -->
<script src="{{ asset('inspinia') }}/js/plugins/iCheck/icheck.min.js"></script>

<!-- Clock picker -->
<script src="{{ asset('inspinia') }}/js/plugins/clockpicker/clockpicker.js"></script>


<script>
    $(document).ready(function() {
        // Set date

        var today = new Date();
        var dd = today.getDate();
        var mm = today.getMonth();
        var yyyy = today.getFullYear();
        var h = today.getHours();
        var m = today.getMinutes();
        mm ++;
        if (dd < 10){
            dd = '0'+dd;
        }
        if (mm < 10){
            mm = '0'+mm;
        }
        if (m < 10){
            m = '0'+m;
        }
        var date_today = mm + '/' + dd + '/' + yyyy;
        var time_curr = h + ':' + m;

        document.getElementById("start_date").value = date_today;
        document.getElementById("end_date").value = date_today;
        document.getElementById("start_time").value = time_curr;
        document.getElementById("end_time").value = time_curr;

        // Set time
    });

</script>

{{-- to do start time and end time --}}
<script>
    $(document).ready(function() {
        $('.enableEndDate').on('click',function(){

            if (document.getElementById('is_end_date').checked) {
                // enable end_time input
                document.getElementById("end_date").disabled = false;
            } else {
                // disable input
                document.getElementById("end_date").disabled = true;
            }

        });

        $('.enableEndTime').on('click',function(){
            if (document.getElementById('is_end_time').checked) {
                // enable end_time input
                document.getElementById("end_time").disabled = false;
            } else {
                // disable input
                document.getElementById("end_time").disabled = true;
            }
        });
    });

</script>




{{--  Calendar  --}}
<script>
    $(document).ready(function() {

            $('.i-checks').iCheck({
                checkboxClass: 'icheckbox_square-green',
                radioClass: 'iradio_square-green'
            });

        /* initialize the external events
         -----------------------------------------------------------------*/


        $('#external-events div.external-event').each(function() {

            // store data so the calendar knows to render an event upon drop
            $(this).data('event', {
                title: $.trim($(this).text()), // use the element's text as the event title
                stick: true // maintain when user navigates (see docs on the renderEvent method)
            });

            // make the event draggable using jQuery UI
            $(this).draggable({
                zIndex: 1111999,
                revert: true,      // will cause the event to go back to its
                revertDuration: 0  //  original position after the drag
            });

        });


        /* initialize the calendar
         -----------------------------------------------------------------*/
        var date = new Date();
        var d = date.getDate();
        var m = date.getMonth();
        var y = date.getFullYear();

        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            editable: true,
            droppable: true, // this allows things to be dropped onto the calendar
            drop: function() {
                // is the "remove after drop" checkbox checked?
                if ($('#drop-remove').is(':checked')) {
                    // if so, remove the element from the "Draggable Events" list
                    $(this).remove();
                }
            },

            eventClick: function(info) {
            console.log(info)
            console.log(info.title)
            var eventObj = info.event;
            console.log(eventObj)
            // alert('Clicked ' + info.title);

            $("#toDoEdit").modal("show");
            $("#toDoEdit .edit-task").text(info.event);

            name = info.title
            notes = info.notes
            start_date = info.start_date
            end_date = info.end_date
            is_end_date = info.is_end_date
            is_end_time = info.is_end_time
            start_time = info.start_time
            end_time = info.end_time

            console.log("start_time")
            console.log(start_time)

            let text = start_date;
            const myArray = text.split("-");

            console.log(myArray)
            console.log(myArray[1])

            mm = myArray[1];
            dd = myArray[2];
            yyyy = myArray[0];

            var date_today = mm + '/' + dd + '/' + yyyy;
            console.log(date_today)


            var today = new Date();
            var h = today.getHours();
            var m = today.getMinutes();
            var time_curr = h + ':' + m;


            document.getElementById("edit-task").value = name;
            document.getElementById("edit-notes").value = notes;
            document.getElementById("edit-start_date").value = date_today;

            if (is_end_date == '1'){

                document.getElementById('edit-is_end_date').checked = true;

                const myArray = end_date.split("-");
                edit_mm = myArray[1];
                edit_dd = myArray[2];
                edit_yyyy = myArray[0];

                var end_date_today = edit_mm + '/' + edit_dd + '/' + edit_yyyy;
                document.getElementById("edit-end_date").disabled = false;
                document.getElementById("edit-end_date").value = end_date_today;

            }


            if (start_time){

                document.getElementById('edit-is_end_time').checked = true;

                const myArray = start_time.split(":");
                edit_ss = myArray[0];
                edit_mm = myArray[1];

                var start_time_today = edit_ss + ':' + edit_mm;
                document.getElementById("edit-start_time").value = start_time_today;
            }else{
                document.getElementById("edit-start_time").value = time_curr;
            }


            if (end_time){
                const myArray = end_time.split(":");
                edit_ss = myArray[0];
                edit_mm = myArray[1];

                var end_time_today = edit_ss + ':' + edit_mm;
                document.getElementById("edit-end_time").value = end_time_today;
            }else{
                document.getElementById("edit-end_time").value = time_curr;
            }





            // <a href="#" data-toggle="modal" data-target="#toDoEdit" aria-expanded="false" class="btn btn-primary btn-outline"><i class="fa fa-plus"></i> New </a>


            // alert('Clicked ');
            // if (eventObj.url) {
            //     alert(
            //     'Clicked ' + eventObj.title + '.\n' +
            //     'Will open ' + eventObj.title + ' in a new tab'
            //     );

            //     // window.open(eventObj.url);

            //     info.jsEvent.preventDefault(); // prevents browser from following link in current tab.
            // } else {
            //     alert('Clicked ' + eventObj.title);
            // }
            },


            events: [
                @foreach ($toDos as $toDo)
                {

                    title: '{{$toDo->name}}',
                    notes: '{{$toDo->notes}}',
                    start_date: '{{$toDo->start_date}}',
                    end_date: '{{$toDo->end_date}}',
                    is_end_date: '{{$toDo->is_end_date}}',
                    is_end_time: '{{$toDo->is_end_time}}',
                    start_time: '{{$toDo->start_time}}',
                    end_time: '{{$toDo->end_time}}',

                    start: new Date({{$toDo->start_year}}, {{$toDo->start_month-1}}, {{$toDo->start_day}}, {{$toDo->start_hour}}, {{$toDo->start_minute}}),
                    @if($toDo->is_end_date == 1)
                        end: new Date({{$toDo->end_year}}, {{$toDo->end_month-1}}, {{$toDo->end_day}} @if($toDo->is_end_time == 1), {{$toDo->end_hour}}, {{$toDo->end_minute}} @endif),
                    @endif
                },
                @endforeach
            ]
        });


    });

</script>

{{-- to do start time and end time --}}
<script>
    $(document).ready(function() {
        $('.enableEndDate').on('click',function(){

            if (document.getElementById('edit-is_end_date').checked) {
                // enable end_time input
                document.getElementById("edit-end_date").disabled = false;
            } else {
                // disable input
                document.getElementById("edit-end_date").disabled = true;
            }

        });

        $('.enableEndTime').on('click',function(){
            if (document.getElementById('edit-is_end_time').checked) {
                // enable end_time input
                document.getElementById("edit-end_time").disabled = false;
            } else {
                // disable input
                document.getElementById("edit-end_time").disabled = true;
            }
        });
    });

</script>

{{-- Date and Time picker  --}}
<script>
$(document).ready(function(){

    $('#data_1 .input-group.date').datepicker({
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        calendarWeeks: true,
        autoclose: true
    });

    $('#data_2 .input-group.date').datepicker({
        startView: 1,
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        autoclose: true,
        format: "dd/mm/yyyy"
    });

    $('#data_3 .input-group.date').datepicker({
        startView: 2,
        todayBtn: "linked",
        keyboardNavigation: false,
        forceParse: false,
        autoclose: true
    });

    $('#data_4 .input-group.date').datepicker({
        minViewMode: 1,
        keyboardNavigation: false,
        forceParse: false,
        autoclose: true,
        todayHighlight: true
    });

    $('#data_5 .input-daterange').datepicker({
        keyboardNavigation: false,
        forceParse: false,
        autoclose: true
    });

    $('.clockpicker').clockpicker();

});

</script>
@endsection
