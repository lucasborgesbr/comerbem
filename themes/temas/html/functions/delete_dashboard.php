<?php
require __DIR__ . "/../../../vendor/autoload.php";
include "functions/logout.php";

$conecta = dbConn();

if(isset($_GET)){
    $id = $_GET['id'];
    $sql = "DELETE FROM tb_restaurante WHERE id_restaurante = '{$id}'";
    if($conecta->query($sql) === TRUE ){
        $conecta->close();
        header("Location: ../dashboard.php?sucesso=delete_restaurante");
        exit();
    }
    else{
        $conecta->close();
        header("Location: ../dashboard.php?erro=delete_erro");
        exit();
    }
}