<!-- Main Header -->
<header class="main-header">

    <!-- Logo -->
    <a href="{{ url('/home') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini">SD</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b></b> Seeding</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Authentication Links -->
                @if (Auth::guest())
                    <li><a href="{{ url('/login') }}">Login</a></li>
                    <li><a href="{{ url('/register') }}">Register</a></li>
                @else
                    <li class="dropdown user user-menu">
                        <!-- Menu Toggle Button -->
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <!-- The user image in the navbar-->
                            {{--<img src="{{ $avatar_url or "https://cdn1.iconfinder.com/data/icons/flat-business-icons/128/user-256.png" }}" class="user-image" alt="User Image">--}}
                            <img src="{{ Gravatar::fallback('https://i.imgur.com/KR5FtU6.jpg')->get(Auth::user()->email) }}" class="user-image" alt="User Image">

                            <!-- hidden-xs hides the username on small devices so only the image appears. -->
                            <span class="hidden-xs">{{Auth::user()->name}} <i class="caret"></i></span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- The user image in the menu -->
                            <li class="user-header">
                                {{--<img src="https://cdn1.iconfinder.com/data/icons/flat-business-icons/128/user-256.png" class="img-circle" alt="User Image">--}}
                                <img src="{{ Gravatar::fallback('https://i.imgur.com/KR5FtU6.jpg')->get(Auth::user()->email) }}" class="img-circle" alt="User Image">

                                <p>
                                    {{ Auth::user()->name }}
                                    <small>{{Auth::user()->email}}</small>
                                </p>
                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="{{ url('/settings') }}" class="btn btn-flat btn-default">Profile <i
                                                class="fa fa-user"></i></a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{ url('/logout') }}" onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();"
                                       class="btn btn-flat btn-default">Đăng xuất <i class="fa fa-sign-out"></i></a>

                                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                        <input type="submit" value="logout" style="display: none;">
                                    </form>
                                </div>
                            </li>
                        </ul>
                    </li>
                @endif

            </ul>
        </div>
    </nav>
</header>