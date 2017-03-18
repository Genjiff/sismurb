<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    <div class="user-panel">
      <div class="pull-left image">
        <img src="dist/img/avatar.png" class="img-circle" alt="User Image">
      </div>
      <div class="pull-left info">
        <p>Sismurb Admin</p>
        <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
      </div>
    </div>
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <li class="header">MENU PRINCIPAL</li>
      <li <?php if ($page == "home") { ?> class="active" <?php } ?> >
        <a href="index.php"><i class="fa fa-hospital-o"></i> Dashboard</a>
      </li>
      <li class="treeview <?php if ($page == "cadastro_paciente" || $page == "pacientes" || $page == "editar_paciente" || $page == "ver_paciente" ) { ?>active<?php } ?>">
        <a href="#">
          <i class="fa fa-heartbeat"></i> <span>Pacientes</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li <?php if ($page == "pacientes") { ?> class="active" <?php } ?> ><a href="index.php?page=pacientes"><i class="fa fa-circle-o"></i> Todos os pacientes</a></li>
          <li <?php if ($page == "cadastro_paciente") { ?> class="active" <?php } ?> ><a href="index.php?page=cadastro_paciente"><i class="fa fa-circle-o"></i> Cadastro de paciente</a></li>
        </ul>
      </li>
      <li class="treeview <?php if ($page == "cadastro_medico" || $page == "medicos" || $page == "editar_medico" || $page == "ver_medico") { ?>active<?php } ?>">
        <a href="#">
          <i class="fa fa-user-md"></i> <span>Médicos</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li <?php if ($page == "medicos") { ?> class="active" <?php } ?> ><a href="index.php?page=medicos"><i class="fa fa-circle-o"></i> Todos os médicos</a></li>
          <li <?php if ($page == "cadastro_medico") { ?> class="active" <?php } ?> ><a href="index.php?page=cadastro_medico"><i class="fa fa-circle-o"></i> Cadastro de médico</a></li>
        </ul>
      </li>
      <li class="treeview">
        <a href="#">
          <i class="fa fa-folder"></i> <span>Examples</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li><a href="pages/examples/invoice.html"><i class="fa fa-circle-o"></i> Invoice</a></li>
          <li><a href="pages/examples/profile.html"><i class="fa fa-circle-o"></i> Profile</a></li>
          <li><a href="pages/examples/login.html"><i class="fa fa-circle-o"></i> Login</a></li>
          <li><a href="pages/examples/register.html"><i class="fa fa-circle-o"></i> Register</a></li>
          <li><a href="pages/examples/lockscreen.html"><i class="fa fa-circle-o"></i> Lockscreen</a></li>
          <li><a href="pages/examples/404.html"><i class="fa fa-circle-o"></i> 404 Error</a></li>
          <li><a href="pages/examples/500.html"><i class="fa fa-circle-o"></i> 500 Error</a></li>
          <li><a href="pages/examples/blank.html"><i class="fa fa-circle-o"></i> Blank Page</a></li>
          <li><a href="pages/examples/pace.html"><i class="fa fa-circle-o"></i> Pace Page</a></li>
        </ul>
      </li>
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
