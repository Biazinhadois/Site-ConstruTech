<?php
require 'init.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $ids = array_column($_SESSION['produtos'], 'id');
    $novoId = $ids ? max($ids) + 1 : 1;

    $nome = trim($_POST['nome'] ?? '');
    $categoria = trim($_POST['categoria'] ?? '');
    $quantidade_minima = (int) ($_POST['quantidade_minima'] ?? 0);
    $quantidade_atual = (int) ($_POST['quantidade_atual'] ?? 0);
    $marca = trim($_POST['marca'] ?? '');
    $preco_unitario = floatval($_POST['preco_unitario'] ?? 0);
    $imagemNome = '';

    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
        $extensao = pathinfo($_FILES['imagem']['name'], PATHINFO_EXTENSION);
        $imagemNome = $novoId . '.' . strtolower($extensao);
        move_uploaded_file($_FILES['imagem']['tmp_name'], __DIR__ . '/../IMAGENS/PRODUTOS/' . $imagemNome);
    }

    $_SESSION['produtos'][] = [
        'id' => $novoId,
        'nome' => $nome,
        'preco_unitario' => $preco_unitario,
        'categoria' => $categoria,
        'quantidade_atual' => $quantidade_atual,
        'quantidade_minima' => $quantidade_minima,
        'marca' => $marca,
        'imagem' => $imagemNome,
    ];

    header('Location: produtos.php?produtoadd=1');
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
        <section>
            <!--Caixa do cadastro-->

            <article class="cadbox">
                <!--Formulário-->

                <form class="formcad" action="cadastrar_produtos.php" method="POST" enctype="multipart/form-data">

                    <h1 class="titulo_cad">Cadastro de Produtos</h1>

                    <input type="text" placeholder="Nome" name="nome" required />

                    <select class="selecionar" name="categoria">
                        <option value="" disabled selected>Categoria</option>
                        <option value="bruto">Bruto</option>
                        <option value="ferramentas">Ferramentas</option>
                        <option value="acabamento">Acabamento</option>
                    </select>
                    <input type="number" placeholder="Quantidade Minima" name="quantidade_minima" required min="1" />
                    <input type="number" placeholder="Quantidade" name="quantidade_atual" required min="1" />
                    <input type="text" placeholder="Marca" name="marca" required />
                    <input type="number" placeholder="Preco Unitário" name="preco_unitario" required min="1" />
                    <input type="file" name="imagem" accept="image/*" required />


                    <!--Botão de cadastro-->
                    <button type="submit" class="buttoncad2" href="#">Envie</button>

                </form>
            </article>

        </section>

    </main>
</body>

</html>