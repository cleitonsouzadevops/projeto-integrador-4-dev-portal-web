<?php
session_start();

// Verificar se o usuário está logado
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Conectar ao banco de dados (inclua aqui o arquivo de conexão)
require_once 'database/conexao.php';

// Função para buscar usuários
function buscarUsuarios($pdo, $termo_busca) {
    // Query para buscar usuários que correspondam ao termo de busca
    $query = "SELECT * FROM usuarios WHERE username LIKE :termo_busca";
    $stmt = $pdo->prepare($query);
    $stmt->bindValue(':termo_busca', '%' . $termo_busca . '%', PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Processar o formulário de busca
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['buscar'])) {
    $termo_busca = $_POST['termo_busca'];
    $usuarios = buscarUsuarios($pdo, $termo_busca);
} else {
    // Exibir todos os usuários inicialmente
    $usuarios = buscarUsuarios($pdo, '');
}

// Processar a exclusão de usuário
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['excluir'])) {
    $usuario_id = $_POST['usuario_id'];

    // Query para excluir usuário
    $query = "DELETE FROM usuarios WHERE id = :usuario_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':usuario_id', $usuario_id);

    // Executar a query
    if ($stmt->execute()) {
        $message = "Usuário excluído com sucesso.";
    } else {
        $message = "Erro ao excluir usuário.";
    }

    // Redirecionar de volta para a página de administração com mensagem
    header("Location: admin_usuarios.php?message=" . urlencode($message));
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Usuários - ContabilidadeX</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="mb-4">Administrar Usuários</h1>

        <!-- Formulário de Busca -->
        <form action="admin_usuarios.php" method="POST" class="form-inline mb-4">
            <div class="form-group mx-sm-3 mb-2">
                <label for="termo_busca" class="sr-only">Buscar Usuário por Nome:</label>
                <input type="text" class="form-control" id="termo_busca" name="termo_busca" placeholder="Nome do Usuário" value="<?php echo isset($termo_busca) ? $termo_busca : ''; ?>" required>
            </div>
            <button type="submit" name="buscar" class="btn btn-primary mb-2">Buscar</button>
        </form>

        <!-- Resultados da Busca -->
        <?php if (isset($usuarios) && count($usuarios) > 0): ?>
            <h2 class="mb-4">Resultados da Busca:</h2>
            <ul class="list-group">
                <?php foreach ($usuarios as $usuario): ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <?php echo $usuario['username']; ?>
                        <form action="admin_usuarios.php" method="POST" style="display:inline;">
                            <input type="hidden" name="usuario_id" value="<?php echo $usuario['id']; ?>">
                            <button type="submit" name="excluir" class="btn btn-danger btn-sm">Excluir</button>
                        </form>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php elseif (isset($usuarios) && count($usuarios) == 0): ?>
            <p class="alert alert-info">Nenhum usuário encontrado.</p>
        <?php endif; ?>

        <!-- Mensagem de Feedback -->
        <?php if (isset($_GET['message'])): ?>
            <p class="alert alert-info"><?php echo htmlspecialchars($_GET['message']); ?></p>
        <?php endif; ?>

        <!-- Links para outras funcionalidades administrativas -->
        <ul class="list-group mt-4">
            <li class="list-group-item"><a href="admin_produtos.php">Administrar Produtos</a></li>
            <li class="list-group-item"><a href="admin_clientes.php">Administrar Clientes</a></li>
            <li class="list-group-item"><a href="index.html">Sair</a></li>
        </ul>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

