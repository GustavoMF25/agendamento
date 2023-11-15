<?php
include './config/config.php';
include './config/conn.php';
// apaga sessão
mysqli_close($con);
session_start();
session_destroy();

$msg = "Logout efetuado!";
header("location:../index.php?msg=" . $msg);