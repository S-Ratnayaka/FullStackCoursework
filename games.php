<?php
require_once __DIR__ . '/../vendor/autoload.php';
include("db.php");

$loader = new \Twig\Loader\FilesystemLoader(__DIR__);
$twig = new \Twig\Environment($loader);

// Multi-criteria search
$where = [];
$params = [];
$types = "";

if (!empty($_GET['name'])) {
    $where[] = "game_name LIKE ?";
    $params[] = "%".$_GET['name']."%";
    $types .= "s";
}

if (!empty($_GET['year'])) {
    $where[] = "YEAR(released_date) = ?";
    $params[] = $_GET['year'];
    $types .= "i";
}

if (!empty($_GET['rating'])) {
    $where[] = "rating >= ?";
    $params[] = $_GET['rating'];
    $types .= "i";
}

$sql = "SELECT * FROM videogames";
if ($where) {
    $sql .= " WHERE " . implode(" AND ", $where);
}
$sql .= " ORDER BY released_date DESC";

$stmt = $mysqli->prepare($sql);
if ($where) {
    $stmt->bind_param($types, ...$params);
}
$stmt->execute();

$results = $stmt->get_result();
$num_rows = $results->num_rows;

echo $twig->render("games.html", [
    'num_rows' => $num_rows,
    'results' => $results
]);
