<?php
session_start();
if((!isset($_SESSION['id_admin'])) == TRUE AND (!isset($_SESSION['email_admin'])) == TRUE){
    session_unset();
    header("Location: pag-login.php?erro=admin_only");
    exit();
}
?>