<?php
    $error_fields = array ();
    $paciente = array ();
    $error_msg = "";
    $success = 0;
    include_once("util/connect.php");

    function povoa_campos (&$p, $connection) {
        $id = 0;

        if (isset($_REQUEST["id"]) && $_REQUEST["id"] != "") {
            $id = $_REQUEST["id"];
        }

        if ($id) {
            $stmt = $connection->prepare("SELECT * FROM pessoa, paciente WHERE id = ? AND pessoa.id = paciente.id_pessoa");
            $stmt->bind_param("i", $id);

            $stmt->execute();

            if ($p = $stmt->get_result()) {
                $p = $p->fetch_assoc();
            } else {
                $error = "Id não existente.";
            }
            $stmt->close();
        } else {
            echo "<script>window.location = 'index.php?page=pacientes'</script>";
        }
    }

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
        if ($_POST["cpf"] != "" && $_POST["id"] != "") {
            $stmt = $conn->prepare("SELECT id FROM pessoa WHERE cpf = ? AND id != ? LIMIT 1");
            $stmt->bind_param("si", $_POST["cpf"], $_POST["id"]);
            $stmt->execute();
            $res = $stmt->get_result()->fetch_assoc();

            if (!empty($res)) {
                $error_fields[] = "cpf";
                $error_msg .= "CPF já cadastrado <br/>";
            }
        }

        if (empty($error_fields)) {
            $id = $_POST["id"];
            $nome = $_POST["nome"];
            $sexo = $_POST["sexo"];
            $rg= $_POST["rg"];
            $cpf = $_POST["cpf"];
            $data_nasc = date_format(date_create_from_format('d/m/Y', $_POST["data_nasc"]), 'Y-m-d');
            $endereco= $_POST["endereco"];
            $telefone = $_POST["telefone"];
            $email = $_POST["email"];
            $estado_civil = $_POST["estado_civil"];
            $nome_da_mae = $_POST["nome_da_mae"];

            $stmt = $conn->prepare("UPDATE pessoa SET
                nome = ?,
                rg = ?,
                cpf = ?,
                data_nasc = ?,
                endereco = ?,
                telefone = ?,
                email = ?,
                sexo = ?
                WHERE id = ?");

            $stmt->bind_param("sissssssi", $nome, $rg, $cpf, $data_nasc, $endereco, $telefone, $email, $sexo, $id);
            $stmt->execute();
            $insert_id = $stmt->insert_id;

            $stmt = $conn->prepare("UPDATE paciente SET
                estado_civil = ?,
                nome_da_mae = ?
                WHERE id_pessoa = ?");
            $stmt->bind_param("ssi", $estado_civil, $nome_da_mae, $id);
            $stmt->execute();
            $stmt->close();
            $success = 1;
        }
    }
    povoa_campos($paciente, $conn);
    $conn->close();
    $error_fields = json_encode($error_fields, JSON_FORCE_OBJECT);
?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Editar Paciente
  </h1>
  <ol class="breadcrumb">
    <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Editar Paciente</li>
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
                <form role="form" action="index.php?page=editar_paciente" method="post">
                    <div class="box-body">
                        <input type="hidden" name="id" value="<?php echo $_REQUEST["id"]; ?>" />
                        <div class="form-group">
                            <label for="nome">Nome Completo</label>
                            <input type="text" class="form-control" name="nome" id="nome" value="<?php echo $paciente["nome"]; ?>" placeholder="Digite o nome do paciente" />
                        </div>
                        <div class="form-group">
                          <label>Sexo</label>
                          <select name="sexo" id="sexo" class="form-control select2" style="width: 100%;">
                            <option <?php if ($paciente["sexo"] == "Masculino") { echo "selected=selected"; } ?> >Masculino</option>
                            <option <?php if ($paciente["sexo"] == "Feminino") { echo "selected=selected"; } ?> >Feminino</option>
                          </select>
                        </div>
                        <div class="form-group">
                            <label for="rg">RG</label>
                            <input type="number" class="form-control" name="rg" id="rg" value="<?php echo $paciente["rg"]; ?>" placeholder="Digite o RG do paciente" />
                        </div>
                        <div class="form-group">
                            <label for="cpf">CPF</label>
                            <input type="text" class="form-control" name="cpf" id="cpf" value="<?php echo $paciente["cpf"]; ?>" placeholder="___.___.___-__" data-inputmask='"mask": "999.999.999-99"' data-mask />
                        </div>
                        <div class="form-group">
                            <label>Data de Nascimento:</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control" name="data_nasc" id="data_nasc" value="<?php echo date("d/m/Y", strtotime($paciente["data_nasc"])); ?>" placeholder="dd/mm/aaaa" data-inputmask="'alias': 'dd/mm/aaaa'" data-mask />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="endereco">Endereço</label>
                            <input type="text" class="form-control" name="endereco" id="endereco" value="<?php echo $paciente["endereco"]; ?>" placeholder="Digite o endereço do paciente"/>
                        </div>
                        <div class="form-group">
                            <label for="telefone">Telefone</label>
                            <input type="text" class="form-control" name="telefone" id="telefone" value="<?php echo $paciente["telefone"]; ?>" placeholder="(__) ____-____" />
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" id="email" value="<?php echo $paciente["email"]; ?>" placeholder="Digite o email do paciente" />
                        </div>
                        <div class="form-group">
                          <label>Estado Civil</label>
                          <select name="estado_civil" id="estado_civil" class="form-control select2" style="width: 100%;">
                            <option <?php if ($paciente["estado_civil"] == "Solteiro") { echo "selected=selected"; } ?> >Solteiro</option>
                            <option <?php if ($paciente["estado_civil"] == "Casado") { echo "selected=selected"; } ?> >Casado</option>
                          </select>
                        </div>
                        <div class="form-group">
                            <label for="nomedamae">Nome da mãe</label>
                            <input type="text" class="form-control" name="nome_da_mae" id="nome_da_mae" value="<?php echo $paciente["nome_da_mae"]; ?>" placeholder="Digite o nome da mãe do paciente"/>
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
                <h4 class="modal-title"><i class="fa fa-plus"></i> Editar paciente</h4>
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
                <h4 class="modal-title"><i class="fa fa-edit"></i> Editar paciente</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <p style="font-size:18px">Dados editados com sucesso</p>
                </div>
            </div>
            <div class="modal-footer clearfix">
                <button type="button" class="btn btn-outline pull-right" data-dismiss="modal"><i class="fa fa-check"></i> OK</button>
            </div>
        </div>
    </div>
</div>
