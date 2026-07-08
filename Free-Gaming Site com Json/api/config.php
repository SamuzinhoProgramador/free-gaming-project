<?php
// Caminho para o arquivo JSON que guardará os dados
$json_file = __DIR__ . '/usuarios.json';

// Função auxiliar para ler os usuários salvos no JSON
function lerUsuarios($arquivo) {
    if (!file_exists($arquivo)) {
        return [];
    }
    $conteudo = file_get_contents($arquivo);
    return json_decode($conteudo, true) ?: [];
}

// Função auxiliar para salvar a lista de usuários de volta no JSON
function salvarUsuarios($arquivo, $usuarios) {
    file_put_contents($arquivo, json_encode($usuarios, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

// Inicialização automática: Cria o arquivo com o Admin padrão se ele não existir
if (!file_exists($json_file)) {
    $senhaAdmin = password_hash('Kai_140111', PASSWORD_DEFAULT);
    $usuariosIniciais = [
        [
            "nome" => "Samuel Admin",
            "email" => "samuelbomfimbordin@gmail.com",
            "senha" => $senhaAdmin,
            "is_admin" => true,
            "admin_code" => "abcdefg"
        ]
    ];
    salvarUsuarios($json_file, $usuariosIniciais);
}
?>