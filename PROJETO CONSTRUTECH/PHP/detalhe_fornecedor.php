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
        <form action="detalhe_fornecedor.php?id=<?php echo $fornecedor['id_2']; ?>" method="POST"></form>
        <h1 class="titulo_fornecedor">Detalhe do fornecedor: <?php echo $fornecedor['fornecedor']; ?> </h1>

        <section class="card">
            <h3>Informações Básicas:</h3>
            <div class="grid-info">
                <div class="infos">Nome Fantasia: <?php echo $fornecedor['fornecedor']; ?></div>
                <div  class="infos">Razão Social:<?php echo $fornecedor['razao_social']; ?></div>
                <div  class="infos">CNPJ: <?php echo $fornecedor['cnpj']; ?></div>
                <div class="infos">Endereço:<?php echo $fornecedor['endereco']; ?></div>
            </div>
        </section>
        <br>
        <div class="mini-grid">
            <section class="card">
                <h3>Contato Principal</h3>
                <p class="infos">Vendedor:<?php echo $fornecedor['nome_consultor']; ?> </p>
                <p  class="infos">E-mail:<?php echo $fornecedor['email']; ?></p>
            </section>
            <section class="card">
                <h3>Trocas e Devoluções</h3>
                <p  class="infos">Aceitação de trocas / Devolução: <?php echo $fornecedor['troca_devolucao']; ?></p>
                <h3>Prazo de Entrega</h3>
                <p  class="infos"><?php echo $fornecedor['prazo_entrega']; ?></p>
            </section>
        </div>

        <div class="mini-grid">
            <section class="card">
                <h3>Observações:</h3>
                <h4  class="infos">Condição de pagamento:</h4>
                <P><?php echo $fornecedor['pagamento_condicacao']; ?></P>
                <h4  class="infos">Pedido minimo:</h4>
                <P><?php echo $fornecedor['pedido_min']; ?></P>

            </section>
            <section class="card">
                <h3>Marcas Principais</h3>

                <?php echo $fornecedor['marca_principal']; ?>
                <br> <br>
                <h3>Retornar a pagina fornecedores:</h3>
                <a href="./fornecedores.php" class="voltar_btn">Voltar</a>

            </section>
        </div>
        </div>
        </form>

    </main>



</body>

</html>
