<?php
// Incluir o arquivo de conexão
include_once('config.php');

// Consultar a tabela de moradores
$query = "SELECT id, nome, telefone FROM moradores";
$result = mysqli_query($conexao, $query);

// Verificar se a consulta teve sucesso
if ($result && mysqli_num_rows($result) > 0) {
    $moradores = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $moradores[] = $row;
    }

    // Retorna os dados em JSON
    echo json_encode($moradores);
} else {
    echo json_encode(['erro' => 'Nenhum morador encontrado ou erro na consulta.']);
}
?>
