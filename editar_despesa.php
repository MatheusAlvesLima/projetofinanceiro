<?php
include("database.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id'])) {
    $id = $_POST["id"];
    $descricao = $_POST["descricao"];
    $valor = $_POST["valor"];
    $data = $_POST["data"];
    $categoria = $_POST["categoria"];

    $query = "UPDATE registro_despesas SET descricao = '$descricao', valor = $valor, data = '$data', categoria = '$categoria' WHERE id = $id";
    $conn->query($query);

    header("Location: index.php");
} elseif (isset($_GET['id'])) {
    $id = $_GET['id'];
    $query = "SELECT * FROM registro_despesas WHERE id = $id";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $descricao = $row['descricao'];
        $valor = $row['valor'];
        $data = $row['data'];
        $categoria = $row['categoria'];
    } else {
        echo "Despesa não encontrada.";
    }
} else {
    echo "ID da despesa não especificado.";
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Editar Despesa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
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

        <h1 class="mt-5">Editar Despesa</h1>

        <form method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="form-group">
                <label for="descricao">
                    <i class="fas fa-info-circle"></i> Descrição:
                </label>
                <input type="text" class="form-control" name="descricao" value="<?php echo $descricao; ?>" required>
            </div>
            <div class="form-group">
                <label for="valor">
                    Valor (R$):
                </label>
                <input type="number" step="0.01" class="form-control" name="valor" value="<?php echo $valor; ?>" required>
            </div>
            <div class="form-group">
                <label for="data">
                    <i class="far fa-calendar-alt"></i> Data da compra:
                </label>
                <input type="date" class="form-control" name="data" value="<?php echo $data; ?>" required>
            </div>
            <div class="form-group">
                <label for="categoria">
                    <i class="fas fa-tags"></i> Categoria:
                </label>
                <input type="text" class="form-control" name="categoria" value="<?php echo $categoria; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Salvar Alterações</button>
        </form>

        <a href="index.php" class="btn btn-secondary mt-2"><i class="fas fa-arrow-left"></i> Voltar para o Registro de Despesas</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>