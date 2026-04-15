<?php
require_once './init.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;

$ids = array_column($_SESSION['fornecedores'], 'id_2');

$index = array_search($id, $ids);

if ($index !== false) {

    $fornecedor = $_SESSION['fornecedores'][$index];
} else {
    header('Location: 404.php');
    exit();
}


?>

<!DOCTYPE html>
<html lang="br-pt">

<head>
    <meta charset="UTF-8">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Electrolize&family=Outfit:wght@100..900&family=Palette+Mosaic&family=Wellfleet&display=swap"
        rel="stylesheet">
    <title>Cadastro de Produtos</title>
    <link rel="stylesheet" href="../CSS/style.CSS">
</head>

<body>
    <?php
    require_once 'partials/header.php';
    ?>


    <main>
        <section>
            <article>
                <div class="produto_especificacoes">


                    <div class="container_produto_especificacoes_dados">
                        <form action="detalhe_fornecedor.php?id=<?php echo $fornecedor['id_2']; ?>" method="POST">
                            <h2>Sobre o Fornecedor:</h2>
                            <label>
                                <p class="container_produto_especificacoes_text">Nome do Consultor/Vendedor:</p><br>
                                <h2 class="container_produto_especificacoes_text">
                                    <?php echo $fornecedor['nome_consultor']; ?></h2>

                                <br>

                                <p class="container_produto_especificacoes_text">WhatsApp/Telefone Comercial:</p><br>
                                <h2 class="container_produto_especificacoes_text"><?php echo $fornecedor['contato']; ?>
                                </h2>
                            </label><br>

                            <p class="container_produto_especificacoes_text">E-mail de Pedidos:</p><br>
                            <h2 class="container_produto_especificacoes_text"><?php echo $fornecedor['email']; ?></h2>
                            </label><br>

                            <p class="container_produto_especificacoes_text">CNPJ:</p><br>
                            <h2 class="container_produto_especificacoes_text"><?php echo $fornecedor['cnpj']; ?></h2>
                            </label><br>

                            <p class="container_produto_especificacoes_text">Condições de Pagamento:</p><br>
                            <h2 class="container_produto_especificacoes_texto">
                                <?php echo $fornecedor['pagamento_condicacao']; ?></h2>
                            </label><br>

                            <p class="container_produto_especificacoes_text">Pedido Mínimo:</p><br>
                            <h2 class="container_produto_especificacoes_text"><?php echo $fornecedor['pedido_min']; ?>
                            </h2>
                            </label><br>

                            <p class="container_produto_especificacoes_text">Confiabilidade:</p><br>
                            <h2 class="container_produto_especificacoes_text">
                                <?php echo $fornecedor['confiabilidade']; ?></h2>
                            </label><br>

                            <a href="fornecedores.php">Voltar</a>
                        </form>
                    </div>
                </div>
            </article>
        </section>
    </main>

</body>

</html>