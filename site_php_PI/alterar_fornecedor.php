<?php
include 'configs.php';
$ID = $_GET['ID'];

$stmt = $conn->prepare('SELECT nome, telefone, morada, tipo, foto FROM fornecedores WHERE ID = ?');
$stmt->bind_param('i', $ID);
$stmt->execute();

$results = $stmt->get_result();
$row = $results->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="pt-PT">

<head>
    <meta charset="UTF-8">
    <title>Alterar Fornecedor</title>
</head>

<body>
    <h1>Alterar Fornecedor</h1>
    <a href="lista_fornecedores.php">Voltar à listagem de fornecedores</a>
    <br><br>

    <form action="actions.php?act=alterar_fornecedor" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="ID" value="<?= $ID?>">
        <table border="0">
            <tr>
                <td>Nome:</td>
                <td><input name="nome" type="text" required value="<?= $row['nome'] ?>" autocomplete="off"></td>
            </tr>
            <tr>
                <td><label for="input_morada">Morada:</label></td>
                <td>
                    <textarea name="morada" id="input_morada"><?= $row['morada'] ?></textarea>
                </td>
            </tr>
            <tr>
                <td><label for="input_telefone">Telefone:</label></td>
                <td>
                    <input name="telefone" id="input_telefone" type="text" maxlength="20" pattern="^\+\d{2,3}\s\d{3}\s\d{3}\s\d{3}$" placeholder="+00(0) 000 000 000" value="<?= $row['telefone']?>">
                </td>
            </tr>
            <tr>
                <td><label for="input_tipo">Tipo:</label></td>
                <td>
                    <select name="tipo" id="input_tipo">
                        <option></option>
                        <option value="admin" <?php if ($row['tipo'] == 'admin') echo 'selected' ?>>Admin</option>
                        <option value="utilizador" <?= $row['tipo'] == 'utilizador' ? 'selected' : '' ?>>Utilizador</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="input_foto">Foto:</label></td>
                <td>
                    <a href="imgs/clientes/<?= $row['foto'] ?>" target="_blank">
                        <img src="imgs/fornecedores/<?= $row['foto'] ?>" alt="<?= $row['foto'] ?>" height="200">
                    </a>
                    <br>
                    <input name="foto" id="input_foto" type="file" accept="image/*">
                </td>
            </tr>

            <tr>
                <td colspan="2" align="right" height="40" valign="bottom">
                    <input type="submit" value="Alterar">
                </td>
            </tr>
        </table>
    </form>
</body>

</html>