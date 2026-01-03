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

$title  = $_GET['v_name'] ?? '';
$author = $_GET['v_author'] ?? '';

$query = "
    SELECT * FROM books
    WHERE title ILIKE '%$title%'
    AND authors ILIKE '%$author%'
";

$result = pg_query($conn, $query);

$_SESSION['results'] = pg_fetch_all($result);
$_SESSION['mode'] = 'Vulnerable';

header("Location: /part3_results.php");
