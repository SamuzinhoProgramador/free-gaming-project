<?php
// Inicia a sessão para poder armazenar dados do usuário durante a navegação
session_start();

// Ativa exibição de erros (útil para debug)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Inclui o arquivo de configuração para conectar ao banco de dados
require_once 'config.php';

// Garante que o banco e a tabela existam antes de qualquer operação
require_once 'setup_banco.php'; 

// ======= RECEBENDO DADOS DO FORMULÁRIO =======
// Pega dados enviados via POST (formulário)
$email = $_POST['email'] ?? '';          // email para login
$password = $_POST['password'] ?? '';    // senha para login
$isAdmin = !empty($_POST['isAdmin']); // checkbox pode enviar 'on', '1', 'true' ou similar
$AdminCode = trim((string)($_POST['adminCode'] ?? ''));  // código secreto para admin (remove espaços em branco)

$newName = $_POST['nameNew'] ?? '';       // nome para cadastro
$newEmail = $_POST['emailNew'] ?? '';     // email para cadastro
$newPassword = $_POST['passwordNew'] ?? '';// senha para cadastro

$acao = $_POST['acao'] ?? ''; // ação: 'login' ou 'cadastro'

// ======= LOGIN =======
if ($acao === 'login') {
    try {
        // Prepara a consulta para buscar usuário pelo email
        $stmt = $conexao->prepare("SELECT * FROM dados_login WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        // Busca o usuário encontrado
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        // Verifica se encontrou o usuário e se a senha bate
        if ($usuario && password_verify($password, $usuario['senha'])) {
            // Converte o valor do banco para booleano
            $isAdminDB = (bool)$usuario['is_admin'];

            if ($isAdminDB) {
                // Caso seja usuário admin
                if (!$isAdmin) {
                    // Tentou logar sem marcar que é admin (debug alert)
                    echo "<script>alert('DEBUG: tentativa de login admin sem marcar checkbox isAdmin'); window.location.href='login.php?erro=login_invalido_conta_admin';</script>";
                    exit;
                } elseif ($AdminCode !== $usuario['admin_code']) {
                    // Código de admin incorreto (debug alert)
                    echo "<script>alert('DEBUG: código admin incorreto'); window.location.href='login.php?erro=login_invalido_erro_code_conta_admin';</script>";
                    exit;
                } else {
                    // Login admin correto (debug alert)
                    $_SESSION['usuario_nome'] = $usuario['nome'];
                    $_SESSION['autenticado'] = 'yes';
                    $_SESSION['is_admin'] = true;
                    echo "<script>alert('DEBUG: login admin bem-sucedido'); window.location.href='index.php?logou_como_admin';</script>";
                    exit;
                }
            } else {
                // Usuário normal (não admin) (debug alert)
                $_SESSION['usuario_nome'] = $usuario['nome'];
                $_SESSION['autenticado'] = 'yes';
                $_SESSION['is_admin'] = false;
                echo "<script>alert('DEBUG: login de usuário normal'); window.location.href='index.php';</script>";
                exit;
            }
        } else {
            // Usuário não encontrado ou senha incorreta (debug alert)
            echo "<script>alert('DEBUG: usuário não encontrado ou senha incorreta'); window.location.href='login.php?erro=login_invalido';</script>";
            exit;
        }
    } catch(PDOException $e) {
        die("Erro ao tentar logar: " . $e->getMessage());
    }
}

// ======= CADASTRO =======
elseif ($acao === 'cadastro') {
    // Verifica se todos os campos obrigatórios estão preenchidos
    if (empty($newName) || empty($newEmail) || empty($newPassword)) {
        header('Location: login.php?erro=campos_vazios');
        exit;
    }

    try {
        // Verifica se o e-mail já está cadastrado
        $stmt = $conexao->prepare("SELECT id FROM dados_login WHERE email = :email");
        $stmt->bindParam(':email', $newEmail);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            // Email já existe
            header('Location: login.php?erro=email_ja_cadastrado');
            exit;
        }

        // Criptografa a senha antes de salvar no banco
        $senhaHash = password_hash($newPassword, PASSWORD_DEFAULT);

        // Insere novo usuário
        $stmt = $conexao->prepare("
            INSERT INTO dados_login (nome, email, senha) 
            VALUES (:nome, :email, :senha)
        ");
        $stmt->bindParam(':nome', $newName);
        $stmt->bindParam(':email', $newEmail);
        $stmt->bindParam(':senha', $senhaHash);
        $stmt->execute();

        // Cria sessão do novo usuário
        $_SESSION['usuario_nome'] = $newName;
        $_SESSION['autenticado'] = 'yes';
        $_SESSION['is_admin'] = false;
        header('Location: index.php');
        exit;
    } catch(PDOException $e) {
        die("Erro ao cadastrar: " . $e->getMessage());
    }
}
?>
