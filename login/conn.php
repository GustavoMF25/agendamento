<?php

try {
    $schemaBase = "syntaxweb_agendamento";
    $con = mysqlI_connect("localhost", "root", "", $schemaBase);



    $sql = "SET NAMES 'utf8'";
    mysqli_query($con, $sql);

    $sql = 'SET character_set_connection=utf8';
    mysqli_query($con, $sql);

    $sql = 'SET character_set_client=utf8';
    mysqli_query($con, $sql);

    $sql = 'SET character_set_results=utf8';
    $res = mysqli_query($con, $sql);
} catch (Exception $e) {
    header("Location: ./start.php");
}
