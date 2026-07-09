<?php session_start();?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style.css">
  <link rel="icon" href="img/controle.png" type="image/png">
  <title>Free Games</title>
</head>
<body>
  <?php
    if (!isset($_SESSION['autenticado'])){
        header('Location:login.php?login=erroIndex' );
    }
    include("cabecalho.php");
  ?>
  <div style="height: 200px;">
  <!--conteudo-->
  </div>
  <?php include("rodapé.php"); ?>
    
  </body>
</html>