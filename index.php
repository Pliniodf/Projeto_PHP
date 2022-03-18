<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Celke - Listar</title>
</head>

<body>

    <a href="index.php">Listar</a><br>
    <a href="create.php">Cadastrar</a><br>

    <h1>Listar Usuário</h1>

    <?php
    if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }

        require 'Conn.php';
        require 'User.php';

        $listUsers = new User();
        $result_users = $listUsers->list();

        foreach($result_users as $row_user){
            //var_dump($row_user);
            extract($row_user);

            //echo "ID: " . $row_user['id'] . "<br>";
            echo "ID: $id <br>";
            //echo "Nome: " . $row_user['nome'] . "<br>";
            echo "Nome: $nome <br>";
            //echo "E-mail: " . $row_user['users'] . "<br>";
            echo "E-mail: $users <br>";

            echo "<a href='view.php?id=$id'>Visualizar</a><br>";
            echo "<a href='edit.php?id=$id'>Editar</a><br>";
            echo "<a href='delete.php?id=$id'>Delete</a><br>";

            echo "<hr>";
        }

        
    ?>

</body>
</html>