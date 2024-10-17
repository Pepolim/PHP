<?php
include 'configs.php';

if(!$_SESSION){
    //echo "Não tens sessão realizada";
    header('Location: login_clientes.php');
    exit;
}

?>
<!DOCTYPE html>
<html lang="pt-PT">

<head>
    <meta charset="UTF-8">
    <title>Clientes</title>
</head>

<body>
    <h1>Clientes</h1>
    <a href="index.php">Inicio</a>
    <br><br>
    <a href="inserir_cliente.php">Registar novo cliente</a>
    <br><br>

    <table border="1">
        <tr>
            <th>
                Foto
            </th>
            <th>
                Nome
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
        
        $sql = 'SELECT ID, nome, morada, tipo, foto FROM clientes ORDER BY nome';
        $results = $conn->query($sql);

        while($row = $results->fetch_assoc()){
        ?>
            <tr>
                <td align="center">
                    <a href="imgs/clientes/<?= $row['foto'] ?>" target="_blank">
                        <img src="imgs/clientes/<?= $row['foto'] ?>" alt="<?= $row['nome'] ?>" height="50">
                    </a>
                    <?php //echo $row['foto'] ?>
                </td>
                <td>
                    <?= $row['nome'] ?>
                </td>
                <td>
                    <?= $row['morada'] ?>
                </td>
                <td>
                    <?= $row['tipo'] ?>
                </td>
                <td align="center">
                    <a href="actions.php?act=delete_client&ID=<?= $row['ID'] ?>" onclick="return confirm('Pretende apagar este cliente?')" style="text-decoration: none;">
                        <img src="imgs/tema/delete.png" alt="Eliminar" title="Eliminar cliente">
                    </a>
                    <a href="alterar_cliente.php?ID=<?= $row['ID'] ?>">
                        <img src="imgs/tema/edit.png" alt="Editar" title="Editar cliente">
                    </a>
                </td>
            </tr>
        <?php
        }
        ?>
    </table>
</body>

</html>