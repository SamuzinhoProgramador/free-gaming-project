<?php session_start();?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <title>Free Games</title>
  <link rel="icon" href="img/controle.png" type="image/png">
</head>
<body>
  <?php 
    if (!isset($_SESSION['autenticado'])){
        header('Location: login.php?login=erroGames' );
    }
    include("cabecalho.php");
  ?>
  <!--conteudo-->
  <script src="js/main.js"></script>
  <?php include("rodapé.php"); ?>
    </body>
</html>