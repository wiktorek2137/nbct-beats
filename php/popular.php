<?php
require_once('connect.php');

$producers_query = "SELECT * FROM beaty INNER JOIN producers ON beaty.beat_autor=producers.producer_id INNER JOIN categories ON beaty.beat_cat=categories.cat_id ORDER BY beat_count DESC LIMIT 2";
$producers_result = mysqli_query($conn, $producers_query);
$wynik = $producers_result->fetch_All(MYSQLI_ASSOC);
echo json_encode($wynik);
?>