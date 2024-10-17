<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <title>Login de fornecedores</title>
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
    <h1>Login do fornecedor</h1>
    
    <a href="index.php">Inicio</a>
    <br><br>

    <form class="form_registo" action="actions.php?act=login_fornecedor" method="POST">
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