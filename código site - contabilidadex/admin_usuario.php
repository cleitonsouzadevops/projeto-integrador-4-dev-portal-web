<?php
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Conectar ao banco de dados (inclua aqui o arquivo de conexão)
require_once 'database/conexao.php';

// Função para buscar clientes
function buscarClientes($pdo, $termo_busca) {
    // Query para buscar clientes que correspondam ao termo de busca
    $query = "SELECT * FROM cliente WHERE nome LIKE :termo_busca";
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':termo_busca', '%' . $termo_busca . '%', PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Processar o formulário de busca
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['buscar'])) {
    $termo_busca = $_POST['termo_busca'];
    $clientes = buscarClientes($pdo, $termo_busca);
} else {
    // Exibir todos os clientes inicialmente
    $clientes = buscarClientes($pdo, '');
}

// Processar a exclusão de cliente
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['excluir'])) {
    $cliente_id = $_POST['cliente_id'];

    // Query para excluir cliente (substituir com sua lógica de exclusão adequada)
    $query = "DELETE FROM clientes WHERE id = :cliente_id";
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
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Clientes - ContabilidadeX</title>
    <link rel="stylesheet" href="css/style_login.css">
</head>
<body>
    <div class="container">
        <h1>Administrar Clientes</h1>

        <!-- Formulário de Busca -->
        <form action="admin_clientes.php" method="POST">
            <label for="termo_busca">Buscar Cliente por Nome:</label>
            <input type="text" id="termo_busca" name="termo_busca" value="<?php echo isset($termo_busca) ? $termo_busca : ''; ?>" required>
            <button type="submit" name="buscar">Buscar</button>
        </form>

        <!-- Resultados da Busca -->
        <?php if (isset($clientes) && count($clientes) > 0): ?>
            <h2>Resultados da Busca:</h2>
            <ul>
                <?php foreach ($clientes as $cliente): ?>
                    <li>
                        <?php echo $cliente['nome']; ?> -
                        <form action="processa_exclusao_cliente.php" method="POST">
                            <input type="hidden" name="cliente_id" value="<?php echo $cliente['id']; ?>">
                            <button type="submit" name="excluir">Excluir</button>
                        </form>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php elseif (isset($clientes) && count($clientes) == 0): ?>
            <p>Nenhum cliente encontrado.</p>
        <?php endif; ?>

        <!-- Mensagem de Feedback -->
        <?php if (isset($_GET['message'])): ?>
            <p class="message"><?php echo htmlspecialchars($_GET['message']); ?></p>
        <?php endif; ?>

        <!-- Links para outras funcionalidades administrativas -->
        <ul>
            <li><a href="admin_produtos.php">Administrar Produtos</a></li>
            <li><a href="admin_usuarios.php">Administrar Usuários</a></li>
            <li><a href="index.html">Sair</a></li> <!-- Link para sair (logout.php a ser implementado) -->
        </ul>
    </div>
</body>
</html>

