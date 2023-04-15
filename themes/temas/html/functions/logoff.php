<?php
session_start();
session_destroy();
header('location:../pag-login.php');
exit();