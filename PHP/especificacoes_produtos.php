<?php
require 'init.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$produto = &$_SESSION['produtos'][$id - 1];

if (isset($_POST['delete'])) {
    unset($_SESSION['produtos'][$id - 1]);
    header('Location: produtos.php');
    exit;
}

if (isset($_POST['nome'])) {
    $produto['nome'] = $_POST['nome'];
    $produto['marca'] = $_POST['marca'];
    $produto['categoria'] = $_POST['categoria'];
    $produto['quantidade_minima'] = (int) $_POST['quantidade_minima'];
    $produto['quantidade_atual'] = (int) $_POST['quantidade_atual'];
    $produto['preco_unitario'] = (float) $_POST['preco_unitario'];
    $produto['preco_total'] = $produto['preco_unitario'] * $produto['quantidade_atual'];
    $saved = true;
}

$imagemSrc = '../IMAGENS/PRODUTOS/' . (!empty($produto['imagem']) ? $produto['imagem'] : $produto['id'] . '.png');
$precoTotal = isset($produto['preco_total']) ? $produto['preco_total'] : ($produto['preco_unitario'] * $produto['quantidade_atual']);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Editar Produto</title>
    <link rel="stylesheet" href="../CSS/style.css">
</head>
<body>
    <?php include 'partials/header.php'; ?>

    <div class="produto_especificacoes">
        <div class="container_produto_especificacoes_imagem">
            <img src="<?php echo $imagemSrc; ?>" alt="<?php echo $produto['nome']; ?>">
        </div>

        <div class="container_produto_especificacoes_dados">
            <form action="especificacoes_produtos.php?id=<?php echo $produto['id']; ?>" method="POST">
                <h2>Editar produto</h2>

                <?php if (!empty($saved)): ?>
                    <p>Dados atualizados na sessão.</p>
                <?php endif; ?>

                <label><p class="container_produto_especificacoes_text">Nome:</p><br>
                    <input type="text" name="nome" value="<?php echo $produto['nome']; ?>" required>
                </label><br>

                <label><p class="container_produto_especificacoes_text">Marca:</p><br>
                    <input type="text" name="marca" value="<?php echo $produto['marca']; ?>" required>
                </label><br>

                <label><p class="container_produto_especificacoes_text">Categoria:</p><br>
                    <select name="categoria" required>
                        <option value="bruto" <?php if ($produto['categoria'] == 'bruto') echo 'selected'; ?>>Bruto</option>
                        <option value="ferramentas" <?php if ($produto['categoria'] == 'ferramentas') echo 'selected'; ?>>Ferramentas</option>
                        <option value="acabamento" <?php if ($produto['categoria'] == 'acabamento') echo 'selected'; ?>>Acabamento</option>
                    </select>
                </label><br>

                <label><p class="container_produto_especificacoes_text">Quantidade Mínima:</p><br>
                    <input type="number" name="quantidade_minima" value="<?php echo $produto['quantidade_minima']; ?>" min="0" required>
                </label><br>

                <label><p class="container_produto_especificacoes_text">Quantidade Atual:</p><br>
                    <input type="number" name="quantidade_atual" value="<?php echo $produto['quantidade_atual']; ?>" min="0" required>
                </label><br>

                <label><p class="container_produto_especificacoes_text">Preço Unitário:</p><br>
                    <input type="number" name="preco_unitario" value="<?php echo $produto['preco_unitario']; ?>" step="0.01" min="0" required>
                </label><br>

                <p class="container_produto_especificacoes_text">Preço Total: <span>R$ <?php echo number_format($precoTotal, 2, ',', '.'); ?></span></p><br>

                <button type="submit">Salvar</button>
                <button type="submit" name="delete" value="1" style="margin-left: 12px;">Deletar</button><br><br>
                <a href="produtos.php">Voltar</a>
            </form>
        </div>
    </div>
</body>
</html>