<?php
    $error_fields = array ();
    $consulta = array ();
    $error_msg = "";
    $success = 0;
    include_once("util/connect.php");

    $stmt = $conn->prepare("SELECT pessoa.id, pessoa.nome, paciente.id_pessoa FROM pessoa, paciente WHERE pessoa.id = paciente.id_pessoa");
    $stmt->execute();

    $pacientes = $stmt->get_result();
    $stmt->close();

    $stmt = $conn->prepare("SELECT pessoa.id, pessoa.nome, medico.especialidade, medico.id_pessoa FROM pessoa, medico WHERE pessoa.id = medico.id_pessoa ORDER BY medico.especialidade ASC");
    $stmt->execute();

    $medicos = $stmt->get_result();
    $stmt->close();

    function povoa_campos (&$c, $connection) {
        $id = 0;

        if (isset($_REQUEST["id"]) && $_REQUEST["id"] != "") {
            $id = $_REQUEST["id"];
        }

        if ($id) {
            $stmt = $connection->prepare("SELECT * FROM consulta WHERE id = ?");
            $stmt->bind_param("i", $id);

            $stmt->execute();

            if ($c = $stmt->get_result()) {
                $c = $c->fetch_assoc();
            } else {
                $error = "Id não existente.";
            }
            $stmt->close();
        } else {
            echo "<script>window.location = 'index.php?page=medicos'</script>";
        }
    }

    if (isset($_POST["submit"])) {
        //checa há campos vazios
        foreach ($_POST as $key => $value) {
            if ($value == "" && $key != "submit") {
                $error_fields[] = $key;
                $error_msg = "Preencha todos os campos <br/>";
            }
        }

        //Checa se médico já possui consulta no horário
        if ($_POST["data"] != "" && $_POST["horarioinicio"] != "" && $_POST["horariofim"] != "" && $_POST["medico"] != "" && $_POST["id"] != "") {
            $stmt = $conn->prepare("SELECT data, horario_inicio, horario_fim FROM consulta WHERE medico = ? AND id != ?");

            $stmt->bind_param("ii", $_POST["medico"], $_POST["id"]);
            $stmt->execute();
            $res = $stmt->get_result();
            $stmt->close();

            $data = date_format(date_create_from_format('d/m/Y', $_POST["data"]), 'Y-m-d');

            $objHorarioInicio = new DateTime($data . " " . $_POST["horarioinicio"]);
            $objHorarioFim = new DateTime($data . " " . $_POST["horariofim"]);

            while ($aux = $res->fetch_assoc()) {
                $checkInicio = new DateTime($aux['data'] . " " . $aux['horario_inicio']);
                $checkFim = new DateTime($aux['data'] . " " . $aux['horario_fim']);

                if (($objHorarioInicio >= $checkInicio && $objHorarioInicio <= $checkFim) || ($objHorarioFim >= $checkInicio && $objHorarioFim <= $checkFim) || ($objHorarioInicio <= $checkInicio && $objHorarioFim >= $checkFim)) {
                    $error_fields[] = "medico";
                    $error_msg .= "Médico já possui consulta nesse horário";
                    break;
                }
            }
        }

        if (empty($error_fields)) {
            $id_consulta = $_POST["id"];
            $id_paciente = $_POST["paciente"];
            $data = date_format(date_create_from_format('d/m/Y', $_POST["data"]), 'Y-m-d');
            $horario_inicio= $_POST["horarioinicio"];
            $horario_fim = $_POST["horariofim"];
            $id_medico = $_POST["medico"];

            $stmt = $conn->prepare("UPDATE consulta SET
                paciente = ?,
                data = ?,
                horario_inicio = ?,
                horario_fim = ?,
                medico = ?
                WHERE id = ?");

            $stmt->bind_param("isssii", $id_paciente, $data, $horario_inicio, $horario_fim, $id_medico, $id_consulta);
            $stmt->execute();
            $stmt->close();
            $success = 1;
        }
    }
    povoa_campos($consulta, $conn);
    $conn->close();
    $error_fields = json_encode($error_fields, JSON_FORCE_OBJECT);
?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
    Editar Consulta
  </h1>
  <ol class="breadcrumb">
    <li><a href="index.php"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Editar Consulta</li>
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
                <form role="form" action="index.php?page=editar_consulta" method="post">
                    <div class="box-body">
                        <input type="hidden" name="id" value="<?php echo $_REQUEST["id"]; ?>" />
                        <div class="form-group">
                            <label for="paciente">Paciente:</label>
                            <select name="paciente" id="paciente" class="form-control select2" style="width: 100%;">
                                <?php while ($paciente = $pacientes->fetch_assoc()) { ?>
                                    <option
                                    <?php if ($consulta["paciente"] == $paciente["id"]) { echo "selected=selected";} ?>
                                    value="<?php echo $paciente["id"] ?>"
                                    >
                                        <?php echo $paciente["nome"]; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Data da Consulta:</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input type="text" class="form-control" name="data" id="data" value="<?php echo date("d/m/Y", strtotime($consulta["data"])); ?>" placeholder="dd/mm/aaaa" data-inputmask="'alias': 'dd/mm/aaaa'" data-mask />
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Horário de Início:</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-clock-o"></i>
                                </div>
                                <input type="text" class="form-control" name="horarioinicio" id="horarioinicio" value="<?php echo $consulta["horario_inicio"]; ?>" placeholder="hh:mm" data-inputmask='"mask": "hh:mm"' data-mask />
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Horário de Término:</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-clock-o"></i>
                                </div>
                                <input type="text" class="form-control" name="horariofim" id="horariofim" value="<?php echo $consulta["horario_fim"]; ?>" placeholder="hh:mm" data-inputmask='"mask": "hh:mm"' data-mask />
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="paciente">Médico:</label>
                            <select name="medico" id="medico" class="form-control select2" style="width: 100%;">
                                <?php while ($medico = $medicos->fetch_assoc()) { ?>
                                    <option
                                    <?php if ($consulta["medico"] == $medico["id"]) { echo "selected=selected";} ?>
                                    value="<?php echo $medico["id"] ?>"
                                    >
                                        <?php echo $medico["especialidade"] . " - " . $medico["nome"]; ?>
                                    </option>
                                <?php } ?>
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
                <h4 class="modal-title"><i class="fa fa-plus"></i> Marcação de consulta</h4>
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
                <h4 class="modal-title"><i class="fa fa-edit"></i> Marcação de consulta</h4>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <p style="font-size:18px">Consulta marcada com sucesso</p>
                </div>
            </div>
            <div class="modal-footer clearfix">
                <button type="button" class="btn btn-outline pull-right" data-dismiss="modal"><i class="fa fa-check"></i> OK</button>
            </div>
        </div>
    </div>
</div>
