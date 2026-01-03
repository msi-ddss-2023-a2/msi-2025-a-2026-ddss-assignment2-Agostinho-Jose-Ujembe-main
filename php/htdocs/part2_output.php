<?php
session_start();

/* Acesso apenas após autenticação */
if (!isset($_SESSION['authenticated']) || $_SESSION['authenticated'] !== true) {
    die("Not authenticated");
}

/* Ligação à Base de Dados */
$db_host = getenv('DB_HOST') ?: 'localhost';
$db_name = getenv('DB_NAME') ?: 'ddss';
$db_user = getenv('DB_USER') ?: 'ddss';
$db_pass = getenv('DB_PASS') ?: 'ddss';

$conn = pg_connect("host=$db_host dbname=$db_name user=$db_user password=$db_pass");

if (!$conn) {
    die("Database connection error");
}

/* Ler últimas mensagens */
$result = pg_query(
    $conn,
    "SELECT author, message FROM messages ORDER BY message_id DESC LIMIT 10"
);

/* Renderização simples (iframe) */
echo "<em>You should print the text here. Some examples below.</em><br><br>";

while ($row = pg_fetch_assoc($result)) {

    /* IMPORTANTE:
       - Vulnerable: imprime raw (XSS executa)
       - Correct: escapa HTML
    */
    if ($row['author'] === 'Correct') {
        $content = htmlspecialchars($row['message'], ENT_QUOTES, 'UTF-8');
    } else {
        $content = $row['message']; // vulnerável por design
    }

    echo "{$row['author']}: {$content}<br>";
}
