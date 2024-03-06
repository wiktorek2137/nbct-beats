<?php
require_once('connect.php');

$producers_query = "SELECT * FROM beaty INNER JOIN producers ON beaty.beat_autor=producers.producer_id LIMIT 4";
$producers_result = mysqli_query($conn, $producers_query);
$wynik = $producers_result->fetch_All(MYSQLI_ASSOC);
echo json_encode($wynik);
?>