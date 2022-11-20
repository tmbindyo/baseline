@extends('business.layouts.app')

@section('title', 'Settings')

@section('content')

    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-9">
            <h2>Settings</h2>
            <ol class="breadcrumb">
                <li>
                    <a href="{{route('business.calendar',$institution->portal)}}">Home</a>
                </li>
                <li class="active">
                    <strong>Settings</strong>
                </li>
            </ol>
        </div>
    </div>


    <div class="wrapper wrapper-content animated fadeInRight">

        <div class="row">
            <div class="col-lg-12">
                <div class="tabs-container">
                    <div class="tabs-top">
                        <ul class="nav nav-tabs">
                            <li class="@if(session()->get( 'active' ) == 'institution') active @elseif(is_null(session()->get( 'active' ))) active @endif"><a data-toggle="tab" href="#institution">Institution</a></li>
                            <li class="@if(session()->get( 'active' ) == 'roles') active @endif"><a data-toggle="tab" href="#roles">Roles</a></li>
                            <li class="@if(session()->get( 'active' ) == 'users') active @endif"><a data-toggle="tab" href="#users">Users</a></li>
                        </ul>
                        <div class="tab-content ">
                            <div id="institution" class="tab-pane @if(session()->get( 'active' ) == 'institution') active @elseif(is_null(session()->get( 'active' ))) active @endif">
                                <div class="panel-body">

                                    <div class="">
                                        <div class="col-md-12">
                                            <form method="post" action="{{ route('business.institution.update',['portal'=>$institution->portal, 'id'=>$institution->id]) }}" autocomplete="off" class="form-horizontal form-label-left">
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
                                                        <div class="col-lg-8">
                                                            <div class="has-warning">
                                                                @if ($errors->has('name'))
                                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                                <strong>{{ $errors->first('name') }}</strong>
                                                            </span>
                                                                @endif
                                                                <input type="text" id="name" name="name" required="required" value="{{$institution->name}}" class="form-control input-lg">
                                                                <i>name</i>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="has-warning">
                                                                @if ($errors->has('portal'))
                                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                                <strong>{{ $errors->first('portal') }}</strong>
                                                            </span>
                                                                @endif
                                                                <input type="text" id="portal" name="portal" required="required" value="{{$institution->portal}}" class="form-control input-lg" readonly>
                                                                <i>portal</i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="has-warning">
                                                                @if ($errors->has('email'))
                                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                                <strong>{{ $errors->first('email') }}</strong>
                                                            </span>
                                                                @endif
                                                                <input type="email" id="email" name="email" required="required" value="{{$institution->email}}" class="form-control input-lg">
                                                                <i>email</i>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="has-warning">
                                                                @if ($errors->has('phone_number'))
                                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                                <strong>{{ $errors->first('"phone_number') }}</strong>
                                                            </span>
                                                                @endif
                                                                <input type="text" id="phone_number" name="phone_number" data-mask="(999) 999-999-999" required="required" value="{{$institution->phone_number}}" class="form-control input-lg">
                                                                <i>phone number</i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="has-warning">
                                                                @if ($errors->has('address_line_1'))
                                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                                <strong>{{ $errors->first('address_line_1') }}</strong>
                                                            </span>
                                                                @endif
                                                                <input type="text" id="address_line_1" name="address_line_1" required="required" value="{{$institution->address->address_line_1}}" class="form-control input-lg">
                                                                <i>address line 1</i>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="has-warning">
                                                                @if ($errors->has('address_line_2'))
                                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                                <strong>{{ $errors->first('address_line_2') }}</strong>
                                                            </span>
                                                                @endif
                                                                <input type="text" id="address_line_2" name="address_line_2" value="{{$institution->address->address_line_2}}" class="form-control input-lg">
                                                                <i>address line 2</i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-lg-4">
                                                            <div class="has-warning">
                                                                @if ($errors->has('street'))
                                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                                <strong>{{ $errors->first('street') }}</strong>
                                                            </span>
                                                                @endif
                                                                <input type="text" id="street" name="street" value="{{$institution->address->street}}" class="form-control input-lg">
                                                                <i>street</i>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="has-warning">
                                                                @if ($errors->has('city'))
                                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                                <strong>{{ $errors->first('city') }}</strong>
                                                            </span>
                                                                @endif
                                                                <input type="text" id="city" name="city" required="required" value="{{$institution->address->town}}" class="form-control input-lg">
                                                                <i>city</i>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <div class="has-warning">
                                                                @if ($errors->has('postal_code'))
                                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                                <strong>{{ $errors->first('postal_code') }}</strong>
                                                            </span>
                                                                @endif
                                                                <input type="text" id="postal_code" name="postal_code" required="required" value="{{$institution->address->postal_code}}" class="form-control input-lg">
                                                                <i>postal code</i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="has-warning">
                                                                @if ($errors->has('currency'))
                                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                                <strong>{{ $errors->first('currency') }}</strong>
                                                            </span>
                                                                @endif
                                                                <select name="currency" data-placeholder="Choose a currency..." class="chosen-select" {{ $errors->has('currency') ? ' is-invalid' : '' }}  tabindex="2">
                                                                    <option></option>
                                                                    @foreach($currencies as $currency)
                                                                        <option @if($institution->currency->id == $currency->id) selected @endif value="{{$currency->id}}">{{$currency->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                                <i>currency</i>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="has-warning">
                                                                @if ($errors->has('agent'))
                                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                                        <strong>{{ $errors->first('agent') }}</strong>
                                                                    </span>
                                                                @endif
                                                                <select name="agent" data-placeholder="agent..." class="chosen-select {{ $errors->has('agent') ? ' is-invalid' : '' }}"  tabindex="2">
                                                                    @if($institution->is_agent_signup)
                                                                        <option value="">Nihu00{{$institution->agent->code}}</option>
                                                                    @endif
                                                                </select>
                                                                <i>agent</i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row">
                                                        <div class="col-lg-2">
                                                            <div class="has-warning">
                                                                @if ($errors->has('sale_format'))
                                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                                        <strong>{{ $errors->first('sale_format') }}</strong>
                                                                    </span>
                                                                @endif
                                                                <input name="is_sale_random" id="is_sale_random" type="checkbox" @if($institution->is_sale_random) checked @endif class="enablerandomReference {{ $errors->has('is_sale_random') ? ' is-invalid' : '' }}" />
                                                                <i>sale reference random</i>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="has-warning">
                                                                @if ($errors->has('sale_format'))
                                                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                                                        <strong>{{ $errors->first('sale_format') }}</strong>
                                                                    </span>
                                                                @endif
                                                                <input type="text" id="sale_format" name="sale_format" required="required" placeholder="Sale format" value="{{$institution->sale_format}}" class="form-control input-lg" @if($institution->is_sale_random) disabled @endif>
                                                                <i>sale format</i>
                                                            </div>
                                                        </div>
                                                    </div>


                                                    @can('edit institution')
                                                        <hr>

                                                        <div class="text-center">
                                                            <button type="submit" class="btn btn-block btn-lg btn-outline btn-success mt-4">{{ __('Update') }}</button>
                                                        </div>
                                                    @endcan
                                                </div>


                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="roles" class="tab-pane @if(session()->get( 'active' ) == 'roles') active @endif">
                                <div class="panel-body">

                                    @can('add role')
                                        <a data-toggle="modal" data-target="#roleRegistration" class="btn btn-primary pull-right btn-round btn-outline"> <span class="fa fa-plus"></span> Role </a>
                                    @endcan
                                    <br>
                                    <br>
                                    <br>

                                    @can('view roles')
                                        {{-- roles --}}
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th class="text-right" width="70em" data-sort-ignore="true">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($roles as $role)
                                                    <tr class="gradeX">
                                                        <td>{{str_replace($institution->portal.' ', "", $role->name)}}</td>
                                                        <td class="text-right">
                                                            <div class="btn-group">
                                                                @can('view role')
                                                                    <a href="{{ route('business.role.show', ['portal'=>$institution->portal, 'id'=>encrypt($role->id)]) }}" class="btn-white btn btn-xs">View</a>
                                                                @endcan
                                                                @if(str_replace($institution->portal.' ', "", $role->name) != "admin" )
                                                                    @can('delete role')
                                                                        <a href="{{ route('business.role.delete', ['portal'=>$institution->portal, 'id'=>$role->id]) }}" class="btn-danger btn btn-xs">Delete</a>
                                                                    @endcan
                                                                @endif
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <th>Name</th>
                                                    <th class="text-right" width="70em" data-sort-ignore="true">Action</th>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    @endcan

                                </div>
                            </div>
                            <div id="users" class="tab-pane @if(session()->get( 'active' ) == 'users') active @endif">
                                <div class="panel-body">

                                    @can('add user')
                                        <a data-toggle="modal" data-target="#userRegistration" class="btn btn-primary pull-right btn-round btn-outline"> <span class="fa fa-plus"></span> User </a>
                                    @endcan
                                    <br>
                                    <br>
                                    <br>

                                    @can('view users')
                                        {{-- users --}}
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                <thead>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>User</th>
                                                    <th>Roles</th>
                                                    <th>Status</th>
                                                    <th class="text-right" width="70em" data-sort-ignore="true">Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($users as $institutionUser)
                                                    <tr class="gradeX">
                                                        <td>{{$institutionUser->user->name}}</td>
                                                        <td>{{$institutionUser->user->email}}</td>
                                                        <td>
                                                            @foreach($institutionUser->user->roles as $role)
                                                                @if(in_array($role->name, $roleNames))
                                                                    <label class="label label-default">{{$role->name}}</label>
                                                                @endif
                                                            @endforeach
                                                        </td>
                                                        <td>{{ $institutionUser->created_at->format('d/m/Y H:i') }}</td>
                                                        <td class="text-right">
                                                            <div class="btn-group">
                                                                @can('view user')
                                                                    <a href="{{ route('business.user.show', ['portal'=>$institution->portal, 'id'=>encrypt($institutionUser->user->id)]) }}" class="btn-white btn btn-xs">View</a>
                                                                @endcan
                                                                @can('delete user')
                                                                    <a href="{{ route('business.user.delete', ['portal'=>$institution->portal, 'id'=>encrypt($institutionUser->user->id)]) }}" class="btn-danger btn btn-xs">Delete</a>
                                                                @endcan
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                                <tfoot>
                                                <tr>
                                                    <th>Name</th>
                                                    <th>User</th>
                                                    <th>Roles</th>
                                                    <th>Status</th>
                                                    <th class="text-right" width="70em" data-sort-ignore="true">Action</th>
                                                </tr>
                                                </tfoot>
                                            </table>
                                        </div>

                                        {{-- deleted users --}}
                                        @if($deletedUsers->count())
                                            <h3 class="text-center">Deleted Users</h3>
                                            <br>
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered table-hover dataTables-example" >
                                                    <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>User</th>
                                                        <th>Status</th>
                                                        <th class="text-right" width="80em" data-sort-ignore="true">Action</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($deletedUsers as $institutionUser)
                                                        <tr class="gradeX">
                                                            <td>{{$institutionUser->user->name}}</td>
                                                            <td>{{$institutionUser->user->email}}</td>
                                                            <td>{{ $institutionUser->created_at->format('d/m/Y H:i') }}</td>
                                                            <td class="text-right">
                                                                <div class="btn-group">
                                                                    @can('view user')
                                                                        <a href="{{ route('business.user.show', ['portal'=>$institution->portal, 'id'=>$institutionUser->user->id]) }}" class="btn-white btn btn-xs">View</a>
                                                                    @endcan
                                                                    @can('delete user')
                                                                        <a href="{{ route('business.user.restore', ['portal'=>$institution->portal, 'id'=>$institutionUser->user->id]) }}" class="btn-warning btn btn-xs">Delete</a>
                                                                    @endcan
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>User</th>
                                                        <th>Status</th>
                                                        <th class="text-right" width="80em" data-sort-ignore="true">Action</th>
                                                    </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        @endif
                                    @endcan

                                </div>
                            </div>




                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

    <br>

@endsection

@include('business.layouts.modals.role_create')
@include('business.layouts.modals.user_add')


@section('js')


    <!-- Mainly scripts -->
    <script src="{{ asset('inspinia') }}/js/jquery-2.1.1.js"></script>
    <script src="{{ asset('inspinia') }}/js/bootstrap.min.js"></script>
    <script src="{{ asset('inspinia') }}/js/plugins/metisMenu/jquery.metisMenu.js"></script>
    <script src="{{ asset('inspinia') }}/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="{{ asset('inspinia') }}/js/plugins/jeditable/jquery.jeditable.js"></script>

    <script src="{{ asset('inspinia') }}/js/plugins/dataTables/datatables.min.js"></script>

    <!-- Chosen -->
    <script src="{{ asset('inspinia') }}/js/plugins/chosen/chosen.jquery.js"></script>

    <!-- Custom and plugin javascript -->
    <script src="{{ asset('inspinia') }}/js/inspinia.js"></script>
    <script src="{{ asset('inspinia') }}/js/plugins/pace/pace.min.js"></script>

    <!-- Select2 -->
    <script src="{{ asset('inspinia') }}/js/plugins/select2/select2.full.min.js"></script>

    <script>
        $(document).ready(function(){


            $('#password, #confirm_password').on('keyup', function () {
            if ($('#password').val() == $('#confirm_password').val()) {
                $('#message').html('Matching').css('color', 'green');
            } else
                $('#message').html('Not Matching').css('color', 'red');
            });

            $('.chosen-select').chosen({width: "100%"});

            $(".select2_currency").select2({
                placeholder: "Select Currency",
                allowClear: true
            });

            $(".select2_plan").select2({
                placeholder: "Select Plan",
                allowClear: true
            });

            $(".select2_type").select2({
                placeholder: "Select Type",
                allowClear: true
            });

            $(".select2_product_category").select2({
                placeholder: "Select Product Category",
                allowClear: true
            });

        });

    </script>

<script>
    $(document).ready(function() {

        $('.enablerandomReference').on('click',function(){
            if (document.getElementById('is_sale_random').checked) {
                // enable end_time input
                document.getElementById("sale_format").disabled = true;

            } else {
                // disable input
                document.getElementById("sale_format").disabled = false;

            }
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
                        title: 'Brands',
                        exportOptions: {
                            columns: [ 0, 1, 2 ]
                        }
                    },
                    {extend: 'pdf',
                        title: 'Brands',
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

    </script>



<script>
    $(document).ready(function(){
        $("#wizard").steps();
        $("#form").validate({
            errorPlacement: function (error, element)
            {
                element.before(error);
            },
            rules: {
                password_confirmation: {
                    equalTo: "#password"
                }
            }
        });
   });

@endsection
