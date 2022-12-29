<?php
function databanco($dt)
{
    $data = explode("/", $dt); //[29][06][2019]
    $data = array_reverse($data); // [2019][06][29]
    $dt = implode("-", $data);
    return $dt; //2019-06-29
}

function dataBuscaBanco($dt)
{
    $data = explode("-", $dt); //[2019][06][29]
    $data = array_reverse($data); // [29][06][2019]
    $dt = implode("/", $data);
    return $dt; // 29/06/2019
}
