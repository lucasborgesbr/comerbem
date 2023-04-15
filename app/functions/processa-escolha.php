<?php
require __DIR__ . "/../../vendor/autoload.php";

if (empty($_POST)) {
    echo "Acesso Não autorizado";
    exit();
}

$conn = dbConn();
$todosRestaurantes = array();

// Limpeza de caracteres especais e codigos maliciosos
$data = filter_var_array($_POST, FILTER_SANITIZE_STRIPPED);

// Delivery (id = 8) ou Comer no Local (id = 9)
$pergunta1 = $data['p1'];
if ($pergunta1 == 'delivery') {
    $resposta1 = '8';
} elseif ($pergunta1 == 'local') {
    $resposta1 = '9';
}

// Resposta pergunta 2 (Tipo de Evento)
$resposta2 = $data['p2'];

// Respostas das categorias de Comida (pergunta 3)
$categorias = "";
for ($i = 0; $i < count($data['p3']); $i++) {

    $idCategoria = $data['p3'][$i];
    $categorias .= "{$idCategoria}, ";  // Where id_categoria in (1, 2, 3,)
}
$categorias = rtrim($categorias, ", ");

// Respostas dos Complementos (Pergunta 4)
$complementos = "";
if (isset($data['p4'])) {
    for ($i = 0; $i < count($data['p4']); $i++) {

        $idComplementos = $data['p4'][$i];
        $complementos .= "{$idComplementos}, "; // Organiza os IDs para pesquisa no banco
    }
    $complementos = rtrim($complementos, ", ");
}

/*if($complementos != ""){
}*/

$restaurantes = $conn->query("SELECT * FROM tb_restaurante WHERE id_restaurante in (SELECT DISTINCT ctr.tb_restaurante_id_restaurante FROM tb_categoria_rel_tb_restaurante ctr 
WHERE ctr.tb_categoria_id_categoria in ({$categorias}) AND ctr.tb_restaurante_id_restaurante in (SELECT re.tb_restaurante_id_restaurante FROM tb_restaurante_rel_tb_evento re 
WHERE re.tb_evento_id_evento = '{$resposta2}' AND re.tb_restaurante_id_restaurante in (SELECT cr.tb_restaurante_id_restaurante FROM tb_complemento_rel_tb_restaurante cr 
WHERE cr.tb_complemento_id_complemento = '{$resposta1}')))");

