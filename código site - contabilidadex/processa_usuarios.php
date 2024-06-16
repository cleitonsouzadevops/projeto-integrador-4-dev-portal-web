<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once 'database/conexao.php';
require_once 'database/conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];

    try {
        $query = "INSERT INTO usuarios (nome, email, telefone) VALUES (:nome, :email, :telefone)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':telefone', $telefone);

        if ($stmt->execute()) {
            $message = "Cliente cadastrado com sucesso!";
        } else {
            $message = "Erro ao cadastrar cliente. Tente novamente.";
        }

        echo $message; // Mensagem de depuração
        // header('Location: clientes.php?message=' . urlencode($message));
        // exit();
    } catch (PDOException $e) {
        die('Erro no banco de dados: ' . $e->getMessage());
    }
}
?>
<!-- Botão para voltar à página inicial -->
<br><br>
<a href="index.html"><button>Voltar à Página Inicial</button></a>
