<?php
require __DIR__ . "/../../../../vendor/autoload.php";
$conecta = dbConn();

session_start();
if(isset($_POST)){
    $email_login=$_POST['email_login'];
    $senha_login=md5($_POST['senha_login']); //criptografar a senha do admin para login

    $sql = "select * from tb_admin where email ='$email_login' and senha = '$senha_login' ";
    $resultado = $conecta->query($sql);
    if ($resultado->num_rows > 0) {
        $admin = $resultado->fetch_assoc();
        $_SESSION['id_admin'] = $admin['id_admin'];
        $_SESSION['nome_admin'] = $admin['nome'];
        $_SESSION['sobrenome_admin'] = $admin['sobrenome'];
        $_SESSION['email_admin'] = $admin['email'];
        $conecta->close();
        header("Location: ../dashboard.php");
        exit();
    }
    else{
        header("Location: ../pag-login.php?erro=login_erro");
        exit();

    }
}
//var_dump($resultado);

