<?php
require __DIR__ . "/../../../vendor/autoload.php";
session_start();
$conecta = dbConn();

$sql = "select * from tb_admin where id_admin = '{$_SESSION['id_admin']}' and email = '{$_SESSION['email_admin']}' ";
$resultado = $conecta->query($sql);
$admin = $resultado->fetch_assoc();

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
    <meta charset="utf-8" />
    <meta
            name="viewport"
            content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Comer Bem - Sistema de decisão alimentar</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/comer-bem-logo-3.png" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
            href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
            rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../assets/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <link rel="stylesheet" href="../assets/vendor/libs/apex-charts/apex-charts.css" />

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
            <div class="content-wrapper">
                <!-- Content -->

                <div class="container-xxl flex-grow-1 container-p-y">

                    <h4 class="fw-bold py-3 mb-4">
                        <span class="text-muted fw-light">Configuração /</span> Meu Perfil
                    </h4>
                    <?php
                    if(isset($_GET['sucesso'])){
                        $msg="Dados atualizados com sucesso!";
                        ?>
                        <div class="alert alert-success" role="alert">
                            <?= $msg; ?>

                        </div>
                        <?php
                    }
                    ?>
                    <?php
                    if(isset($_GET['erro'])){
                        if($_GET['erro'] == 'update_admin'){
                        }
                        ?>
                        <div class="alert alert-danger" role="alert">
                            <?= $msg = "Os dados não foram atualizados."?>
                        </div>
                        <?php
                    }
                    ?>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card mb-4">
                                <h5 class="card-header">Detalhes do Perfil</h5>
                                <!-- Account -->
                                <hr class="my-0">
                                <div class="card-body">
                                    <form id="formAccountSettings" action="functions/update_admin.php" method="POST">
                                        <input type="hidden" name="id_admin" value="<?= $admin['id_admin']?>">
                                        <div class="row">
                                            <div class="mb-3 col-md-6">
                                                <label for="firstName" class="form-label">Nome</label>
                                                <input class="form-control"
                                                       type="text"
                                                       id="nome_update"
                                                       name="nome_update"
                                                       value="<?= $admin['nome']?>"
                                                       autofocus="">
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="lastName" class="form-label">Sobrenome</label>
                                                <input class="form-control"
                                                       type="text"
                                                       name="sobrenome_update"
                                                       id="sobrenome_update"
                                                       value="<?= $admin['sobrenome']?>">
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="email" class="form-label">E-mail</label>
                                                <input class="form-control"
                                                       type="text"
                                                       id="email_update"
                                                       name="email_update"
                                                       value="<?= $admin['email']?>"
                                                       placeholder="xxxxx@exemplo.com">
                                            </div>
                                            <div class="mb-3 col-md-6">
                                                <label for="senha" class="form-label">Nova Senha</label>
                                                <input class="form-control"
                                                       type="password"
                                                       id="senha_update"
                                                       name="senha_update"
                                                       value=""
                                                       placeholder="Digite nova senha para alterar">
                                            </div>
                                        <div class="mt-2">
                                            <button type="submit" class="btn btn-primary me-2">Salvar Alterações</button>
                                        </div>
                                    </form>
                                </div>
                                <!-- /Account -->
                            </div>
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
