<?php
    $error_fields = array ();
    $error_msg = "";
    $success = 0;

    if (isset($_POST["submit"])) {
        include_once("util/connect.php");

        //checa há campos vazios
        foreach ($_POST as $key => $value) {
            if ($value == "" && $key != "submit") {
                $error_fields[] = $key;
                $error_msg = "Preencha todos os campos <br/>";
            }
        }

        //checa se CPF é único
        if ($_POST["cpf"] != "") {
            $stmt = $conn->prepare("SELECT id FROM paciente WHERE cpf = ? LIMIT 1");
            $stmt->bind_param("s", $_POST["cpf"]);
            $stmt->execute();
            $res = $stmt->get_result()->fetch_assoc();

            if (!empty($res)) {
                $error_fields[] = "cpf";
                $error_msg .= "CPF já cadastrado <br/>";
            }
        }

        if (empty($error_fields)) {
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

            $stmt->bind_param("sisssssssss", $nome, $rg, $cpf, $data_nasc, $endereco, $telefone, $email, $sexo, $estado_civil, $nome_da_mae, $tipo);
            $stmt->execute();
            $stmt->close();
            $success = 1;
        }
        $conn->close();
    }
    $error_fields = json_encode($error_fields, JSON_FORCE_OBJECT);
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
                            <input type="text" class="form-control" name="nome" id="nome" value="<?php if (isset($_POST["nome"])) {echo $_POST["nome"];} ?>" placeholder="Digite o nome do paciente" />
                        </div>
                        <div class="form-group">
                          <label>Sexo</label>
                          <select name="sexo" id="sexo" class="form-control select2" style="width: 100%;">
                            <option <?php if (isset($_POST["sexo"]) && $_POST["sexo"] == "Masculino") { echo "selected=selected"; } ?> >Masculino</option>
                            <option <?php if (isset($_POST["sexo"]) && $_POST["sexo"] == "Feminino") { echo "selected=selected"; } ?> >Feminino</option>
                          </select>
                        </div>
                        <div class="form-group">
                            <label for="rg">RG</label>
                            <input type="number" class="form-control" name="rg" id="rg" value="<?php if (isset($_POST["rg"])) {echo $_POST["rg"];} ?>" placeholder="Digite o RG do paciente" />
                        </div>
                        <div class="form-group">
                            <label for="cpf">CPF</label>
                            <input type="text" class="form-control" name="cpf" id="cpf" value="<?php if (isset($_POST["cpf"])) {echo $_POST["cpf"];} ?>" placeholder="___.___.___-__" data-inputmask='"mask": "999.999.999-99"' data-mask />
                        </div>
                        <div class="form-group">
                            <label>Data de Nascimento:</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control" name="datadenascimento" id="datadenascimento" value="<?php if (isset($_POST["datadenascimento"])) {echo $_POST["datadenascimento"];} ?>" placeholder="dd/mm/aaaa" data-inputmask="'alias': 'dd/mm/aaaa'" data-mask />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="endereco">Endereço</label>
                            <input type="text" class="form-control" name="endereco" id="endereco" value="<?php if (isset($_POST["endereco"])) {echo $_POST["endereco"];} ?>" placeholder="Digite o endereço do paciente"/>
                        </div>
                        <div class="form-group">
                            <label for="telefone">Telefone</label>
                            <input type="text" class="form-control" name="telefone" id="telefone" value="<?php if (isset($_POST["telefone"])) {echo $_POST["telefone"];} ?>" placeholder="(__) ____-____" />
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email" value="<?php if (isset($_POST["email"])) {echo $_POST["email"];} ?>" placeholder="Digite o email do paciente" />
                        </div>
                        <div class="form-group">
                          <label>Estado Civil</label>
                          <select name="estadocivil" id="estadocivil" class="form-control select2" style="width: 100%;">
                            <option <?php if (isset($_POST["estadocivil"]) && $_POST["estadocivil"] == "Solteiro") { echo "selected=selected"; } ?> >Solteiro</option>
                            <option <?php if (isset($_POST["estadocivil"]) && $_POST["estadocivil"] == "Casado") { echo "selected=selected"; } ?> >Casado</option>
                          </select>
                        </div>
                        <div class="form-group">
                            <label for="nomedamae">Nome da mãe</label>
                            <input type="text" class="form-control" name="nomedamae" id="nomedamae" value="<?php if (isset($_POST["nomedamae"])) {echo $_POST["nomedamae"];} ?>" placeholder="Digite o nome da mãe do paciente"/>
                        </div>
                        <div class="form-group">
                          <label>Tipo de paciente</label>
                          <select name="tipo" id="tipo" class="form-control select2" style="width: 100%;">
                            <option <?php if (isset($_POST["tipo"]) && $_POST["tipo"] == "Estudante") { echo "selected=selected"; } ?> >Estudante</option>
                            <option <?php if (isset($_POST["tipo"]) && $_POST["tipo"] == "Técnico") { echo "selected=selected"; } ?> >Técnico</option>
                          </select>
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <button name="submit" id="submit" type="submit" class="btn btn-primary">Enviar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.box -->
</section>
<!-- /.content -->

<!-- MODAL ERRO -->
<div class="modal modal-danger fade" id="erro" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-plus"></i> Cadastro de paciente</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <p style="font-size:18px" id="msg_error"></p>
                </div>
            </div>
            <div class="modal-footer clearfix">
                <button type="button" class="btn btn-outline pull-right" data-dismiss="modal"><i class="fa fa-check"></i> OK</button>
            </div>
        </div>
    </div>
</div>

<!-- MODAL SUCESSO -->
<div class="modal modal-success fade" id="sucesso" tabindex="-1" role="dialog" data-backdrop="static" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><i class="fa fa-edit"></i> Cadastro de paciente</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <p style="font-size:18px">Paciente cadastrado com sucesso</p>
                </div>
            </div>
            <div class="modal-footer clearfix">
                <button type="button" class="btn btn-outline pull-right" data-dismiss="modal"><i class="fa fa-check"></i> OK</button>
            </div>
        </div>
    </div>
</div>
