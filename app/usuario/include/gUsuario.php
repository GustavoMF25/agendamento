<?php

include '../../config/conn.php';
include '../../config/config.php';

$nome = isset($_POST['nome']) ? $_POST['nome'] : null;
$login = isset($_POST['login']) ? $_POST['login'] : null;
$email_usuario = isset($_POST['email_usuario']) ? $_POST['email_usuario'] : null;
$nascimento = isset($_POST['nascimento']) ? $_POST['nascimento'] : null;
$senha = isset($_POST['senha']) ? $_POST['senha'] : null;
$confirmar_senha = isset($_POST['confirma_senha']) ? $_POST['confirma_senha'] : null;
$response = array();

if (!empty($nome) && !empty($login) && !empty($email_usuario) && !empty($nascimento) && !empty($senha) && !empty($confirmar_senha)) {

    if ($senha == $confirmar_senha) {
        $senha = md5($senha);

        $dataAtual = date('Y-m-d H:i:s');

        $query = "insert into usuario(
                idsistema,
                nome,
                login,
                senha,
                email,
                datanascimento,
                created_at,
                updated_at,
                status                
            ) values(
                {$_SESSION['idsistema']},
                '{$nome}',
                '{$login}',
                '{$senha}',
                '{$email_usuario}',
                '{$nascimento}',
                '{$dataAtual}',
                '{$dataAtual}',
                'a'
            )";
        if (mysqli_query($con, $query)) {
            $response = ["msg" => "Usuario registrado com sucesso!", "response" => true, "acao" => 0];
        } else {
            $response = ["msg" => "Falha ao registrar o usuario!", "response" => false, "acao" => 1];
        }
    } else {
        $response = ["msg" => "As senhas não são parecidas, por favor tente novamente!", "response" => false, "acao" => 2];
    }
} else {
    $response = ["msg" => "Por favor, preencha corretamente as informações!", "response" => false, "acao" => 2];
}
header("Location: ../../index.php?msg={$response['msg']}&response={$response['response']}&acao={$response['acao']}");
