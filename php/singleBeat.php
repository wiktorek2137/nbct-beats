<?php
require_once('connect.php');

$beatID = $_POST['id'];

$singleBeat_query = "SELECT * FROM beaty INNER JOIN producers ON beaty.beat_autor=producers.producer_id INNER JOIN categories ON beaty.beat_cat=categories.cat_id WHERE beat_id = '$beatID'";
$singleBeat_result = mysqli_query($conn, $singleBeat_query);
$singleBeat = $singleBeat_result->fetch_All(MYSQLI_ASSOC);
echo json_encode($singleBeat);
?>