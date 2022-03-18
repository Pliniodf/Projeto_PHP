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
    <title>Celke - Editar</title>
</head>

<body>

    <a href="index.php">Listar</a><br>
    <a href="create.php">Cadastrar</a><br>

    <h1>Editar o Usuário</h1>

    <?php
    if(isset($_SESSION['msg'])){
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }

    //Incluir os arquivos
    require 'Conn.php';
    require 'User.php';

    //Receber os dados do formulario
    $formData = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    
    //Verificar se o usuario clicou no botao
    if(!empty($formData['SendEditUser'])){
        //var_dump($formData);

        //Instanciando a classe e criando o objeto
        $editUser = new User();

        //Enviando os datos para o atributo $formData
        $editUser->formData = $formData;

        //Instanciando o metodo Editar
        $value = $editUser->edit();

        //Verificando
        if($value){
            $_SESSION['msg'] = "<p style='color: green;'>Usuario editado com sucesso!</p>";
                header("Location: index.php");
        }else{
            echo "<p style='color: #f00;'>Usuario nao Editado com sucesso!</p>";
        }
    }
    
    //Verificar se o id possui valor
    if(!empty($id)){
       
        
        //Instanciando a classe e criando o objeto
        $viewUser = new User();

        //Enviando o id para o atributo id da classe User
        $viewUser->id = $id;

        //Instanciando o metodo visualizar
        $valueUser = $viewUser->view();

        //var_dump($valueUser);
        extract($valueUser);

        ?>
    <form name="EditUser" method="POST" action="">
        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <label for="">Nome: </label>
        <input type="text" name="nome" placeholder="Nome Completo" value="<?php echo $nome; ?>" require /><br><br>

        <label for="">E-mail: </label>
        <input type="email" name="email" placeholder="e-mail" value="<?php echo $email; ?>" require /><br><br>

        <input type="submit"    value="Editar" name="SendEditUser" />
    </form>
        <?php
       
    }else{
        $_SESSION['msg'] = "<p style='color: #f00;'>Usuario nao encontrado!</p>";
                header("Location: index.php");
    }

    ?>

</body>
</html>