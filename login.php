<?php 
session_start(); 
if (isset($_SESSION['autenticado'])){
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Free Gaming - Login</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="icon" href="img/controle.png" type="image/png">
</head>
<body style="background-color: #fbdbab;">

<?php include("cabecalho.php"); ?>

<div class="container d-flex justify-content-center align-items-center" style="min-height:80vh;">
  <div class="card shadow p-4" style="width:100%; max-width:450px; background-color:#fdcc77; border-radius:15px; border: none;">

    <div class="text-center mb-4">
      <?php 
        $msg = "Login";
        $latest = "index";
        if(isset($_GET['login'])) {
            if($_GET['login'] == 'erroGames'){ 
              $msg = "Faça Login para acessar os Jogos";
              $latest = "games";
            }
            if($_GET['login'] == 'erroIndex'){
               $msg = "Faça Login para acessar a Principal";
            }
        }
      ?>
      <h4 style="color: #d45d65; font-weight: bold;"><?php echo $msg; ?></h4>
    </div>

    <form action="valida_login.php" method="post">
      <div class="mb-3">
        <label class="form-label fw-bold">Email</label>
        <input type="email" name="email" class="form-control" placeholder="seuemail@exemplo.com" required>
      </div>

      <div class="mb-3">
        <label class="form-label fw-bold">Senha</label>
        <input type="password" name="password" class="form-control" placeholder="Digite sua senha" required>
      </div>

      <div class="form-check mb-3">
        <input class="form-check-input" type="checkbox" id="isAdmin" name="isAdmin">
        <label class="form-check-label fw-bold" for="isAdmin">Sou Admin</label>
      </div>

      <div id="adminCodeContainer" class="mb-3 d-none">
        <label class="form-label fw-bold">Código do Admin</label>
        <input type="text" name="adminCode" class="form-control" placeholder="Código de acesso">
      </div>

      <div class="text-center mb-3">
        <span class="text-dark opacity-75">Ainda não tem uma conta?</span>
        <a href="cadastro.php" class="d-inline-block fw-bold link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover ms-1" style="color: #d45d65;">
          Cadastre-se
        </a>
      </div>


      <input type="hidden" name="latest" value=<?php echo $latest;?>>
      <p>Atenção: o login ainda não possui nenhuma função além de ser necessaria </p>
      <p>para entrar em outras abas, e está aqui somente para demonstrar uma parte</p>
      <p>do meu conhecimentoem criação de sistemas de login</p>
      <input type="hidden" name="acao" value="login">
      <button type="submit" class="btn w-100 text-white fw-bold py-2" style="background-color:#f46f78;">
        ENTRAR
      </button>

      <?php if (isset($_GET['erro'])): ?>
        <div class="alert alert-danger mt-3 text-center">
          <?php 
            if($_GET['erro'] == 'login_invalido') echo "Usuário ou senha inválidos.";
            if($_GET['erro'] == 'codigo_admin_incorreto') echo "Código de acesso Admin incorreto.";
            if($_GET['erro'] == 'conta_admin_sem_checkbox') echo "Esta conta é de administrador. Marque 'Sou Admin'.";
            if($_GET['erro'] == 'email_ja_cadastrado') echo "Este e-mail já está cadastrado no sistema.";
            if($_GET['erro'] == 'campos_vazios') echo "Por favor, preencha todos os campos.";
          ?>
        </div>
      <?php endif; ?>
    </form>
  </div>
</div>

<?php include("rodapé.php"); ?>

<script>
  const adminCheckbox = document.getElementById('isAdmin');
  if(adminCheckbox) {
      adminCheckbox.addEventListener('change', function () {
          document.getElementById('adminCodeContainer').classList.toggle('d-none');
      });
  }
</script>
</body>
</html>