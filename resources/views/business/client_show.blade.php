@extends('business.layouts.app')

@section('title', 'Create Client')

@section('css')

    <link href="{{ asset('inspinia') }}/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/font-awesome/css/font-awesome.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/jasny/jasny-bootstrap.min.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/plugins/dataTables/datatables.min.css" rel="stylesheet">

    <link href="{{ asset('inspinia') }}/css/animate.css" rel="stylesheet">
    <link href="{{ asset('inspinia') }}/css/style.css" rel="stylesheet">
    {{--  Tags  --}}
    <style>
        .tags-input-wrapper {
            background: #ffffff;
            padding: 10px;
            border-radius: 4px;
            max-width: 650px;
            border: 1px solid #ccc
        }

        .tags-input-wrapper input {
            border: none;
            background: transparent;
            outline: none;
            width: 150px;
        }

        .tags-input-wrapper .tag {
            display: inline-block;
            background-color: #009432;
            color: white;
            border-radius: 20px;
            padding: 0px 3px 0px 7px;
            margin-right: 5px;
            margin-bottom: 5px;
        }

        .tags-input-wrapper .tag a {
            margin: 0 7px 3px;
            display: inline-block;
            cursor: pointer;
        }
    </style>
@endsection



@section('content')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>Clients</h2>
        <ol class="breadcrumb">
            <li>
                <a href="{{route('business.dashboard')}}">Home</a>
            </li>
            <li>
                <a href="{{route('business.sales')}}">Sales</a>
            </li>
            <li>
                <a href="{{route('business.clients')}}">Clients</a>
            </li>
            <li class="active">
                <strong>Client</strong>
            </li>
        </ol>
    </div>
</div>

