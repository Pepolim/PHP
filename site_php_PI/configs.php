<?php

$debug = true;
$server = 'localhost';
$user = 'root';
$pw = '';
$db = 'livraria';

define('SALT', '@#$_erR_er€');

//limitar estas configs para um IP público:
//if($_SERVER['REMOTE_ADDR'] != "2.1.1.1")
//    $debug = false;
 
if($debug){
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}
else {
    error_reporting(0);
    ini_set('display_errors', 0);
}
 
$conn = new mysqli($server, $user, $pw, $db);
if($conn->connect_error){
    if ($debug)
        die("Erro ao ligar ao servidor de base de dados!<br>Datalhes: $conn->connect_error");
    else{
        //die("Erro ao tentar ligar ao servidor!");
        echo 'Erro ao tentar ligar ao servidor!';
        exit;
    }
}
/*
else
    echo "ok";
*/
