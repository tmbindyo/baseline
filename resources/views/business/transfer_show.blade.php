@extends('business.layouts.app')

@section('title', 'Transfer Show')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-5">
            <h2>Transfer's</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('business.calendar',$institution->portal)}}">Home</a>
                </li>
                <li>
                    Accounting
                </li>
                <li class="active">
                    <a href="{{route('business.transfers',$institution->portal)}}">Transfers</a>
                </li>
                <li class="active">
                    <strong>Transfer Create</strong>
                </li>
            </ol>
        </div>
        <div class="col-md-7">
            <div class="title-action">
                @can('add expense')
                    <a href="{{route('business.transfer.expense.create',['portal'=>$institution->portal, 'id'=>$transfer->id])}}" class="btn btn-primary btn-outline"><i class="fa fa-plus"></i> Expense </a>
                @endcan
                @can('add to do')
                    <a data-toggle="modal" data-target="#toDoRegistration" class="btn btn-success btn-round btn-outline"> <span class="fa fa-plus"></span> To Do </a>
                @endcan
            </div>
        </div>
    </div>

    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-8">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Transfer Registration <small>Form</small></h5>

                    </div>

                    <div class="ibox-content">

                        <div class="row">
                            <div class="col-md-12">
                                <form method="post" action="{{ route('business.transfer.update',['portal'=>$institution->portal, 'id'=>$transfer->id]) }}" autocomplete="off" class="form-horizontal form-label-left">
                                @csrf

                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif

                                <div class="col-md-12">
                                    <br>
                                    <br>
                                    <div class="has-warning">
                                        @if ($errors->has('amount'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('amount') }}</strong>
                                            </span>
                                        @endif
                                        <input type="number" id="amount" name="amount" required="required" value="{{$transfer->amount}}" class="form-control input-lg {{ $errors->has('amount') ? ' is-invalid' : '' }}">
                                        <i>amount</i>
                                    </div>
                                    <br>
                                    <div class="has-warning" id="data_1">
                                        <div class="input-group date">
                                            @if ($errors->has('date'))
                                                <span class="invalid-feedback" style="display: block;" role="alert">
                                                    <strong>{{ $errors->first('date') }}</strong>
                                                </span>
                                            @endif
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                            <input type="text" required="required" name="date" class="form-control input-lg {{ $errors->has('date') ? ' is-invalid' : '' }}" value="{{$transfer->date}}">
                                        </div>
                                        <i>What is the start date of the transfer?</i>
                                        <span id="inputSuccess2Status4" class="sr-only">(success)</span>
                                    </div>
                                    <br>
                                    <div class="has-warning">
                                        @if ($errors->has('source_account'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('source_account') }}</strong>
                                            </span>
                                        @endif
                                        <select name="source_account" class="select2_demo_tag form-control input-lg {{ $errors->has('source_account') ? ' is-invalid' : '' }}" readonly>
                                            <option value="{{$transfer->sourceAccount->id}}">{{$transfer->sourceAccount->name}} [{{$transfer->sourceAccount->balance}}]</option>
                                        </select>
                                        <i>source account</i>
                                    </div>
                                    <br>
                                    <div class="has-warning">
                                        @if ($errors->has('destination_account'))
                                            <span class="invalid-feedback" style="display: block;" role="alert">
                                                <strong>{{ $errors->first('destination_account') }}</strong>
                                            </span>
                                        @endif
                                        <select name="destination_account" class="select2_demo_tag form-control input-lg {{ $errors->has('destination_account') ? ' is-invalid' : '' }}" readonly>
                                            <option value="{{$transfer->destinationAccount->id}}">{{$transfer->destinationAccount->name}} [{{$transfer->destinationAccount->balance}}]</option>
                                        </select>
                                        <i>destination account</i>
                                    </div>
                                    @can('edit transfer')
                                        <br>
                                        <hr>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-block btn-lg btn-outline btn-success mt-4">{{ __('Save') }}</button>
                                        </div>
                                    @endcan
                                </div>


                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{--  details  --}}
        <div class="row">
            <div class="col-lg-12">
                <div class="wrapper wrapper-content animated fadeInUp">
                    <div class="ibox">
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-lg-3">
                                    <div class="widget style1 navy-bg">
                                        <div class="row vertical-align">
                                            <div class="col-xs-3">
                                                <i class="fa fa-user fa-3x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <h3 class="font-bold">{{$transfer->user->name}}</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="widget style1 {{$transfer->status->label}}">
                                        <div class="row vertical-align">
                                            <div class="col-xs-3">
                                                <i class="fa fa-ellipsis-v fa-3x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <h3 class="font-bold">{{$transfer->status->name}}</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="widget style1 navy-bg">
                                        <div class="row vertical-align">
                                            <div class="col-xs-3">
                                                <i class="fa fa-plus-square fa-3x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <h3 class="font-bold">{{$transfer->created_at}}</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="widget style1 navy-bg">
                                        <div class="row vertical-align">
                                            <div class="col-xs-3">
                                                <i class="fa fa-scissors fa-3x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <h3 class="font-bold">{{$transfer->updated_at}}</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row m-t-sm">
                                <div class="col-lg-12">
                                <div class="panel white-panel">
                                <div class="panel-heading">
                                    <div class="panel-options">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a href="#expenses" data-toggle="tab">Expenses</a></li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="panel-body">

                                    <div class="tab-content">
                                        <div class="tab-pane active" id="expenses">
                                            @can('view expenses')
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                        <thead>
                                                        <tr>
                                                            <th>Recurring</th>
                                                            <th>Type</th>
                                                            <th>Expense #</th>
                                                            <th>Date</th>
                                                            <th>Created</th>
                                                            <th>Expense Account</th>
                                                            <th>Total</th>
                                                            <th>Paid</th>
                                                            <th>Status</th>
                                                            <th class="text-right" width="13em" data-sort-ignore="true">Action</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($transfer->expenses as $expense)
                                                            <tr class="gradeA">
                                                                <td>
                                                                    @if($expense->is_recurring == 1)
                                                                        <p><span class="badge badge-success">True</span></p>
                                                                    @else
                                                                        <p><span class="badge badge-success">False</span></p>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if($expense->is_order == 1)
                                                                        <p><a href="{{route('business.order.show',['portal'=>$institution->portal, 'id'=>$expense->order_id])}}" class="badge badge-success">Order</a></p>
                                                                    @elseif($expense->is_project == 1)
                                                                        <p><a href="{{route('business.project.show',['portal'=>$institution->portal, 'id'=>$expense->project->id])}}" class="badge badge-primary">Project {{$expense->project->name}}</a></p>
                                                                    @elseif($expense->is_project == 1)
                                                                        <p><a href="{{route('business.project.show',['portal'=>$institution->portal, 'id'=>$expense->project_id])}}" class="badge badge-primary">Design {{$expense->design->name}}</a></p>
                                                                    @elseif($expense->is_liability == 1)
                                                                        <p><a href="{{route('business.liability.show',['portal'=>$institution->portal, 'id'=>$expense->liability_id])}}" class="badge badge-primary">Liability</a></p>
                                                                    @elseif($expense->is_transfer == 1)
                                                                        <p><a href="{{route('business.transfer.show',['portal'=>$institution->portal, 'id'=>$expense->transfer_id])}}" class="badge badge-primary">Transfer</a></p>
                                                                    @elseif($expense->is_campaign == 1)
                                                                        <p><a href="{{route('business.campaign.show',['portal'=>$institution->portal, 'id'=>$expense->campaign_id])}}" class="badge badge-primary">Campaign</a></p>
                                                                    @elseif($expense->is_asset == 1)
                                                                        <p><a href="{{route('business.asset.show',['portal'=>$institution->portal, 'id'=>$expense->asset_id])}}" class="badge badge-primary">Asset</a></p>
                                                                    @else
                                                                        <p><span class="badge badge-info">None</span></p>
                                                                    @endif
                                                                </td>
                                                                <td>{{$expense->reference}}</td>
                                                                <td>{{$expense->date}}</td>
                                                                <td>{{$expense->created_at}}</td>
                                                                <td>{{$expense->expenseAccount->name}}</td>
                                                                <td>{{$expense->total}}</td>
                                                                <td>{{$expense->paid}}</td>
                                                                <td>
                                                                    <p><span class="label {{$expense->status->label}}">{{$expense->status->name}}</span></p>
                                                                </td>
                                                                <td class="text-right">
                                                                    <div class="btn-group">
                                                                        <a href="{{ route('business.expense.show', ['portal'=>$institution->portal, 'id'=>$expense->id]) }}" class="btn-success btn-outline btn btn-xs">View</a>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>
                                                        <tfoot>
                                                        <tr>
                                                            <th>Recurring</th>
                                                            <th>Type</th>
                                                            <th>Expense #</th>
                                                            <th>Date</th>
                                                            <th>Created</th>
                                                            <th>Expense Account</th>
                                                            <th>Total</th>
                                                            <th>Paid</th>
                                                            <th>Status</th>
                                                            <th class="text-right" width="13em" data-sort-ignore="true">Action</th>
                                                        </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            @endcan
                                        </div>
                                    </div>

                                </div>

                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{--    To Do's    --}}
        @can('view to dos')
            <div class="row m-t-lg">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>To Do's</h5>
                        </div>
                        <div class="">
                            <ul class="pending-to-do">
                                @foreach($pendingToDos as $pendingToDo)
                                    <li>
                                        <div>
                                            <small>{{$pendingToDo->due_date}}</small>
                                            <h4>{{$pendingToDo->name}}</h4>
                                            <p>{{$pendingToDo->notes}}.</p>
                                            @if($pendingToDo->is_design === 1)
                                                <p><span class="badge badge-primary">{{$pendingToDo->design->name}}</span></p>
                                            @endif
                                            <a href="{{route('business.to.do.set.in.progress',['portal'=>$institution->portal, 'id'=>$pendingToDo->id])}}"><i class="fa fa-arrow-circle-o-right "></i></a>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>

                            <ul class="in-progress-to-do">
                                @foreach($inProgressToDos as $inProgressToDo)
                                    <li>
                                        <div>
                                            <small>{{$inProgressToDo->due_date}}</small>
                                            <h4>{{$inProgressToDo->name}}</h4>
                                            <p>{{$inProgressToDo->notes}}.</p>
                                            @if($inProgressToDo->is_design === 1)
                                                <p><span class="badge badge-primary">{{$inProgressToDo->design->name}}</span></p>
                                            @endif
                                            <a href="{{route('business.to.do.set.completed',['portal'=>$institution->portal, 'id'=>$inProgressToDo->id])}}"><i class="fa fa-check "></i></a>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                            <ul class="overdue-to-do">
                                @foreach($overdueToDos as $overdueToDo)
                                    <li>
                                        <div>
                                            <small>{{$overdueToDo->due_date}}</small>
                                            <h4>{{$overdueToDo->name}}</h4>
                                            <p>{{$overdueToDo->notes}}.</p>
                                            @if($overdueToDo->is_design === 1)
                                                <p><span class="badge badge-primary">{{$overdueToDo->design->name}}</span></p>
                                            @endif
                                            @if($overdueToDo->status->name === "Pending")
                                                <a href="{{route('business.to.do.set.completed',['portal'=>$institution->portal, 'id'=>$overdueToDo->id])}}"><i class="fa fa-check-double "></i></a>
                                            @elseif($overdueToDo->status->name === "In progress")
                                                <a href="{{route('business.to.do.set.completed',['portal'=>$institution->portal, 'id'=>$overdueToDo->id])}}"><i class="fa fa-check-double "></i></a>
                                            @endif
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                            <ul class="completed-to-do">
                                @foreach($completedToDos as $completedToDo)
                                    <li>
                                        <div>
                                            <small>{{$completedToDo->due_date}}</small>
                                            <h4>{{$completedToDo->name}}</h4>
                                            <p>{{$completedToDo->notes}}.</p>
                                            @if($completedToDo->is_design === 1)
                                                <p><span class="badge badge-primary">{{$completedToDo->design->name}}</span></p>
                                            @endif
                                            <a href="{{route('business.to.do.delete',['portal'=>$institution->portal, 'id'=>$completedToDo->id])}}"><i class="fa fa-trash-o "></i></a>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                    </div>
                </div>
            </div>
        @endcan
    </div>


@endsection

@include('business.layouts.modals.to_do_create')

@section('js')


<!-- Mainly scripts -->
<script src="{{ asset('inspinia') }}/js/jquery-2.1.1.js"></script>
<script src="{{ asset('inspinia') }}/js/bootstrap.min.js"></script>
<script src="{{ asset('inspinia') }}/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="{{ asset('inspinia') }}/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- ChartJS-->
<script src="{{ asset('inspinia') }}/js/plugins/chartJs/Chart.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="{{ asset('inspinia') }}/js/inspinia.js"></script>
<script src="{{ asset('inspinia') }}/js/plugins/pace/pace.min.js"></script>

<!-- Chosen -->
<script src="{{ asset('inspinia') }}/js/plugins/chosen/chosen.jquery.js"></script>

<!-- blueimp gallery -->
<script src="{{ asset('inspinia') }}/js/plugins/blueimp/jquery.blueimp-gallery.min.js"></script>

<!-- DROPZONE -->
<script src="{{ asset('inspinia') }}/js/plugins/dropzone/dropzone.js"></script>

<!-- Switchery -->
<script src="{{ asset('inspinia') }}/js/plugins/switchery/switchery.js"></script>

<!-- Image cropper -->
<script src="{{ asset('inspinia') }}/js/plugins/cropper/cropper.min.js"></script>

<!-- Data picker -->
<script src="{{ asset('inspinia') }}/js/plugins/datapicker/bootstrap-datepicker.js"></script>

<!-- Date range use moment.js same as full calendar plugin -->
<script src="{{ asset('inspinia') }}/js/plugins/fullcalendar/moment.min.js"></script>

<!-- Date range picker -->
<script src="{{ asset('inspinia') }}/js/plugins/daterangepicker/daterangepicker.js"></script>

<script src="{{ asset('inspinia') }}/js/plugins/jeditable/jquery.jeditable.js"></script>

<script src="{{ asset('inspinia') }}/js/plugins/dataTables/datatables.min.js"></script>

<!-- JSKnob -->
<script src="{{ asset('inspinia') }}/js/plugins/jsKnob/jquery.knob.js"></script>

<!-- Input Mask-->
<script src="{{ asset('inspinia') }}/js/plugins/jasny/jasny-bootstrap.min.js"></script>

<!-- NouSlider -->
<script src="{{ asset('inspinia') }}/js/plugins/nouslider/jquery.nouislider.min.js"></script>

<!-- IonRangeSlider -->
<script src="{{ asset('inspinia') }}/js/plugins/ionRangeSlider/ion.rangeSlider.min.js"></script>

<!-- iCheck -->
<script src="{{ asset('inspinia') }}/js/plugins/iCheck/icheck.min.js"></script>

<!-- MENU -->
<script src="{{ asset('inspinia') }}/js/plugins/metisMenu/jquery.metisMenu.js"></script>

<!-- Clock picker -->
<script src="{{ asset('inspinia') }}/js/plugins/clockpicker/clockpicker.js"></script>

<!-- Select2 -->
<script src="{{ asset('inspinia') }}/js/plugins/select2/select2.full.min.js"></script>

<!-- TouchSpin -->
<script src="{{ asset('inspinia') }}/js/plugins/touchspin/jquery.bootstrap-touchspin.min.js"></script>

<!-- Masonry -->
<script src="{{ asset('inspinia') }}/js/plugins/masonary/masonry.pkgd.min.js"></script>

<!-- Chosen -->
<script src="{{ asset('inspinia') }}/js/plugins/chosen/chosen.jquery.js"></script>

<!-- Input Mask-->
<script src="{{ asset('inspinia') }}/js/plugins/jasny/jasny-bootstrap.min.js"></script>

<!-- Data picker -->
<script src="{{ asset('inspinia') }}/js/plugins/datapicker/bootstrap-datepicker.js"></script>

<!-- Switchery -->
<script src="{{ asset('inspinia') }}/js/plugins/switchery/switchery.js"></script>

<!-- iCheck -->
<script src="{{ asset('inspinia') }}/js/plugins/iCheck/icheck.min.js"></script>

<!-- MENU -->
<script src="{{ asset('inspinia') }}/js/plugins/metisMenu/jquery.metisMenu.js"></script>

<!-- Color picker -->
<script src="{{ asset('inspinia') }}/js/plugins/colorpicker/bootstrap-colorpicker.min.js"></script>

<!-- Clock picker -->
<script src="{{ asset('inspinia') }}/js/plugins/clockpicker/clockpicker.js"></script>

<!-- Image cropper -->
<script src="{{ asset('inspinia') }}/js/plugins/cropper/cropper.min.js"></script>

<!-- Date range use moment.js same as full calendar plugin -->
<script src="{{ asset('inspinia') }}/js/plugins/fullcalendar/moment.min.js"></script>

<!-- Date range picker -->
<script src="{{ asset('inspinia') }}/js/plugins/daterangepicker/daterangepicker.js"></script>

<!-- Select2 -->
<script src="{{ asset('inspinia') }}/js/plugins/select2/select2.full.min.js"></script>

<style>

    .grid .ibox {
        margin-bottom: 0;
    }

    .grid-item {
        margin-bottom: 25px;
        width: 300px;
    }
</style>

<script>
    $(window).load(function() {

        $('.grid').masonry({
            // options
            itemSelector: '.grid-item',
            columnWidth: 300,
            gutter: 25
        });

    });
</script>

<!-- Page-Level Scripts -->
<script>
    $(document).ready(function(){
        $('.dataTables-example').DataTable({
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                { extend: 'copy'},
                {extend: 'csv'},
                {extend: 'excel',
                    title: '{{$transfer->reference}} Expenses',
                    exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
                        }
                },
                {extend: 'pdf',
                    title: '{{$transfer->reference}} Expenses',
                    exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
                        }
                },

                {extend: 'print',
                    customize: function (win){
                        $(win.document.body).addClass('white-bg');
                        $(win.document.body).css('font-size', '10px');

                        $(win.document.body).find('table')
                            .addClass('compact')
                            .css('font-size', 'inherit');
                    }
                }
            ]

        });

        /* Init DataTables */
        var oTable = $('#editable').DataTable();

        /* Apply the jEditable handlers to the table */
        oTable.$('td').editable( '../example_ajax.php', {
            "callback": function( sValue, y ) {
                var aPos = oTable.fnGetPosition( this );
                oTable.fnUpdate( sValue, aPos[0], aPos[1] );
            },
            "submitdata": function ( value, settings ) {
                return {
                    "row_id": this.parentNode.getAttribute('id'),
                    "column": oTable.fnGetPosition( this )[2]
                };
            },

            "width": "90%",
            "height": "100%"
        } );


    });

    function fnClickAddRow() {
        $('#editable').dataTable().fnAddData( [
            "Custom row",
            "New row",
            "New row",
            "New row",
            "New row" ] );

    }
