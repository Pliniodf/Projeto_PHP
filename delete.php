<?php

session_start();
ob_start();

//Receber o id da URL
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

//Verificar se o ID possui valor
if(!empty($id)){
    //Incluir os arquivos
    require 'Conn.php';
    require 'User.php';

    //Istancia a classe e criar o objeto
    $deleteUser = new User();

    //Enviar o id para o atributo da classe User
    $deleteUser->id = $id;

    //Instanciar o metodo apagar
    $value = $deleteUser->delete();

    if($value){
        $_SESSION['msg'] = "<p style='color: green;'>Usuario apagado com sucesso</p>";
        header("Location: index.php");
    }else{
        $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Usuario nao apagado com sucesso</p>";
                header("Location: index.php");
    }
}else{
    $_SESSION['msg'] = "<p style='color: #f00;'>Erro: Usuario nao encontrado</p>";
                header("Location: index.php");
}