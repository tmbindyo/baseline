<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <span>
                        <img alt="image" class="img-circle" src="{{ asset('inspinia') }}/img/profile_small.jpg" />
                    </span>
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear">
                            <span class="block m-t-xs">
                                <strong class="font-bold">{{$user->name}}</strong>
                            </span>
                            <span class="text-muted text-xs block">
                                @if($user->activeUserAccount->userType->name == "Business")
                                    {{$user->activeUserAccount->institution->name}}
                                    <b class="caret"></b>
                                @elseif($user->activeUserAccount->userType->name == "Personal")
                                    Personal Account
                                    <b class="caret"></b>
                                @elseif($user->activeUserAccount->userType->name == "Admin")
                                    Nihusubu Admin
                                    <b class="caret"></b>
                                @endif
                                    {{--  {{$user->activeUserAccount}}  --}}

                            </span>
                        </span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        @foreach($user->inactiveUserAccount as $userAccount)
                            @if($userAccount->userType->name == "Business")
                                <li><a href="{{route('activate.user.account',$userAccount->id)}}"> Access {{$userAccount->institution->name}} </a></li>
                            @endif
                            @if($userAccount->userType->name == "Personal")
                                <li><a href="{{route('activate.user.account',$userAccount->id)}}">Access Personal Account</a></li>
                            @endif
                            @if($userAccount->userType->name == "Admin")
                                <li><a href="{{route('activate.user.account',$userAccount->id)}}">Access Admin Account</a></li>
                            @endif
                        @endforeach
                        <li><a href="{{route('create.user.account')}}">Create New Account</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    <img alt="image" style="height: 20px;" src="{{ asset('inspinia') }}/img/nihusubu.jpg" />
                </div>
            </li>

            {{-- <li class="nav-item {{ Route::currentRouteNamed( 'business.dashboard' ) ?  'active' : '' }}">
                <a href="{{ route('business.dashboard') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
            </li> --}}

            @can('view breakdown')
                <li class="nav-item {{ Route::currentRouteNamed( 'business.breakdown',$institution->portal ) ?  'active' : '' }}">
                    <a href="{{ route('business.breakdown',$institution->portal) }}"><i class="fa fa-tags"></i> <span class="nav-label">Breakdown </span></a>
                </li>
            @endcan

            {{-- @can('view breakdown')
                <li class="nav-item {{ Route::currentRouteNamed( 'business.calendar',$institution->portal ) ?  'active' : '' }}">
                   <a href="{{ route('business.calendar',$institution->portal) }}"><i class="fa fa-calendar"></i> <span class="nav-label">Calendar </span></a>
                </li>
            @endcan --}}

            @can('view calendar')
                <li class="nav-item {{ Route::currentRouteNamed( 'business.calendar',$institution->portal ) ?  'active' : '' }}">
                   <a href="{{ route('business.calendar',$institution->portal) }}"><i class="fa fa-calendar"></i> <span class="nav-label">Calendar </span></a>
                </li>
            @endcan

            @can('view categories')
                <li class="nav-item {{ Route::currentRouteNamed( 'business.categories',$institution->portal ) ?  'active' : '' }}">
                   <a href="{{ route('business.categories',$institution->portal) }}"><i class="fa fa-database"></i> <span class="nav-label">Categories </span></a>
                </li>
            @endcan

            @can('view settings')
                <li class="nav-item {{ Route::currentRouteNamed( 'business.settings',$institution->portal ) ?  'active' : '' }}">
                    <a href="{{ route('business.settings',$institution->portal) }}"><i class="fa fa-sliders"></i> <span class="nav-label">Settings </span></a>
                </li>
            @endcan


        </ul>

    </div>
</nav>
