<?php
require __DIR__ . "/../../vendor/autoload.php";
$conecta = dbConn();

if(isset($_POST)){
    $sugestao_rest = $_POST['sugestao-rest'];
    $sugestao_username = $_POST['username-sugestao'];

    if($sugestao_username[0] == '@'){
        $sugestao_username = ltrim($sugestao_username, '@');
    }

    $sql_sugestao = "INSERT INTO tb_sugestaorest (nome, perfil) VALUES ('$sugestao_rest', '$sugestao_username')";
    if($conecta->query($sql_sugestao) ===  TRUE){
        $conecta->close();
        header("Location: ../questionario.php?sucesso");
        exit();
    }
} else {
    $conecta->close();
    header("Location: ../questionario.php");
    exit();
}



