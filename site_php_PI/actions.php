<?php
session_start();
include 'configs.php';

$act = $_GET['act'];//para conseguir fazer insert de varias coisas

//INSERT DO FORNECEDOR
if($act == 'inserir_fornecedor'){

    $nome = htmlentities($_POST['nome']);
    $telefone = htmlentities($_POST['telefone']);
    $morada = htmlentities($_POST['morada']);
    $tipo = htmlentities($_POST['tipo']);
    //$foto = $_POST['foto'];

    if(!$nome || !$telefone || !$morada || !$tipo)
        die("Todos os registos menos a foto devem ser preenchidos");

    //print_r($_POST);
    //echo "$nome vive na morada $morada, é $tipo do nosso site e caso seja necessario contactar este é o numero $telefone";

    //NAO USAR O SEGUINTE POR CAUSA DE SQL INJECTION
    //$sql = "INSERT INTO fornecedores(nome, telefone, morada, tipo, foto) VALUES('$nome','$telefone','$morada','$tipo','$foto')";

    $folder = "imgs/fornecedores/";

    $u_file_name = htmlentities($_FILES['foto']['name']);
    $extension = strtolower(pathinfo($u_file_name, PATHINFO_EXTENSION));
    
    /*A USAR O REGEX
    
    $extension = '';
    $regex = '/\.[a-z|A-Z|0-9]+$/';

    preg_match($regex, $u_file_name, $extension);
    $extension = $extension[1];*/
    
    //jpg jpeg bmp png tiff gif
    if(
        $extension != 'jpg' && 
        $extension != 'jpeg' && 
        $extension != 'bmp' && 
        $extension != 'png' && 
        $extension != 'tiff' && 
        $extension != 'gif'
    )
        die("Ficheiro não permitido");

    $file = uniqid() . '.' . $extension;
    
    move_uploaded_file($_FILES['foto']['tmp_name'], $folder.$file);

    $stmt = $conn->prepare('INSERT INTO fornecedores(nome, telefone, morada, tipo, foto) VALUES(?, ?, ?, ?, ?)');
    $stmt->bind_param('sssss', $nome, $telefone, $morada, $tipo, $file);
    $stmt->execute();

    if($stmt->affected_rows === 0)
        die("Nao foi possivel registar o novo fornecedor");
    else
        echo "Fornecedor registado com sucesso";

    //header('Location: inserir_fornecedor.php');
}

//ALTERAR O FORNECEDOR
else if($act == 'alterar_fornecedor'){

    $ID = htmlentities($_POST['ID']);
    $nome = htmlentities($_POST['nome']);
    $telefone = htmlentities($_POST['telefone']);
    $morada = htmlentities($_POST['morada']);
    $tipo = htmlentities($_POST['tipo']);
    //$foto = $_POST['foto'];

    // Editar com foto: quando envia uma imagem
    if ($_FILES['foto']['size'] !== 0){
        //obter a imagem para depois a apagar
        $stmt = $conn->prepare('SELECT foto FROM fornecedores WHERE ID = ?');
        $stmt->bind_param('i', $ID);
        $stmt->execute();
        $results = $stmt->get_result();
        $row = $results->fetch_assoc();

        if($row['foto'] && file_exists('imgs/clientes/'.$row['foto'])){
            unlink('imgs/fornecedores/'.$row['foto']);
        
            //Verificar se a imagem continua a existir
            if(file_exists('imgs/fornecedores/'.$row['foto']))
                die("Não foi possível eliminar o ficheiro, tente novamente o processo de edição...");
            }
        //Receber a nova imagem
        $folder = 'imgs/fornecedores/';

        $u_file_name = $_FILES['foto']['name'];
        $extension = strtolower(pathinfo($u_file_name, PATHINFO_EXTENSION));
    
        //jpg jpeg bmp png tiff gif
        if (
            $extension != 'jpg' &&
            $extension != 'jpeg' &&
            $extension != 'bmp' &&
            $extension != 'png' &&
            $extension != 'tiff' &&
            $extension != 'gif'
        )
            die("Ficheiro não permitido!");
    
        $file = uniqid() . '.' . $extension;
    
        move_uploaded_file($_FILES['foto']['tmp_name'], $folder.$file);

        $stmt = $conn->prepare('UPDATE fornecedores SET nome = ?, telefone = ?, morada = ?, tipo = ?, foto = ? WHERE ID = ?');
        $stmt->bind_param('sssssi', $nome, $telefone, $morada, $tipo, $file, $ID);
        $stmt->execute();

        if($stmt->affected_rows === 0)
            die("Não foi possível alterar o registo da foto, a edição ficou pendente. Tente novamente!");
    }
    // Editar sem foto
    else {
        $stmt = $conn->prepare('UPDATE fornecedores SET nome = ?, telefone = ?, morada = ?, tipo = ? WHERE ID = ?');
        $stmt->bind_param('ssssi', $nome, $telefone, $morada, $tipo, $ID);
        $stmt->execute();

        if($stmt->affected_rows === 0)
            die("Não foi possível editar o fornecedor (Talvez não tenha feito edição?)");
    }

    echo "Fornecedor alterado com sucesso";
}

