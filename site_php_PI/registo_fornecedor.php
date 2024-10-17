<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <title>Registo de fornecedores</title>
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
            /*
            $('.bt-1').on("click", function() {
                $('input[name="password"]').attr('type', 'text');

                if($(this).text() == "Mostrar"){
                    $(this).text("Ocultar");
                    $('input[name="password"]').attr('type', 'text');
                }
                else{
                    $(this).text("Mostrar");
                    $('input[name="password"]').attr('type', 'password');
                }
            })*/

            //mostrar password
            $('.mostra-pw').on("mousedown", function() {
                $(this).text("Ocultar");
                $('input[name="password"]').attr('type', 'text');
                $('input[name="rep_password"]').attr('type', 'text');
            });
 
            $('.mostra-pw').on("mouseup mouseleave", function() {
                $(this).text("Mostrar");
                $('input[name="password"]').attr('type', 'password');
                $('input[name="rep_password"]').attr('type', 'password');
            });

            //SUBMIT DO FORM
            $('.form_registo').on('submit', function(){
                var nickname = $('input[name="nickname"]');
                var email = $('input[name="email"]');
                var pw1 = $('input[name="password"]');
                var pw2 = $('input[name="rep_password"]');

  
                //Nome Obrigatorio
                if($.trim(nickname.val()) == ""){
                    alert("Error: O campo Nome necessita de ser preenchido");
                    nickname.val("");
                    nickname.focus();
                    return false;
                }
                
                
                //Email Obrigatorio
                if($.trim(email.val()) == ""){
                    alert("Error: O campo Email necessita de ser preenchido");
                    email.val("");
                    emial.focus();
                    return false;
                }

                //Validar passwords
                if(pw1.val() != pw2.val()){
                    alert("Error: As passwords são diferentes!");
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
    <h1>Registo do fornecedor</h1>
    
    <a href="index.php">Inicio</a>
    <br><br>

    <form class="form_registo" action="actions.php?act=registar_fornecedor" method="POST">
        <table border="0">
            <tr>
                <td><label for="input_nickname" >Nome(nickname):</label></td>
                <td><input name="nickname" id="input_nickname" type="text"></td>
            </tr>

            <tr>
                <td><label for="input_email">Email:</label></td>
                <td>
                    <input name="email" id="input_email" type="text" placeholder="exemplo@gmail.com">
                </td>
            </tr>
            <tr>
                <td><label for="input_password">Password:</label></td>
                <td>
                    <input name="password" id="input_password" type="password"> <span class="mostra-pw">Mostrar</span>
                </td>
            </tr>
            <tr>
                <td><label for="input_rep_password">Password:</label></td> 
                <td>
                    <input name="rep_password" id="input_rep_password" type="password">
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