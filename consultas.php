<?php
    include_once("util/connect.php");
    $stmt = $conn->prepare("SELECT
        consulta.id,
        paciente.id_pessoa as IdPaciente,
        pp.nome as NomePaciente,
        consulta.data,
        consulta.horario_inicio,
        consulta.horario_fim,
        dp.nome as NomeMedico,
        medico.id_pessoa as IdMedico,
        medico.especialidade
        FROM consulta
        INNER JOIN medico
        ON consulta.medico = medico.id_pessoa
        INNER JOIN pessoa dp
        ON consulta.medico = dp.id
        inner join paciente
	    ON consulta.paciente = paciente.id_pessoa
        inner join pessoa pp
	    ON consulta.paciente = pp.id");
    $stmt->execute();

    $res = $stmt->get_result();

    $stmt->close();
    $conn->close();
?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Lista de Pacientes
  </h1>
  <ol class="breadcrumb">
    <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Lista de Pacientes</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-xs-9">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Lista de Pacientes</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="listadepacientes" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Paciente</th>
                                <th>Data da Consulta</th>
                                <th>Horário de Início</th>
                                <th>Horário de Término</th>
                                <th>Médico Responsável</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($consulta = $res->fetch_assoc()) {?>
                                <tr>
                                    <td><a href="index.php?page=ver_paciente&id=<?php echo $consulta["IdPaciente"]; ?>"><?php echo $consulta["NomePaciente"]; ?></td>
                                    <td><?php echo date("d/m/Y", strtotime($consulta["data"])); ?></td>
                                    <td><?php echo $consulta["horario_inicio"]; ?></td>
                                    <td><?php echo $consulta["horario_fim"]; ?></td>
                                    <td><a href="index.php?page=ver_medico&id=<?php echo $consulta["IdMedico"]; ?>"><?php echo $consulta["especialidade"] . " - " . $consulta["NomeMedico"]; ?></td>
                                    <td>
                                        <a href="index.php?page=editar_consulta&id=<?php echo $consulta["id"]; ?>" style="padding: 2px 8px;" class="btn btn-success" title="Editar Consulta">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <a href="excluir_consulta.php?id=<?php echo $consulta["id"]; ?>" style="padding: 2px 8px;" class="excluir btn btn-danger" title="Excluir Consulta">
                                            <i class="fa fa-trash-o"></i>
                                        </a>
                                    </td>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Paciente</th>
                                <th>Data da Consulta</th>
                                <th>Horário de Início</th>
                                <th>Horário de Término</th>
                                <th>Médico Responsável</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </div>
    </div>
    <!-- /.box -->
</section>
<!-- /.content -->

<!-- MODAL ERRO -->
<div class="modal modal-danger fade" id="confirmacao" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-plus"></i> Excluir consulta</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <p style="font-size:18px" id="msg_error">Tem certeza que deseja excluir esta consulta?</p>
                </div>
            </div>
            <div class="modal-footer clearfix">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal"><i class="fa fa-x"></i>Cancelar</button>
                <a id="seguirExclusao" href=""><button type="button" class="btn btn-outline pull-right"><i class="fa fa-check"></i> OK</button></a>
            </div>
        </div>
    </div>
</div>
