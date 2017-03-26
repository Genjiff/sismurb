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
      <li class="treeview <?php if ($page == "home" || $page == "consultas" || $page == "marcar_consulta") { ?>active<?php } ?>">
        <a href="#">
          <i class="fa fa-hospital-o"></i> <span>Consultas</span>
          <span class="pull-right-container">
            <i class="fa fa-angle-left pull-right"></i>
          </span>
        </a>
        <ul class="treeview-menu">
          <li <?php if ($page == "consultas" || $page == "home") { ?> class="active" <?php } ?> ><a href="index.php?page=consultas"><i class="fa fa-circle-o"></i> Consultas marcadas</a></li>
          <li <?php if ($page == "marcar_consulta") { ?> class="active" <?php } ?> ><a href="index.php?page=marcar_consulta"><i class="fa fa-circle-o"></i> Marcar consulta</a></li>
        </ul>
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
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>
