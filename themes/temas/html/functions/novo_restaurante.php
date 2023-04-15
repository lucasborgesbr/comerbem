<?php
require __DIR__ . "/../../../../vendor/autoload.php";
$conecta = dbConn();

if(isset($_POST)) {
    $nome_restaurante = $_POST['nome_restaurante'];
    $perfil = $_POST['username'];
    $eventos = $_POST['evento'];
    $categorias = $_POST['categoria'];
    $complementos = $_POST['complemento'];

    $sql = "INSERT INTO tb_restaurante (nome, perfil, ativo) VALUES ('{$nome_restaurante}', '{$perfil}', 1)";
    $resultado_restaurante = $conecta->query($sql);

    if ($resultado_restaurante === TRUE) {
        $id_restaurante = $conecta->insert_id;

        // Inserir Eventos
        foreach ($eventos as $evento){
            $sqlInsertEventos = "INSERT INTO tb_restaurante_rel_tb_evento (tb_restaurante_id_restaurante, tb_evento_id_evento) VALUES 
            ('{$id_restaurante}', '{$evento}')";
            $conecta->query($sqlInsertEventos);
        }

        foreach ($categorias as $categoria){
            $sqlInsertCategorias = "INSERT INTO tb_categoria_rel_tb_restaurante (tb_restaurante_id_restaurante, tb_categoria_id_categoria) VALUES 
                        ('{$id_restaurante}', '{$categoria}')";
                        $conecta->query($sqlInsertCategorias);
        }

        foreach ($complementos as $complemento){
            $sqlInsertComplementos = "INSERT INTO tb_complemento_rel_tb_restaurante (tb_restaurante_id_restaurante, tb_complemento_id_complemento) VALUES 
                        ('{$id_restaurante}', '{$complemento}')";
            $conecta->query($sqlInsertComplementos);
        }

        $conecta->close();
        header("Location: ../dashboard.php?sucesso=cadastro_sucesso");
        exit();
    }
    else{
        $conecta->close();
        header("Location: ../novo-restaurante.php?erro=cadastro_erro");
        exit();
    }
}
//var_dump($_POST);