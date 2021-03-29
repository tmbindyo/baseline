@extends('business.layouts.app')

@section('title', 'Warehouse')

@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-8">
            <h2>Warehouse</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('business.calendar',$institution->portal)}}">Home</a>
                </li>
                <li>
                    Inventory
                </li>
                <li>
                    <a href="{{route('business.warehouses',$institution->portal)}}">Warehouses</a>
                </li>
                <li class="active">
                    <strong>Warehouse</strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-4">
        </div>
    </div>


    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">
            <div class="col-lg-8 col-md-12">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>Warehouse Update <small>Form</small></h5>

                    </div>

                    <div class="ibox-content">

                        <div class="row">
                            <div class="col-md-12">
                                <form method="post" action="{{ route('business.warehouse.update',['portal'=>$institution->portal, 'id'=>$warehouse->id]) }}" autocomplete="off" class="form-horizontal form-label-left">
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
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="has-warning">
                                                @if ($errors->has('name'))
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $errors->first('name') }}</strong>
                                                    </span>
                                                @endif
                                                <input type="text" id="name" name="name" required="required" value="{{$warehouse->name}}" class="form-control input-lg">
                                                <i>name</i>
                                            </div>
                                        </div>
                                    </div>

                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="">
                                                @if ($errors->has('street'))
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $errors->first('street') }}</strong>
                                                    </span>
                                                @endif
                                                <input type="text" id="street" name="street" required="required" value="{{$warehouse->address->street}}" class="form-control input-lg {{ $errors->has('street') ? ' is-invalid' : '' }}">
                                                <i>street</i>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="">
                                                @if ($errors->has('town'))
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $errors->first('town') }}</strong>
                                                    </span>
                                                @endif
                                                <input type="text" name="town" id="town" class="form-control input-lg {{ $errors->has('town') ? ' is-invalid' : '' }}" value="{{$warehouse->address->town}}">
                                                <i>town</i>
                                            </div>
                                        </div>
                                    </div>

                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="">
                                                @if ($errors->has('po_box'))
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $errors->first('po_box') }}</strong>
                                                    </span>
                                                @endif
                                                <input type="text" id="po_box" name="po_box" required="required" value="{{$warehouse->address->po_box}}" class="form-control input-lg {{ $errors->has('po_box') ? ' is-invalid' : '' }}">
                                                <i>po box</i>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="">
                                                @if ($errors->has('postal_code'))
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $errors->first('postal_code') }}</strong>
                                                    </span>
                                                @endif
                                                <input type="text" name="postal_code" id="postal_code" class="form-control input-lg {{ $errors->has('postal_code') ? ' is-invalid' : '' }}" value="{{$warehouse->address->postal_code}}">
                                                <i>postal code</i>
                                            </div>
                                        </div>
                                    </div>

                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="">
                                                @if ($errors->has('address_line_1'))
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $errors->first('address_line_1') }}</strong>
                                                    </span>
                                                @endif
                                                <input type="text" id="address_line_1" name="address_line_1" required="required" value="{{$warehouse->address->address_line_1}}" class="form-control input-lg {{ $errors->has('address_line_1') ? ' is-invalid' : '' }}">
                                                <i>address line 1</i>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="">
                                                @if ($errors->has('address_line_2'))
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $errors->first('address_line_2') }}</strong>
                                                    </span>
                                                @endif
                                                <input type="text" name="address_line_2" id="address_line_2" class="form-control input-lg {{ $errors->has('address_line_2') ? ' is-invalid' : '' }}" value="{{$warehouse->address->address_line_2}}">
                                                <i>address line 2</i>
                                            </div>
                                        </div>
                                    </div>

                                    <br>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="">
                                                @if ($errors->has('email'))
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                                <input type="text" id="email" name="email" required="required" value="{{$warehouse->address->email}}" class="form-control input-lg {{ $errors->has('email') ? ' is-invalid' : '' }}">
                                                <i>email</i>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="">
                                                @if ($errors->has('phone_number'))
                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                        <strong>{{ $errors->first('phone_number') }}</strong>
                                                    </span>
                                                @endif
                                                <input type="text" name="phone_number" id="phone_number" class="form-control input-lg {{ $errors->has('phone_number') ? ' is-invalid' : '' }}" value="{{$warehouse->address->phone_number}}">
                                                <i>phone number</i>
                                            </div>
                                        </div>
                                    </div>

                                    @can('edit warehouse')
                                        <br>
                                        <hr>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-block btn-lg btn-outline btn-success mt-4">{{ __('UPDATE') }}</button>
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

        {{--  Warehouse details  --}}
        <div class="row">
            <div class="col-lg-3">
                <div class="widget style1 navy-bg">
                    <div class="row">
                        <div class="col-xs-4">
                            <i class="fa fa-cloud fa-5x"></i>
                        </div>
                        <div class="col-xs-8 text-right">
                            <span> Products </span>
                            <h2 class="font-bold">{{$warehouse->inventories_count}}</h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
                                                <h3 class="font-bold">{{$warehouse->user->name}}</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="widget style1 {{$warehouse->status->label}}">
                                        <div class="row vertical-align">
                                            <div class="col-xs-3">
                                                <i class="fa fa-ellipsis-v fa-3x"></i>
                                            </div>
                                            <div class="col-xs-9 text-right">
                                                <h3 class="font-bold">{{$warehouse->status->name}}</h3>
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
                                                <h3 class="font-bold">{{$warehouse->created_at}}</h3>
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
                                                <h3 class="font-bold">{{$warehouse->updated_at}}</h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                            {{--  <div class="row">
                                <div class="col-lg-12">
                                    <dl class="dl-horizontal">
                                        <dt>Volume:</dt>
                                        <dd>
                                            <div class="progress progress-striped active m-b-sm">
                                                <div style="width: 60%;" class="progress-bar"></div>
                                            </div>
                                            <small>Project completed in <strong>60%</strong>. Remaining close the project, sign a contract and invoice.</small>
                                        </dd>
                                    </dl>
                                </div>
                            </div>  --}}
                            <div class="row m-t-sm">
                                <div class="col-lg-12">
                                    <div class="panel white-panel">
                                        <div class="panel-heading">
                                            <div class="panel-options">
                                                <ul class="nav nav-tabs">
                                                    <li class="active"><a href="#inventory" data-toggle="tab">Inventory</a></li>
                                                    <li class=""><a href="#adjustments" data-toggle="tab">Adjustments</a></li>
                                                    <li class=""><a href="#source-transfer-orders" data-toggle="tab">Source Transfer orders</a></li>
                                                    <li class=""><a href="#destination-transfer-orders" data-toggle="tab">Destination Transfer orders</a></li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="panel-body">

                                            <div class="tab-content">
                                                <div class="tab-pane active" id="inventory">
                                                    @can('view stock')
                                                        <div class="table-responsive">
                                                            <table class="table table-striped table-bordered table-hover dataTables-inventory" >
                                                                <thead>
                                                                <tr>
                                                                    <th>Product</th>
                                                                    <th>Quantity</th>
                                                                    <th>Last Updated</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>

                                                                @foreach($inventories as $inventory)
                                                                    <tr class="gradeX">
                                                                        <td>{{$inventory->product->name}}</td>
                                                                        <td>{{$inventory->quantity}}
                                                                        </td>
                                                                        <td>{{$inventory->updated_at}}</td>
                                                                    </tr>
                                                                @endforeach

                                                                </tbody>
                                                                <tfoot>
                                                                <tr>
                                                                    <th>Product</th>
                                                                    <th>Quantity</th>
                                                                    <th>Last Updated</th>
                                                                </tr>
                                                                </tfoot>
                                                            </table>
                                                        </div>
                                                    @endcan
                                                </div>
                                                <div class="tab-pane" id="adjustments">
                                                    @can('view inventory adjustments')
                                                        <div class="table-responsive">
                                                            <table class="table table-striped table-bordered table-hover dataTables-adjustments" >
                                                                <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Date</th>
                                                                    <th>Reason</th>
                                                                    <th>Description</th>
                                                                    <th>Account</th>
                                                                    <th>Type</th>
                                                                    <th class="text-right" width="13em" data-sort-ignore="true">Action</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach($inventoryAdjustments as $inventoryAdjustment)
                                                                    <tr class="gradeX">
                                                                        <td>
                                                                            {{$inventoryAdjustment->inventory_adjustment_number}}
                                                                        </td>
                                                                        <td>
                                                                            {{$inventoryAdjustment->created_at}}
                                                                        </td>
                                                                        <td>
                                                                            {{$inventoryAdjustment->reason->name}}
                                                                        </td>
                                                                        <td>
                                                                            {{$inventoryAdjustment->description}}
                                                                        </td>
                                                                        <td>
                                                                            @isset($inventoryAdjustment->account->name)
                                                                                {{$inventoryAdjustment->account->name}}
                                                                            @endisset
                                                                        </td>
                                                                        <td>
                                                                        @if($inventoryAdjustment->is_value_adjustment == 1)
                                                                                <p><span class="label label-info">Value</span></p>
                                                                        @else
                                                                                <p><span class="label label-info">Quantity</span></p>
                                                                        @endif
                                                                        </td>
                                                                        <td>
                                                                            @can('view inventory adjustment')
                                                                                <a href="{{ route('business.inventory.adjustment.show', ['portal'=>$institution->portal, 'id'=>$inventoryAdjustment->id]) }}" class="btn-success btn-outline btn btn-xs">View</a>
                                                                            @endcan
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                                </tbody>
                                                                <tfoot>
                                                                    <th>#</th>
                                                                    <th>Date</th>
                                                                    <th>Reason</th>
                                                                    <th>Description</th>
                                                                    <th>Account</th>
                                                                    <th>Type</th>
                                                                    <th class="text-right" width="13em" data-sort-ignore="true">Action</th>
                                                                </tfoot>
                                                            </table>
                                                        </div>
                                                    @endcan
                                                </div>
                                                <div class="tab-pane" id="source-transfer-orders">
                                                    @can('view transfer orders')
                                                        <div class="table-responsive">
                                                            <table class="table table-striped table-bordered table-hover dataTables-source-transfer-orders" >
                                                                <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Date</th>
                                                                    <th>Reason</th>
                                                                    <th>Destination</th>
                                                                    <th class="text-right" width="13em" data-sort-ignore="true">Action</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach($sourceTransferOrders as $sourceTransferOrder)
                                                                    <tr class="gradeX">
                                                                        <td>{{$sourceTransferOrder->transfer_order_number}}</td>
                                                                        <td>
                                                                            {{$sourceTransferOrder->date}}
                                                                        </td>
                                                                        <td>
                                                                            {{$sourceTransferOrder->reason}}
                                                                        </td>
                                                                        <td>
                                                                            {{$sourceTransferOrder->destinationWarehouse->name}}
                                                                        </td>
                                                                        <td>
                                                                            @can('view transfer order')
                                                                                <a href="{{ route('business.transfer.order.show', ['portal'=>$institution->portal, 'id'=>$sourceTransferOrder->id]) }}" class="btn-success btn-outline btn btn-xs">View</a>
                                                                            @endcan
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                                </tbody>
                                                                <tfoot>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Date</th>
                                                                    <th>Reason</th>
                                                                    <th>Destination</th>
                                                                    <th class="text-right" width="13em" data-sort-ignore="true">Action</th>
                                                                </tr>
                                                                </tfoot>
                                                            </table>
                                                        </div>
                                                    @endcan
                                                </div>
                                                <div class="tab-pane" id="destination-transfer-orders">
                                                    @can('view transfer orders')
                                                        <div class="table-responsive">
                                                            <table class="table table-striped table-bordered table-hover dataTables-destination-transfer-orders" >
                                                                <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Date</th>
                                                                    <th>Reason</th>
                                                                    <th>Destination</th>
                                                                    <th class="text-right" width="13em" data-sort-ignore="true">Action</th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                @foreach($destinationTransferOrders as $destinationTransferOrder)
                                                                    <tr class="gradeX">
                                                                        <td>{{$destinationTransferOrder->transfer_order_number}}</td>
                                                                        <td>
                                                                            {{$destinationTransferOrder->date}}
                                                                        </td>
                                                                        <td>
                                                                            {{$destinationTransferOrder->reason}}
                                                                        </td>
                                                                        <td>
                                                                            {{$destinationTransferOrder->sourceWarehouse->name}}
                                                                        </td>
                                                                        <td>
                                                                            @can('view transfer order')
                                                                                <a href="{{ route('business.transfer.order.show', ['portal'=>$institution->portal, 'id'=>$destinationTransferOrder->id]) }}" class="btn-success btn-outline btn btn-xs">View</a>
                                                                            @endcan
                                                                        </td>
                                                                    </tr>
                                                                @endforeach
                                                                </tbody>
                                                                <tfoot>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>Date</th>
                                                                    <th>Reason</th>
                                                                    <th>Destination</th>
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

    </div>


