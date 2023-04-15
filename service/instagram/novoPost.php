<?php

require __DIR__ . "/../../vendor/autoload.php";

$conn = dbConn();

use Instagram\Api;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
// Contador de Novos posts Encontrados
$contador = 0;

// Arquivo de cache para login no Instagram
$cachePool = new FilesystemAdapter('Instagram', 0, __DIR__ . "/../../storage/cache");
$Instagram = new Api($cachePool);

// Login no Instagram e Seleção do perfil a ser escaneado
$Instagram->login(CONF_API_INTAGRAM_LOGIN, CONF_API_INTAGRAM_PASS);
$perfilComidas = $Instagram->getProfile(CONF_INSTAGRAM_PERFIL);

foreach ($perfilComidas->getMedias() as $media){

    $post = $conn->query("SELECT * FROM tb_post WHERE externo_id = {$media->getId()}")->num_rows;

    if($post == 0){

        $external_id = $media->getId();
        $thumbnail_base64 = base64_encode(file_get_contents($media->getThumbnailSrc()));
        $link = $media->getLink();
        $post_date = $media->getDate()->format(CONF_DATE_APP);
        $caption = filter_var(remove_emoji($media->getCaption()), FILTER_SANITIZE_STRIPPED);
        $shortCode = $media->getShortCode();
        $isVideo = $media->isVideo();
        if($media->isVideo()){
            $video_src = $media->getVideoUrl();
        } else {
            $video_src = NULL;
        }

        $novo_post = $conn->query("INSERT INTO tb_post (externo_id, mini_foto, link, dt_post, legenda, shortCode, 
                     isVideo, video_src, dt_criacao, dt_atualizacao) VALUES (
                               '{$external_id}', '{$thumbnail_base64}', '{$link}', '{$post_date}', '{$caption}', '{$shortCode}',
                               '{$isVideo}', '{$video_src}', now(), now() ) ");

        if($novo_post){
            $contador++;
        }
    }
}

// caso seja passado o atributo "full" na url, ele vai tentar recuperar todos os posts.
// Por padrão a API tras apenas os 12 primeiros do feed

if(isset($_GET['full'])){

    do{
        $perfilComidas = $Instagram->getMoreMedias($perfilComidas);
        foreach ($perfilComidas->getMedias() as $media){

            $post = $conn->query("SELECT * FROM tb_post WHERE externo_id = {$media->getId()}")->num_rows;

            if($post == 0){

                $external_id = $media->getId();
                $thumbnail_base64 = base64_encode(file_get_contents($media->getThumbnailSrc()));
                $link = $media->getLink();
                $post_date = $media->getDate()->format(CONF_DATE_APP);
                $caption = filter_var(remove_emoji($media->getCaption()), FILTER_SANITIZE_STRIPPED);
                $shortCode = $media->getShortCode();
                $isVideo = $media->isVideo();
                if($media->isVideo()){
                    $video_src = $media->getVideoUrl();
                } else {
                    $video_src = NULL;
                }

                $novo_post = $conn->query("INSERT INTO tb_post (externo_id, mini_foto, link, dt_post, legenda, shortCode, 
                     isVideo, video_src, dt_criacao, dt_atualizacao) VALUES (
                               '{$external_id}', '{$thumbnail_base64}', '{$link}', '{$post_date}', '{$caption}', '{$shortCode}',
                               '{$isVideo}', '{$video_src}', now(), now() ) ");

                if($novo_post){
                    $contador++;
                }
            }
        }
    } while ($perfilComidas->hasMoreMedias());

}

// Fecha conexão com Banco de Dados
$conn->close();

echo date_fmt_br(). " | {$contador} novos posts importados";