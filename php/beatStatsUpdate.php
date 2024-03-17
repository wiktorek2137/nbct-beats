<?php
require_once('connect.php');

// Sprawdzenie, czy żądanie jest typu POST i czy przesłano wymagany parametr
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['beatId'])) {
    $beatId = $_POST['beatId'];

    // Poprawka: Zmieniłeś nazwę zmiennej z $trackId na $beatId, ale nie zmieniłeś jej w warunku
    if (!empty($beatId)) {
        // WAŻNE: Użycie zmiennych w zapytaniu bezpośrednio jest niebezpieczne i naraża na SQL Injection.
        // Należy użyć przygotowanych zapytań z parametrami, aby zapewnić bezpieczeństwo.
        $query = "UPDATE beaty SET beat_views = beat_views + 1 WHERE beat_id = ?";
        $stmt = $conn->prepare($query);

        // Bindowanie parametru jako integer
        $stmt->bind_param("i", $beatId);
        $stmt->execute();

        if ($stmt->affected_rows > 0) {
            echo json_encode(['status' => 'success', 'message' => 'Licznik zaktualizowany.'.$beatId]);
        } else {
            // Może nie znaleźć rekordu z podanym ID lub beat_views jest już zwiększone
            echo json_encode(['status' => 'error', 'message' => 'Nie udało się zaktualizować licznika lub nie znaleziono utworu.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'ID utworu jest puste.']);
    }
} else {
    // Dodano obsługę przypadku, gdy nie jest to żądanie POST lub nie przesłano wymaganego parametru
    echo json_encode(['status' => 'error', 'message' => 'Nieprawidłowe żądanie lub brakujący parametr beatId.']);
}

// Zamknięcie połączenia
$conn->close();
?>
