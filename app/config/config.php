<?php

session_start();

setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');

//DOMAIN = dominio Ex:.. localhost
function pathUrl() {
    $root = "";
    $dir = str_replace('\\', '/', realpath($dir = __DIR__));

    //HTTPS OU HTTP
    $root .= !empty($_SERVER['HTTPS']) ? 'https' : 'http';
    //Host
    $root .= '://' . $_SERVER['HTTP_HOST'];
    //ALIAS
    if (!empty($_SERVER['CONTEXT_PREFIX'])) {
        $root .= $_SERVER['CONTEXT_PREFIX'];
        $root .= substr($dir, strlen($_SERVER['CONTEXT_DOCUMENT_ROOT']));
    } else {
        $root .= substr($dir, strlen($_SERVER['DOCUMENT_ROOT']));
    }
    $root .= '/';
    return $root;
}

//Dominio/
$temBasef = array_reverse(explode('/', pathUrl()));
unset($temBasef[0], $temBasef[1], $temBasef[2]);
define('BASEF', implode('/', array_reverse($temBasef)));

//Dominios/app
$tempBased = array_reverse(explode('/', pathUrl()));
unset($tempBased[0], $tempBased[1]);
define('BASED', implode('/', array_reverse($tempBased)));



