<?php
require_once './init.php';

$categoria_get = isset($_GET['especialidade']) ? trim($_GET['especialidade']) : '';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $ids = array_column($_SESSION['fornecedores'], 'id_2');
    $Idfornecedor = $ids ? max($ids) + 1 : 1;


    $_SESSION['fornecedores'][] = [
        'id_2' => $Idfornecedor,
        'fornecedor' => $_POST['fornecedor'],
        'especialidade' => $_POST['especialidade'],
        'marca_principal' => $_POST['marca_principal'],
        'troca_devolucao' => $_POST['troca_devolucao'],
        'prazo_entrega' => $_POST['prazo_entrega'],

    ];

    header('Location: fornecedores.php?fornecedoresadd=1');
    exit;

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
    <link rel="stylesheet" href="../CSS/style.css">
</head>

<body>

    <?php
    require_once 'partials/header.php';
    ?>


    <main>

        <?php
        ?>
        <section class="conteudo">
            <div class="container_conteudo_filtros">
                <ul>
                    <li><a href="fornecedores.php">Todos</a></li>
                    <?php
                    foreach ($categorias_fornecedores as $kcatfor => $vcatfor) {
                        print '<li><a href="fornecedores.php?especialidade=' . $kcatfor . '">' . $vcatfor . '</a></li>';
                    }
                    ?>
                </ul>
            </div>
            <div class="fornecedores_grid">
                <?php
                foreach ($_SESSION['fornecedores'] as $fornecedor) {
                    if ($categoria_get === '' ||strtolower(trim($fornecedor['especialidade'])) === strtolower(trim($categoria_get))){
                        print '<div class="container_fornecedores">
                        <a href="detalhe_fornecedor.php?id=' . $fornecedor['id_2'] . '" class="container_fornecedores_dados">
                        <h2>' . $fornecedor['fornecedor'] . '</h2>
                        <h3>' . $fornecedor['marca_principal'] . '</h3>
                        <h3>' . $fornecedor['cnpj'] . '</h3>
                        <p class="container_fornecedores_linha">_____________________</p>
                    </a>
                    <a href="#" class="container_fornecedores_rastreio">
                        <p>Link de Rastreio</p>
                    </a>
                    </div>';
                    }
                }
                ?>
            </div>
        </section>
    </main>
</body>

</html>