<?php
require_once('connect.php');

$producerID = $_POST['id'];

$producerBeatNewest_query = "SELECT * FROM beaty INNER JOIN producers ON beaty.beat_autor=producers.producer_id INNER JOIN categories ON beaty.beat_cat=categories.cat_id WHERE beat_autor = '$producerID' ORDER BY beat_count DESC LIMIT 4";
$producerBeatNewest_result = mysqli_query($conn, $producerBeatNewest_query);
$producerBeatNewest = $producerBeatNewest_result->fetch_All(MYSQLI_ASSOC);
echo json_encode($producerBeatNewest);
?>