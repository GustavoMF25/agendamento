<?php
include "../config/config.php";
include "../config/conn.php";


$titulo = isset($_POST['titulo']) ? $_POST['titulo'] : '';
$url = isset($_POST['url']) ? $_POST['url'] : '';
$dataInicio = isset($_POST['dataInicio']) ? $_POST['dataInicio'] : '';
$dataFim = isset($_POST['dataFim']) ? $_POST['dataFim'] : '';
$horaInicio = isset($_POST['horaInicio']) ? $_POST['horaInicio'] : 'null';
$horaFim = isset($_POST['horaFim']) ? $_POST['horaFim'] : 'null';
$importancia = isset($_POST['importancia']) ? $_POST['importancia'] : '';
$descricao = isset($_POST['descricao']) ? $_POST['descricao'] : '';
$duracao = isset($_POST['duracao']) ? $_POST['duracao'] : '0';
$response = [];

if ($titulo != '' && $dataInicio != '' && $dataFim != '' && $importancia != '') {

    $horaInicio = $horaInicio != '' ? "'$horaInicio'" : 'null';
    $horaFim = $horaFim != '' ? "'$horaFim'" : 'null';

    $sqlInsert = "insert into agendamento values(
                                            null,
                                            {$_SESSION['id']}, 
                                            {$_SESSION['idsistema']}, 
                                            '{$titulo}', 
                                            {$importancia}, 
                                            '{$url}', 
                                            '{$descricao}', 
                                            '{$dataInicio}', 
                                            '{$dataFim}', 
                                            '$duracao', 
                                            {$horaInicio}, 
                                            {$horaFim}
                                        )";

    if (!mysqli_query($con, $sqlInsert)) {
        $response = ["msg" => "Erro ao criar evento :/ ", "acao" => "2"];
    } else {
        $response = ["msg" => "Evento criado com Sucesso! :D", "acao" => "0"];
    }
} else {
    $response = ["msg" => "Preencha as informações", "acao" => "1"];
}
header("Location: ../?msg={$response['msg']}&acao={$response['acao']}");