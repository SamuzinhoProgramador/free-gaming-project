<?php
session_start();
session_destroy();
unset($_SESSION["autenticado"]);
header('Location: login.php');
exit;
?>