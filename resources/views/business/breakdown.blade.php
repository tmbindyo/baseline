@extends('business.layouts.app')

@section('title', 'Categories')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-9">
            <h2>Categories</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('business.calendar',$institution->portal)}}">Home</a>
                </li>
                <li>
                    Settings
                </li>
                <li class="active">
                    <strong>Categories</strong>
                </li>
            </ol>
        </div>
        <div class="col-md-3">
            <div class="title-action">
                @can('add category')
                    <a data-toggle="modal" data-target="#categoryRegistration" class="btn btn-primary pull-right btn-round btn-outline"> <span class="fa fa-plus"></span> Category </a>
{{--                    <a href="{{route('business.category.create',$institution->portal)}}" class="btn btn-primary btn-outline"><i class="fa fa-plus"></i> Category </a>--}}
                @endcan
            </div>
        </div>
    </div>


    <div class="wrapper wrapper-content animated fadeInRight">
        {{-- categorys --}}
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Categories</h5>

                    </div>
                    <div class="ibox-content">

                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                <thead>
                                    <tr>
                                        <th>Name</th>

                                        <th>Adjustment</th>
                                        <th>Total</th>
                                        <th>Paid</th>
                                        <th>Balance</th>

                                        <th>User</th>
                                        <th>Status</th>
                                        <th class="text-right" width="80em" data-sort-ignore="true">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($categories as $category)
                                        <tr class="gradeX">
                                            <td>{{$category->name}}</td>

                                            <td>
                                                @if($category->categoryTotalAdjustment->count() > 0)
                                                    {{$category->categoryTotalAdjustment[0]->adjustments}}
                                                @else
                                                    0
                                                @endif
                                            </td>
                                            <td>
                                                @if($category->categoryTotalTotal->count() > 0)
                                                    {{$category->categoryTotalTotal[0]->totals}}</td>
                                                @else
                                                    0
                                                @endif
                                            <td>
                                                @if($category->categoryTotalPaid->count() > 0)
                                                    {{$category->categoryTotalPaid[0]->paid}}</td>
                                                @else
                                                    0
                                                @endif
                                            <td>
                                                @if($category->categoryTotalBalance->count() > 0)
                                                    {{$category->categoryTotalBalance[0]->balance}}</td>
                                                @else
                                                    0
                                                @endif

                                            <td>{{$category->user->name}}</td>
                                            <td>
                                                <span class="label {{$category->status->label}}">{{$category->status->name}}</span>
                                            </td>
                                            <td class="text-right">
                                                <div class="btn-group">
                                                    @can('view category')
                                                        <a href="{{ route('business.category.show',['portal'=>$institution->portal, 'id'=>$category->id]) }}" class="btn-white btn btn-xs">View</a>
                                                    @endcan
                                                    @can('delete category')
                                                        <a href="{{ route('business.category.delete',['portal'=>$institution->portal, 'id'=>$category->id]) }}" class="btn-danger btn btn-xs">Delete</a>
                                                    @endcan
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Name</th>

                                        <th>Sub Total</th>
                                        <th>Adjustment</th>
                                        <th>Totals</th>
                                        <th>Paid</th>
                                        <th>Balance</th>

                                        <th>User</th>
                                        <th>Status</th>
                                        <th class="text-right" width="80em" data-sort-ignore="true">Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>


@endsection

@include('business.layouts.modals.category_create')

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

    <!-- Page-Level Scripts -->
    <script>
        $(document).ready(function(){
            $('.dataTables-example').DataTable({
                dom: '<"html5buttons"B>lTfgitp',
                buttons: [
                    { extend: 'copy'},
                    {extend: 'csv'},
                    {extend: 'excel',
                        title: 'Categories',
                        exportOptions: {
                            columns: [ 0, 1, 2, 3 ]
                        }
                    },
                    {extend: 'pdf',
                        title: 'Categories',
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

    </script>

@endsection
