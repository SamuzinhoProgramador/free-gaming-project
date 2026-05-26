<?php

try {
    $conexao = new PDO('mysql:host=localhost', 'root', '');
    $conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Criar banco
    $conexao->exec("CREATE DATABASE IF NOT EXISTS free_gaming");
    $conexao->exec("USE free_gaming");

    // Criar tabela
    $conexao->exec("
        CREATE TABLE IF NOT EXISTS dados_login (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nome VARCHAR(100) NOT NULL,
            email VARCHAR(100) NOT NULL UNIQUE,
            senha VARCHAR(255) NOT NULL,
            is_admin TINYINT(1) DEFAULT 0,
            admin_code VARCHAR(255) DEFAULT NULL
        )
    ");

    // Criar admin inicial (apenas se não existir)
    $senhaAdmin = password_hash('Kai_140111', PASSWORD_DEFAULT);
    $adminCode = 'abcdefg'; // Código secreto para admin

    $conexao->exec("
        INSERT IGNORE INTO dados_login (nome, email, senha, is_admin, admin_code)
        VALUES ('Samuel Admin', 'samuelbomfimbordin@gmail.com', '$senhaAdmin', 1, '$adminCode')
    ");

} catch (PDOException $e) {
    die("Erro ao configurar banco: " . $e->getMessage());
}