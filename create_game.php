<?php
require_once __DIR__ . '/../vendor/autoload.php';
include("db.php");

$loader = new \Twig\Loader\FilesystemLoader(__DIR__);
$twig = new \Twig\Environment($loader);

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = htmlspecialchars(trim($_POST['game_name']));
    $description = htmlspecialchars(trim($_POST['game_description']));
    $date = htmlspecialchars(trim($_POST['released_date']));
    $rating = htmlspecialchars(trim($_POST['rating']));

    $stmt = $mysqli->prepare("INSERT INTO videogames 
        (game_name, game_description, released_date, rating)
        VALUES (?, ?, ?, ?)");

    $stmt->bind_param("sssd", $name, $description, $date, $rating);
    $stmt->execute();

    header("Location: games.php");
    exit();
}

echo $twig->render("create_game.html");