@endsection

@section('js')

<!-- Mainly scripts -->
<script src="{{ asset('inspinia') }}/js/jquery-2.1.1.js"></script>
<script src="{{ asset('inspinia') }}/js/bootstrap.min.js"></script>
<script src="{{ asset('inspinia') }}/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="{{ asset('inspinia') }}/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<script src="{{ asset('inspinia') }}/js/plugins/jeditable/jquery.jeditable.js"></script>

<script src="{{ asset('inspinia') }}/js/plugins/dataTables/datatables.min.js"></script>

<!-- Custom and plugin javascript -->
<script src="{{ asset('inspinia') }}/js/inspinia.js"></script>
<script src="{{ asset('inspinia') }}/js/plugins/pace/pace.min.js"></script>

<!-- slick carousel-->
<script src="{{ asset('inspinia') }}/js/plugins/slick/slick.min.js"></script>

<script>
    $(document).ready(function(){


        $('.product-images').slick({
            dots: true
        });

    });

</script>

<!-- Page-Level Scripts -->
<script>
    $(document).ready(function(){
        $('.dataTables-inventory').DataTable({
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                { extend: 'copy'},
                {extend: 'csv'},
                {extend: 'excel',
                    title: '{{$warehouse->name}} Inventory',
                    exportOptions: {
                            columns: [ 0, 1, 2 ]
                        }
                },
                {extend: 'pdf',
                    title: '{{$warehouse->name}} Inventory',
                    exportOptions: {
                            columns: [ 0, 1, 2 ]
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
<script>
    $(document).ready(function(){
        $('.dataTables-adjustments').DataTable({
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                { extend: 'copy'},
                {extend: 'csv'},
                {extend: 'excel',
                    title: '{{$warehouse->name}} Adjustments',
                    exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5 ]
                        }
                },
                {extend: 'pdf',
                    title: '{{$warehouse->name}} Adjustments',
                    exportOptions: {
                            columns: [ 0, 1, 2, 3, 4, 5 ]
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
<script>
    $(document).ready(function(){
        $('.dataTables-source-transfer-orders').DataTable({
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                { extend: 'copy'},
                {extend: 'csv'},
                {extend: 'excel', title: '{{$warehouse->name}} Source Transfer Orders',
                    exportOptions: {
                            columns: [ 0, 1, 2, 3 ]
                        }
                },
                {extend: 'pdf', title: '{{$warehouse->name}} Source Transfer Orders',
                    exportOptions: {
                            columns: [ 0, 1, 2, 3 ]
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
<script>
    $(document).ready(function(){
        $('.dataTables-destination-transfer-orders').DataTable({
            dom: '<"html5buttons"B>lTfgitp',
            buttons: [
                { extend: 'copy'},
                {extend: 'csv'},
                {extend: 'excel',
                    title: '{{$warehouse->name}} Destination Transfer Orders',
                    exportOptions: {
                            columns: [ 0, 1, 2, 3 ]
                        }
                },
                {extend: 'pdf',
                    title: '{{$warehouse->name}} Destination Transfer Orders',
                    exportOptions: {
                            columns: [ 0, 1, 2, 3 ]
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

@endsection
