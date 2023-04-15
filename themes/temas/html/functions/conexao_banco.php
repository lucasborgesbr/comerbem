<?php
$servidor = "isabelle.solutionsbox.com.br";
$usuario = "isabelle_imedicaluser";
$senha = "ew5FMGwELDp8GS1qk9";
$banco="isabelle_imedical";
// Criar conexão
$conecta = new mysqli($servidor, $usuario, $senha,$banco);
if ($conecta->connect_error) {
    die("Falha na conexão: " . $conecta->connect_error."<br>");
}

date_default_timezone_set('America/Sao_Paulo');