<?php
//session_start();
include 'header.php'
?>
<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <title>Testes em PHP</title>
</head>
<body>
    
    <?php
    /*
        $username = "Pepolim";
        $email = "n.pepolim@gmail.com";
        $quant_posts = 10;
        $admin = true;
        $genero = 'm';
        $racio = 15.56;
        $saldo = 1500000;
        
        echo "O meu nome é $username ";
        if($genero = 'm')
            echo "sou um homem";
        else
            echo "sou uma mulher";

        echo " ja publiquei $quant_posts vezes com um ratio de $racio";
        
        if($admin)
            echo " , sou admin";
        else
            echo " , sou um utilizador";

        echo " e podem-me contactar com o email $email<br>";
        echo "O $username tem \${$saldo}eur"*/
    ?>
    <br><br>
    <a href="lista_clientes.php">Listagem de Clientes</a>
    <br><br>
    <a href="lista_fornecedores.php">Listagem de Fornecedores</a>
    <br><br><br>
    <a href="registo_cliente.php">Registo de Clientes</a>
    <br><br>
    <a href="login_clientes.php">Login de Clientes</a>
    <br><br>
</body>
</html>