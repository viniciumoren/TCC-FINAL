<?php
session_start();
include_once('config.php');

// Verificar se a sessão está ativa
if (!isset($_SESSION["email"]) || !isset($_SESSION["senha"])) {
    unset($_SESSION['email']);
    unset($_SESSION['senha']);
    header('location: tela-de-login.php');
    exit();
}

$logado = $_SESSION['nome'];

if (!empty($_GET['search'])) {
    $data = $_GET['search'];
    $sql = "SELECT * FROM listaencomenda WHERE id LIKE '%$data%' or nome LIKE '%$data%' or apartamento LIKE '%$data%' ORDER BY id DESC";

} else {
    $sql = "SELECT * FROM listaencomenda ORDER BY id DESC";
}

$result = $conexao->query($sql);

// Verificar se a consulta foi bem-sucedida
if (!$result) {
    die("Erro na consulta: " . $conexao->error);
}

// Fechar a conexão com o banco de dados
mysqli_close($conexao);
?>


<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISTEMA | GN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to right, rgba(20, 147, 220), rgb(17, 54, 71));
            color: white;
            text-align: center;
            min-width: 700px;
            min-height: 400px;
            height: 100vh;
            background-repeat: no-repeat;
            background-image: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url(https://i0.wp.com/catagua.com.br/wp-content/uploads/2021/03/confira-as-vantagens-de-escolher-uma-casa-em-condominio-fechado.jpg?resize=1024%2C576&ssl=1);
            background-attachment: fixed;
            background-size: 100% 100%;


        }

        .table-bg {
            background: rgba(0, 0, 0, 0.3);
            border-radius: 15px 15px 0 0;
        }

        .box-search {
            display: flex;
            justify-content: center;
            gap: .1%;
        }

        .menu-container {
            margin: 20px 0;
        }

        .menu {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
        }

        .menu a {
            color: #ffffff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            background-color: rgba(0, 0, 0, 0.3);
            transition: background-color 0.3s, color 0.3s;
        }

        .menu a:hover {
            background-color: rgba(0, 0, 0, 0.6);
            color: #ffffff;
        }

        .menu-container-registra {
            margin: 40px 0px 0px 60px;
            display: flex;
            justify-content: flex-start;
        }

        video {

            position: fixed;
            margin-left: 1100px;
            margin-top: 250px;
            bottom: 20px;
            right: 20px;
            width: 150px;
            height: 255px;
            border: 5px solid dodgerblue;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
            background-color: #000;
        }

        nav {
            background-color: #2F3C50;
        }



        /* Estilo para riscar o texto */
        .strikethrough {
            text-decoration: line-through;
            color: rgba(255, 255, 255, 0.5);
            /* Um pouco mais claro para indicar que está riscado */
        }
        a{
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg shadow-sm" style="background: transparent;">
        <div class="container-fluid">
            <a class="navbar-brand fw-bold" href="#" style="font-size: 1.5rem; color: white;">
                SYS PRO
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <!-- Adicione itens de navegação aqui, se necessário -->
                </ul>
                <div class="d-flex">
                    <a href="sair.php" class="btn btn-danger me-3"
                        style="padding: 10px 20px; font-weight: bold; border-radius: 30px;">
                        Sair
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <br><br>
    <?php
    echo "<h1>Bem-vindo <u>" . htmlspecialchars($logado) . "</u></h1>";
    ?>
    <div class="menu-container">
        <div class="menu">
            <a href="listaEntrada.php">Entrada</a>
            <a href="listaEncomenda.php">Encomendas</a>
            <a href="autorizados.php">Autorizados</a>
        </div>
    </div>


    <div class="box-search">
        <input type="search" class="form-control w-25" placeholder="Pesquisar" id="pesquisar">
        <button onclick="searchData()" class='btn btn-primary'>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search"
                viewBox="0 0 16 16">
                <path
                    d="M10.442 10.442a1 1 0 0 1 1.415 0l3.85 3.85a1 1 0 0 1-1.415 1.415l-3.85-3.85a1 1 0 0 1 0-1.415z" />
                <path d="M6.5 12a5.5 5.5 0 1 1 0-11 5.5 5.5 0 0 1 0 11zm0-1a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9z" />
            </svg>


        </button>
    </div>
    <div class="menu-container-registra" ">
            <div class=" menu">
        <a href="registraEncomenda.php">Registrar</a>
        <a href="chatbot.php"><i class="fa fa-whatsapp" style="font-size:36px"></i>
</a>
    </div>
    </div>
    <div></div>
    <div class="m-5">
        <table class="table text-white table-bg">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Status</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Apartamento</th>
                    <th scope="col">data</th>
                    <th scope="col">Quem Recebeu</th>
                    <th scope="col">Quem Entregou</th>
                    <th scope="col">Horário de Entrega</th>




                </tr>
            </thead>
            <tbody>
                <?php
                while ($user_data = mysqli_fetch_assoc($result)) {
                    // Verifica se o status é "entregue"
                    $class = (htmlspecialchars($user_data['status']) === 'entregue') ? 'strikethrough' : '';

                    // Formatar a data para "Hora:Minuto Dia/Mês/Ano"
                    $dataFormatada = date('H:i d/m/Y', strtotime($user_data['data']));

                    // Verifica se horario_entrega possui um valor antes de formatar
                    if (!empty($user_data['horario_entrega'])) {
                        $dataFormatada2 = date('H:i d/m/Y', strtotime($user_data['horario_entrega']));
                    } else {
                        $dataFormatada2 = 'N/A'; // Ou qualquer outro valor que deseje exibir
                    }

                    echo "<tr class='$class' data-id='" . htmlspecialchars($user_data['id']) . "'>";
                    echo "<td>" . htmlspecialchars($user_data['id']) . "</td>";
                    echo "<td>" . htmlspecialchars($user_data['status']) . "</td>";
                    echo "<td>" . htmlspecialchars($user_data['nome']) . "</td>";
                    echo "<td>" . htmlspecialchars($user_data['apartamento']) . "</td>";
                    echo "<td>" . $dataFormatada . "</td>"; // Exibe a data formatada
                    echo "<td>" . htmlspecialchars($user_data['email_registrante']) . "</td>";
                    echo "<td>" . htmlspecialchars($user_data['email_entregador']) . "</td>";
                    echo "<td>" . $dataFormatada2 . "</td>"; // Exibe a data de saída formatada ou 'N/A'
                    echo '</tr>';
                }
                ?>
            </tbody>



        </table>
    </div>
</body>

<div id="video-container" style="position:fixed; bottom:10px; right:10px; width:300px; display:none;">
    <video id="video-libras" width="300" controls>
        <source id="video-source" src="" type="video/mp4">
    </video>
</div>



<script>
    var search = document.getElementById('pesquisar');
    search.addEventListener("keydown", function (event) {
        if (event.key === "Enter") {
            searchData();
        }
    });

    function searchData() {
        window.location = 'listaEncomenda.php?search=' + search.value;
    }


    const videoContainer = document.getElementById('video-container');
    const videoSource = document.getElementById('video-source');

    function showVideo(src) {
        videoSource.src = src;
        videoContainer.style.display = 'block';
        document.getElementById('video-libras').load(); // Recarrega o vídeo
        document.getElementById('video-libras').play(); // Garante que o vídeo comece a tocar
    }

    function hideVideo() {
        videoContainer.style.display = 'none';
        videoSource.src = ''; // Limpa o src
    }

    // Associando os eventos de mouseover e mouseout para os botões e colunas
    document.querySelector("a[href='chatbot.php']").addEventListener('mouseover', () => showVideo('video/registrar.mp4'));
    document.querySelector("a[href='registraEncomenda.php']").addEventListener('mouseover', () => showVideo('video/registrar.mp4'));
    document.querySelector("a[href='listaEncomenda.php']").addEventListener('mouseover', () => showVideo('video/encomendas.mp4'));
    document.querySelector("a[href='listaEntrada.php']").addEventListener('mouseover', () => showVideo('video/entrada.mp4'));
    document.querySelector("a[href='autorizados.php']").addEventListener('mouseover', () => showVideo('video/autorizados.mp4'));
    document.querySelector("a[href='sair.php']").addEventListener('mouseover', () => showVideo('video/sair.mp4'));
    document.querySelector("h1").addEventListener('mouseover', () => showVideo('video/bem-vindo.mp4'));

    // Para os nomes das colunas da tabela
    document.querySelector("th:nth-child(2)").addEventListener('mouseover', () => showVideo('video/status.mp4')); // Status
    document.querySelector("th:nth-child(3)").addEventListener('mouseover', () => showVideo('video/nome.mp4'));   // Nome
    document.querySelector("th:nth-child(4)").addEventListener('mouseover', () => showVideo('video/apartamento.mp4')); // Apartamento
    document.querySelector("th:nth-child(5)").addEventListener('mouseover', () => showVideo('video/data.mp4')); // Data
    document.querySelector("th:nth-child(6)").addEventListener('mouseover', () => showVideo('video/quem_recebeu.mp4')); // Data
    document.querySelector("th:nth-child(7)").addEventListener('mouseover', () => showVideo('video/quem_entregou.mp4')); // Data
    document.querySelector("th:nth-child(8)").addEventListener('mouseover', () => showVideo('video/horario_entrega.mp4')); // Data

    // Para a barra de pesquisa
    document.getElementById('pesquisar').addEventListener('mouseover', () => showVideo('video/pesquisar.mp4'));

    // Esconder o vídeo quando o mouse sai de cima dos elementos
    const allElements = document.querySelectorAll('a, th, #pesquisar, h1');
    allElements.forEach(element => {
        element.addEventListener('mouseout', hideVideo);
    });


</script>

<script>
    // Adiciona um evento de duplo clique em cada linha da tabela
    document.querySelectorAll('tbody tr').forEach(row => {
        row.addEventListener('dblclick', function () {
            const id = this.getAttribute('data-id'); // Pega o ID do registro
            updateStatus(id);
        });
    });

    function updateStatus(id) {
        if (confirm("Você tem certeza que deseja marcar como entregue?")) {
            // Fazendo a requisição AJAX para atualizar o status
            fetch('update_status.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ id: id, status: 'entregue' })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert("Status atualizado para entregue!");
                        location.reload(); // Atualiza a página para refletir a mudança
                    } else {
                        alert("Erro ao atualizar o status.");
                    }
                })
                .catch((error) => {
                    console.error('Erro:', error);
                });
        }
    }
</script>


</html>