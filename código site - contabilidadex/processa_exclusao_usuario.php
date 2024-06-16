<?php
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Conectar ao banco de dados (inclua aqui o arquivo de conexão)
require_once 'database/conexao.php';

// Verificar se o ID do cliente foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cliente_id = $_POST['cliente_id'];

    // Query para excluir cliente (substitua com sua lógica de exclusão adequada)
    $query = "DELETE FROM usuarios WHERE id = :cliente_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':cliente_id', $cliente_id);

    // Executar a query
    if ($stmt->execute()) {
        $message = "Cliente excluído com sucesso.";
    } else {
        $message = "Erro ao excluir cliente.";
    }

    // Redirecionar de volta para a página de administração com mensagem
    header("Location: admin_clientes.php?message=" . urlencode($message));
    exit();
} else {
    header("Location: admin_clientes.php"); // Caso não seja POST, redirecionar de volta
    exit();
}
?>

