<?php
// Conexão com o banco de dados
$servername = "localhost";
$username = "root"; // nome de usuário do banco
$password = ""; // senha do banco
$dbname = "fut_pag";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Erro de conexão: " . $conn->connect_error);
}

// Recebe os dados do formulário
$titulo = $_POST['titulo'];
$descricao = $_POST['descricao'];
$imagem = $_FILES['imagem'];

// Verifica se o upload foi feito corretamente
if ($imagem['error'] === UPLOAD_ERR_OK) {
    $imagemNome = uniqid() . "_" . basename($imagem['name']);
    $caminhoImagem = "img/" . $imagemNome; // Pasta alterada para "img"

    // Move a imagem para a pasta 'img'
    if (move_uploaded_file($imagem['tmp_name'], $caminhoImagem)) {
        // Insere os dados na tabela 'post'
        $sql = "INSERT INTO post (titulo, path_image, descricao) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sss", $titulo, $caminhoImagem, $descricao);

        if ($stmt->execute()) {
            echo "Post enviado com sucesso!";
        } else {
            echo "Erro ao inserir dados: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Erro ao mover o arquivo da imagem.";
    }
} else {
    echo "Erro no upload da imagem.";
}

$conn->close();
?>
