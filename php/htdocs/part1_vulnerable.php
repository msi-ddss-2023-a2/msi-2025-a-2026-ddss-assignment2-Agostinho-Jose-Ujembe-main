<?php

$db_host = getenv('DB_HOST') ?: 'localhost';
$db_name = getenv('DB_NAME') ?: 'ddss';
$db_user = getenv('DB_USER') ?: 'ddss';
$db_pass = getenv('DB_PASS') ?: 'ddss';

$conn = @pg_connect(
    "host=$db_host dbname=$db_name user=$db_user password=$db_pass"
);


if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST['v_username'] ?? '';
    $password = $_POST['v_password'] ?? '';
    $remember = $_POST['v_remember'] ?? '';
} else {
    $username = $_GET['v_username'] ?? '';
    $password = $_GET['v_password'] ?? '';
    $remember = $_GET['v_remember'] ?? '';
}


if ($conn) {
    $query = "
        SELECT * FROM users
        WHERE username = '$username'
        AND password = '$password'
    ";
    $result = pg_query($conn, $query);
}


if (isset($result) && $result && pg_num_rows($result) > 0) {
    echo "<h3>Login Successful (Vulnerable)</h3>";
} else {
    echo "<h3>Login Failed (Vulnerable)</h3>";
}


echo "<hr>";
echo "v_username -> $username <br>";
echo "v_password -> $password <br>";
echo "v_remember -> $remember <br>";
?>


