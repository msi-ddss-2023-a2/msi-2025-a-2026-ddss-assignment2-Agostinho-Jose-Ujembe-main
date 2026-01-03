<?php


session_start();

/* Apenas POST é aceite */
if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    die("Invalid request method");
}

/* Validação CSRF */
if (
    !isset($_SESSION['csrf']) ||
    !isset($_POST['csrf_token']) ||
    !is_string($_SESSION['csrf']) ||
    !is_string($_POST['csrf_token']) ||
    !hash_equals($_SESSION['csrf'], $_POST['csrf_token'])
) {
    die("CSRF validation failed");
}

/* Leitura segura dos dados */
$username = $_POST['v_username'] ?? '';
$password = $_POST['v_password'] ?? '';
$remember = $_POST['v_remember'] ?? '';

/* Ligação à BD */
$db_host = getenv('DB_HOST') ?: 'localhost';
$db_name = getenv('DB_NAME') ?: 'ddss';
$db_user = getenv('DB_USER') ?: 'ddss';
$db_pass = getenv('DB_PASS') ?: 'ddss';

$conn = pg_connect(
    "host=$db_host dbname=$db_name user=$db_user password=$db_pass"
);

if (!$conn) {
    die("Database connection failed");
}

/* Query preparada (proteção contra SQL Injection) */
$query = "SELECT password FROM users WHERE username = $1";
$result = pg_query_params($conn, $query, [$username]);

/* Verificação da password com hash */
if ($result && pg_num_rows($result) === 1) {
    $row = pg_fetch_assoc($result);

    if (password_verify($password, $row['password'])) {
        echo "<h3>Login Successful (Secure)</h3>";
        exit;
    }
}

echo "<h3>Login Failed (Secure)</h3>";
?>


