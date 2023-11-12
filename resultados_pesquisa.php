<?php
include("database.php");

if (isset($_GET['termo_pesquisa'])) {
    $termoPesquisa = $_GET['termo_pesquisa'];

    // Consulta para pesquisar no banco de dados
    $query = "SELECT * FROM registro_despesas WHERE descricao LIKE '%$termoPesquisa%' OR categoria LIKE '%$termoPesquisa%' ORDER BY data DESC";
    $result = $conn->query($query);
} else {
    // Se nenhum termo de pesquisa foi especificado, defina $termoPesquisa como vazio
    $termoPesquisa = "";
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Resultados da Pesquisa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="/projeto-despesas/style.css">
    <!-- Adicione a folha de estilo Bootstrap ao seu projeto -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Adicione a folha de estilo personalizada para tornar a barra de navegação fixa e o menu hambúrguer -->
    <link rel="stylesheet" href="/projeto-despesas/style.css">
</head>

<body>
    <style>
        body {
            height: 100px;
            /* For browsers that do not support gradients */
            background-image: linear-gradient(-90deg, yellow, white);
        }
    </style>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <!-- Adicione um botão hambúrguer para telas menores -->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="index.php">Despesas Pessoais</a>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item active">
                        <a class="nav-link" href="adicionar_despesa.php"><i class="fas fa-plus"></i> Adicionar Despesa</a>
                    </li>
                </ul>
            </div>
        </nav>

        <h1 class="mt-3">Resultados da Pesquisa</h1>

        <p class="mt-3">Resultados para: <strong><?php echo $termoPesquisa; ?></strong></p>

        <table class="table mt-4">
            <thead>
                <tr>
                    <th>Descrição</th>
                    <th>Valor (R$)</th>
                    <th>Data</th>
                    <th>Categoria</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($result) && $result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row['descricao'] . "</td>";
                        echo "<td>" . $row['valor'] . "</td>";
                        echo "<td>" . $row['data'] . "</td>";
                        echo "<td>" . $row['categoria'] . "</td>";
                        echo "<td>";
                        echo "<a href='editar_despesa.php?id=" . $row['id'] . "' class='btn btn-primary'><i class='fas fa-edit'></i> Editar</a>";
                        echo "<a href='excluir_despesa.php?id=" . $row['id'] . "' class='btn btn-danger'><i class='fas fa-trash'></i> Excluir</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>Nenhum resultado encontrado para: <strong>$termoPesquisa</strong></td></tr>";
                }
                ?>
            </tbody>
        </table>

        <a href="index.php" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Voltar para o Registro de Despesas</a>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>