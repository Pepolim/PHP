<?php
include 'configs.php';

$act = $_GET['act'];

if ($act == 'teste') {
    $nickname = htmlentities($_POST['nickname']);
    $email = htmlentities($_POST['email']);
    $pw = htmlentities($_POST['pw']);
    $telefone = htmlentities($_POST['telefone']);
    $total_posts = htmlentities($_POST['total_posts']);

    $stmt = $conn->prepare('INSERT INTO utilizadores (nickname, email, pw, telefone, total_posts) VALUES(?,?,?,?,?)');
    $stmt->bind_param('ssssi', $nickname, $email, $pw, $telefone, $total_posts);
    $stmt->execute();

    if ($stmt->affected_rows !== 0) {
        echo json_encode(
            array(
                'status' => 'ok',
                'msg' => 'Registo efetuado com sucesso'
            )
        );
    } else {
        echo json_encode(
            array(
                'status' => 'err',
                'msg' => 'Não foi possível registar o utilizador'
            )
        );
    }
}
