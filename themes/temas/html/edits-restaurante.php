<?php
require __DIR__ . "/../../../vendor/autoload.php";

$conecta = dbConn();
if(!isset($_GET['id'])){
    header("Location:dashboard.php");
    exit();
}
$id_restaurante = $_GET['id'];
$sql = "SELECT * FROM tb_restaurante WHERE id_restaurante = '{$id_restaurante}'";
$resultado = $conecta->query($sql);
$restaurante = $resultado->fetch_assoc();

?>
<!DOCTYPE html>
<html
        lang="pt-br"
        class="light-style layout-menu-fixed"
        dir="ltr"
        data-theme="theme-default"
        data-assets-path="../assets/"
        data-template="vertical-menu-template-free"
>
<head>
    <meta charset="utf-8"/>
    <meta
            name="viewport"
            content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title><?= CONF_TITLE ?></title>

    <meta name="description" content=""/>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/logo-mini.png"/>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link
            href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
            rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css"/>

    <!-- Core CSS -->
    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css"/>
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css"/>
    <link rel="stylesheet" href="../assets/css/demo.css"/>

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css"/>

    <link rel="stylesheet" href="../assets/vendor/libs/apex-charts/apex-charts.css"/>

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../assets/js/config.js"></script>
</head>

<body>
<!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
        <!-- Menu -->

        <?php
        include("blocos/menu.php");
        ?>

        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
            <!-- Navbar -->

            <?php
            include "blocos/nav.php";
            ?>

            <!-- / Navbar -->

            <!-- Content wrapper -->
                <!-- Content -->
                <div class="container-xxl flex-grow-1 container-p-y">
                    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Restaurantes/</span> Editar dados do
                        restaurante</h4>
                    <div class="content-wrapper">
                        <?php
                        if(isset($_GET['sucesso'])){
                            $msg="Dados do restaurante editados com sucesso!";
                            ?>
                            <div class="alert alert-success" role="alert">
                                <?= $msg; ?>

                            </div>
                            <?php
                        }
                        ?>
                        <?php
                        if(isset($_GET['erro'])){
                            ?>
                            <div class="alert alert-danger" role="alert">
                                <?= $msg = "Erro ao editar os dados do restaurante."?>
                            </div>
                            <?php
                        }
                        ?>

                    <!-- Basic Layout -->
                        <div class="row">
                            <div class="col-xl">
                                <div class="card mb-4">
                                    <div class="card-header d-flex justify-content-between align-items-center">
                                        <h5 class="mb-0">Dados</h5>
                                    </div>
                                    <div class="card-body">
                                        <form action="functions/update_restaurante.php" method="post">
                                            <input type="hidden" name="id_restaurante" value="<?=$_GET['id']?>">
                                            <div class="mb-3">
                                                <label class="form-label" for="basic-default-fullname">Nome do perfil</label>
                                                <input type="text"
                                                       class="form-control"
                                                       value="<?= $restaurante['nome']?>"
                                                       id="nome_restaurante"
                                                       name="nome_restaurante"
                                                       placeholder=""
                                                       required="required"/>

                                                <div class="form-text">*Obrigatório</div>
                                            </div>
                                            <div class="mb-3">
                                                <label class="form-label" for="basic-default-fullname">@ no Instagram</label>
                                                <input type="text"
                                                       class="form-control"
                                                       value="<?= $restaurante['perfil']?>"
                                                       id="username"
                                                       name="username"
                                                       placeholder=""
                                                       required="required"/>

                                                <div class="form-text">*Obrigatório</div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Evento</label>
                                                <br>
                                                <?php
                                                $arrayEventos = array();
                                                $sqlEventosMarcados = "SELECT * FROM tb_restaurante_rel_tb_evento rev WHERE rev.tb_restaurante_id_restaurante = '{$id_restaurante}'";
                                                $resultadoEventos = $conecta->query($sqlEventosMarcados);
                                                while ($ev = $resultadoEventos->fetch_assoc()){
                                                    array_push($arrayEventos, $ev['tb_evento_id_evento']);
                                                }

                                                $sql = "SELECT * FROM tb_evento WHERE ativo = 1";
                                                $resultado = $conecta->query($sql);

                                                while ($row_evento = $resultado->fetch_assoc()){
                                                    ?>
                                                    <div class="form-check form-check-inline mt-3">
                                                        <input class="form-check-input"
                                                               type="checkbox"
                                                               name="evento[]"
                                                               id="evento<?=$row_evento['id_evento']?>"
                                                               value="<?=$row_evento['id_evento']?>"
                                                               <?= (in_array($row_evento['id_evento'], $arrayEventos) ? 'checked' : '') ?>
                                                        >
                                                        <label class="form-check-label" for="evento<?=$row_evento['id_evento']?>"><?=$row_evento['tipo_evento']?></label>
                                                    </div>
                                                <?php } ?>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label" for="basic-default-company">Categoria</label>
                                                <br>
                                                <?php

                                                $arrayCategorias = array();
                                                $sqlCategoriasMarcados = "SELECT * FROM tb_categoria_rel_tb_restaurante rre WHERE rre.tb_restaurante_id_restaurante = '{$id_restaurante}'";
                                                $resultadoCategorias = $conecta->query($sqlCategoriasMarcados);
                                                while ($cat = $resultadoCategorias->fetch_assoc()){
                                                    array_push($arrayCategorias, $cat['tb_categoria_id_categoria']);
                                                }

                                                $sql = "SELECT * FROM tb_categoria WHERE ativo = 1";
                                                $resultado = $conecta->query($sql);

                                                while ($row_categoria = $resultado->fetch_assoc()){
                                                    ?>
                                                    <div class="form-check form-check-inline mt-3">
                                                        <input class="form-check-input"
                                                               type="checkbox"
                                                               name="categoria[]"
                                                               id="categoria<?=$row_categoria['id_categoria']?>"
                                                               value="<?=$row_categoria['id_categoria']?>"
                                                            <?= (in_array($row_categoria['id_categoria'], $arrayCategorias) ? 'checked' : '') ?>
                                                        >
                                                        <label class="form-check-label" for="categoria<?=$row_categoria['id_categoria']?>"><?=$row_categoria['descricao_comidas']?></label>
                                                    </div>
                                                <?php } ?>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label" for="basic-default-company">Complemento</label>
                                                <br>
                                                <?php
                                                $arrayComplemento = array();
                                                $sqlComplementoMarcado = "SELECT * FROM tb_complemento_rel_tb_restaurante rrc WHERE rrc.tb_restaurante_id_restaurante = '{$id_restaurante}'";
                                                $resultadoComplemento = $conecta->query($sqlComplementoMarcado);
                                                while ($cm = $resultadoComplemento->fetch_assoc()){
                                                    array_push($arrayComplemento, $cm['tb_complemento_id_complemento']);
                                                }

                                                $sql = "SELECT * FROM tb_complemento WHERE ativo = 1 OR descricao_complemento in ('Delivery', 'Comer no Local')";
                                                $resultado = $conecta->query($sql);

                                                while ($row_complemento = $resultado->fetch_assoc()){
                                                    ?>
                                                    <div class="form-check form-check-inline mt-3">
                                                        <input class="form-check-input"
                                                               type="checkbox"
                                                               name="complemento[]"
                                                               id="complemento<?=$row_complemento['id_complemento']?>"
                                                               value="<?=$row_complemento['id_complemento']?>"
                                                            <?= (in_array($row_complemento['id_complemento'], $arrayComplemento) ? 'checked' : '') ?>
                                                        >
                                                        <label class="form-check-label" for="evento<?=$row_complemento['id_complemento']?>"><?=$row_complemento['descricao_complemento']?></label>
                                                    </div>
                                                <?php } ?>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Restaurante Ativo?</label>
                                                <br>
                                                <div class="form-check form-check-inline mt-3">
                                                    <input class="form-check-input"
                                                           type="radio"
                                                           name="ativo"
                                                           id="ativo"
                                                           value="true"
                                                        <?= ($restaurante['ativo'] ? 'checked' : '') ?>
                                                    >
                                                    <label class="form-check-label" for="ativo">Ativo</label>
                                                </div>
                                                <div class="form-check form-check-inline mt-3">
                                                    <input class="form-check-input"
                                                           type="radio"
                                                           name="ativo"
                                                           id="ativo"
                                                           value="false"
                                                        <?= (!$restaurante['ativo'] ? 'checked' : '') ?>
                                                    >
                                                    <label class="form-check-label" for="ativo">Inativo</label>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Salvar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            </form>
                        </div>
                </div>
            </div>


            <!-- / Content -->

            <!-- Footer -->
            <?php
            include "blocos/footer.php"
            ?>
            <!-- / Footer -->

            <div class="content-backdrop fade"></div>
        </div>
        <!-- Content wrapper -->
    </div>
    <!-- / Layout page -->
</div>

<!-- Overlay -->
<div class="layout-overlay layout-menu-toggle"></div>
</div>
<!-- / Layout wrapper -->

<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->
<script src="../assets/vendor/libs/jquery/jquery.js"></script>
<script src="../assets/vendor/libs/popper/popper.js"></script>
<script src="../assets/vendor/js/bootstrap.js"></script>
<script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

<script src="../assets/vendor/js/menu.js"></script>
<!-- endbuild -->

<!-- Vendors JS -->
<script src="../assets/vendor/libs/apex-charts/apexcharts.js"></script>

<!-- Main JS -->
<script src="../assets/js/main.js"></script>

<!-- Page JS -->
<script src="../assets/js/dashboards-analytics.js"></script>

<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
</body>
</html>
