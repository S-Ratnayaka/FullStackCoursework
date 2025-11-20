<?php
require_once __DIR__ . '/../vendor/autoload.php';
include("db.php");

$loader = new \Twig\Loader\FilesystemLoader(__DIR__);
$twig = new \Twig\Environment($loader);

$id = intval($_GET['id']);

$result = $mysqli->query("SELECT * FROM videogames WHERE game_id=$id");
$game = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $name = htmlspecialchars(trim($_POST['game_name']));
    $description = htmlspecialchars(trim($_POST['game_description']));
    $date = htmlspecialchars(trim($_POST['released_date']));
    $rating = htmlspecialchars(trim($_POST['rating']));

    $stmt = $mysqli->prepare("UPDATE videogames
        SET game_name=?, game_description=?, released_date=?, rating=?
        WHERE game_id=?");

    $stmt->bind_param("sssdi", $name, $description, $date, $rating, $id);
    $stmt->execute();

    header("Location: games.php");
    exit();
}

echo $twig->render("edit_game.html", ["game" => $game]);
