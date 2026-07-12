<?php
session_start();

ini_set('display_errors', 1);
error_reporting(E_ALL);

// Inclui a nossa nova configuração de arquivos JSON
require_once 'config.php';

// ======= RECEBENDO DADOS DO FORMULÁRIO =======
$email = $_POST['email'] ?? '';          
$password = $_POST['password'] ?? '';    
$isAdmin = !empty($_POST['isAdmin']); 
$AdminCode = trim((string)($_POST['adminCode'] ?? ''));  

$latest = $_POST['latest'];

$newName = $_POST['nameNew'] ?? '';       
$newEmail = $_POST['emailNew'] ?? '';     
$newPassword = $_POST['passwordNew'] ?? '';

$acao = $_POST['acao'] ?? ''; 

// Carrega os dados atuais do arquivo JSON
$usuarios = lerUsuarios($json_file);

// ======= PROCESSANDO O LOGIN =======
if ($acao === 'login') {
    $usuarioEncontrado = null;

    // Procura o usuário pelo email na lista do JSON
    foreach ($usuarios as $u) {
        if (strcasecmp($u['email'], $email) === 0) {
            $usuarioEncontrado = $u;
            break;
        }
    }

    // Se o usuário existir e a senha descriptografada bater
    if ($usuarioEncontrado && password_verify($password, $usuarioEncontrado['senha'])) {
        $isAdminDB = (bool)($usuarioEncontrado['is_admin'] ?? false);

        if ($isAdminDB) {
            if (!$isAdmin) {
                header('Location: login.php?erro=conta_admin_sem_checkbox');
                exit;
            } elseif ($AdminCode !== ($usuarioEncontrado['admin_code'] ?? '')) {
                header('Location: login.php?erro=codigo_admin_incorreto');
                exit;
            } else {
                $_SESSION['usuario_nome'] = $usuarioEncontrado['nome'];
                $_SESSION['autenticado'] = 'yes';
                $_SESSION['is_admin'] = true;
                header('Location: '.$latest.'.php');
                exit;
            }
        } else {
            $_SESSION['usuario_nome'] = $usuarioEncontrado['nome'];
            $_SESSION['autenticado'] = 'yes';
            $_SESSION['is_admin'] = false;
            header('Location: '.$latest.'.php');
            exit;
        }
    } else {
        header('Location: login.php?erro=login_invalido');
        exit;
    }
}

// ======= PROCESSANDO O CADASTRO =======
elseif ($acao === 'cadastro') {
    if (empty($newName) || empty($newEmail) || empty($newPassword)) {
        header('Location: login.php?erro=campos_vazios');
        exit;
    }

    // Verifica se o e-mail já existe no arquivo JSON
    foreach ($usuarios as $u) {
        if (strcasecmp($u['email'], $newEmail) === 0) {
            header('Location: login.php?erro=email_ja_cadastrado');
            exit;
        }
    }

    // Criptografa a senha do novo usuário
    $senhaHash = password_hash($newPassword, PASSWORD_DEFAULT);

    // Cria a estrutura do novo usuário
    $novoUsuario = [
        "nome" => $newName,
        "email" => $newEmail,
        "senha" => $senhaHash,
        "is_admin" => false,
        "admin_code" => null
    ];

    // Adiciona o usuário no array e salva no arquivo JSON
    $usuarios[] = $novoUsuario;
    salvarUsuarios($json_file, $usuarios);

    // Loga o usuário automaticamente após o cadastro
    $_SESSION['usuario_nome'] = $newName;
    $_SESSION['autenticado'] = 'yes';
    $_SESSION['is_admin'] = false;
    header('Location: index.php');
    exit;
}
?>