<?php
session_start();
include_once('config.php');

// Receber os dados JSON
$data = json_decode(file_get_contents('php://input'), true);
$id = $data['id'];
$email = $data['email'];
$horario = $data['horario'];

// Verificar se os dados foram recebidos
if (isset($id) && isset($email) && isset($horario)) {
    // Atualizar a saída no banco de dados
    $sql = "UPDATE listaentrada SET email_registro_saida = ?, horario_saida = ? WHERE id = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("ssi", $email, $horario, $id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'error' => $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(['success' => false, 'error' => 'Dados incompletos.']);
}

// Fechar a conexão com o banco de dados
$conexao->close();
?>
