<?php
session_start();

ob_start();

//receber o id do usuario
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Celke - Visualizar</title>
</head>

<body>

    <a href="index.php">Listar</a><br>
    <a href="create.php">Cadastrar</a><br>

    <h1>Detalhes do Usuário</h1>

    <?php
    if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }

    
    //Verificar se o id possui valor
    if(!empty($id)){
        //Incluir os arquivos
        require 'Conn.php';
        require 'User.php';
        
        //Instanciando a classe e criando o objeto
        $viewUser = new User();

        //Enviando o id para o atributo id da classe User
        $viewUser->id = $id;

        //Instanciando o metodo visualizar
        $valueUser = $viewUser->view();

        //var_dump($valueUser);
        extract($valueUser);
        echo "Id do usuario: $id <br>";
        echo "Nome do usuario: $nome <br>";
        echo "E-mail do usuario: $email <br>";
        echo "Cadastrado: ". date('d/m/Y H:i:s', strtotime($created)) . " <br>";

        //o if faz com que se o (midifield) estiver vazio nao apareça nada
        echo "Editado: ";
        if(!empty($midifield)){
            echo date('d/m/Y H:i:s', strtotime($midifield));
        }
        echo "<br>";
    }else{
        $_SESSION['msg'] = "<p style='color: #f00;'>Usuario nao encontrado!</p>";
                header("Location: index.php");
    }

    ?>

</body>
</html>