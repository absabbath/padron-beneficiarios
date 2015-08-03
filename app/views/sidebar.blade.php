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

        <!-- search form (Optional) -->
        <form action="{{URL::action('BeneficiarioController@buscarBeneficiario', 'buscador')}}" method="PUT" class="sidebar-form">
          <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Clave elector..."/>
              <span class="input-group-btn">
                <button type='submit' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
          </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">Acciones</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="active"><a href="{{ url('/')}}" class="fa fa-home"><span>Inicio</span></a></li>
            <li><a href="{{ url('buscador')}}" class="fa fa-user-plus"> <span> Beneficiario</span></a></li>
            <li class="treeview">
                <a href="#" class="fa fa-table"> <span> Reportes</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="#">Mis beneficiarios</a></li>
                    <li><a href="#">Consulta personalizada</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#" class="fa fa-eye"> <span> Admin</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('admin/usuario')}}"> <i class="fa fa-user-plus"></i>  Gestión de usuarios</a></li>
                    <li><a href="{{ url('admin/dependencia')}}"> <i class="fa fa-users"></i> Gestión de dependencias</a></li>
                    <li><a href="{{ url('admin/reportes')}}"><i class="fa fa-server"></i> Consultas</a></li>
                    <li><a href="{{ url('admin')}}"><i class="fa  fa-cloud-upload"></i> Cargar padron</a></li>
                </ul>
            </li>
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>