<?php
session_start(); // Start sesji na początku pliku
require_once('connect.php');

if ($_SESSION['type'] !== 'admin') {
    // Przekieruj do strony logowania lub strony błędu
    header('Location: login_page.php');
    exit;
}
$prodId = isset($_SESSION['prod_id']) ? $_SESSION['prod_id'] : '0';


$adminNewestBeat_query = "SELECT * FROM beaty INNER JOIN producers ON beaty.beat_autor=producers.producer_id WHERE beat_autor = $prodId ORDER BY beat_date DESC LIMIT 1";
$adminNewestBeat_result = mysqli_query($conn, $adminNewestBeat_query);
$wynik = $adminNewestBeat_result->fetch_All(MYSQLI_ASSOC);
echo json_encode($wynik);
?>