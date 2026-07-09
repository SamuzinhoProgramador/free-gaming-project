<?php
session_start();
session_destroy();
unset($_SESSION["autenticado"]);
setcookie('autenticado', '', time() - 3600, '/');
setcookie('usuario_nome', '', time() - 3600, '/');
header('Location: login.php');
exit;
?>