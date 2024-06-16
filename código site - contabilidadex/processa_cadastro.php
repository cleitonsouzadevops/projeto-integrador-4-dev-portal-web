<?php
require_once 'database/conexao.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $hashed_password = password_hash($password, PASSWORD_DEFAULT); // Criptografar a senha

    try {
        // Verificar se o usuário já existe
        $query = "SELECT * FROM usuarios WHERE username = :username";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $message = "Usuário já existe.";
        } else {
            // Inserir novo usuário
    #        $query = "INSERT INTO usuarios (username, password) VALUES (:username, :password)";
     #       $stmt = $pdo->prepare($query);
      #      $stmt->bindParam(':username', $username);
       #     $stmt->bindParam(':password', $hashed_password);
 $query = "INSERT INTO usuarios (username, senha, data_criacao) VALUES (:username, :senha, :data_criacao)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':senha', $password);
        $stmt->bindParam(':data_criacao', $data_criacao);


            if ($stmt->execute()) {
                $message = "Cadastro efetuado com sucesso!";
            } else {
                $message = "Erro ao cadastrar. Tente novamente.";
            }
        }

        // Redirecionar de volta para a página de cadastro com mensagem
        echo $message; // Mensagem de depuração
        // header('Location: cadastre-se.php?message=' . urlencode($message));
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
            <a href="usuario.php"><button>Novo Cadastro</button></a>
        </p>
    </div>
</body>
</html>


