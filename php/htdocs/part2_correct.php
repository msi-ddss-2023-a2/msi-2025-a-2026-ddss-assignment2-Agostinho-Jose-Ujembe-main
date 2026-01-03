<?php
session_start();

if (!isset($_SESSION['authenticated'])) {
    die("Not authenticated");
}

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Invalid method");
}

/* CSRF */
if (
    !isset($_SESSION['csrf']) ||
    !isset($_POST['csrf_token']) ||
    !hash_equals($_SESSION['csrf'], $_POST['csrf_token'])
) {
    die("CSRF validation failed");
}

$text = $_POST['c_text'] ?? '';

$db_host = getenv('DB_HOST') ?: 'localhost';
$db_name = getenv('DB_NAME') ?: 'ddss';
$db_user = getenv('DB_USER') ?: 'ddss';
$db_pass = getenv('DB_PASS') ?: 'ddss';

$conn = pg_connect("host=$db_host dbname=$db_name user=$db_user password=$db_pass");

/* Query preparada */
$query = "INSERT INTO messages (type, content) VALUES ($1, $2)";
pg_query_params($conn, $query, ['Correct', htmlspecialchars($text, ENT_QUOTES, 'UTF-8')]);

header("Location: /part2.html");
