<?php

include "../config/config.php";
include "../config/conn.php";


$sqlQuery = "select 
                id,
                titulo ,
                inicio,
                fim,
                importancia
            from agendamento where idusuario = {$_session['id']}";
$resp = mysqli_query($con, $sqlQuery);
$response = [];
$i = 0;
while ($row = mysqli_fetch_array($resp)) {
    $response[$i]["id"] = $row[0];
    $response[$i]["title"] = $row[1];
    $response[$i]["start"] = $row[2];
    $response[$i]["end"] = $row[3];
    switch ($row[4]) {
        case 1:
            $response[$i]["className"] = "bg-danger";
        case 2:
            $response[$i]["className"] = "bg-warning";
        case 3:
            $response[$i]["className"] = "bg-success";
    }
}

echo json_encode($response);
