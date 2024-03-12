<?php
session_start(); // Start sesji na początku pliku

// Sprawdzenie, czy formularz został wysłany
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'connect.php'; // Dołączenie pliku z połączeniem do bazy danych

    // Pobranie danych z formularza
    $beatTitle = $_POST['beat_title'];
    $beatPrice = $_POST['beat_price'];
    $beatAutor = $_SESSION['prod_id']; // Pobranie ID autora z sesji

    // Generowanie unikalnych nazw plików
    $timestamp = date('YmdHis'); // Format: rok, miesiąc, dzień, godzina, minuta, sekunda
    $coverExtension = pathinfo($_FILES['beat_cover']['name'], PATHINFO_EXTENSION);
    $musicExtension = pathinfo($_FILES['beat_music']['name'], PATHINFO_EXTENSION);
    $beatCover = "cover_" . $timestamp . "." . $coverExtension;
    $beatMusic = "music_" . $timestamp . "." . $musicExtension;

    // Przenieś pliki do docelowego katalogu (upewnij się, że folder 'uploads' istnieje)
    $coverUploadPath = "../uploads/img/" . $beatCover;
    $musicUploadPath = "../uploads/music/" . $beatMusic;
    move_uploaded_file($_FILES['beat_cover']['tmp_name'], $coverUploadPath);
    move_uploaded_file($_FILES['beat_music']['tmp_name'], $musicUploadPath);

    // Przygotowanie zapytania SQL
    $sql = "INSERT INTO beaty (beat_title, beat_autor, beat_price, beat_cover, beat_music) VALUES (?, ?, ?, ?, ?)";

    if ($stmt = $conn->prepare($sql)) {
        // Powiązanie parametrów
        $stmt->bind_param("sisss", $beatTitle, $beatAutor, $beatPrice, $beatCover, $beatMusic);

        // Wykonanie zapytania
        if ($stmt->execute()) {
            $_SESSION['message'] = "New record created successfully";
        } else {
            $_SESSION['message'] = "Error: " . $stmt->error;
        }

        // Zamknięcie statement
        $stmt->close();
    } else {
        $_SESSION['message'] = "Error: " . $conn->error;
    }
    $conn->close();

    // Przekierowanie do tego samego skryptu, aby odświeżyć i pokazać komunikat
    header("Location: ../admin-panel.php");
    exit();
}
?>
