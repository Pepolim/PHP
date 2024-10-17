<!DOCTYPE html>
<html lang="pt-PT">
<head>
    <meta charset="UTF-8">
    <title>Registo de um novo fornecedor</title>
</head>
<body>
    <h1>Registar novo fornecedor</h1>
    
    <a href="lista_fornecedores.php">voltar a listagem de fornecedores</a>
    <br><br>

    <form action="actions.php?act=inserir_fornecedor" method="POST" enctype="multipart/form-data">
        <table border="0">
            <tr>
                <td><label for="input_nome">Nome:</label></td>
                <td><input name="nome" id="input_nome" type="text"></td>
            </tr>

            <tr>
                <td><label for="input_telefone">Telefone:</label></td>
                <td>
                    <input name="telefone" id="input_telefone" type="text" maxlength="20" pattern="^\+\d{2,3}\s\d{3}\s\d{3}\s\d{3}$" placeholder="+00(0) 000 000 000">
                </td>
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
                        <option></option>
                        <option value="admin">Admin</option>
                        <option value="utilizador">Utilizador</option>
                    </select>
                </td>
            </tr>

            <tr>
                <td><label for="input_foto">Foto:</label></td>
                <td>
                    <input name="foto" id="input_foto" type="file" accept=".jpg, .png, .jpeg"></td>
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