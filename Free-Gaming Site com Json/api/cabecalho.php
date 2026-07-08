<?php
$username = $_SESSION['usuario_nome'] ?? '';
if (isset($_SESSION['autenticado'])) {
    $login_logoff = 'SAIR';
    $link = 'logoff.php';
} else {
    $login_logoff = 'ENTRAR';
    $link = 'login.php';
}
?>

<style>
  .nav-link:hover {
    color: #fdcc77 !important; /* Cor amarela ao passar o mouse */
    text-decoration: underline;
  }
  .btn-nav-custom {
    background-color: #fdcc77; 
    color: #f46f78 !important;
    font-weight: bold;
    border: none;
    transition: 0.3s;
  }
  .btn-nav-custom:hover {
    background-color: #fddb9b; /* Um amarelo levemente mais claro no hover */
    transform: scale(1.05);
  }
</style>

<nav class="navbar navbar-expand-lg navbar-dark" style="background-color:#f46f78;">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">
      <img src="img/Logo_texto.png" alt="Logo" style="width: 220px;">
    </a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="menu">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item"><a class="nav-link text-white" href="index.php">Principal</a></li>
        <li class="nav-item"><a class="nav-link text-white" href="games.php">Jogos</a></li>
      </ul>

      <ul class="navbar-nav align-items-center">
        <li class="nav-item">
          <a class="btn btn-nav-custom px-3 me-2" href="<?php echo $link; ?>">
            <?php echo $login_logoff; if($username) echo " | " . htmlspecialchars($username); ?>
          </a>
        </li>

        <?php if (!isset($_SESSION['autenticado'])): ?>
        <li class="nav-item">
          <a class="btn btn-nav-custom px-3" href="cadastro.php">
            CADASTRAR-SE
          </a>
        </li>
        <?php endif; ?>
      </ul>
    </div>
  </div>
</nav>