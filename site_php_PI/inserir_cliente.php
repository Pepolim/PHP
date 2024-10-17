<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <title>Registo de um novo cliente</title>
</head>
<body>
    <h1>Registar novo cliente</h1>
    
    <a href="lista_clientes.php">voltar a listagem de clientes</a>
    <br><br>
    <!-- enctype="multipart/form-data" SERVE PARA CONSEGUIR RECEBER IMAGENS-->
    <form action="actions.php?act=inserir_cliente" method="POST" enctype="multipart/form-data">
        <table border="0">
            <tr>
                <td><label for="input_nome">Nome:</label></td>
                <td><input name="nome" id="input_nome" type="text"></td>
            </tr>
            <tr>
                <td><label for="input_morada">Morada:</label></td>
                <td>
                    <textarea name="morada" id="input_morada"></textarea>
                </td>
            </tr>
            <tr>
                <td><label for="input_tipo">Tipo:</label></td>
                <td>
                    <select name="tipo" id="input_tipo">
                        <option value="admin">Admin</option>
                        <option value="utilizador">Utilizador</option>
                        <option value="moderador">Moderador</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="input_foto">Foto:</label></td>
                <td>
                    <input name="foto" id="input_foto" type="file"></td>
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