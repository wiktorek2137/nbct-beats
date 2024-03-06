<?php
require_once('connect.php');

$producerID = $_POST['id'];

$producers_query = "SELECT * FROM producers WHERE producer_id = '$producerID'";
$producers_result = mysqli_query($conn, $producers_query);
$producer = $producers_result->fetch_All(MYSQLI_ASSOC);
echo json_encode($producer);
?>