while ($restaurante = $restaurantes->fetch_assoc()) {

    $todosRestaurantes[$restaurante['id_restaurante']] = array(
        'id' => $restaurante['id_restaurante'],
        'nome' => $restaurante['nome'],
        'perfil' => $restaurante['perfil'],
        'posts' => array()
    );

    $listaPosts = $conn->query("SELECT * FROM tb_post p LEFT JOIN tb_post_rel_tb_restaurante pr ON pr.id_post = p.id_post
                                WHERE pr.id_restaurante = {$restaurante['id_restaurante']}");

    while ($posts = $listaPosts->fetch_assoc()) {

        $todosRestaurantes[$restaurante['id_restaurante']]['posts'][$posts['id_post']] = $posts;

    }

}

//echo "<pre>";
//var_dump($todosRestaurantes);
//echo "</pre>";
//exit;

?>

<!doctype html>
<html class="fixed sidebar-light">
<head>
    <title>Comer Bem - Sobradinho</title>
    <!-- Basic -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1.0, shrink-to-fit=no">
    <!-- Favicon -->
    <link rel="shortcut icon" href="<?= "../../shared/img/comer-bem-logo.png" ?>" type="image/x-icon"/>
    <link rel="apple-touch-icon" href="<?= "../../shared/img/comer-bem-logo.png" ?>">
    <!-- Web Fonts  -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light"
          rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="<?= "../../themes/porto-admin/assets/style.css" ?>">
    <!-- Head Libs -->
    <script src="<?= "../../themes/porto-admin/vendor/modernizr/modernizr.js"; ?>"></script>

    <style>
        .footer-teste {
            max-width: calc(1000px - 80px) !important;
            width: calc(96% - 80px) !important;
        }

        p {
            color: #fffffc;

        }
        p {
            color: #fffffc;
            font-family: system-ui;

        }
        .body {
            background-color: #171717 !important;
            color: #fffffc;
            font-family: system-ui;
        }
    </style>

</head>
<body data-plugin-page-transition data-spy="scroll" data-target=".wrapper-spy" data-offset="100">

<div class="body">

    <div class="loading-overlay">
        <div class="bounce-loader">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
        </div>
    </div>

    <!-- header -->

    <div role="main" class="main">

        <!-- CONTENT -->
        <div class="section section-no-border bg-color-light m-0" id="frm">
            <div class="container">
                <div class="row text-center">
                    <div class="col">
                        <a href="#">
                            <img src="<?= "../../shared/img/comer-bem-logo.png" ?>" height="200px">
                        </a>
                    </div>
                </div>
                <br><br>
                <div class="row">
                    <div class="col-lg-12 pe-lg-5 mb-5 mb-lg-0" style="text-align: center; padding-bottom: 30px;">

                        <div class="offset-anchor" id="contact-sent"></div>


                        <div class="overflow-hidden mb-1">
                            <h2 class="font-weight-normal text-7 mb-1"
                                style="font-family: system-ui; letter-spacing: 6px; font-size: 30px!important;">Encontramos opções perfeitas pra
                                você!
                            </h2>
                        </div>
                        <div class="overflow-hidden mb-4 pb-3">
                            <p class="mb-0" style="font-size: 18px">Esses são os restaurantes sugeridos:</p>
                        </div>
                    </div>
                </div>
                <?php
                foreach ($todosRestaurantes as $info) {
                    ?>
                    <h4 style="font-size: 18px"><?= "{$info['nome']}" ?> - <a target="_blank"
                                                      href="https://www.instagram.com/<?= $info['perfil'] ?>/"
                                                      style="color: #fffffc"><?= "@{$info['perfil']}" ?></a></h4>
                    <p style="font-size: 16px">Veja as últimas publicações sobre esse lugar:</p>
                    <div class="row padding-top-half portfolio-area">

                        <?php foreach ($info['posts'] as $postInstagram) { ?>

                            <div class="col-12 col-md-6 col-lg-4 portfolio-item">
                                <div class="portfolio-inner-content">
                                    <a href="<?= $postInstagram['link'] ?>" target="_blank">
                                        <div class="item-img-holder position-relative">
                                            <img src="data:image/jpg;base64,<?= $postInstagram['mini_foto'] ?>"
                                                 style="width: 350px">

                                        </div>
                                        <div class="item-detail-area">
                                            <p class="text"
                                               style="font-family: monospace;"><?= str_limit_words(remove_emoji($postInstagram['legenda']), 10) ?></p>
                                        </div>
                                    </a>
                                </div>
                            </div>

                        <?php } ?>

                    </div>

                <?php } ?>

                <div class="dropdown-divider"></div>
                <br>
                <div class="row">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-6">
                        <div class="card mb-5">
                            <div class="card-header d-flex justify-content-between align-items-center"
                                 style="background: #242424;">
                                <h5 class="mb-0">Não encontrou o que procurava? Você pode sugerir novos lugares!</h5>
                            </div>
                            <div class="card-body" style="background: #242424">
                                <div class="mb-3">
                                            <form action="sugestao-rest.php" method="post">
                                                <div class="mb-3">
                                                    <label class="form-label" for="basic-default-fullname">Nome do
                                                        Restaurante</label>
                                                    <input type="text"
                                                           class="form-control"
                                                           id="sugestao-rest"
                                                           name="sugestao-rest"
                                                           placeholder=""
                                                </div>
                                                <br>
                                                <div class="mb-3">
                                                    <label class="form-label" for="basic-default-fullname">@ no
                                                        Instagram</label>
                                                    <input type="text"
                                                           class="form-control"
                                                           id="username-sugestao"
                                                           name="username-sugestao"
                                                           placeholder=""
                                                </div>
                                                <br>
                                                <button type="submit" class="btn btn-primary" style="background-color: #d2322d;
                                                    border-color: #d2322d #d2322d #a82824;
                                                    color: #FFF; ">Enviar!
                                                </button>

                                            </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

            <footer id="footer" class="m-0 p-0">
                <div class="footer-copyright bg-color-light py-4">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-9 mb-1 footer-teste">
                                <p><a href="../admin.php" target="_self">Efetuar Login - Admin</a></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-9 mb-1 footer-teste">
                                <p>Comer Bem © Copyright 2022. Todos os direitos reservados.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>

            <!-- Vendor -->

            <script src="../../themes/porto-admin/assets/scripts.js"></script>


</body>
</html>