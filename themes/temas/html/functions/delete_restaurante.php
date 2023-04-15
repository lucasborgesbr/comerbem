<?php
require __DIR__ . "/../../../../vendor/autoload.php";
$conecta = dbConn();


if (isset($_GET)) {
    $id_restaurante = $_GET['id'];

    $sqlLimpaEventos = "DELETE FROM tb_restaurante_rel_tb_evento WHERE tb_restaurante_id_restaurante = '{$id_restaurante}'";
    if(!$conecta->query($sqlLimpaEventos)){
        $conecta->close();
        header("Location: ../dashboard.php?erro");
        exit();
    }

    $sqlLimpaCategorias = "DELETE FROM tb_categoria_rel_tb_restaurante WHERE tb_restaurante_id_restaurante = '{$id_restaurante}'";
    if(!$conecta->query($sqlLimpaCategorias)){
        $conecta->close();
        header("Location: ../dashboard.php?erro");
        exit();
    }

    $sqlLimpaComplementos = "DELETE FROM tb_complemento_rel_tb_restaurante WHERE tb_restaurante_id_restaurante = '{$id_restaurante}'";
    if(!$conecta->query($sqlLimpaComplementos)){
        $conecta->close();
        header("Location: ../dashboard.php?erro");
        exit();
    }

    $sqlLimpaPosts = "DELETE FROM tb_post_rel_tb_restaurante WHERE id_restaurante = '{$id_restaurante}'";
    if(!$conecta->query($sqlLimpaPosts)){
        $conecta->close();
        header("Location: ../dashboard.php?erro");
        exit();
    }


    $sql = "DELETE FROM tb_restaurante WHERE id_restaurante = '{$id_restaurante}'";
    if ($conecta->query($sql) === TRUE) {
        $conecta->close();
        header("Location: ../dashboard.php?sucesso=delete_restaurante");
        exit();
    } else {
        $conecta->close();
        header("Location: ../dashboard.php?erro");
        exit();
    }
}