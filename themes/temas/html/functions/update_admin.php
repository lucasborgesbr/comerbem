<?php
require __DIR__ . "/../../../../vendor/autoload.php";
$conecta = dbConn();

if(isset($_POST)){
    $id_admin = $_POST['id_admin'];
    $nome_update = $_POST['nome_update'];
    $sobrenome_update = $_POST['sobrenome_update'];
    $email_update = $_POST['email_update'];
    $senha_update = ($_POST['senha_update'] != '' ? md5($_POST['senha_update']) : '');

    $sql = "UPDATE tb_admin SET nome = '{$nome_update}', sobrenome = '{$sobrenome_update}', 
            email = '{$email_update}'";
    if($senha_update != ''){
        $sql .= ", senha = '{$senha_update}'";
    }
    $sql .= " WHERE id_admin = '{$id_admin}'";

    if($conecta->query($sql) === TRUE){
        session_start();
        $_SESSION['nome_admin'] = $nome_update;
        $_SESSION['sobrenome_admin'] = $sobrenome_update;
        $conecta->close();
        header("Location: ../pag-conf-admin.php?sucesso");
        exit();

    }
    else{
            $conecta->close();
            header("Location: ../pag-conf-admin.php?erro");
            exit();
        }
}
//var_dump($_POST);