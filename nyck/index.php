<?php
// Conexão com o banco de dados
$servername = "localhost"; // Substitua pelo seu servidor
$username = "root"; // Substitua pelo seu usuário
$password = ""; // Substitua pela sua senha
$dbname = "fut_pag"; // Substitua pelo nome do seu banco de dados

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Consulta para buscar os posts
$sql = "SELECT titulo, descricao, path_image FROM post";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Futibivis</title>
    
    <link rel="stylesheet" href="styles.css"> 
<body>
        <h1>Galeria de futebol</h1>
    </div>

    <div class="galeria">
        <?php
        // Verificar se há resultados e exibi-los
        if ($result->num_rows > 0) {
            // Exibir os dados de cada linha
            while ($row = $result->fetch_assoc()) {
                echo '<div class="post">';
                echo '<img src="' . htmlspecialchars($row["path_image"]) . '" alt="' . htmlspecialchars($row["titulo"]) . '">';
                echo '<h3>' . htmlspecialchars($row["titulo"]) . '</h3>';
                echo '<p class="descricao">' . htmlspecialchars($row["descricao"]) . '</p>'; // Descrição oculta inicialmente
                echo '</div>';
            }
        } else {
            echo '<p>Nenhum post encontrado.</p>';
        }
        // Fechar a conexão
        $conn->close();
        ?>
    </div>

    <!-- Botão para o formulário -->
    <a href="envio.html" class="botao">Enviar Novo Post</a>
</body>
</html>
