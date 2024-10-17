<?php
include 'configs.php';
?>
<!DOCTYPE html>
<html lang="pt-PT">

<head>
    <meta charset="UTF-8">
    <title>Fórum de coisas</title>
    <link rel="stylesheet" href="includes/styles.css">
    <script src="includes/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function() {
            //alert("aaa");
            $(".bt-registar").on('click', function() {
                let in_nickname = $('*[name="nickname"]').val();
                let in_email = $('*[name="email"]').val();
                let in_pw = $('*[name="pw"]').val();
                let in_telefone = $('*[name="telefone"]').val();
                let in_total_posts = $('*[name="total_posts"]').val();

                $.post(
                    "api.php?act=teste", {
                        nickname: in_nickname,
                        email: in_email,
                        pw: in_email,
                        telefone: in_telefone,
                        total_posts: in_total_posts
                    },
                    function(data) {
                        data = $.parseJSON(data);
                        if (alert(data.status) == 'ok')
                            alert("OK!!!\n" + data.msg)
                        else //if(alert(data.status) == 'erro')
                            alert("ERRO!!! Detalhes:\n" + data.msg)
                    }
                );
            });
        });
    </script>
</head>

<body>
    <h1>Utilizadores</h1>

    <div class="form-registo">
        <label>
            Nickname:<br>
            <input type="text" name="nickname">
        </label>
        <label>
            Email:<br>
            <input type="text" name="email">
        </label>
        <label>
            Pw:<br>
            <input type="text" name="pw">
        </label>
        <label>
            Telefone:<br>
            <input type="text" name="telefone">
        </label>
        <label>
            Total de posts do utilizador:<br>
            <input type="text" name="total_posts">
        </label>

        <input class="bt-registar" type="submit" value="Registar">
    </div>

    <br>

    <table class="formated-table">
        <tr>
            <th>Nickname</th>
            <th>Email</th>
            <th>Telefone</th>
            <th>Total de Posts</th>
            <th>Opções</th>
        </tr>
        <?php
        $sql = 'SELECT ID, nickname, email, telefone, total_posts FROM utilizadores ORDER BY nickname';
        $results = $conn->query($sql);

        while ($row = $results->fetch_assoc()) {
        ?>
            <tr>
                <td><?= $row['nickname'] ?></td>
                <td><?= $row['email'] ?></td>
                <td><?= $row['telefone'] ?></td>
                <td align="center"><?= $row['total_posts'] ?></td>
                <td align="center">
                    <img src="imgs/edit.png">
                    <img src="imgs/delete.png">
                </td>
            </tr>
        <?php
        }

        if ($results->num_rows == 0) {
        ?>
            <tr>
                <td colspan="4" align="center">Sem resultados</td>
            </tr>
        <?php
        }
        ?>
    </table>
</body>

</html>