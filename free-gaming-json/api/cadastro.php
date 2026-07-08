<?php session_start(); ?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Free Gaming - Cadastro</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="icon" href="img/controle.png" type="image/png">
</head>
<body style="background-color: #fbdbab;">

<?php include("cabecalho.php"); ?>

<div class="container d-flex justify-content-center align-items-center" style="min-height:80vh;">
  <div class="card shadow p-4" style="width:100%; max-width:450px; background-color:#fdcc77; border-radius:15px; border: none;">

    <h4 class="text-center mb-4" style="color: #d45d65; font-weight: bold;">Cadastre-se</h4>

    <form action="valida_login.php" method="post">
      <div class="mb-3">
        <label class="form-label fw-bold">Nome</label>
        <input type="text" name="nameNew" class="form-control" placeholder="Como quer ser chamado?" required>
      </div>

      <div class="mb-3">
        <label class="form-label fw-bold">Email</label>
        <input type="email" name="emailNew" class="form-control" placeholder="exemplo@email.com" required>
      </div>

      <div class="mb-4">
        <label class="form-label fw-bold">Senha</label>
        <input type="password" name="passwordNew" class="form-control" placeholder="Crie uma senha forte" required>
      </div>

      <input type="hidden" name="acao" value="cadastro">
      <button type="submit" class="btn w-100 text-white fw-bold py-2" style="background-color:#f46f78;">
        CADASTRAR AGORA
      </button>
    </form>
  </div>
</div>

<?php include("rodapé.php"); ?>
</body>
</html>