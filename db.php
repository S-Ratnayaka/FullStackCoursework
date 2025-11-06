<?php
$mysqli = new mysqli("localhost","2432452","zhnukv","db2432452");
if ($mysqli -> connect_errno) {
echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
exit();
}
?>