<div class="wrapper wrapper-content animated fadeInRight">


    <div class="row m-b-lg m-t-lg">
        <div class="col-md-6">

            <div class="profile-image">
                <img src="{{ asset('inspinia') }}/img/a4.jpg" class="img-circle circle-border m-b-md" alt="profile">
            </div>
            <div class="profile-info">
                <div class="">
                    <div>
                        <h2 class="no-margins">
                            Alex Smith
                        </h2>
                        <h4>Founder of Groupeq</h4>
                        <small>
                            There are many variations of passages of Lorem Ipsum available, but the majority
                            have suffered alteration in some form Ipsum available.
                        </small>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <table class="table small m-b-xs">
                <tbody>
                <tr>
                    <td>
                        <strong>142</strong> Projects
                    </td>
                    <td>
                        <strong>22</strong> Followers
                    </td>

                </tr>
                <tr>
                    <td>
                        <strong>61</strong> Comments
                    </td>
                    <td>
                        <strong>54</strong> Articles
                    </td>
                </tr>
                <tr>
                    <td>
                        <strong>154</strong> Tags
                    </td>
                    <td>
                        <strong>32</strong> Friends
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="col-md-3">
            <small>Sales in last 24h</small>
            <h2 class="no-margins">206 480</h2>
            <div id="sparkline1"></div>
        </div>


    </div>
    <div class="row">

        <div class="col-lg-3">

            <div class="ibox">
                <div class="ibox-content">
                    <h3>About Alex Smith</h3>

                    <p class="small">
                        There are many variations of passages of Lorem Ipsum available, but the majority have
                        suffered alteration in some form, by injected humour, or randomised words which don't.
                        <br/>
                        <br/>
                        If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't
                        anything embarrassing
                    </p>

                    <p class="small font-bold">
                        <span><i class="fa fa-circle text-navy"></i> Online status</span>
                    </p>

                </div>
            </div>

            <div class="ibox">
                <div class="ibox-content">
                    <h3>Followers and friends</h3>
                    <p class="small">
                        If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't
                        anything embarrassing
                    </p>
                    <div class="user-friends">
                        <a href=""><img alt="image" class="img-circle" src="{{ asset('inspinia') }}/img/a3.jpg"></a>
                        <a href=""><img alt="image" class="img-circle" src="{{ asset('inspinia') }}/img/a1.jpg"></a>
                        <a href=""><img alt="image" class="img-circle" src="{{ asset('inspinia') }}/img/a2.jpg"></a>
                        <a href=""><img alt="image" class="img-circle" src="{{ asset('inspinia') }}/img/a4.jpg"></a>
                        <a href=""><img alt="image" class="img-circle" src="{{ asset('inspinia') }}/img/a5.jpg"></a>
                        <a href=""><img alt="image" class="img-circle" src="{{ asset('inspinia') }}/img/a6.jpg"></a>
                        <a href=""><img alt="image" class="img-circle" src="{{ asset('inspinia') }}/img/a7.jpg"></a>
                        <a href=""><img alt="image" class="img-circle" src="{{ asset('inspinia') }}/img/a8.jpg"></a>
                        <a href=""><img alt="image" class="img-circle" src="{{ asset('inspinia') }}/img/a2.jpg"></a>
                        <a href=""><img alt="image" class="img-circle" src="{{ asset('inspinia') }}/img/a1.jpg"></a>
                    </div>
                </div>
            </div>

            <div class="ibox">
                <div class="ibox-content">
                    <h3>Personal friends</h3>
                    <ul class="list-unstyled file-list">
                        <li><a href=""><i class="fa fa-file"></i> Project_document.docx</a></li>
                        <li><a href=""><i class="fa fa-file-picture-o"></i> Logo_zender_company.jpg</a></li>
                        <li><a href=""><i class="fa fa-stack-exchange"></i> Email_from_Alex.mln</a></li>
                        <li><a href=""><i class="fa fa-file"></i> Contract_20_11_2014.docx</a></li>
                        <li><a href=""><i class="fa fa-file-powerpoint-o"></i> Presentation.pptx</a></li>
                        <li><a href=""><i class="fa fa-file"></i> 10_08_2015.docx</a></li>
                    </ul>
                </div>
            </div>

            <div class="ibox">
                <div class="ibox-content">
                    <h3>Private message</h3>

                    <p class="small">
                        Send private message to Alex Smith
                    </p>

                    <div class="form-group">
                        <label>Subject</label>
                        <input type="email" class="form-control" placeholder="Message subject">
                    </div>
                    <div class="form-group">
                        <label>Message</label>
                        <textarea class="form-control" placeholder="Your message" rows="3"></textarea>
                    </div>
                    <button class="btn btn-primary btn-block">Send</button>

                </div>
            </div>

        </div>

        <div class="col-lg-5">

            <div class="social-feed-box">

                <div class="pull-right social-action dropdown">
                    <button data-toggle="dropdown" class="dropdown-toggle btn-white">
                        <i class="fa fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu m-t-xs">
                        <li><a href="#">Config</a></li>
                    </ul>
                </div>
                <div class="social-avatar">
                    <a href="" class="pull-left">
                        <img alt="image" src="{{ asset('inspinia') }}/img/a1.jpg">
                    </a>
                    <div class="media-body">
                        <a href="#">
                            Andrew Williams
                        </a>
                        <small class="text-muted">Today 4:21 pm - 12.06.2014</small>
                    </div>
                </div>
                <div class="social-body">
                    <p>
                        Many desktop publishing packages and web page editors now use Lorem Ipsum as their
                        default model text, and a search for 'lorem ipsum' will uncover many web sites still
                        in their infancy. Packages and web page editors now use Lorem Ipsum as their
                        default model text.
                    </p>

                    <div class="btn-group">
                        <button class="btn btn-white btn-xs"><i class="fa fa-thumbs-up"></i> Like this!</button>
                        <button class="btn btn-white btn-xs"><i class="fa fa-comments"></i> Comment</button>
                        <button class="btn btn-white btn-xs"><i class="fa fa-share"></i> Share</button>
                    </div>
                </div>
                <div class="social-footer">
                    <div class="social-comment">
                        <a href="" class="pull-left">
                            <img alt="image" src="{{ asset('inspinia') }}/img/a1.jpg">
                        </a>
                        <div class="media-body">
                            <a href="#">
                                Andrew Williams
                            </a>
                            Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words.
                            <br/>
                            <a href="#" class="small"><i class="fa fa-thumbs-up"></i> 26 Like this!</a> -
                            <small class="text-muted">12.06.2014</small>
                        </div>
                    </div>

                    <div class="social-comment">
                        <a href="" class="pull-left">
                            <img alt="image" src="{{ asset('inspinia') }}/img/a2.jpg">
                        </a>
                        <div class="media-body">
                            <a href="#">
                                Andrew Williams
                            </a>
                            Making this the first true generator on the Internet. It uses a dictionary of.
                            <br/>
                            <a href="#" class="small"><i class="fa fa-thumbs-up"></i> 11 Like this!</a> -
                            <small class="text-muted">10.07.2014</small>
                        </div>
                    </div>

                    <div class="social-comment">
                        <a href="" class="pull-left">
                            <img alt="image" src="{{ asset('inspinia') }}/img/a3.jpg">
                        </a>
                        <div class="media-body">
                            <textarea class="form-control" placeholder="Write comment..."></textarea>
                        </div>
                    </div>

                </div>

            </div>

            <div class="social-feed-box">

                <div class="pull-right social-action dropdown">
                    <button data-toggle="dropdown" class="dropdown-toggle btn-white">
                        <i class="fa fa-angle-down"></i>
                    </button>
                    <ul class="dropdown-menu m-t-xs">
                        <li><a href="#">Config</a></li>
                    </ul>
                </div>
                <div class="social-avatar">
                    <a href="" class="pull-left">
                        <img alt="image" src="{{ asset('inspinia') }}/img/a6.jpg">
                    </a>
                    <div class="media-body">
                        <a href="#">
                            Andrew Williams
                        </a>
                        <small class="text-muted">Today 4:21 pm - 12.06.2014</small>
                    </div>
                </div>
                <div class="social-body">
                    <p>
                        Many desktop publishing packages and web page editors now use Lorem Ipsum as their
                        default model text, and a search for 'lorem ipsum' will uncover many web sites still
                        in their infancy. Packages and web page editors now use Lorem Ipsum as their
                        default model text.
                    </p>
                    <p>
                        Lorem Ipsum as their
                        default model text, and a search for 'lorem ipsum' will uncover many web sites still
                        in their infancy. Packages and web page editors now use Lorem Ipsum as their
                        default model text.
                    </p>
                    <img src="{{ asset('inspinia') }}/img/gallery/3.jpg" class="img-responsive">
                    <div class="btn-group">
                        <button class="btn btn-white btn-xs"><i class="fa fa-thumbs-up"></i> Like this!</button>
                        <button class="btn btn-white btn-xs"><i class="fa fa-comments"></i> Comment</button>
                        <button class="btn btn-white btn-xs"><i class="fa fa-share"></i> Share</button>
                    </div>
                </div>
                <div class="social-footer">
                    <div class="social-comment">
                        <a href="" class="pull-left">
                            <img alt="image" src="{{ asset('inspinia') }}/img/a1.jpg">
                        </a>
                        <div class="media-body">
                            <a href="#">
                                Andrew Williams
                            </a>
                            Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words.
                            <br/>
                            <a href="#" class="small"><i class="fa fa-thumbs-up"></i> 26 Like this!</a> -
                            <small class="text-muted">12.06.2014</small>
                        </div>
                    </div>

                    <div class="social-comment">
                        <a href="" class="pull-left">
                            <img alt="image" src="{{ asset('inspinia') }}/img/a2.jpg">
                        </a>
                        <div class="media-body">
                            <a href="#">
                                Andrew Williams
                            </a>
                            Making this the first true generator on the Internet. It uses a dictionary of.
                            <br/>
                            <a href="#" class="small"><i class="fa fa-thumbs-up"></i> 11 Like this!</a> -
                            <small class="text-muted">10.07.2014</small>
                        </div>
                    </div>

                    <div class="social-comment">
                        <a href="" class="pull-left">
                            <img alt="image" src="{{ asset('inspinia') }}/img/a8.jpg">
                        </a>
                        <div class="media-body">
                            <a href="#">
                                Andrew Williams
                            </a>
                            Making this the first true generator on the Internet. It uses a dictionary of.
                            <br/>
                            <a href="#" class="small"><i class="fa fa-thumbs-up"></i> 11 Like this!</a> -
                            <small class="text-muted">10.07.2014</small>
                        </div>
                    </div>

                    <div class="social-comment">
                        <a href="" class="pull-left">
                            <img alt="image" src="{{ asset('inspinia') }}/img/a3.jpg">
                        </a>
                        <div class="media-body">
                            <textarea class="form-control" placeholder="Write comment..."></textarea>
                        </div>
                    </div>

                </div>

            </div>




        </div>
        <div class="col-lg-4 m-b-lg">
            <div id="vertical-timeline" class="vertical-container light-timeline no-margins">
                <div class="vertical-timeline-block">
                    <div class="vertical-timeline-icon navy-bg">
                        <i class="fa fa-briefcase"></i>
                    </div>

                    <div class="vertical-timeline-content">
                        <h2>Meeting</h2>
                        <p>Conference on the sales results for the previous year. Monica please examine sales trends in marketing and products. Below please find the current status of the sale.
                        </p>
                        <a href="#" class="btn btn-sm btn-primary"> More info</a>
                        <span class="vertical-date">
                                    Today <br>
                                    <small>Dec 24</small>
                                </span>
                    </div>
                </div>

                <div class="vertical-timeline-block">
                    <div class="vertical-timeline-icon blue-bg">
                        <i class="fa fa-file-text"></i>
                    </div>

                    <div class="vertical-timeline-content">
                        <h2>Send documents to Mike</h2>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since.</p>
                        <a href="#" class="btn btn-sm btn-success"> Download document </a>
                        <span class="vertical-date">
                                    Today <br>
                                    <small>Dec 24</small>
                                </span>
                    </div>
                </div>

                <div class="vertical-timeline-block">
                    <div class="vertical-timeline-icon lazur-bg">
                        <i class="fa fa-coffee"></i>
                    </div>

                    <div class="vertical-timeline-content">
                        <h2>Coffee Break</h2>
                        <p>Go to shop and find some products. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's. </p>
                        <a href="#" class="btn btn-sm btn-info">Read more</a>
                        <span class="vertical-date"> Yesterday <br><small>Dec 23</small></span>
                    </div>
                </div>

                <div class="vertical-timeline-block">
                    <div class="vertical-timeline-icon yellow-bg">
                        <i class="fa fa-phone"></i>
                    </div>

                    <div class="vertical-timeline-content">
                        <h2>Phone with Jeronimo</h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, optio, dolorum provident rerum aut hic quasi placeat iure tempora laudantium ipsa ad debitis unde? Iste voluptatibus minus veritatis qui ut.</p>
                        <span class="vertical-date">Yesterday <br><small>Dec 23</small></span>
                    </div>
                </div>

                <div class="vertical-timeline-block">
                    <div class="vertical-timeline-icon navy-bg">
                        <i class="fa fa-comments"></i>
                    </div>

                    <div class="vertical-timeline-content">
                        <h2>Chat with Monica and Sandra</h2>
                        <p>Web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like). </p>
                        <span class="vertical-date">Yesterday <br><small>Dec 23</small></span>
                    </div>
                </div>
            </div>

        </div>

    </div>

    {{--  Sales  --}}
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Sales</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>SKU</th>
                                <th>Stock on Hand</th>
                                <th>Reorder Level</th>
                                <th>Status</th>
                                <th class="text-right" width="135px" data-sort-ignore="true">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="gradeA">
                                <td>Gecko</td>
                                <td>Firefox 1.0</td>
                                <td>Win 98+ / OSX.2+</td>
                                <td class="center">1.7</td>
                                <td class="center">1.7</td>
                                <td class="text-right">
                                    <div class="btn-group">
                                        <a href="{{ route('business.product.group.show', 1) }}" class="btn-success btn-outline btn btn-xs">View</a>
                                        <a href="{{ route('business.product.group.edit', 1) }}" class="btn-warning btn-outline btn btn-xs">Edit</a>
                                        <a href="{{ route('business.product.group.delete', 1) }}" class="btn-danger btn-outline btn btn-xs">Delete</a>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>SKU</th>
                                <th>Stock on Hand</th>
                                <th>Reorder Level</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </tfoot>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{--  Pending pyments  --}}
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox float-e-margins">
                <div class="ibox-title">
                    <h5>Pending Payments</h5>
                    <div class="ibox-tools">
                        <a class="collapse-link">
                            <i class="fa fa-chevron-up"></i>
                        </a>
                    </div>
                </div>
                <div class="ibox-content">

                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover dataTables-example" >
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>SKU</th>
                                <th>Stock on Hand</th>
                                <th>Reorder Level</th>
                                <th>Status</th>
                                <th class="text-right" width="135px" data-sort-ignore="true">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr class="gradeA">
                                <td>Gecko</td>
                                <td>Firefox 1.0</td>
                                <td>Win 98+ / OSX.2+</td>
                                <td class="center">1.7</td>
                                <td class="center">1.7</td>
                                <td class="text-right">
                                    <div class="btn-group">
                                        <a href="{{ route('business.product.group.show', 1) }}" class="btn-success btn-outline btn btn-xs">View</a>
                                        <a href="{{ route('business.product.group.edit', 1) }}" class="btn-warning btn-outline btn btn-xs">Edit</a>
                                        <a href="{{ route('business.product.group.delete', 1) }}" class="btn-danger btn-outline btn btn-xs">Delete</a>
                                    </div>
                                </td>
                            </tr>
                            </tbody>
                            <tfoot>
                            <tr>
                                <th>Name</th>
                                <th>SKU</th>
                                <th>Stock on Hand</th>
                                <th>Reorder Level</th>
                                <th>Status</th>
                                <th>Action</th>
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

    <!-- Custom and plugin javascript -->
    <script src="{{ asset('inspinia') }}/js/inspinia.js"></script>
    <script src="{{ asset('inspinia') }}/js/plugins/pace/pace.min.js"></script>

    <link href="{{ asset('inspinia') }}/css/plugins/chosen/chosen.css" rel="stylesheet">

    <!-- jQuery Tags Input -->
    <script src="{{ asset('js') }}/tagplug-master/index.js"></script>

    <!-- Input Mask-->
    <script src="{{ asset('js') }}/js/plugins/jasny/jasny-bootstrap.min.js"></script>

    <script src="{{ asset('inspinia') }}/js/plugins/dataTables/datatables.min.js"></script>

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

    {{--  Tag script  --}}
    <script>
        $(document).ready(function() {
            var tagInput = new TagsInput({
                selector: 'tag-input',
                duplicate: false
            });
        });
    </script>

    {{--  Script to prevent form submit on enter key press  --}}
    <script>
        $(document).ready(function () {
            $(document).ready(function() {
                $(window).keydown(function(event){
                    if(event.keyCode == 13) {
                        event.preventDefault();
                        return false;
                    }
                });
            });
        });
    </script>
@endsection
