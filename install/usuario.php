<?php
require("../required.php");
include '../app/config/conn.php';

try {
    $nome = $_POST['nome'] ? $_POST['nome'] : '';
    $login = $_POST['login'] ? $_POST['login'] : '';
    $email = $_POST['email'] ? $_POST['email'] : '';
    $idsistemas = $_POST['idsistemas'] ? $_POST['idsistemas'] : '';
    $datanascimento = $_POST['datanascimento'] ? $_POST['datanascimento'] : '';
    $senha = $_POST['senha'] ?  password_hash($_POST['senha'], PASSWORD_DEFAULT)  : '';
    $foto = $_FILES['foto'] ? $_FILES['foto'] : '';
    $data = date("Y-m-d");
    $hora = date("H:i:s");

    $sqlUser = "insert into usuario(
        idsistema,
        nome,
        login,
        senha,
        email,
        foto,
        datanascimento,
        created_at,
        updated_at,
        status
    ) values (
        $idsistemas,
        '$nome',
        '$login',
        '$senha',
        '$email',
        ";

    if ($foto) {
        $ext = explode(".", $foto["name"]);
        $ext = array_reverse($ext);
        $ext = strtolower($ext[0]);
        if ($ext != "jpg" && $ext != "jpeg" && $ext != "gif" && $ext != "png") { //Verifica extensao do arquivo
            $response = ['response' => false, "msg" => "Escolha um arquivo valido!"];
            $foto = null;
        } elseif ($foto["size"] > 3000 * 4000) { //Verifica tamanho do arquivo
            $response = ['response' => false, "msg" => "Tamanho excedido!"];
            $foto = null;
        } else {
            $nomefoto = explode('.', $foto["name"])[0] . "_" . date("YmdHis") . "." . $ext;
            $salvaArquivo = move_uploaded_file($foto["tmp_name"], "../app/assets/images/usuario/" . $nomefoto);

            if ($salvaArquivo) {
                
                $local = "usuario/" . $nomefoto;
                $sqlUser .= "'$local', ";
            } else {
                $sqlUser .= "'aaa', ";
                $response = ['response' => false, "msg" => "Erro ao salvar imagem!"];
            }
        }
    } else {
        $sqlUser .= "'', ";
    }

    $sqlUser .= "
            '$datanascimento',
            '$data $hora',
            '$data $hora',
            'a'
    )";
    $stmt = mysqli_prepare($con, $sqlUser);

    if ($stmt) {
        mysqli_stmt_execute($stmt);

        $response = ['response' => true, "msg" => "Usuario cadastrado com sucesso! "];
    }else{
        $response = ['response' => false, "msg" => "Falha ao cadastrado o usuario! "];
    }

    echo json_encode($response);
} catch (Exception $e) {

    echo json_encode(['response' => false, "msg" => "Ocorreu uma falha na instalação, por favor entre em contato com o administrador do sistema!", "erro" =>  $e->getMessage()]);
}
 
