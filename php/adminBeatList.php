<?php
session_start(); // Start sesji na początku pliku
require_once('connect.php');

if ($_SESSION['type'] !== 'admin') {
    // Przekieruj do strony logowania lub strony błędu
    header('Location: login_page.php');
    exit;
}
$prodId = isset($_SESSION['prod_id']) ? $_SESSION['prod_id'] : '0';


$adminBeatList_query = "SELECT * FROM beaty INNER JOIN producers ON beaty.beat_autor=producers.producer_id INNER JOIN categories ON beaty.beat_cat=categories.cat_id WHERE beat_autor = $prodId ORDER BY beat_date DESC";
$adminBeatList_result = mysqli_query($conn, $adminBeatList_query);
$wynik = $adminBeatList_result->fetch_All(MYSQLI_ASSOC);
echo json_encode($wynik);
?>