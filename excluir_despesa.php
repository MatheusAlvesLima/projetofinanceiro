<?php
include("database.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "DELETE FROM registro_despesas WHERE id = $id";
    $conn->query($query);

    header("Location: index.php");
} else {
    echo "ID da despesa não especificado.";
}
?>
<!DOCTYPE html>
<html>

<head>
    <title>Excluir Despesa</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
</head>

<body>
    <style>
        body {
            height: 100px;
            background-color: red;
            /* For browsers that do not support gradients */
            background-image: linear-gradient(-90deg, yellow, white);
        }
    </style>
    <div class="container">
        <h1 class="mt-5">Excluir Despesa</h1>

        <p class="mt-3">Tem certeza de que deseja excluir esta despesa?</p>

        <form method="POST">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Excluir</button>
        </form>

        <a href="index.php" class="btn btn-secondary mt-2"><i class="fas fa-arrow-left"></i> Voltar para o Registro de Despesas</a>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>