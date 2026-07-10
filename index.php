<?php session_start();
    if (!isset($_SESSION['autenticado'])){
        header('Location: login.php?login=erroIndex' );
        exit;
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="icon" href="img/controle.png" type="image/png">
  <title>Free Games</title>
</head>
<body>
  <?php

    include("cabecalho.php");
  ?>
  <div style="height: 200px;">
  <!--conteudo-->
  </div>
  <?php include("rodapé.php"); ?>
    
  </body>
</html>