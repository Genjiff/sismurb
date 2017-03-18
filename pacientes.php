<?php
    include_once("util/connect.php");
    $stmt = $conn->prepare("SELECT pessoa.id, pessoa.nome, pessoa.data_nasc, paciente.id_pessoa, paciente.nome_da_mae FROM pessoa, paciente WHERE pessoa.id=paciente.id_pessoa");
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
                                <th>Nome</th>
                                <th>Data de Nascimento</th>
                                <th>Nome da Mãe</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($paciente = $res->fetch_assoc()) {?>
                                <tr>
                                    <td><a href="index.php?page=ver_paciente&id=<?php echo $paciente["id"] ?>"><?php echo $paciente["nome"] ?></td>
                                    <td><?php echo date("d/m/Y", strtotime($paciente["data_nasc"])) ?></td>
                                    <td><?php echo $paciente["nome_da_mae"] ?></td>
                            <?php } ?>
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Nome</th>
                                <th>Data de Nascimento</th>
                                <th>Tipo</th>
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
