<?php
    include_once("util/connect.php");
    $stmt = $conn->prepare("SELECT * FROM medicos_view");
    $stmt->execute();

    $res = $stmt->get_result();

    $stmt->close();
    $conn->close();
?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Lista de Médicos
  </h1>
  <ol class="breadcrumb">
    <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Lista de Médicos</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-xs-9">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Lista de Médicos</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <table id="listademedicos" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Nome</th>
                                <th>Especialidade</th>
                                <th>Número do CRM</th>
                                <th>Opções</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($medico = $res->fetch_assoc()) {?>
                                <tr>
                                    <td><a href="index.php?page=ver_medico&id=<?php echo $medico["id"] ?>"><?php echo $medico["nome"] ?></td>
                                    <td><?php echo $medico["especialidade"] ?></td>
                                    <td><?php echo $medico["crm"] ?></td>
                                    <td>
                                        <a href="index.php?page=editar_medico&id=<?php echo $medico["id"] ?>" style="padding: 2px 8px;" class="btn btn-success" title="Editar médico">
                                            <i class="fa fa-pencil"></i>
                                        </a>
                                        <a href="excluir_pessoa.php?id=<?php echo $medico["id"] ?>&return_page=medicos" style="padding: 2px 8px;" class="excluir btn btn-danger" title="Excluir médico">
                                            <i class="fa fa-trash-o"></i>
                                        </a>
                                    </td>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Nome</th>
                                <th>Especialidade</th>
                                <th>Número do CRM</th>
                                <th>Opções</th>
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
                <h4 class="modal-title"><i class="fa fa-plus"></i> Excluir médico</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <p style="font-size:18px" id="msg_error">Tem certeza que deseja excluir este médico?</p>
                </div>
            </div>
            <div class="modal-footer clearfix">
                <button type="button" class="btn btn-outline pull-left" data-dismiss="modal"><i class="fa fa-x"></i>Cancelar</button>
                <a id="seguirExclusao" href=""><button type="button" class="btn btn-outline pull-right"><i class="fa fa-check"></i> OK</button></a>
            </div>
        </div>
    </div>
</div>
