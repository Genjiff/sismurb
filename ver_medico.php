<?php
    $id = 0;

    if (isset($_GET["id"]) && $_GET["id"] != "") {
        $id = $_GET["id"];
    }

    if ($id) {
        include_once("util/connect.php");

        $stmt = $conn->prepare("SELECT * FROM pessoa, medico WHERE id = ? AND pessoa.id = medico.id_pessoa");
        $stmt->bind_param("i", $id);

        $stmt->execute();

        if ($medico = $stmt->get_result()) {
            $medico = $medico->fetch_assoc();
        } else {
            $error = "Id não existente.";
        }

        $stmt->close();
        $conn->close();
    } else {
        //redirect
        echo "<script>window.location = 'index.php?page=medicos'</script>";
    }
?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Dados do Médico - <?php echo $medico["nome"]; ?>
  </h1>
  <ol class="breadcrumb">
    <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dados do médico</li>
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
                        <p><?php echo $medico["nome"]; ?></p>
                    </div>
                    <div class="form-group">
                      <label>Sexo</label>
                      <p><?php echo $medico["sexo"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label for="rg">RG</label>
                        <p><?php echo $medico["rg"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label for="cpf">CPF</label>
                        <p><?php echo $medico["cpf"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label>Data de Nascimento:</label>
                        <p><?php echo date("d/m/Y", strtotime($medico["data_nasc"])); ?></p>
                    </div>
                    <div class="form-group">
                        <label for="endereco">Endereço</label>
                        <p><?php echo $medico["endereco"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label for="telefone">Telefone</label>
                        <p><?php echo $medico["telefone"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <p><?php echo $medico["email"]; ?></p>
                    </div>
                    <div class="form-group">
                      <label>Especialidade</label>
                      <p><?php echo $medico["especialidade"]; ?></p>
                    </div>
                    <div class="form-group">
                        <label for="crm">Número do CRM</label>
                        <p><?php echo $medico["crm"]; ?></p>
                    </div>
                </div>
                <div class="box-footer">
                    <a href="index.php?page=editar_medico&id=<?php echo $medico["id"] ?>"><button class="btn btn-success">Editar</button></a>
                    <a href="index.php?page=excluir_pessoa&id=<?php echo $medico["id"] ?>&return_page=medicos"><button class="btn btn-danger">Excluir</button></a>
                </div>
            </div>
        </div>
    </div>
    <!-- /.box -->
</section>
<!-- /.content -->
