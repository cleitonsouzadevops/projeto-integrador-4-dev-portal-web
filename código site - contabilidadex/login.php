<?php
session_start();

// Verificar se o usuário já está logado, redirecionar se estiver
if (isset($_SESSION['username'])) {
    header("Location: admin_clientes.php");
    exit();
}

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validar usuário e senha (exemplo básico, deve-se implementar um sistema de autenticação seguro)
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Verificar se usuário e senha correspondem (exemplo simples, substituir com lógica de autenticação adequada)
    if ($username === 'admin' && $password === 'senha123') {
        // Autenticação bem-sucedida, iniciar sessão
        $_SESSION['username'] = $username;
        header("Location: admin_clientes.php");
        exit();
    } else {
        $error = "Usuário ou senha incorretos.";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - ContabilidadeX</title>
    <link rel="stylesheet" href="css/style_login.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="password"] {
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #45a049;
        }

        .error {
            color: red;
            margin-top: 10px;
        }

        .btn-voltar {
            text-align: center;
            margin-top: 10px;
        }

        .btn-voltar a {
            text-decoration: none;
            color: #333;
            padding: 5px 10px;
            background-color: #f0f0f0;
            border: 1px solid #ccc;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        .btn-voltar a:hover {
            background-color: #e0e0e0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Login</h1>
        
        <form id="loginForm" action="login.php" method="POST">
            <div>
                <label for="username">Usuário:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div>
                <label for="password">Senha:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Entrar</button>
        </form>

        <div class="btn-voltar">
            <a href="index.html">Voltar para a página inicial</a>
        </div>

        <?php if (isset($error)): ?>
            <p class="error"><?php echo $error; ?></p>
        <?php endif; ?>
    </div>
</body>
</html>

