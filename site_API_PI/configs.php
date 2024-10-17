<?php
$server = 'localhost';
$user = 'root';
$pw = '';
$db = 'forum_pi';

error_reporting(E_ALL);
ini_set('display_errors', 1);
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$conn = new mysqli($server, $user, $pw, $db);

if($conn->connect_error)
    die("Erro ao ligar ao servidor de base de dados!<br>Datalhes: $conn->connect_error");