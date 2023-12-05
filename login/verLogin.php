<?php
require("../required.php");
include '../app/config/conn.php';
session_start();

function getUserIP()
{
    $client = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote = $_SERVER['REMOTE_ADDR'];

    if (filter_var($client, FILTER_VALIDATE_IP)) {
        $ip = $client;
    } elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
        $ip = $forward;
    } else {
        $ip = $remote;
    }

    return $ip;
}

$_SESSION['ip'] = $user_ip = getUserIP();
$login = $_POST["login"];
$senha = $_POST["senha"];
if ($login == null || $senha == null) {
    $msg = "=) <br>usuário e/ou senha inválidos.";

    header("location:../index?msg=" . $msg);
} else {
    $sql = "select 
                   id,
                   nome,
                   login,
                   email,
                   datanascimento,
                   idsistema,
                   foto,
                   senha
            from usuario 
            where login = '{$login}' and status = 'a'";

    if (!$query = mysqli_query($con, $sql)) {

        $msg = "<i class='fa fa-frown-o' aria-hidden='true'></i> <br> UErro ao procurar usuario";
        header("location: ../index.php?msg=" . $msg);
    } elseif (!mysqli_num_rows($query)) {

        $msg = "<i class='fa fa-frown-o' aria-hidden='true'></i> <br> Usuario desativado ou inexistente";
        header("location: ../index.php?msg=" . $msg);
    } else {

        $row = mysqli_fetch_array($query);
        if (password_verify($senha, $row[7])) {
            $sqlSistema = "select idplano, nomecliente, logo from sistema where ativo = 's' and id = {$row[5]}";

            $querySis = mysqli_query($con, $sqlSistema);
            $rowSis = mysqli_fetch_array($querySis);
            if (isset($rowSis)) {

                $_SESSION['id'] = $row[0];
                $_SESSION['nomesobrenome'] = $row[1];
                $_SESSION['login'] = $row[2];
                $_SESSION['email'] = $row[3];
                $_SESSION['datanascimento'] = $row[4];
                $_SESSION['idsistema'] = $row[5];
                $_SESSION['foto'] = $row[6];
                $_SESSION['idplano'] = $rowSis[0];
                $_SESSION['nomecliente'] = $rowSis[1];
                $_SESSION['logo'] = $rowSis[2];
                $_SESSION['temp'] = time();
                $_SESSION['tokenForm'] = md5(time());

                header("Location: ../app/");
            } else {
                $msg = "<i class='fa fa-frown-o' aria-hidden='true'></i> <br> Sistema desativado ou inexistente";
                header("location: ../index.php?msg=" . $msg);
            }
        } else {
            $msg = "<i class='fa fa-frown-o' aria-hidden='true'></i> <br> Erro ao procurar usuario";
            header("location: ../index.php?msg=" . $msg);
        }
    }
}
