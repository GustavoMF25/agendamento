<?php
include "../config/config.php";
include "../config/conn.php";
include "../config/funcao.php";
$id = $_POST['id'];
$sqlAgendamento = "select 
                        a.titulo,
                        a.importancia,
                        a.url,
                        a.descricao,
                        a.datainicio,
                        a.datafim,
                        a.diatodo,
                        a.horainicio,
                        a.horafim,
                        u.nome
                    from agendamento a
                    left join usuario u on (u.id = a.idusuario)
                    where a.id = {$id}";
$resp = mysqli_query($con, $sqlAgendamento);

$agendamento = mysqli_fetch_array($resp);


$titulo = $agendamento[0];
$importancia = $agendamento[1];
$url = $agendamento[2];
$descricao = $agendamento[3];
$dataInicio = dataBuscaBanco($agendamento[4]);
$dataFim = dataBuscaBanco($agendamento[5]);
$diatodo = $agendamento[6];
$horaInicio = $agendamento[7];
$horaFim = $agendamento[8];
$usuario = $agendamento[9];
?>
<div class="modal-header">
    <span class="">
        <h5 class="modal-title "><?= $titulo ?></h5>
    </span>

    <?php
    switch ($importancia) {
        case 3:
            echo "<span class='badge bg-danger'><i class='fas fa-exclamation-circle'></i> Urgente</span>";
            break;
        case 2:
            echo "<span class='badge bg-warning'><i class='fas fa-exclamation-circle'></i> Importante</span>";
            break;
        case 1:
            echo "<span class='badge bg-primary'><i class='fas fa-exclamation-circle'></i> Básico</span>";
            break;
    }
    ?>

</div>
<div class="modal-body">
    <div class="row">
        <div class="col-md-4 col-lg-4 col-sm-4 d-flex justify-content-start font-size-12">
            <span><b><small> De <?= $dataInicio ?> <?= !empty($horaInicio) ? "Ás " . $horaInicio : '' ?> </small></b></span>
        </div>
        <div class="col-md-4 col-lg-4 col-sm-4 d-flex justify-content-center">
            <span><b><small> <?= $diatodo == 1 ? 'Durante o dia inteiro' : '' ?> </small></b></span>
        </div>
        <div class="col-md-4 col-lg-4 col-sm-4 d-flex justify-content-end font-size-12">
            <span><b><small> Até <?= $dataFim ?> <?= !empty($horaFim) ? "Ás " . $horaFim : '' ?></small></b></span>
        </div>
        <div class="col-md-12 col-lg-12 col-sm-12">
            <?php
            if (!empty($url)) {
                echo "<span>URL : <a href='$url'>Clique Aqui</a></span>";
            }
            ?>
        </div>
        <hr style="border-bottom: 1px; border-color: #333;">
        <div class="col-md-12 col-lg-12 col-sm-12 justify-content-center">
            <?= $descricao ?>
        </div>

    </div>
</div>
<div class="modal-footer d-flex justify-content-between">

    <div>
        <span><small>Criado por: <b><?= $usuario ?></b></small></span>
    </div>
    <div>
        <button type="button" onclick="$('#modalDetalhes').modal('toggle')" class="btn btn-danger" data-dismiss="modal">Fechar</button>
    </div>
</div>
<?php
mysqli_close($con);
?>