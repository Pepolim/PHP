<?php
include 'configs.php';
$ID = htmlentities($_GET['ID']);

$stmt = $conn->prepare('SELECT nome, morada, tipo, foto FROM clientes WHERE ID = ?');
$stmt->bind_param('i', $ID);
$stmt->execute();

$results = $stmt->get_result();
$row = $results->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="pt-PT">

<head>
    <meta charset="UTF-8">
    <title>Alterar cliente</title>
</head>

<body>
    <h1>Alterar cliente</h1>
    <a href="lista_clientes.php">Voltar à listagem de clientes</a>
    <br><br>

    <form action="actions.php?act=alterar_cliente" method="POST" enctype="multipart/form-data">
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
                <td><label for="input_tipo">Tipo:</label></td>
                <td>
                    <select name="tipo" id="input_tipo">
                        <option></option>
                        <option value="admin" <?php if ($row['tipo'] == 'admin') echo 'selected' ?>>Admin</option>
                        <option value="utilizador" <?= $row['tipo'] == 'utilizador' ? 'selected' : '' ?>>Utilizador</option>
                        <option value="moderador" <?= $row['tipo'] == 'moderador' ? 'selected' : '' ?>>Moderador</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="input_foto">Foto:</label></td>
                <td>
                    <a href="imgs/clientes/<?= $row['foto'] ?>" target="_blank">
                        <img src="imgs/clientes/<?= $row['foto'] ?>" alt="<?= $row['foto'] ?>" height="200">
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