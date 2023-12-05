<?php
require("../required.php");
include '../app/config/conn.php';

try {
    $nomeSistema = $_POST['nome-sistema'] ? $_POST['nome-sistema'] : '';
    $telefone = $_POST['telefone'] ? $_POST['telefone'] : '';
    $emailSistema = $_POST['email'] ? $_POST['email'] : '';
    $foto = $_FILES['foto'] ? $_FILES['foto'] : '';
    $data = date("Y-m-d");
    $hora = date("H:i:s");
    $response = [];

    $sqlSistema = "insert into sistema(nomecliente, emailcliente, logo, telefone, ativo, datager, horager) values('$nomeSistema','$emailSistema', ";

    if ($foto) {
        $ext = explode(".", $foto["name"]);
        $ext = array_reverse($ext);
        $ext = strtolower($ext[0]);
        if ($ext != "jpg" && $ext != "gif" && $ext != "png") { //Verifica extensao do arquivo
            $response = ['response' => false, "msg" => "Escolha um arquivo valido!"];
            $foto = null;
        } elseif ($foto["size"] > 3000 * 4000) { //Verifica tamanho do arquivo
            $response = ['response' => false, "msg" => "Tamanho excedido!"];
            $foto = null;
        } else {
            $nomefoto = explode('.', $foto["name"])[0] . "_" . date("YmdHis") . "." . $ext;
            $salvaArquivo = move_uploaded_file($foto["tmp_name"], "../app/assets/images/sistemas/" . $nomefoto);

            if ($salvaArquivo) {
                $local = "sistemas/" . $nomefoto;
                $sqlSistema .= "'$local', ";
            } else {
                $response = ['response' => false, "msg" => "Falha ao salvar a foto!"];
            }
        }
    } else {
        $sqlSistema .= "'', ";
    }
    $sqlSistema .= "'$telefone' , 's', '$data', '$hora')";


    if ($stmt = mysqli_prepare($con, $sqlSistema)) {
        mysqli_stmt_execute($stmt);
        $idSistema = mysqli_insert_id($con);
        $response = ['response' => true, "msg" => "Sistema cadastrado com sucesso! ", "idSistema" => $idSistema];
    }
    echo json_encode($response);
} catch (Exception $e) {
    $response =  ['response' => false, "msg" => "Ocorreu uma falha na criação do sistema, por favor entre em contato com o administrador do sistema!", "erro" =>  $e->getMessage()];
    echo json_encode($response);
}
