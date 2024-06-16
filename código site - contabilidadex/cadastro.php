<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastro de Usuários - ContabilidadeX</title>
 <link rel="stylesheet" href="css/style.css">
<script src="js/script.js" defer></script>


</head>
<body>
    <h1>Cadastro de Usuários</h1>
    
    <form id="loginForm" action="processa_cadastro.php" method="POST">
        <div>
            <label for="id">ID:</label>
            <input type="text" id="id" name="id" readonly>
        </div>
        <div>
            <label for="username">Usuário:</label>
            <input type="text" id="username" name="username" required>
        </div>
        <div>
            <label for="password">Senha:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <div>
            <label for="data_criacao">Data de Criação:</label>
            <input type="date" id="data_criacao" name="data_criacao" required>
        </div>
        <button type="submit">Entrar</button>
    </form>

    <?php
    // Verifica se há uma mensagem para exibir
    if (isset($_GET['message'])) {
        echo '<p>' . htmlspecialchars($_GET['message']) . '</p>'; // Exibe a mensagem
    }
    ?>
</body>
</html>

