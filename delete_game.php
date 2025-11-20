<?php
require_once __DIR__ . '/../vendor/autoload.php';
include("db.php");

$id = intval($_GET['id']);

$stmt = $mysqli->prepare("DELETE FROM videogames WHERE game_id=?");
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: games.php");
exit();
