<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Produtos - ContabilidadeX</title>
    <link rel="stylesheet" href="css/style_cadastro.css"> <!-- Link para o arquivo CSS -->
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
            text-align: center;
        }

        h1 {
            margin-bottom: 20px;
            color: #333;
        }

        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 5px;
            text-align: left;
        }

        input[type="text"] {
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            width: calc(100% - 16px); /* A largura do input é 100% do container menos a borda */
        }

        input[type="submit"] {
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
            width: 100%; /* Botão ocupa 100% da largura do container */
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        .message {
            margin-top: 10px;
            color: #333;
        }

        .message.error {
            color: red;
        }

        .btn-voltar {
            margin-top: 10px;
            text-align: center;
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
        <h1>Cadastro de Produtos</h1>
        
        <form action="processa_produto.php" method="POST">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>
            
            <label for="descricao">Descrição:</label>
            <input type="text" id="descricao" name="descricao" required>
            
            <label for="preco">Preço:</label>
            <input type="text" id="preco" name="preco" required>
            
            <input type="submit" value="Cadastrar">
        </form>
 <script>
      // JavaScript para aplicar a máscara de preço (R$ X.XXX,XX)
  //   document.getElementById('preco').addEventListener('input', function(event) {
//         let preco = event.target.value.replace(/\D/g, ''); // Remove não dígitos
//            preco = preco.replace(/(\d)(\d{2})$/, '$1,$2'); // Coloca vírgula antes dos centavos
  //          preco = preco.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.'); // Coloca ponto para milhar
    //        preco = 'R$ ' + preco;
      //      event.target.value = preco; // Atualiza o valor no campo
       // });
    </script>



        <!-- Mensagem de sucesso/erro -->
        <?php
        if (isset($_GET['message'])) {
            $message = htmlspecialchars($_GET['message']);
            echo '<p class="message">' . $message . '</p>';
        }
        ?>

        <div class="btn-voltar">
            <a href="index.html">Sair</a>
        </div>
    </div>
</body>
</html>

