<?php
session_start();

if (isset($_POST["submit"]) && !empty($_POST['email']) && !empty($_POST['senha'])) {
    include_once('config.php');
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Consulta ao banco de dados
    $sql = "SELECT * FROM usuarios2 WHERE email = '$email' AND senha = '$senha'";
    $result = $conexao->query($sql);

    if (mysqli_num_rows($result) < 1) {
        // Se as credenciais estiverem incorretas, define a mensagem de erro
        $_SESSION['error_message'] = 'E-mail ou senha incorretos.';
        header('location: tela-de-login.php');
        exit;
    } else {
        // Se o login for bem-sucedido, armazena o email na sessão
        $user_data = $result->fetch_assoc();
        $_SESSION['email'] = $email;
        $_SESSION['senha'] = $senha;
        $_SESSION['nome'] = $user_data['nome'];
        header('location: listaEntrada.php');
        exit;
    }
} else {
    // Caso os campos estejam vazios
    $_SESSION['error_message'] = 'Por favor, preencha todos os campos.';
    header('location: tela-de-login.php');
    exit;
}
?>
