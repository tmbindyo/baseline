@extends('personal.layouts.app')

@section('title', 'Members')

@section('css')

    <link href="{{ asset('inspinia') }}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/dataTables/datatables.min.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/animate.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/css/style.css" rel="stylesheet">

@endsection



@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-9">
            <h2>Members</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('personal.calendar')}}">Home</a>
                </li>
                <li class="active">
                    <a href="{{route('personal.chama.show',$chama->id)}}"><strong>Chama</strong></a>
                </li>
                <li class="active">
                    <strong>Members</strong>
                </li>
            </ol>
        </div>
        <div class="col-md-3">
            <div class="title-action">
                <a href="{{route('personal.chama.member.create',$chama->id)}}" class="btn btn-success btn-outline"><i class="fa fa-plus"></i> Member </a>
            </div>
        </div>
    </div>


    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Members</h5>

                </div>
                <div class="ibox-content">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                                <tr>
                                    <th>Account</th>
                                    <th>Name</th>
                                    <th>Phone number</th>
                                    <th>Email</th>
                                    <th>Registerer</th>
                                    <th>Shares</th>
                                    <th>Member Role</th>
                                    <th>Status</th>
                                    <th class="text-right" width="13em" data-sort-ignore="true">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($members as $member)
                                    <tr class="gradeX">
                                        <td>
                                            @if($member->is_user == 1)
                                                Nihusubu User
                                            @else
                                                Nihusubu User
                                            @endif
                                        </td>
                                        <td>{{$member->name}}</td>
                                        <td>{{$member->phone_number}}</td>
                                        <td>{{$member->email}}</td>
                                        <td>{{$member->user->name}}</td>
                                        <td>{{$member->shares}}</td>
                                        <td>{{$member->chamaMemberRole->name}}</td>
                                        <td>
                                            <span class="label {{$member->status->label}}">{{$member->status->name}}</span>
                                        </td>
                                        <td class="text-right">
                                            <div class="btn-group">
                                                <a href="{{ route('personal.chama.member.show', ['chama_id'=>$chama->id, 'member_id'=>$member->id]) }}" class="btn-white btn btn-xs">View</a>
                                                <a href="{{ route('personal.chama.member.delete', ['chama_id'=>$chama->id, 'member_id'=>$member->id]) }}" class="btn-danger btn btn-xs">Delete</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Account</th>
                                    <th>Name</th>
                                    <th>Phone number</th>
                                    <th>Email</th>
                                    <th>Registerer</th>
                                    <th>Shares</th>
                                    <th>Member Role</th>
                                    <th>Status</th>
                                    <th class="text-right" width="13em" data-sort-ignore="true">Action</th>
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
                    {extend: 'excel', title: 'ExampleFile'},
                    {extend: 'pdf', title: 'ExampleFile'},

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
