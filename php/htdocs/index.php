<?php

require_once 'index.html';


$db = pg_connect(
    "host=db dbname=ddss-database-assignment-2 user=ddss-database-assignment-2 password=ddss-database-assignment-2"
);


if (!$db) {
    error_log("Database connection failed");
    exit;
}


$usersQuery    = pg_query($db, 'SELECT * FROM users');
$messagesQuery = pg_query($db, 'SELECT * FROM messages');
$booksQuery    = pg_query($db, 'SELECT * FROM books');


$users    = pg_fetch_all($usersQuery);
$messages = pg_fetch_all($messagesQuery);
$books    = pg_fetch_all($booksQuery);



?>
