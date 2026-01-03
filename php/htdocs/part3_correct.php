<?php
session_start();

if (!isset($_SESSION['authenticated'])) {
    die("Not authenticated");
}

$db_host = getenv('DB_HOST') ?: 'localhost';
$db_name = getenv('DB_NAME') ?: 'ddss';
$db_user = getenv('DB_USER') ?: 'ddss';
$db_pass = getenv('DB_PASS') ?: 'ddss';

$conn = pg_connect("host=$db_host dbname=$db_name user=$db_user password=$db_pass");

$title  = $_GET['c_name'] ?? '';
$author = $_GET['c_author'] ?? '';

$sql = "
    SELECT * FROM books
    WHERE title ILIKE $1
    AND authors ILIKE $2
";

$params = [
    '%' . $title . '%',
    '%' . $author . '%'
];

$result = pg_query_params($conn, $sql, $params);

$_SESSION['results'] = pg_fetch_all($result);
$_SESSION['mode'] = 'Correct';

header("Location: /part3_results.php");
