<?php

    if (!empty($_GET['id'])) {

        include_once('config.php');

        $id = $_GET['id'];
        $sqlSelect = "SELECT * FROM usuarios2 WHERE id=$id";
        $result = $conexao->query($sqlSelect);
        


        if ($result -> num_rows > 0) {
            while ($user_data = mysqli_fetch_assoc($result)) {
                $nome= $user_data['nome'];
                $email = $user_data['email'];
                $senha = $user_data['senha'];
                $telefone = $user_data['telefone'];
                $sexo = $user_data['sexo'];
                $data_nasc = $user_data['data_nasc'];
                $cidade = $user_data['cidade'];
                $estado = $user_data['estado'];
                $endereco = $user_data['endereco'];
            }
            
            // print_r($sexo);
        }
        else 
        {
            header('Location: sistema.php');
        }

   
    }else{
        header('Location: sistema.php');
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario | GN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
</head>

<style>
body {
    font-family: Arial, Helvetica, sans-serif;
    background-image: linear-gradient(to right, rgb(20,147,220), rgb(17,54,71));
}
.box {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background-color: rgba(0,0,0,0.8);
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
.labelInput{
    position: absolute;
    top: 0px;
    left: 0px;
    pointer-events: none;
    transition: .5s;
}
.inputUser:focus ~ .labelInput,
.inputUser:valid ~ .labelInput{
    top:-20px;
    font-size: 12px;
    color: dodgerblue;
}
#data_nascimento{
    border: none;
    padding: 8px;
    border-radius: 10px;
    color: black;
    outline:none;
    background-color: white;
    font-size: 15px;
    width: 50%;

}
.box_data_nascimento{
    display: flex;
    flex-direction: row;
    align-items: center;
    gap: 3px;
}
#update{
    background-image: linear-gradient(to right, rgb(0,92,197), rgb(90,20,220));
    width: 100%;
    border: none;
    padding: 15px;
    color: white;
    font-size: 15px;
    cursor: pointer;
    border-radius: 10px;
}
#update:hover {
    background-image: linear-gradient(to right, rgb(0,80,172), rgb(80,19,195));

}
</style>

<body>
<a href="sistema.php">Voltar</a>
    <div class="box">
        <form action="saveEdit.php" method='POST'>
            <fieldset>
                <legend><b>Formulario de Clientes</b></legend>
                <br>
                <div class="inputBox">
                    <input type="text" name="nome" id="nome" class="inputUser"  value="<?php echo $nome?>" required>
                    <label for="nome" class="labelInput">Nome Completo</label>
                </div>
                <br> <br>
                <div class="inputBox">
                    <input type="text" name="senha" id="senha" class="inputUser" value="<?php echo $senha?>" required>
                    <label for="senha" class="labelInput">Senha</label>
                </div>
                <br> <br>


                <div class="inputBox">
                    <input type="text" name="email" id="email" class="inputUser" value="<?php echo $email?>" required>
                    <label for="email" class="labelInput">Email</label>
                </div>

                <br> <br>

                <div class="inputBox">
                    <input type="tel" name="telefone" id="telefone" class="inputUser" value="<?php echo $telefone?>" required>
                    <label for="telefone" class="labelInput">Telefone</label>
                </div>
                <p>Sexo</p>
                <p>Sexo</p>
                <input type="radio" id="feminino" name="genero" value="feminino" <?php echo ($sexo == 'feminino') ? 'checked' : ''; ?> required>
                <label for="feminino">Feminino</label>
                <br>
                <input type="radio" id="masculino" name="genero" value="masculino" <?php echo ($sexo == 'masculino') ? 'checked' : ''; ?> required>
                <label for="masculino">Masculino</label>
                <br>
                <input type="radio" id="outro" name="genero" value="outro" <?php echo ($sexo == 'outro') ? 'checked' : ''; ?> required>
                <label for="outro">Outro</label>

                <br> <br>

                <div class="box_data_nascimento">
                    <label for="data_nascimento"><b>Data de nascimento:</b></label>
                    <input type="date" name="data_nascimento" id="data_nascimento" class="inputUser"  value="<?php echo $data_nasc?>" required>
                </div>

                <br> <br><br>

                <div class="inputBox">
                    <input type="text" name="cidade" id="cidade" class="inputUser" value="<?php echo $telefone?>" required>
                    <label class="labelInput" for="cidade">Cidade</label>
                </div>
                <br> <br>

                <div class="inputBox">
                    <input type="text" name="estado" id="estado" class="inputUser" value="<?php echo $estado?>" required>
                    <label class="labelInput" for="estado">Estado</label>
                </div>
                <br> <br>

                <div class="inputBox">
                    <input type="text" name="endereco" id="endereco" class="inputUser" value="<?php echo $telefone?>" required>
                    <label class="labelInput" for="endereco">Endereço</label>
                </div>
                <br> <br>
                <input name='id' value="<?php echo $id ?>">
                <input type="submit" name="update" id="update">
            </fieldset>
        </form>
    </div>
</body>

</html>