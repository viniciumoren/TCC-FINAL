<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WhatsApp Controle de Acesso</title>
    <style>
        /* Seu estilo permanece o mesmo */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            background-repeat: no-repeat;
            background-image: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url(https://i0.wp.com/catagua.com.br/wp-content/uploads/2021/03/confira-as-vantagens-de-escolher-uma-casa-em-condominio-fechado.jpg?resize=1024%2C576&ssl=1);
            background-attachment: fixed;
            background-size: 100% 100%;
        }

        .container {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 500px;
        }

        h1 {
            color: #075e54;
            text-align: center;
            margin-bottom: 2rem;
        }

        .wa-button {
            background: #25d366;
            color: white;
            border: none;
            padding: 1rem 2rem;
            border-radius: 25px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            margin: 1rem auto;
            transition: background 0.3s ease;
        }

        .wa-button:hover {
            background: #128c7e;
        }

        .input-group {
            margin-bottom: 1rem;
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            color: #333;
        }

        select {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
        }

        .status {
            text-align: center;
            margin-top: 1rem;
            color: #666;
        }

        #video-container {
            position: fixed;
            bottom: 20px;
            right: 20px;
            display: none;
            z-index: 9999;
        }

        #video-libras {
            width: 300px;
        }
        .btn-voltar {
            position: absolute;
            top: 1%;
            left: 1%;
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            font-family: Arial, sans-serif;
            color: white;
            background-color: dodgerblue;
            text-decoration: none;
            border-radius: 5px;
            border: 2px solid dodgerblue;
            transition: background-color 0.3s ease, color 0.3s ease, transform 0.3s ease;
            margin-bottom: 20px;
            /* Espaçamento inferior */
        }

        .btn-voltar:hover {
            background-color: white;
            color: dodgerblue;
            transform: scale(1.05);
            /* Efeito de zoom ao passar o mouse */
        }

        .btn-voltar:active {
            background-color: #1E90FF;
            /* Cor mais escura ao clicar */
            transform: scale(1);
            /* Retira o efeito de zoom */
        }
    </style>
</head>
<body>
<a href="listaEntrada.php" class="btn-voltar">Voltar</a>
<div class="container">
    <h1 id="titulo">Controle de Acesso</h1> <!-- ID adicionado -->

    <div class="input-group">
        <label id="label-morador" for="morador">Selecione o Morador:</label> <!-- ID adicionado -->
        <select id="morador" name="morador">
            <option value="" disabled selected>Selecione um morador</option>
            <?php foreach ($moradores as $morador): ?>
                <option value="<?= $morador['telefone'] ?>"><?= $morador['nome'] ?> (Apto: <?= $morador['id'] ?>)</option>
            <?php endforeach; ?>
        </select>
    </div>

    <button id="btn-entrada" class="wa-button" onclick="sendMessage()">Solicitar Entrada</button> <!-- ID adicionado -->

    <div class="status" id="status"></div>
</div>

<div id="video-container">
    <video id="video-libras" controls>
        <source id="video-source" src="" type="video/mp4">
    </video>
</div>

<script>
    const videoContainer = document.getElementById('video-container');
    const videoSource = document.getElementById('video-source');
    const videoElement = document.getElementById('video-libras');

    function showVideo(src) {
        videoSource.src = src;
        videoContainer.style.display = 'block';
        videoElement.load();
        videoElement.play();
    }

    function hideVideo() {
        videoContainer.style.display = 'none';
        videoSource.src = '';
    }

    // Adicionando eventos para mostrar e esconder vídeos
    document.getElementById('titulo').addEventListener('mouseover', () => {
        showVideo('video/controle-acesso.mp4'); // Vídeo para "Controle de Acesso"
    });
    document.getElementById('titulo').addEventListener('mouseout', hideVideo);

    document.getElementById('label-morador').addEventListener('mouseover', () => {
        showVideo('video/selecione-morador.mp4'); // Vídeo para "Selecione o Morador"
    });
    document.getElementById('label-morador').addEventListener('mouseout', hideVideo);

    document.getElementById('btn-entrada').addEventListener('mouseover', () => {
        showVideo('video/solicitar-entrada.mp4'); // Vídeo para "Solicitar Entrada"
    });
    document.getElementById('btn-entrada').addEventListener('mouseout', hideVideo);

    function sendMessage() {
        const moradorSelect = document.getElementById('morador');
        const telefone = moradorSelect.value;
        const nome = moradorSelect.options[moradorSelect.selectedIndex].text;
        const status = document.getElementById('status');

        if (!telefone) {
            status.textContent = 'Por favor, selecione um morador.';
            status.style.color = '#ff0000';
            return;
        }

        const message = encodeURIComponent(`Liberar entrada do visitante para ${nome}?

        *Selecione uma opção:*
        1️⃣ - Sim, liberar entrada
        2️⃣ - Não, negar acesso
        3️⃣ - Aguardar confirmação

        Por favor, responda com o número da opção desejada.`);

        const whatsappUrl = `whatsapp://send?phone=${telefone}&text=${message}`;

        window.location.href = whatsappUrl;

        setTimeout(() => {
            window.location.href = `https://api.whatsapp.com/send?phone=${telefone}&text=${message}`;
        }, 1000);

        status.textContent = 'Abrindo WhatsApp...';
        status.style.color = '#25d366';

        setTimeout(() => {
            status.textContent = '';
        }, 3000);
    }
</script>
</body>
</html>
