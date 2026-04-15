<?php
require_once './init.php';

$categoria_get = isset($_GET['categoria']) ? trim($_GET['categoria']) : '';


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
    <link rel="stylesheet" href="../CSS/style.CSS">
</head>

<body>

    <?php
    require_once 'partials/header.php';
    ?>


    <main>


        <table class="container_conteudo_planilha_produto">
            <tr class="container_planilha_produto_especificações">
                <th>FORNECEDOR</th>
                <th>ESPECIALIDADE</th>
                <th>MARCAS PRINCIPAIS</th>
                <th>TROCAS/DEVOLUÇÕES</th>
                <th>PRAZO DE ENTREGA</th>
                <th>LINK DE RASTREIO</th>
            </tr>
            <?php
            foreach ($_SESSION['fornecedores'] as $fornecedor) {

                if (isset($_SESSION['fornecedores']) && !empty($_SESSION['fornecedores'])) {
                    print '<tr class="container_planilha_produto_dados">
                
            <td><a href="detalhe_fornecedor.php?id=' . $fornecedor['id_2'] . '">' . $fornecedor['fornecedor'] . '</a></td>
            <td>' . $fornecedor['especialidade'] . '</td>
            <td>' . $fornecedor['marca_principal'] . '</td>
            <td>' . $fornecedor['troca_devolucao'] . '</td>
            <td>' . $fornecedor['prazo_entrega'] . '</td>
            <td><a href="https://rastreamento.correios.com.br/app/index.php" target="blanck">Link Entrega</a></td>
        </tr>';
                }

            }
            ;

            ?>

        </table>

    </main>
</body>

</html>