<?php
session_start();

if (!isset($_SESSION['authenticated'])) {
    die("Not authenticated");
}

$text = $_POST['v_text'] ?? '';

$db_host = getenv('DB_HOST') ?: 'localhost';
$db_name = getenv('DB_NAME') ?: 'ddss';
$db_user = getenv('DB_USER') ?: 'ddss';
$db_pass = getenv('DB_PASS') ?: 'ddss';

$conn = pg_connect("host=$db_host dbname=$db_name user=$db_user password=$db_pass");

/* SQL Injection + XSS armazenado */
$query = "
    INSERT INTO messages (type, content)
    VALUES ('Vulnerable', '$text')
";

pg_query($conn, $query);

header("Location: /part2.html");
