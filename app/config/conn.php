<?php

try {
    $host = $_ENV['bd_host_mysql'];
    $usuario = $_ENV['bd_user_mysql'];
    $schemaBase = $_ENV['bd_schema_mysql'];
    $password = $_ENV['bd_password_mysql'];

    if (!isset($host)) {
        header('Location: ../');
    }

    $con = mysqlI_connect($host, $usuario, $password, $schemaBase);

    $sql = "SET NAMES 'utf8'";
    mysqli_query($con, $sql);

    $sql = 'SET character_set_connection=utf8';
    mysqli_query($con, $sql);

    $sql = 'SET character_set_client=utf8';
    mysqli_query($con, $sql);

    $sql = 'SET character_set_results=utf8';
    $res = mysqli_query($con, $sql);
} catch (Exception $e) {
    header('Location: ../');
}
