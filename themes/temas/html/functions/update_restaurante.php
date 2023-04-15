<?php
require __DIR__ . "/../../../../vendor/autoload.php";
$conecta = dbConn();

if (isset($_POST)) {
    $id_restaurante = $_POST['id_restaurante'];
    $nome_restaurante = $_POST['nome_restaurante'];
    $perfil = $_POST['username'];
    $eventos = $_POST['evento'];
    $categorias = $_POST['categoria'];
    $complementos = $_POST['complemento'];
    $ativo = ($_POST['ativo'] == 'true' ? '1' : '0');

    $sqlUpdateRestaurante = "UPDATE tb_restaurante SET nome = '{$nome_restaurante}', perfil = '{$perfil}', ativo = '{$ativo}' WHERE id_restaurante = '{$id_restaurante}'";
    if(!$conecta->query($sqlUpdateRestaurante)){
        $conecta->close();
        header("Location: ../novo-restaurante.php?erro");
        exit();
    }

    $sqlLimpaEventos = "DELETE FROM tb_restaurante_rel_tb_evento WHERE tb_restaurante_id_restaurante = '{$id_restaurante}'";
    if(!$conecta->query($sqlLimpaEventos)){
        $conecta->close();
        header("Location: ../novo-restaurante.php?erro");
        exit();
    }

    $sqlLimpaCategorias = "DELETE FROM tb_categoria_rel_tb_restaurante WHERE tb_restaurante_id_restaurante = '{$id_restaurante}'";
    if(!$conecta->query($sqlLimpaCategorias)){
        $conecta->close();
        header("Location: ../novo-restaurante.php?erro");
        exit();
    }

    $sqlLimpaComplementos = "DELETE FROM tb_complemento_rel_tb_restaurante WHERE tb_restaurante_id_restaurante = '{$id_restaurante}'";
    if(!$conecta->query($sqlLimpaComplementos)){
        $conecta->close();
        header("Location: ../novo-restaurante.php?erro");
        exit();
    }

    // Inserir Eventos
    foreach ($eventos as $evento) {
        $sqlInsertEventos = "INSERT INTO tb_restaurante_rel_tb_evento (tb_restaurante_id_restaurante, tb_evento_id_evento) VALUES 
            ('{$id_restaurante}', '{$evento}')";
        if(!$conecta->query($sqlInsertEventos)){
            $conecta->close();
            header("Location: ../novo-restaurante.php?erro");
            exit();
        }
    }

    foreach ($categorias as $categoria) {
        $sqlInsertCategorias = "INSERT INTO tb_categoria_rel_tb_restaurante (tb_restaurante_id_restaurante, tb_categoria_id_categoria) VALUES 
                        ('{$id_restaurante}', '{$categoria}')";
        if(!$conecta->query($sqlInsertCategorias)){
            $conecta->close();
            header("Location: ../novo-restaurante.php?erro");
            exit();
        }
    }

    foreach ($complementos as $complemento) {
        $sqlInsertComplementos = "INSERT INTO tb_complemento_rel_tb_restaurante (tb_restaurante_id_restaurante, tb_complemento_id_complemento) VALUES 
                        ('{$id_restaurante}', '{$complemento}')";
        if(!$conecta->query($sqlInsertComplementos)){
            $conecta->close();
            header("Location: ../novo-restaurante.php?erro");
            exit();
        }
    }

    $conecta->close();
    header("Location: ../dashboard.php?sucesso");
    exit();
}
//var_dump($_POST);