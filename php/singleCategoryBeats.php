<?php
require_once('connect.php');

$categoryID = $_POST['id'];

$categoryBeat_query = "SELECT * FROM beaty INNER JOIN categories ON beaty.beat_cat=categories.cat_id
INNER JOIN producers ON producers.producer_id=beaty.beat_autor WHERE cat_id = '$categoryID'";
$categoryBeat_result = mysqli_query($conn, $categoryBeat_query);
$categoryBeat = $categoryBeat_result->fetch_All(MYSQLI_ASSOC);
echo json_encode($categoryBeat);
?>