</script>

{{--  Get due date to populate   --}}
<script>
    $(document).ready(function() {
        // Set date
        console.log('var');
        var today = new Date();
        console.log(today);
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
        var date_today = mm + '/' + dd + '/' + yyyy;
        var time_curr = h + ':' + m;
        console.log(time_curr);
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

<script>
    $(document).ready(function(){

        var $image = $(".image-crop > img")
        $($image).cropper({
            aspectRatio: 1.618,
            preview: ".img-preview",
            done: function(data) {
                // Output the result data for cropping image.
            }
        });

        var $inputImage = $("#inputImage");
        if (window.FileReader) {
            $inputImage.change(function() {
                var fileReader = new FileReader(),
                    files = this.files,
                    file;

                if (!files.length) {
                    return;
                }

                file = files[0];

                if (/^image\/\w+$/.test(file.type)) {
                    fileReader.readAsDataURL(file);
                    fileReader.onload = function () {
                        $inputImage.val("");
                        $image.cropper("reset", true).cropper("replace", this.result);
                    };
                } else {
                    showMessage("Please choose an image file.");
                }
            });
        } else {
            $inputImage.addClass("hide");
        }

        $("#download").click(function() {
            window.open($image.cropper("getDataURL"));
        });

        $("#zoomIn").click(function() {
            $image.cropper("zoom", 0.1);
        });

        $("#zoomOut").click(function() {
            $image.cropper("zoom", -0.1);
        });

        $("#rotateLeft").click(function() {
            $image.cropper("rotate", 45);
        });

        $("#rotateRight").click(function() {
            $image.cropper("rotate", -45);
        });

        $("#setDrag").click(function() {
            $image.cropper("setDragMode", "crop");
        });

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

        var elem = document.querySelector('.js-switch');
        var switchery = new Switchery(elem, { color: '#1AB394' });

        var elem_2 = document.querySelector('.js-switch_2');
        var switchery_2 = new Switchery(elem_2, { color: '#ED5565' });

        var elem_3 = document.querySelector('.js-switch_3');
        var switchery_3 = new Switchery(elem_3, { color: '#1AB394' });

        var elem_18 = document.querySelector('.js-switch_18');
        var switchery_18 = new Switchery(elem_18, { color: '#1AB394' });

        var elem_19 = document.querySelector('.js-switch_19');
        var switchery_19 = new Switchery(elem_19, { color: '#1AB394' });

        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green'
        });

        $('.demo1').colorpicker();


        $('.clockpicker').clockpicker();

        $('input[name="daterange"]').daterangepicker();

        $('#reportrange span').html(moment().subtract(29, 'days').format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));

        $('#reportrange').daterangepicker({
            format: 'MM/DD/YYYY',
            startDate: moment().subtract(29, 'days'),
            endDate: moment(),
            minDate: '01/01/2012',
            maxDate: '12/31/2015',
            dateLimit: { days: 60 },
            showDropdowns: true,
            showWeekNumbers: true,
            timePicker: false,
            timePickerIncrement: 1,
            timePicker12Hour: true,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            opens: 'right',
            drops: 'down',
            buttonClasses: ['btn', 'btn-sm'],
            applyClass: 'btn-primary',
            cancelClass: 'btn-default',
            separator: ' to ',
            locale: {
                applyLabel: 'Submit',
                cancelLabel: 'Cancel',
                fromLabel: 'From',
                toLabel: 'To',
                customRangeLabel: 'Custom',
                daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa'],
                monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                firstDay: 1
            }
        }, function(start, end, label) {
            console.log(start.toISOString(), end.toISOString(), label);
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        });

        $(".select2_demo_1").select2();
        $(".select2_demo_2").select2();
        $(".select2_demo_tag").select2({
            placeholder: "Select Tags",
            allowClear: true
        });
        $(".select2_demo_project").select2({
            placeholder: "Select Project",
            allowClear: true
        });
        $(".select2_demo_category").select2({
            placeholder: "Select Categories",
            allowClear: true
        });

        $('.chosen-select').chosen({width: "100%"});


    });

    $(".dial").knob();

    $("#basic_slider").noUiSlider({
        start: 40,
        behaviour: 'tap',
        connect: 'upper',
        range: {
            'min':  20,
            'max':  80
        }
    });

    $("#range_slider").noUiSlider({
        start: [ 40, 60 ],
        behaviour: 'drag',
        connect: true,
        range: {
            'min':  20,
            'max':  80
        }
    });

    $("#drag-fixed").noUiSlider({
        start: [ 40, 60 ],
        behaviour: 'drag-fixed',
        connect: true,
        range: {
            'min':  20,
            'max':  80
        }
    });


</script>

<script>
    $(document).ready(function () {
        $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
        });
    });
</script>


<script>
    $(document).ready(function(){

        Dropzone.options.dropzone =
            {
                maxFilesize: 12,
                renameFile: function(file) {
                    var dt = new Date();
                    var time = dt.getTime();
                    return time+file.name;
                },
                acceptedFiles: ".jpeg,.jpg,.png,.gif",
                addRemoveLinks: true,
                timeout: 50000,
                removedfile: function(file)
                {
                    var name = file.upload.filename;
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                        },
                        type: 'POST',
                        url: '{{ url("image/delete") }}',
                        data: {filename: name},
                        success: function (data){
                            console.log("File has been successfully removed!!");
                        },
                        error: function(e) {
                            console.log(e);
                        }});
                    var fileRef;
                    return (fileRef = file.previewElement) != null ?
                        fileRef.parentNode.removeChild(file.previewElement) : void 0;
                },

                success: function(file, response)
                {
                    console.log(response);
                },
                error: function(file, response)
                {
                    return false;
                }
            };
    });
</script>


@endsection
