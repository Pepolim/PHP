<?php
include 'configs.php';
?>
<!DOCTYPE html>
<html lang="pt-PT">

<head>
    <meta charset="UTF-8">
    <title>Fornecedores</title>
</head>

<body>
    <h1>Fornecedores</h1>
    <a href="index.php">Inicio</a>
    <br><br>
    <a href="inserir_fornecedor.php">Registar novo fornecedor</a>
    <br><br>
    
    <table border="1" cellpadding="3" >
        <tr>
            <th>
                Foto
            </th>
            <th>
                Nome
            </th>
            <th>
                Telefone
            </th>
            <th>
                Morada
            </th>
            <th>
                Tipo
            </th>
            <th>
                Opções
            </th>
        </tr>
        <?php
        
        $sql = 'SELECT ID, nome, morada, tipo, foto, telefone FROM fornecedores ORDER BY nome';
        $results = $conn->query($sql);

        while($row = $results->fetch_assoc()){
        ?>
            <tr>
                <td align="center">
                    <a href="imgs/fornecedores/<?= $row['foto'] ?>" target="_blank">
                        <img src="imgs/fornecedores/<?= $row['foto'] ?>" alt="<?= $row['nome'] ?>" height="50">
                    </a>
                </td>
                <td>
                    <?= $row['nome'] ?>
                </td>
                <td>
                    <?= $row['telefone'] ?>
                </td>
                <td>
                    <?= $row['morada'] ?>
                </td>
                <td>
                    <?= $row['tipo'] ?>
                </td>
                <td align="center">
                    <a href="actions.php?act=delete_fornec&ID=<?= $row['ID'] ?>" onclick="return confirm('Pretende apagar este fornecedor?')" style="text-decoration: none;">
                        <img src="imgs/tema/delete.png" alt="Eliminar" title="Eliminar fornecedor">
                    </a>
                    <a href="alterar_fornecedor.php?ID=<?= $row['ID'] ?>">
                        <img src="imgs/tema/edit.png" alt="Editar" title="Editar fornecedor">
                    </a>
                </td>
            </tr>
        <?php
        }
        ?>
    </table>
</body>

</html>