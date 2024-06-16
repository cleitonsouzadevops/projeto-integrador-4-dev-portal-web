#<?php
#$host = 'localhost';
#$dbname = 'contabilidadeX';
#$username = 'cleiton';
#$password = 'Cpd13314@';

#try {
#    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
#    echo "Conexão com o banco de dados estabelecida com sucesso!";
#} catch (PDOException $e) {
#    echo "Erro de conexão com o banco de dados: " . $e->getMessage();
#}
#?>


<?php
#error_reporting(E_ALL);
#ini_set('display_errors', 1);

$host = 'localhost';
$dbname = 'contabilidadeX';
$username = 'seu_usuario';
$password = 'sua_senha';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

#    echo "Conexão com o banco de dados estabelecida com sucesso cleiton !<br>";

    // Exemplo de consulta para verificar se há algum problema ao buscar dados
    $stmt = $pdo->query("SELECT * FROM clientes");
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
#    echo "Número de linhas encontradas: " . count($rows);

} catch (PDOException $e) {
    die("Erro de conexão com o banco de dados: " . $e->getMessage());
}
?>

