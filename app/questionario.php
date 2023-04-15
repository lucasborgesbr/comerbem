<?php
require __DIR__ . "/../vendor/autoload.php";
$conn = dbConn();
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
    <link rel="shortcut icon" href="<?= "../shared/img/comer-bem-logo.png" ?>" type="image/x-icon"/>
    <link rel="apple-touch-icon" href="<?= "../shared/img/comer-bem-logo.png" ?>">
    <!-- Web Fonts  -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light"
          rel="stylesheet" type="text/css">

    <link rel="stylesheet" href="<?= "../themes/porto-admin/assets/style.css" ?>">
    <!-- Head Libs -->
    <script src="<?= "../themes/porto-admin/vendor/modernizr/modernizr.js"; ?>"></script>

    <style>
        .footer-teste {
            max-width: calc(1000px - 80px) !important;
            width: calc(96% - 80px) !important;
        }

        p {
            color: #fffffc;
            font-family: system-ui;

        }

        a {
            text-decoration: none;
            color: #fffffc;
            font-family: system-ui;
        }

        .body {
            background-color: #171717 !important;
            color: #fffffc;
            font-family: system-ui;
        }

        .pergunta {
            font-size: 22px;
            font-weight: bold;
            padding-bottom: 15px;
        }

        .resposta {
            font-size: 18px;
            padding-bottom: 3px;
        }
    </style>

</head>
<body data-plugin-page-transition data-spy="scroll" data-target=".wrapper-spy" data-offset="100"
      style="background: #ccc">

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
                            <img src="<?= "../shared/img/comer-bem-logo.png" ?>" height="200px">
                        </a>
                    </div>
                </div>
                <br><br>
                <div class="row">
                    <div class="col-lg-12 pe-lg-5 mb-5 mb-lg-0" style="text-align: center; padding-bottom: 30px;">

                        <div class="offset-anchor" id="contact-sent"></div>


                        <div class="overflow-hidden mb-1">
                            <h2 class="font-weight-normal text-7 mb-1"
                                style="font-family: system-ui; letter-spacing: 6px; font-size: 30px!important;">O que vamos comer hoje?</h2>
                        </div>
                        <div class="overflow-hidden mb-4 pb-3">
                            <p class="mb-0" style="font-size: 20px!important;">Vamos te ajudar a encontrar o melhor local para comer em Sobradinho!</p>
                        </div>

                        <?php
                        if (isset($_GET['erro'])) {
                            $msg = "Erro ao enviar sugestão";
                            ?>
                            <div class="alert alert-danger" role="alert" style="    background-color: #ffe0db;
                            border-color: #ffc5bb;color: #ff3e1d;">
                                <?= $msg ?>
                            </div>
                            <?php
                        }
                        if (isset($_GET['sucesso'])) {
                            $msg = "Agradecemos por sugerir um novo local!";
                            ?>
                            <div class="alert alert-success" role="alert" style=" background-color: #e8fadf;
                        border-color: #d4f5c3; color: #71dd37;">
                                <?= $msg ?>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="col-lg-12 pe-lg-5 mb-5 mb-lg-0">
                        <form action="functions/processa-escolha.php" method="POST" enctype="multipart/form-data"
                              novalidate="novalidate" class="form-horizontal form-bordered">

                            <div class="form-row" id="p1" style="">
                                <div class="form-group col-md-12">
                                    <label class="pergunta">Hoje você quer sair ou pedir um delivery?</label>
                                    <div class="radio">
                                        <label class="resposta">
                                            <input type="radio" name="p1" value="delivery">
                                            Delivery
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label class="resposta">
                                            <input type="radio" name="p1" value="local">
                                            Ir ao Local / Retirar Pedido
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="form-row" id="p2" style="">
                                <div class="form-group col-md-12">
                                    <label class="pergunta">Qual o tipo de Ambiente ou Evento você está
                                        buscando?</label>

                                    <?php
                                    $eventos = $conn->query("SELECT * FROM tb_evento WHERE ativo = 1");
                                    while ($evento = $eventos->fetch_assoc()) {

                                        ?>
                                        <div class="radio">
                                            <label class="resposta">
                                                <input type="radio" name="p2" id="<?= "ev{$evento['id_evento']}" ?>"
                                                       value="<?= $evento['id_evento'] ?>">
                                                <?= "{$evento['tipo_evento']} ({$evento['descricao_evento']})" ?>
                                            </label>
                                        </div>
                                        <?php
                                    }
                                    ?>


                                </div>
                            </div>
                            <br>
                            <div class="form-row" id="p3" style="">
                                <div class="form-group col-md-12">
                                    <label class="pergunta">Qual tipo de comida você gostaria hoje?</label>

                                    <?php
                                    $categorias = $conn->query("SELECT * FROM tb_categoria WHERE ativo = 1");
                                    while ($categoria = $categorias->fetch_assoc()) {
                                        ?>
                                        <div class="checkbox">
                                            <label class="resposta">
                                                <input type="checkbox" name="p3[]"
                                                       value="<?= $categoria['id_categoria'] ?>">
                                                <?= $categoria['descricao_comidas'] ?>

                                            </label>
                                        </div>
                                        <?php
                                    }

                                    ?>

                                </div>
                            </div>
                            <br>
                            <div class="form-row" id="p4" style="">
                                <div class="form-group col-md-12">
                                    <label class="pergunta">Você está buscando algo em especial?</label>

                                    <?php
                                    $complementos = $conn->query("SELECT * FROM tb_complemento WHERE ativo = 1");
                                    while ($complemento = $complementos->fetch_assoc()) {
                                        ?>
                                        <div class="checkbox">
                                            <label class="resposta">
                                                <input type="checkbox" name="p4[]"
                                                       value="<?= $complemento['id_complemento'] ?>">
                                                <?= $complemento['descricao_complemento'] ?>

                                            </label>
                                        </div>
                                        <?php
                                    }
                                    ?>

                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <hr>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-12 mb-5">
                                    <button type="submit"
                                            class="btn btn-danger btn-modern pull-right" style="font-size: 15px">Enviar Formulário</button>
                                </div>
                            </div>
                        </form>
                    </div>


                </div>


            </div>
        </div>
    </div>

    <footer id="footer" class="m-0 p-0" style=" font-size: 20px">
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

    <script src="../themes/porto-admin/assets/scripts.js"></script>


</body>
</html>