<?php

require __DIR__ . "/../../vendor/autoload.php";
$conn = dbConn();

use Instagram\Api;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;

$contador = 0;

// Arquivo de cache para login no Instagram
$cachePool = new FilesystemAdapter('Instagram', 0, __DIR__ . "/../../storage/cache");
$Instagram = new Api($cachePool);
// Login no Instagram
$Instagram->login(CONF_API_INTAGRAM_LOGIN, CONF_API_INTAGRAM_PASS);

$postPendente = $conn->query("SELECT * FROM tb_post p WHERE p.id_post NOT IN (SELECT pr.id_post FROM tb_post_rel_tb_restaurante pr)");

if($postPendente->num_rows > 0){

    while($novoPost = $postPendente->fetch_assoc()){

        $match = "";
        $postID = $novoPost['id_post'];
        $postDesc = remove_emoji($novoPost['legenda']);

        $exp = '/@\w+\.?\w+/m';
        preg_match_all($exp, $postDesc, $match, PREG_SET_ORDER, 0);

        if(count($match) > 0){
            for($i = 0; $i<count($match); $i++){
                $perfilInsta = substr($match[$i][0], 1);

                $perfilExiste = $conn->query("SELECT * FROM tb_restaurante WHERE perfil = '{$perfilInsta}'");

                if($perfilExiste->num_rows == 0){

                    $perfilRestaurante = $Instagram->getProfile($perfilInsta);

                    $nomeRestaurante = addslashes(ucwords(mb_strtolower(remove_emoji($perfilRestaurante->getFullName()))));
                    $username = $perfilRestaurante->getUserName();

                    $insertRestaurante = $conn->query("INSERT INTO tb_restaurante (nome, perfil, ativo, dt_criacao, dt_atualizacao) VALUES
                     ('{$nomeRestaurante}', '{$username}', '1', now(), now())");

                    if($insertRestaurante){
                        $idRestaurante = $conn->insert_id;
                    }
                } else {

                    $restaurante = $perfilExiste->fetch_assoc();
                    $idRestaurante = $restaurante['id_restaurante'];

                }

                if($conn->query("INSERT INTO tb_post_rel_tb_restaurante (id_post, id_restaurante) VALUES ('{$postID}', '{$idRestaurante}')")){
                    $contador++;
                }
            }
        }

    }
}

echo date_fmt_br(). " | {$contador} novos posts relacionados";