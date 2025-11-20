<?php
include("db.php");

$term = "%".$_GET['term']."%";

$stmt = $mysqli->prepare("SELECT game_name FROM videogames 
                          WHERE game_name LIKE ? LIMIT 10");
$stmt->bind_param("s", $term);
$stmt->execute();
$res = $stmt->get_result();

$data = [];
while ($row = $res->fetch_assoc()) {
    $data[] = $row['game_name'];
}

echo json_encode($data);
