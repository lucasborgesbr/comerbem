<?php
require __DIR__ . "/../../../../vendor/autoload.php";
$conecta = dbConn();
//var_dump($conecta);

if(isset($_POST)){
    $nome_admin=$_POST['nome_admin'];
    $sobrenome_admin=$_POST['sobrenome_admin'];
    $email=$_POST['email_admin'];
    $senha_admin=md5($_POST['senha_admin']);  //criptografar a senha do admin

    $sql = "select * from tb_admin where email = '{$email}'";
    $resultado = $conecta->query($sql);
    if ($resultado->num_rows > 0) {
        //erro de volta pra tela
        $conecta->close();
        header("Location: ../pag-cadastrar-user.php?erro=email");
        exit();
    } else {
        $sql_insert = "INSERT INTO tb_admin (nome, sobrenome, email,senha)
                        VALUES ('$nome_admin', '$sobrenome_admin', '$email', '$senha_admin')";
        if($conecta->query($sql_insert) === TRUE) {
            $conecta->close();
            header("Location: ../pag-login.php?sucesso");// echo "Novo registro criado com sucesso";
            exit();

        } else {
            $conecta->close();
            header("Location: ../pag-cadastrar-user.php?erro");
            exit();
        }

        //echo "0 results";
    }
}







