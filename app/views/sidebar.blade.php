<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ asset("/assets/img/default.png") }}" class="img-circle" alt="User Image" />
            </div>
            <div class="pull-left info">
                <p>{{Auth::user()->nombre}}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">Menú principal</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="active"><a href="#" class="fa fa-home"><span>Inicio</span></a></li>
            <li><a href="#" class="fa fa-user-plus"><span>Beneficiario</span></a></li>
            <li class="treeview">
                <a href="#" class="fa-table"><span>Reportes</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="#">Link in level 2</a></li>
                    <li><a href="#">Link in level 2</a></li>
                </ul>
            </li>
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>