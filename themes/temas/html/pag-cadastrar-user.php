<?php
require __DIR__ . "/../../../vendor/autoload.php";
?>
<!DOCTYPE html>
<html
        lang="pt-br"
        class="light-style customizer-hide"
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

    <title><?= CONF_TITLE ?></title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../assets/img/favicon/logo-mini.png">

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

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="../assets/vendor/css/pages/page-auth.css" />
    <!-- Helpers -->
    <script src="../assets/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="../assets/js/config.js"></script>
</head>

<body>
<!-- Content -->

<div class="container-xxl">
    <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
            <?php
            if(isset($_GET['erro'])){
                if($_GET['erro'] == 'email'){
                    $msg="O e-mail informado já existe!";
                }
                else{
                    $msg="Houve um erro ao cadastrar. Tente novamente.";
                }
            ?>
            <div class="alert alert-danger" role="alert">
                <?= $msg; ?>
            </div>
            <?php
            }
            ?>
            <!-- Register Card -->
            <div class="card">
                <div class="card-body">
                    <!-- Logo -->
                    <div class="app-brand justify-content-center">
                        <img src="../assets/img/favicon/comer-bem-logo-3.png" style="height: 150px; " >
                    </div>
                    <!-- /Logo -->
                    <h4 class="mb-2"> Cadastro administrativo </h4>
                    <p></p>
                        <form id="formAuthentication" class="mb-3" action="functions/registrar.php" method="POST">
                        <div class="mb-3">
                            <label for="username" class="form-label">Nome</label>
                            <input
                                    type="text"
                                    class="form-control"
                                    id="nome_admin"
                                    name="nome_admin"
                                    placeholder="Entre com seu Nome"
                                    autofocus
                            />
                        </div>
                        <div class="mb-3">
                            <label for="username" class="form-label">Sobrenome</label>
                            <input
                                    type="text"
                                    class="form-control"
                                    id="sobrenome_admin"
                                    name="sobrenome_admin"
                                    placeholder="Entre com seu Sobrenome"
                                    autofocus
                            />
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="text" class="form-control"
                                   id="email_admin"
                                   name="email_admin"
                                   placeholder="Entre com seu e-mail" />
                        </div>
                        <div class="mb-3 form-password-toggle">
                            <label class="form-label" for="password">Senha</label>
                            <div class="input-group input-group-merge">
                                <input
                                        type="password"
                                        id="senha_admin"
                                        class="form-control"
                                        name="senha_admin"
                                        placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                        aria-describedby="password"
                                />
                                <span class="input-group-text cursor-pointer"><i class="bx bx-hide"></i></span>
                            </div>
                        </div>


                        <button class="btn btn-primary d-grid w-100" type="submit">Cadastrar</button>
                    </form>

                    <p class="text-center">
                        <span>Já tem uma conta?</span>
                        <a href="pag-login.php">
                            <span>Faça Login</span>
                        </a>
                    </p>
                </div>
            </div>
            <!-- Register Card -->
        </div>
    </div>
</div>

<!-- / Content -->
<!-- Core JS -->
<!-- build:js assets/vendor/js/core.js -->
<script src="../assets/vendor/libs/jquery/jquery.js"></script>
<script src="../assets/vendor/libs/popper/popper.js"></script>
<script src="../assets/vendor/js/bootstrap.js"></script>
<script src="../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

<script src="../assets/vendor/js/menu.js"></script>
<!-- endbuild -->

<!-- Vendors JS -->

<!-- Main JS -->
<script src="../assets/js/main.js"></script>

<!-- Page JS -->

<!-- Place this tag in your head or just before your close body tag. -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
</body>
</html>
