<?php
    $id = 0;

    if (isset($_GET["id"]) && $_GET["id"] != "") {
        $id = $_GET["id"];
    }

    if ($id) {
        include_once("util/connect.php");

        $stmt = $conn->prepare("SELECT * FROM pessoa, paciente WHERE id = ? AND pessoa.id = paciente.id_pessoa");
        $stmt->bind_param("i", $id);

        $stmt->execute();

        if ($paciente = $stmt->get_result()) {
            $paciente = $paciente->fetch_assoc();
        } else {
            $error = "Id não existente.";
        }

        $stmt->close();
        $conn->close();
    } else {
        //redirect
        echo "<script>window.location = 'index.php?page=pacientes'</script>";
    }
?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Ficha do Paciente - <?php echo $paciente["nome"]; ?>
  </h1>
  <ol class="breadcrumb">
    <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Ficha de Paciente</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-6">
            <!-- general form elements -->
            <div class="box box-primary">
                <div class="box-body">
                    <div class="form-group">
                        <label>Nome Completo</label>
                        <p><?php echo $paciente["nome"]; ?></p>
                    </div>
                    <div class="form-group">
                      <label>Sexo</label>
                      <p><?php echo $paciente["sexo"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label for="rg">RG</label>
                        <p><?php echo $paciente["rg"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label for="cpf">CPF</label>
                        <p><?php echo $paciente["cpf"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Data de Nascimento:</label>
                        <p><?php echo date("d/m/Y", strtotime($paciente["data_nasc"])); ?></p>
                    </div>
                    <div class="form-group">
                        <label for="endereco">Endereço</label>
                        <p><?php echo $paciente["endereco"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label for="telefone">Telefone</label>
                        <p><?php echo $paciente["telefone"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <p><?php echo $paciente["email"]; ?></p>
                    </div>
                    <div class="form-group">
                      <label>Estado Civil</label>
                      <p><?php echo $paciente["estado_civil"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label for="nomedamae">Nome da mãe</label>
                        <p><?php echo $paciente["nome_da_mae"]; ?></p>
                    </div>
                </div>
                <div class="box-footer">
                    <a href="index.php?page=editar_paciente&id=<?php echo $paciente["id"] ?>"><button class="btn btn-success">Editar</button></a>
                    <a href="index.php?page=excluir_pessoa&id=<?php echo $paciente["id"] ?>"><button class="btn btn-danger">Excluir</button></a>
                </div>
            </div>
        </div>
    </div>
    <!-- /.box -->
</section>
<!-- /.content -->
