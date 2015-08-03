<!-- Main Header -->
<header class="main-header">

    <!-- Logo -->

    <a href="{{ url('/')}}" class="logo"><b>Padrón</b></a>


    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div cla  ss="navbar-custom-menu">
            <ul class="nav navbar-nav navbar-right">
               
                <!-- User Account Menu -->
                <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <!-- The user image in the navbar-->
                        <img src="{{ asset("/assets/img/default.png") }}" class="user-image" alt="User Image"/>
                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                        <span class="hidden-xs">{{Auth::user()->nombre}}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- The user image in the menu -->
                        <li class="user-header">
                            <img src="{{ asset("/assets/img/default.png") }}" class="img-circle" alt="User Image" />
                            <p>
                                {{Auth::user()->nombre}}
                                <small>{{$dependencia = "Direccion Gral"}}</small>
                            </p>
                        </li>
                        <!-- Menu Body -->
                   
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">Perfil</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{ URL::action('LoginController@anyLogout') }}" class="btn btn-default btn-flat">Cerrar sesión</a>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>