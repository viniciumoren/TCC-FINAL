<?php
session_start();
include_once('config.php');

// Verificar se a sessão está ativa
if (!isset($_SESSION["email"]) || !isset($_SESSION["senha"])) {
    echo json_encode(['success' => false, 'message' => 'Não autorizado']);
    exit();
}
date_default_timezone_set('America/Bahia');
// Obter o email do usuário logado
$logado = $_SESSION["email"];

$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['id']) && isset($data['status'])) {
    $id = intval($data['id']);
    $status = $data['status'];
    $horarioEntrega = date('Y-m-d H:i:s'); // Obtém o horário atual

    // Atualizar o status, email do entregador e o horário de entrega
    $sql = "UPDATE listaencomenda SET status = ?, email_entregador = ?, horario_entrega = ? WHERE id = ?";
    $stmt = $conexao->prepare($sql);
    $stmt->bind_param('sssi', $status, $logado, $horarioEntrega, $id);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Erro ao atualizar']);
    }
    
    $stmt->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Dados inválidos']);
}

// Fechar a conexão com o banco de dados
mysqli_close($conexao);
?>