//DELETE FORNECEDOR
else if($act == 'delete_fornec'){

    $ID = $_GET['ID'];

    $stmt = $conn->prepare('SELECT foto FROM fornecedores WHERE ID = ?');
    $stmt->bind_param('i', $ID);
    $stmt->execute();

    $results = $stmt->get_result();
    $row = $results->fetch_assoc();

    unlink('imgs/fornecedores/'.$row['foto']);


    $stmt = $conn->prepare('DELETE FROM fornecedores WHERE ID = ?');
    $stmt->bind_param('i', $ID);
    $stmt->execute();

    if($stmt->affected_rows === 0)
        die("Nao foi possivel eliminar o fornecedor");
    else
        echo "Fornecedor eliminado com sucesso";

    
}
//REGISTO DO FORNECEDOR
else if($act == 'registar_fornecedor'){

    $nome = htmlentities($_POST['nickname']);
    $email = htmlentities($_POST['email']);
    $password = hash('sha256', SALT . $_POST['password'] . SALT);

    $stmt = $conn->prepare('SELECT COUNT(*) AS total FROM fornecedores WHERE email = ? or nome = ?');
    $stmt->bind_param('s', $email, $nome);
    $stmt->execute();
    $results = $stmt->get_result();
    $row = $results->fetch_assoc();

    if($row['total'] !== 0)
        die("Este email ou nome já existe registado");

    $stmt = $conn->prepare('INSERT INTO fornecedores(nome, email, pw) VALUES(?, ?, ?)');
    $stmt->bind_param('sss', $nome, $email, $password);
    $stmt->execute();

    if($stmt->affected_rows === 0)
        die("Nao foi possivel registar");
    else
        echo "Registado com sucesso";
}

