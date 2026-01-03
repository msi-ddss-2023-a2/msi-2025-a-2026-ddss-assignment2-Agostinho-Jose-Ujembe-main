<?php
session_start();

if (!isset($_SESSION['authenticated'])) {
    die("Not authenticated");
}

$results = $_SESSION['results'] ?? [];
$mode = $_SESSION['mode'] ?? 'Unknown';

echo "<h2>Search Results ($mode)</h2>";

if (!$results) {
    echo "No books found.";
    exit;
}

echo "<ul>";
foreach ($results as $book) {
    echo "<li>";
    echo "<b>" . htmlspecialchars($book['title']) . "</b><br>";
    echo "Authors: " . htmlspecialchars($book['authors']) . "<br>";
    echo "Category: " . htmlspecialchars($book['category']) . "<br>";
    echo "Price: " . htmlspecialchars($book['price']) . "<br>";
    echo "</li><br>";
}
echo "</ul>";
