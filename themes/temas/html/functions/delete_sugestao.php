<?php

require __DIR__ . "/../../../../vendor/autoload.php";
$conecta = dbConn();


if (isset($_GET)) {
    $id_restaurante = $_GET['id'];

    $sqlLimparSugestao = "DELETE FROM tb_sugestaorest WHERE id_sugestaoRest = '{$id_restaurante}'";
    if ($conecta->query($sqlLimparSugestao)) {
        $conecta->close();
        header("Location: ../sugestao-rest.php?sucesso");
        exit();
    }
    else{
        $conecta->close();
        header("Location: ../sugestao-rest.php?erro");
        exit();
    }
}