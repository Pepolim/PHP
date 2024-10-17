<?php
session_start();

if ($_SESSION){
?>
    seja bem-vindo
    <strong style="text-transform: capitalize;"><?= $_SESSION['nome']?></strong>
    (<?=$_SESSION['tipo']?>)
    <a href="actions.php?act=logout">Logout</a>
<?php
}
else{
?>
    <a href="login_fornecedor.php"> Iniciar sessão fornecedor</a>
    | 
    <a href="registo_fornecedor.php"> Criar novo registo fornecedor </a>

<?php 
}
?>