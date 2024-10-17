<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <title>Login de Clientes</title>
    <style>
        .mostra-pw{
            background-color: gray;
            padding: 5px 10px;
            display: inline-block;
            border-radius: 5px;
            color: white;
        }
    </style>

    <script src="includes/js/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function(){
            //mostrar password
            $('.mostra-pw').on("mousedown", function() {
                $(this).text("Ocultar");
                $('input[name="password"]').attr('type', 'text');
            });
 
            $('.mostra-pw').on("mouseup mouseleave", function() {
                $(this).text("Mostrar");
                $('input[name="password"]').attr('type', 'password');
            });

            //SUBMIT DO FORM
            $('.form_registo').on('submit', function(){
                var utilizador = $('input[name="utilizador"]');
                var email = $('input[name="email"]');
                var password = $('input[name="password"]');

  
            });

        });

        
    </script>
</head>
<body>
    <h1>Login do Cliente</h1>
    <?php
    //POR NO HEADER
    function apresenta_msg($msg, $tipo){
        $cor = '';

        if($tipo == 'alerta')
            $cor = 'yellow';
        else if ($tipo == 'sucesso')
            $cor = 'green';
        else if ($tipo == 'erro')
            $cor = 'red';
        else if ($tipo == 'info')
            $cor = 'cyan';

        if($msg)
            echo "<div style=\"background:$cor; color:white; padding:20px; margin-bottom;30px\">". $msg . '</div>';
    }

    $msg = $_GET['msg'];
    if($msg == 'sem_permissoes')
        apresenta_msg('Nao tem permissoes para aceder a esta pagina, realize o login a baixo','info');

    else if ($msg == 'inserir_cliente_ok')
        apresenta_msg('Cliente registado com sucesso','sucesso');
    else if ($msg == 'inserir_cliente_err')
    apresenta_msg('Nao foi possivel registar','erro');
    ?>
    <a href="index.php">Inicio</a>
    <br><br>

    <form class="form_registo" action="actions.php?act=login_cliente" method="POST">
        <table border="0">
            <tr>
                <td><label for="input_utilizador">Email ou utilizador:</label></td>
                <td>
                    <input name="utilizador" id="input_utilizador" type="text">
                </td>
            </tr>
            <tr>
                <td><label for="input_password">Password:</label></td>
                <td>
                    <input name="password" id="input_password" type="password"> <span class="mostra-pw">Mostrar</span>
                </td>
            </tr>
            <tr>
                <td colspan="2" align="right" height="40" valign="bottom">
                    <input type="submit" value="login">
                </td>
            </tr>
        </table> 
    </form>
</body>
</html>