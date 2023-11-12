<?php
include("database.php");

$query = "SELECT * FROM registro_despesas ORDER BY data DESC";
$result = $conn->query($query);

// Recupera os resultados da consulta em uma matriz
$despesas = array();
$totalDespesas = 0;

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $despesas[] = $row;
        $totalDespesas += $row['valor'];
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Registro de Despesas Pessoais</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="/projeto-despesas/style.css">
    <!-- Adicione a folha de estilo Bootstrap ao seu projeto -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Adicione a folha de estilo personalizada para tornar a barra de navegação fixa e o menu hambúrguer -->
</head>

<body class="container-lg">
    <style>
        body {
            height: 100px;
            /* For browsers that do not support gradients */
            background-image: linear-gradient(-90deg, yellow, white);
        }

        .calculator-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .calculator {
            background-color: #eee;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 20px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2);
        }

        .calculator #display {
            font-size: 24px;
            text-align: right;
            margin-bottom: 10px;
        }

        .calculator .buttons {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            grid-gap: 5px;
        }

        .calculator .buttons button {
            font-size: 16px;
        }

        .custom-bg-danger {
            background-color: red;
            /* Define o background em vermelho */
            color: white;
            /* Define a cor do texto como preto */
        }

        /* Quando a tela estiver com no máximo 880px de largura */
        @media (max-width: 880px) {

            /* Navegação */
            .navbar-toggler {
                display: block;
            }

            .navbar-brand {
                text-align: center;
                width: 100%;
            }

            .navbar-nav {
                width: 100%;
                text-align: center;
                margin-top: 10px;
            }

            .navbar-nav .nav-link {
                display: block;
            }

            /* Título */
            h1 {
                text-align: center;
                font-size: 1.8rem;
                margin-top: 20px;
            }

            /* Barra de Pesquisa */
            .input-group {
                margin-top: 10px;
                margin-bottom: 20px;
                text-align: center;
            }

            .col-md-4 {
                width: 100%;
            }

            #termoPesquisa {
                width: 100%;
                margin-right: 0;
            }

            .input-group-append {
                display: block;
                width: 100%;
                text-align: center;
            }

            .input-group-text {
                display: block;
                margin: 0 auto;
            }

            /* Tabela de Despesas */
            .table {
                margin: 0 auto;
                width: 100%;
            }

            .table th {
                text-align: center;
            }

            .table tbody {
                text-align: center;
            }

            /* Valor total das Despesas */
            .alert {
                text-align: center;
            }

            /* Calculadora Digital */
            .calculator-container {
                margin: 0 auto;
                text-align: center;
            }

            .calculator {
                width: 100%;
            }

            #display {
                width: 100%;
            }

            .buttons {
                display: flex;
                flex-wrap: wrap;
                justify-content: space-between;
            }

            .btn {
                margin-top: 10px;
                width: 45%;
            }

        }
    </style>


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

    <div class="text-center">
        <h1 class="mt-3">Registro de Despesas Pessoais</h1>
    </div>

    <!-- Barra de pesquisa -->
    <div class="input-group mt-3">
        <input type="text" id="termoPesquisa" class="form-control" placeholder="Pesquisar despesas...">
        <div class="input-group-append">
            <span class="input-group-text" style="cursor: pointer;" onclick="pesquisarDespesas()"><i class="fas fa-search"></i></span>
        </div>
    </div>

    <!-- Tabela de despesas (com rolagem horizontal em telas menores) -->
    <div class="table-responsive">
        <table class="table mt-4">
            <thead>
                <tr>
                    <th>
                        <i class="fas fa-info-circle"></i> Descrição
                    </th>
                    <th>
                        Valor (R$)
                    </th>
                    <th>
                        <i class="far fa-calendar-alt"></i> Data da Compra
                    </th>
                    <th>
                        <i class="fas fa-tags"></i> Categoria
                    </th>
                    <th>
                        <i class="fas fa-cogs"></i> Ações
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($despesas as $row) {
                    echo "<tr>";
                    echo "<td>" . $row['descricao'] . "</td>";
                    echo "<td>R$ " . number_format($row['valor'], 2, ',', '.') . "</td>";
                    echo "<td>" . $row['data'] . "</td>";
                    echo "<td>" . $row['categoria'] . "</td>";
                    echo "<td>";
                    echo "<a href='editar_despesa.php?id=" . $row['id'] . "' class='btn btn-primary'><i class='fas fa-edit'></i> Editar</a>";
                    echo "<a href='excluir_despesa.php?id=" . $row['id'] . "' class='btn btn-danger'><i class='fas fa-trash'></i> Excluir</a>";
                    echo "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Valor total das despesas -->
    <div class="container-xl custom-bg-danger text-center">
        <strong>Valor total das despesas: R$ <?php echo number_format($totalDespesas, 2, ',', '.'); ?></strong>
    </div>

    <!-- Calculadora Digital -->
    <div class="calculator-container-lg text-center">
        <div class="calculator">
            <input type="text" id="display" class="form-control" placeholder="0">
            <div class="buttons mt-3">
                <button class="btn btn-secondary" onclick="appendToDisplay('7')">7</button>
                <button class="btn btn-secondary" onclick="appendToDisplay('8')">8</button>
                <button class="btn btn-secondary" onclick="appendToDisplay('9')">9</button>
                <button class="btn btn-secondary" onclick="appendToDisplay('+')">+</button>
                <button class="btn btn-secondary" onclick="appendToDisplay('4')">4</button>
                <button class="btn btn-secondary" onclick="appendToDisplay('5')">5</button>
                <button class="btn btn-secondary" onclick="appendToDisplay('6')">6</button>
                <button class="btn btn-secondary" onclick="appendToDisplay('-')">-</button>
                <button class="btn btn-secondary" onclick="appendToDisplay('1')">1</button>
                <button class="btn btn-secondary" onclick="appendToDisplay('2')">2</button>
                <button class="btn btn-secondary" onclick="appendToDisplay('3')">3</button>
                <button class="btn btn-secondary" onclick="appendToDisplay('*')">*</button>
                <button class="btn btn-secondary" onclick="appendToDisplay('0')">0</button>
                <button class="btn btn-secondary" onclick="appendToDisplay('.')">.</button>
                <button class="btn btn-secondary" onclick="calculate()">=</button>
                <button class="btn btn-secondary" onclick="appendToDisplay('/')">/</button>
                <button class="btn btn-secondary" onclick="clearDisplay()">C</button>
            </div>
        </div>
    </div>
    </div>



    <!-- Função para pesquisar despesas na tabela -->
    <script>
        function pesquisarDespesas() {
            var termoPesquisa = document.getElementById("termoPesquisa").value;
            // Redireciona o usuário para a página de resultados da pesquisa com o termo de pesquisa passado como parâmetro
            window.location.href = "resultados_pesquisa.php?termo_pesquisa=" + termoPesquisa;
        }

        let display = document.getElementById("display");

        function appendToDisplay(value) {
            if (display.value === "Erro") {
                display.value = "";
            }
            display.value += value;
        }

        function clearDisplay() {
            display.value = "";
        }

        function calculate() {
            try {
                display.value = eval(display.value);
            } catch (error) {
                display.value = "Erro";
            }
        }
    </script>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>