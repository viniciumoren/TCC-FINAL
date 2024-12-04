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
    $sql = "SELECT * FROM autorizados WHERE id LIKE '%$data%' or nome LIKE '%$data%' or destino LIKE '%$data%' ORDER BY id DESC";

} else {
    $sql = "SELECT * FROM autorizados ORDER BY id DESC";
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

    <style>
        html {
            height: 100vh;

        }

        footer {}

        body {
            font-family: 'Poppins', sans-serif;
            color: white;
            text-align: center;
            min-width: 700px;
            min-height: 100vh;
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

    <div class="m-5">
        <table class="table text-white table-bg">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Documento</th>
                    <th scope="col">Destino</th>
                    <th scope="col">Motivo</th>
                    <th scope="col">Veiculo</th>
                    <th scope="col">Placa</th>

                </tr>
            </thead>
            <tbody>
                <?php
                while ($user_data = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($user_data['id']) . "</td>";
                    echo "<td>" . htmlspecialchars($user_data['nome']) . "</td>";
                    echo "<td>" . htmlspecialchars($user_data['documento']) . "</td>"; // Considere ocultar
                    echo "<td>" . htmlspecialchars($user_data['destino']) . "</td>";
                    echo "<td>" . htmlspecialchars($user_data['motivo']) . "</td>";
                    echo "<td>" . htmlspecialchars($user_data['veiculo']) . "</td>";
                    echo "<td>" . htmlspecialchars($user_data['placa']) . "</td>";
                    // echo "<td>" . htmlspecialchars($user_data['id']) . "</td>";
                    // echo "<td>" . htmlspecialchars($user_data['nome']) . "</td>";
                    // echo "<td>" . htmlspecialchars($user_data['senha']) . "</td>"; // Considere ocultar
                    // echo "<td>" . htmlspecialchars($user_data['email']) . "</td>";
                    // echo "<td>" . htmlspecialchars($user_data['telefone']) . "</td>";
                    // echo "<td>" . htmlspecialchars($user_data['sexo']) . "</td>";
                    // echo "<td>" . htmlspecialchars($user_data['cidade']) . "</td>";
                    // echo "<td>" . htmlspecialchars($user_data['data_nasc']) . "</td>";
                    // echo "<td>" . htmlspecialchars($user_data['cidade']) . "</td>";
                    // echo "<td>" . htmlspecialchars($user_data['estado']) . "</td>";
                    // echo "<td>" . htmlspecialchars($user_data['endereco']) . "</td>";
                    // echo "<td> 
                    //     <a class='btn btn-sm btn-primary' href='edit.php?id=$user_data[id]'>
                    //         <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil' viewBox='0 0 16 16'>
                    //             <path d='M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z'/>
                    //         </svg>
                    //     </a>
                    //     <a class='btn btn-sm btn-danger' href='delete.php?id=$user_data[id]'>
                    //             <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-trash-fill' viewBox='0 0 16 16'>
                    //                 <path d='M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z'/>
                    //             </svg>
                    //     </a>
                    // </td>";
                    // echo '</tr>';
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
        window.location = 'autorizados.php?search=' + search.value;
    }
</script>
<script>
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

    // Associando eventos de mouseover e mouseout para os botões e colunas
    document.querySelector("a[href='listaEncomenda.php']").addEventListener('mouseover', () => showVideo('video/encomenda.mp4'));
    document.querySelector("a[href='listaEntrada.php']").addEventListener('mouseover', () => showVideo('video/entrada.mp4'));
    document.querySelector("a[href='autorizados.php']").addEventListener('mouseover', () => showVideo('video/autorizados.mp4'));
    document.querySelector("a[href='sair.php']").addEventListener('mouseover', () => showVideo('video/sair.mp4'));
    document.querySelector("h1").addEventListener('mouseover', () => showVideo('videos/bemvindo.mp4'));

    // Para as colunas da tabela
    document.querySelector("th:nth-child(2)").addEventListener('mouseover', () => showVideo('video/nome.mp4'));    // Nome
    document.querySelector("th:nth-child(3)").addEventListener('mouseover', () => showVideo('video/documento.mp4')); // Documento
    document.querySelector("th:nth-child(4)").addEventListener('mouseover', () => showVideo('video/destino.mp4'));  // Destino
    document.querySelector("th:nth-child(5)").addEventListener('mouseover', () => showVideo('video/motivo.mp4'));  // Motivo
    document.querySelector("th:nth-child(6)").addEventListener('mouseover', () => showVideo('video/veiculo.mp4')); // Veículo
    document.querySelector("th:nth-child(7)").addEventListener('mouseover', () => showVideo('video/placa.mp4')); // Veículo

    // Para a barra de pesquisa
    document.getElementById('pesquisar').addEventListener('mouseover', () => showVideo('video/pesquisar.mp4'));

    // Esconder o vídeo quando o mouse sai dos elementos
    const allElements = document.querySelectorAll('a, th, #pesquisar, h1');
    allElements.forEach(element => {
        element.addEventListener('mouseout', hideVideo);
    });
</script>


</html>