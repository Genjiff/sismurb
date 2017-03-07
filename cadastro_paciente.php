<?php
    $empty_fields = array ();

    if (isset($_POST["submit"])) {
        include_once("util/connect.php");

        foreach ($_POST as $key => $value) {
            if ($value == "") {
                $empty_fields[] = $key;
            }
        }

        if (empty($empty_fields)) {
            $nome = $_POST["nome"];
            $sexo = $_POST["sexo"];
            $rg= $_POST["rg"];
            $cpf = $_POST["cpf"];
            $data_nasc = date_format(date_create_from_format('d/m/Y', $_POST["datadenascimento"]), 'Y-m-d');
            $endereco= $_POST["endereco"];
            $telefone = $_POST["telefone"];
            $email = $_POST["email"];
            $estado_civil = $_POST["estadocivil"];
            $nome_da_mae = $_POST["nomedamae"];
            $tipo = $_POST["tipo"];

            $stmt = $conn->prepare("INSERT INTO paciente (
                nome,
                rg,
                cpf,
                data_nasc,
                endereco,
                telefone,
                email,
                sexo,
                estado_civil,
                nome_da_mae,
                tipo)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("siissssssss", $nome, $rg, $cpf, $data_nasc, $endereco, $telefone, $email, $sexo, $estado_civil, $nome_da_mae, $tipo);
            $stmt->execute();
        }

        $empty_fields = json_encode($empty_fields, JSON_FORCE_OBJECT);
    }
?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Cadastro de Paciente
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Cadastro de Paciente</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="row">
        <!-- left column -->
        <div class="col-md-6">
            <!-- general form elements -->
            <div class="box box-primary">
                <!-- form start -->
                <form role="form" action="index.php?page=cadastro_paciente" method="post">
                    <div class="box-body">
                        <div class="form-group">
                            <label for="nome">Nome Completo</label>
                            <input type="text" class="form-control" name="nome" id="nome" placeholder="Digite o nome do paciente" />
                        </div>
                        <div class="form-group">
                          <label>Sexo</label>
                          <select name="sexo" id="sexo" class="form-control select2" style="width: 100%;">
                            <option selected="selected">Masculino</option>
                            <option>Feminino</option>
                          </select>
                        </div>
                        <div class="form-group">
                            <label for="rg">RG</label>
                            <input type="number" class="form-control" name="rg" id="rg" placeholder="Digite o RG do paciente" />
                        </div>
                        <div class="form-group">
                            <label for="cpf">CPF</label>
                            <input type="text" class="form-control" name="cpf" id="cpf" placeholder="___.___.___-__" data-inputmask='"mask": "999.999.999-99"' data-mask />
                        </div>
                        <div class="form-group">
                            <label>Data de Nascimento:</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control" name="datadenascimento" id="datadenascimento" placeholder="dd/mm/aaaa" data-inputmask="'alias': 'dd/mm/aaaa'" data-mask />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="endereco">Endereço</label>
                            <input type="text" class="form-control" name="endereco" id="endereco" placeholder="Digite o endereço do paciente"/>
                        </div>
                        <div class="form-group">
                            <label for="telefone">Telefone</label>
                            <input type="text" class="form-control" name="telefone" id="telefone" placeholder="(__) ____-____" />
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Digite o email do paciente" />
                        </div>
                        <div class="form-group">
                          <label>Estado Civil</label>
                          <select name="estadocivil" id="estadocivil" class="form-control select2" style="width: 100%;">
                            <option selected="selected">Solteiro</option>
                            <option>Casado</option>
                          </select>
                        </div>
                        <div class="form-group">
                            <label for="nomedamae">Nome da mãe</label>
                            <input type="text" class="form-control" name="nomedamae" id="nomedamae" placeholder="Digite o nome da mãe do paciente"/>
                        </div>
                        <div class="form-group">
                          <label>Tipo de paciente</label>
                          <select name="tipo" id="tipo" class="form-control select2" style="width: 100%;">
                            <option selected="selected">Estudante</option>
                            <option>Técnico</option>
                          </select>
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button name="submit" id="submit" type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.box -->
</section>
<!-- /.content -->
