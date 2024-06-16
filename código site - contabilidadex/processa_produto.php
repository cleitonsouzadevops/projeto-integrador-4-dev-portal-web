<?php
require_once 'database/conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $preco = $_POST['preco'];

    try {
        $query = "INSERT INTO produtos (nome, descricao, preco) VALUES (:nome, :descricao, :preco)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':descricao', $descricao);
        $stmt->bindParam(':preco', $preco);

        if ($stmt->execute()) {
            $message = "Produto cadastrado com sucesso!";
        } else {
            $message = "Erro ao cadastrar produto. Tente novamente.";
        }

        echo $message; // Mensagem de depuração
        // header('Location: produtos.php?message=' . urlencode($message));
        // exit();
    } catch (PDOException $e) {
        die('Erro no banco de dados: ' . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Opções de Navegação - ContabilidadeX</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            text-align: center;
        }
        a {
            text-decoration: none;
            margin: 10px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background-color: #0056b3;
        }
        p {
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Botão para voltar à página inicial -->
       <p>
 <a href="index.html"><button>Página Inicial</button></a>

        <p>
            <a href="produtos.php"><button>Novo Cadastro</button></a>
        </p>
    </div>
</body>
</html>


