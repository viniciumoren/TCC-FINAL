<?php

if (isset($_POST['submit'])) {
    // print_r('Nome:' .$_POST['nome']);
    // print_r('<br>');
    // print_r('Email:' .$_POST['email']);
    // print_r('<br>');
    // print_r('Telefone:' .$_POST['telefone']);
    // print_r('<br>');
    // print_r('Sexo:' .$_POST['genero']);
    // print_r('<br>');
    // print_r('Data de nascimento:' .$_POST['data_nascimento']);
    // print_r('<br>');
    // print_r('Cidade:' .$_POST['cidade']);
    // print_r('<br>');
    // print_r('Estado:' .$_POST['estado']);
    // print_r('<br>');
    // print_r('Endereço:' .$_POST['endereco']);

    include_once('config.php');

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $telefone = $_POST['telefone'];
    $sexo = $_POST['genero'];
    $data_nasc = $_POST['data_nascimento'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $endereco = $_POST['endereco'];

    $result = mysqli_query($conexao, "INSERT INTO usuarios2(nome,email,senha,telefone,sexo,data_nasc,cidade,estado,endereco) 
        VALUES ('$nome','$email',$senha,'$telefone','$sexo','$data_nasc','$cidade','$estado', '$endereco')");

    header('location: tela-de-login.php');
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario | GN</title>
</head>

<style>
    body {
        font-family: Arial, Helvetica, sans-serif;
        /* background-image: linear-gradient(to right, rgb(20,147,220), rgb(17,54,71)); */
        background-image: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url(https://i0.wp.com/catagua.com.br/wp-content/uploads/2021/03/confira-as-vantagens-de-escolher-uma-casa-em-condominio-fechado.jpg?resize=1024%2C576&ssl=1);
        height: 100vh;
        background-repeat: no-repeat;
        background-image: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url(https://i0.wp.com/catagua.com.br/wp-content/uploads/2021/03/confira-as-vantagens-de-escolher-uma-casa-em-condominio-fechado.jpg?resize=1024%2C576&ssl=1);
        background-attachment: fixed;
        background-size: 100% 100%;
    }

    .box {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        background-color: rgba(0, 0, 0, 0.8);
        padding: 15px;
        border-radius: 15px;
        width: 300px;
        color: white;
    }

    fieldset {
        border: 3px solid dodgerblue;
    }

    legend {
        border: 1px solid dodgerblue;
        padding: 10px;
        text-align: center;
        background-color: dodgerblue;
        border-radius: 8px;
        color: white;
    }

    .inputBox {
        position: relative;
    }

    .inputUser {
        background: none;
        border: none;
        border-bottom: 1px solid white;
        outline: none;
        color: white;
        font-size: 15px;
        width: 100%;
        letter-spacing: 2px;
    }

    .labelInput {
        position: absolute;
        top: 0px;
        left: 0px;
        pointer-events: none;
        transition: .5s;
    }

    .inputUser:focus~.labelInput,
    .inputUser:valid~.labelInput {
        top: -20px;
        font-size: 12px;
        color: dodgerblue;
    }

    #data_nascimento {
        border: none;
        padding: 8px;
        border-radius: 10px;
        color: black;
        outline: none;
        background-color: white;
        font-size: 15px;
        width: 50%;

    }

    .box_data_nascimento {
        display: flex;
        flex-direction: row;
        align-items: center;
        gap: 3px;
    }

    #submit {
        background-image: linear-gradient(to right, rgb(0, 92, 197), rgb(90, 20, 220));
        width: 100%;
        border: none;
        padding: 15px;
        color: white;
        font-size: 15px;
        cursor: pointer;
        border-radius: 10px;
    }

    #submit:hover {
        background-image: linear-gradient(to right, rgb(0, 80, 172), rgb(80, 19, 195));

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

<body>
    <a href="index.php" class="btn-voltar">Voltar</a>
    <div class="box">
        <form action="formulario.php" method='POST'>
            <fieldset>
                <legend><b>Formulario de Clientes</b></legend>
                <br>
                <div class="inputBox">
                    <input type="text" name="nome" id="nome" class="inputUser" required>
                    <label for="nome" class="labelInput">Nome Completo</label>
                </div>
                <br> <br>
                <div class="inputBox">
                    <input type="password" name="senha" id="senha" class="inputUser" required>
                    <label for="senha" class="labelInput">Senha</label>
                </div>
                <br> <br>


                <div class="inputBox">
                    <input type="text" name="email" id="email" class="inputUser" required>
                    <label for="email" class="labelInput">Email</label>
                </div>

                <br> <br>

                <div class="inputBox">
                    <input type="tel" name="telefone" id="telefone" class="inputUser" required>
                    <label for="telefone" class="labelInput">Telefone</label>
                </div>
                <p>Sexo</p>
                <input type="radio" id="feminino" name="genero" value="feminino" required>
                <label for="feminino">Feminino</label>
                <br>
                <input type="radio" id="masculino" name="genero" value="masculino" required>
                <label for="masculino">Masculino</label>
                <br>
                <input type="radio" id="outro" name="genero" value="outro" required>
                <label for="outro">Outro</label>
                <br> <br>

                <div class="box_data_nascimento">
                    <label for="data_nascimento"><b>Data de nascimento:</b></label>
                    <input type="date" name="data_nascimento" id="data_nascimento" class="inputUser" required>
                </div>

                <br> <br><br>

                <div class="inputBox">
                    <input type="text" name="cidade" id="cidade" class="inputUser" required>
                    <label class="labelInput" for="cidade">Cidade</label>
                </div>
                <br> <br>

                <div class="inputBox">
                    <input type="text" name="estado" id="estado" class="inputUser" required>
                    <label class="labelInput" for="estado">Estado</label>
                </div>
                <br> <br>

                <div class="inputBox">
                    <input type="text" name="endereco" id="endereco" class="inputUser" required>
                    <label class="labelInput" for="endereco">Endereço</label>
                </div>
                <br> <br>

                <input type="submit" name="submit" id="submit">
            </fieldset>
        </form>
    </div>
</body>

</html>