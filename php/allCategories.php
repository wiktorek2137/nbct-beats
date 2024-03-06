<?php
require_once('connect.php');

$producers_query = "SELECT * FROM categories";
$producers_result = mysqli_query($conn, $producers_query);
$wynik = $producers_result->fetch_All(MYSQLI_ASSOC);
echo json_encode($wynik);
?>