<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Registar</title>
    <style>
        .mostra-pw {
            background-color: gray;
            padding: 5px 10px;
            display: inline-block;
            border-radius: 5px;
            color: white;
            margin-left: 10px;
        }
    </style>
    <script src="includes/js/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.mostra-pw').on("mousedown", function() {
                $(this).text("Ocultar");
                $('input[name="password"]').attr('type', 'text');
                $('input[name="re_password"]').attr('type', 'text');
            });

            $('.mostra-pw').on("mouseup mouseleave", function() {
                $(this).text("Mostrar");
                $('input[name="password"]').attr('type', 'password');
                $('input[name="re_password"]').attr('type', 'password');
            });

            // na submissão do formulário
            $('.form_registo').on('submit', function(){
                var nome = $('input[name="nome"]');
                var email = $('input[name="email"]');
                var pw1 = $('input[name="password"]');
                var pw2 = $('input[name="re_password"]');

                //Nome obrigatório
                if ($.trim(nome.val()) == ""){
                    alert("Erro: O campo Nome necessita de ser preenchido");
                    nome.val("");
                    nome.focus();
                    return false;
                }

                //Email obrigatório
                if ($.trim(email.val()) == ""){
                    alert("Erro: O campo Email necessita de ser preenchido");
                    email.val("");
                    email.focus();
                    return false;
                }

                // validar passwords
                if (pw1.val() != pw2.val()){
                    alert("Erro: As passwords são diferentes!");
                    pw1.val("");
                    pw2.val("");
                    pw1.focus();
                    return false;
                }
            });
        });
    </script>
</head>

<body>
    <h1>Registo do cliente</h1>
    <br><br>
    <a href="index.php">Inicio</a>
    <br><br>

    <form class="form_registo" action="actions.php?act=registar_cliente" method="POST">
        <table border="0">
            <tr>
                <td>Nome:</td>
                <td><input name="nome" type="text"></td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><input name="email" type="text"></td>
            </tr>
            <tr>
                <td>Password:</td>
                <td>
                    <input name="password" type="password">
                    <span class="mostra-pw">Mostrar</span>
                </td>
            </tr>
            <tr>
                <td>Repetir Password:</td>
                <td>
                    <input name="re_password" type="password">
                </td>
            </tr>
            <tr>
                <td colspan="2" align="right" height="40" valign="bottom">
                    <input type="submit" value="Registar">
                </td>
            </tr>
        </table>
    </form>
</body>

</html>