//LOGIN DO FORNECEDOR
else if($act == 'login_fornecedor'){

    $utilizador = strtolower(htmlentities($_POST['utilizador']));
    $password = hash('sha256', SALT . $_POST['password'] . SALT);

    $stmt = $conn->prepare('SELECT ID, nome, email, tipo, pw FROM fornecedores WHERE (email = ?) AND pw = ?');
    $stmt->bind_param('ss', $utilizador, $password);
    $stmt->execute();

    $results = $stmt->get_result();
    $row = $results->fetch_assoc();

    if(!$row)
        die("Utilizador ou Password Errada");

    $row['email'] = strtolower($row['email']);
    $row['nome'] = strtolower($row['nome']);

    if($row['email'] == $utilizador && $row['pw'] == $password){
        $_SESSION['ID'] = $row['ID'];
        $_SESSION['nome'] = $row['nome'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['tipo'] = $row['tipo'];
        $_SESSION['cargo'] = 'fornecedor';

        echo 'Login Válido <a href="index.php">Voltar à pagina inicial</a>';
    }
}

//LOGOUT DO FORNECEDOR
else if($act == 'logout'){
    session_destroy();
    echo '<a href="index.php">Voltar à pagina inicial</a>';
}

//ALTERAR O CLIENTE
else if ($act == 'alterar_cliente'){
    $ID = htmlentities($_POST['ID']);
    $nome = htmlentities($_POST['nome']);
    $morada = htmlentities($_POST['morada']);
    $tipo = htmlentities($_POST['tipo']);

    // Editar com foto: quando envia uma imagem
    if ($_FILES['foto']['size'] !== 0){
        //obter a imagem para depois a apagar
        $stmt = $conn->prepare('SELECT foto FROM clientes WHERE ID = ?');
        $stmt->bind_param('i', $ID);
        $stmt->execute();
        $results = $stmt->get_result();
        $row = $results->fetch_assoc();

        if($row['foto'] && file_exists('imgs/clientes/'.$row['foto'])){
            unlink('imgs/clientes/'.$row['foto']);
            
            //Verificar se a imagem continua a existir
            if(file_exists('imgs/clientes/'.$row['foto']))
                die("Não foi possível eliminar o ficheiro, tente novamente o processo de edição...");
        }

        //Receber a nova imagem
        $folder = 'imgs/clientes/';

        $u_file_name = $_FILES['foto']['name'];
        $extension = strtolower(pathinfo($u_file_name, PATHINFO_EXTENSION));
    
        //jpg jpeg bmp png tiff gif
        if (
            $extension != 'jpg' &&
            $extension != 'jpeg' &&
            $extension != 'bmp' &&
            $extension != 'png' &&
            $extension != 'tiff' &&
            $extension != 'gif'
        )
            die("Ficheiro não permitido!");
    
        $file = uniqid() . '.' . $extension;
    
        move_uploaded_file($_FILES['foto']['tmp_name'], $folder.$file);

        $stmt = $conn->prepare('UPDATE clientes SET nome = ?, morada = ?, tipo = ?, foto = ? WHERE ID = ?');
        $stmt->bind_param('ssssi', $nome, $morada, $tipo, $file, $ID);
        $stmt->execute();

        if($stmt->affected_rows === 0)
            die("Não foi possível alterar o registo da foto, a edição ficou pendente. Tente novamente!");
    }
    // Editar sem foto
    else {
        $stmt = $conn->prepare('UPDATE clientes SET nome = ?, morada = ?, tipo = ? WHERE ID = ?');
        $stmt->bind_param('sssi', $nome, $morada, $tipo, $ID);
        $stmt->execute();

        if($stmt->affected_rows === 0)
            die("Não foi possível editar o cliente (Talvez não tenha feito edição?)");
    }

    echo "Cliente alterado com sucesso";
}

//INSERT DO CLIENTE
if($act == 'inserir_cliente'){

    $nome = htmlentities($_POST['nome']);
    $morada = htmlentities($_POST['morada']);
    $tipo = htmlentities($_POST['tipo']);
    //$foto = $_POST['foto'];
    
    if(!$nome || !$morada || !$tipo)
        die("Todos os registos menos a foto devem ser preenchidos");
    
    //print_r($_POST);
    //echo "$nome vive na morada $morada, é $tipo do nosso site e caso seja necessario contactar este é o numero $telefone";
    
    //NAO USAR O SEGUINTE POR CAUSA DE SQL INJECTION
    //$sql = "INSERT INTO fornecedores(nome, telefone, morada, tipo, foto) VALUES('$nome','$telefone','$morada','$tipo','$foto')";
    
    $folder = "imgs/clientes/";

    $u_file_name = $_FILES['foto']['name'];
    $extension = strtolower(pathinfo($u_file_name, PATHINFO_EXTENSION));
    
    /*A USAR O REGEX
    
    $extension = '';
    $regex = '/\.[a-z|A-Z|0-9]+$/';

    preg_match($regex, $u_file_name, $extension);
    $extension = $extension[1];*/
    
    //jpg jpeg bmp png tiff gif
    if(
        $extension != 'jpg' && 
        $extension != 'jpeg' && 
        $extension != 'bmp' && 
        $extension != 'png' && 
        $extension != 'tiff' && 
        $extension != 'gif'
    )
        die("Ficheiro não permitido");

    $file = uniqid() . '.' . $extension;
    
    move_uploaded_file($_FILES['foto']['tmp_name'], $folder.$file);


    //PREPARE STATEMENTS
    $stmt = $conn->prepare('INSERT INTO clientes(nome, morada, tipo, foto) VALUES(?, ?, ?, ?)');
    $stmt->bind_param('ssss', $nome, $morada, $tipo, $file);
    $stmt->execute();
    
    if($stmt->affected_rows === 0)
        die("Nao foi possivel registar o novo cliente");
    else
        echo "Cliente registado com sucesso";
    
    //header('Location: inserir_fornecedor.php');
}
//DELETE CLIENTE
else if($act == 'delete_client'){

    $ID = htmlentities($_GET['ID']);

    //obter a imagem para depois apagar
    $stmt = $conn->prepare('SELECT foto FROM clientes WHERE ID = ?');
    $stmt->bind_param('i', $ID);
    $stmt->execute();

    $results = $stmt->get_result();
    $row = $results->fetch_assoc();

    unlink('imgs/clientes/'.$row['foto']);

    
    $stmt = $conn->prepare('DELETE FROM clientes WHERE ID = ?');
    $stmt->bind_param('i', $ID);
    $stmt->execute();

    if($stmt->affected_rows === 0)
        die("Nao foi possivel eliminar o cliente");
    else
        echo "Cliente eliminado com sucesso";
}

//REGISTO DO CLIENTE
else if($act == 'registar_cliente'){

    $nome = htmlentities($_POST['nome']);
    $email = htmlentities($_POST['email']);
    $password = hash('sha256', SALT . $_POST['password'] . SALT);

    $stmt = $conn->prepare('SELECT COUNT(*) AS total FROM clientes WHERE (email = ? or nome = ?');
    $stmt->bind_param('ss', $email, $nome);
    $stmt->execute();
    $results = $stmt->get_result();
    $row = $results->fetch_assoc();

    if($row['total'] !== 0)
        die("Este email ou nome já existe registado");

    $stmt = $conn->prepare('INSERT INTO clientes(nome, email, pw) VALUES(?, ?, ?)');
    $stmt->bind_param('sss', $nome, $email, $password);
    $stmt->execute();

    if($stmt->affected_rows === 0)
        die("Nao foi possivel registar");
    else
        echo "Registado com sucesso";
}

//LOGIN DO Cliente
else if($act == 'login_cliente'){

    $utilizador = strtolower(htmlentities($_POST['utilizador']));
    $password = hash('sha256', SALT . $_POST['password'] . SALT);

    $stmt = $conn->prepare('SELECT ID, nome, email, tipo, pw FROM clientes WHERE (nome = ? or email = ?) AND pw = ?');
    $stmt->bind_param('sss',$utilizador, $utilizador, $password);
    $stmt->execute();

    $results = $stmt->get_result();
    $row = $results->fetch_assoc();

    if(!$row)
        die("Utilizador ou Password Errada");

    $row['email'] = strtolower($row['email']);
    $row['nome'] = strtolower($row['nome']);

    if(($row['nome'] == $utilizador || $row['email'] == $utilizador) && $row['pw'] == $password){
        $_SESSION['ID'] = $row['ID'];
        $_SESSION['nome'] = $row['nome'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['tipo'] = $row['tipo'];
        $_SESSION['cargo'] = 'cliente';

        echo 'Login Válido <a href="index.php">Voltar à pagina inicial</a>';
    }
}