<?php
session_start(); // Start sesji na początku pliku
require_once('connect.php');

// Sprawdzenie, czy żądanie jest typu POST i czy przesłano wymagany parametr
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['beat_id'])) {
    $beatId = $_POST['beat_id'];

    // Przygotowanie zapytania SQL do usunięcia rekordu
    $stmt = $conn->prepare("DELETE FROM beaty WHERE beat_id = ?");
    $stmt->bind_param("i", $beatId); // "i" oznacza typ integer

    // Wykonanie zapytania
    if ($stmt->execute()) {
        echo "Rekord usunięty pomyślnie";
    } else {
        echo "Błąd podczas usuwania rekordu: " . $conn->error;
    }

    // Zamknięcie zapytania
    $stmt->close();
} else {
    echo "Nieprawidłowe żądanie";
}

// Zamknięcie połączenia
$conn->close();
?>