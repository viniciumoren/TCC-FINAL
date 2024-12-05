<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela de Login</title>
    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
            background: linear-gradient(to right , rgba(20, 147,220),  rgb(17,54,71));
            width: 100%;
            height: 100vh;
            background-repeat: no-repeat;
            background-image: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url(https://i0.wp.com/catagua.com.br/wp-content/uploads/2021/03/confira-as-vantagens-de-escolher-uma-casa-em-condominio-fechado.jpg?resize=1024%2C576&ssl=1);
            background-attachment: fixed;
            background-size: 100% 100%;
        }
        div{
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%,-50%);
            padding: 80px;
            border-radius: 15px;
            color: white;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            background: rgba(0, 0, 0, 0.6);
        }
        input {
            padding: 15px;
            border: none;
            outline: none;
            font-size: 15px;
            background-color: #2F3C50;
            color: white;
        }
        input::placeholder{
            color: white;
        }
        .inputSubmit {
            background-color: #7B61FF;
            border: none;
            padding: 15px;
            width: 100%;
            border-radius: 10px;
            color: white;
        }
        .inputSubmit:hover{
            background-color: deepskyblue;
        }
        .btn-voltar {
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
        }

        .btn-voltar:hover {
            background-color: white;
            color: dodgerblue;
            transform: scale(1.05);
        }

        .btn-voltar:active {
            background-color: #1E90FF;
            transform: scale(1);
        }

        .error-message {
            background-color: rgba(255, 0, 0, 0.8);
            color: white;
            padding: 10px;
            border-radius: 5px;
            margin-top: 10px;
            width: 90%;
            height: 20px;
            text-align: center;
            position: relative; 
            left: 50%;
            transform: translateX(-50%);
        }
    </style>
</head>
<body>
    <a href="home.php" class="btn-voltar">Voltar</a>
    <div>
        <h1>Login</h1>

        <form action="testeLogin.php" method="POST">
            <input type="email" name="email" placeholder="Usuário" required>
            <br><br>
            <input type="password" name="senha" placeholder="Senha" required>
            <br><br>
            <input class="inputSubmit" type="submit" name="submit" value="Login">
        </form>
    <?php
    // Exibe a mensagem de erro, se houver
    if (isset($_SESSION['error_message'])) {
        echo "<div class='error-message'>" . $_SESSION['error_message'] . "</div>";
        unset($_SESSION['error_message']); // Remove a mensagem após exibição
    }
    ?>
    </div>

</body>
</html>
