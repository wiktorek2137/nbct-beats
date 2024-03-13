<?php
session_start(); // Start sesji na początku pliku

// Sprawdzenie, czy formularz został wysłany
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'connect.php'; // Dołączenie pliku z połączeniem do bazy danych

    // Pobranie danych z formularza
    $beatTitle = $_POST['beat_title'];
    $beatPrice = $_POST['beat_price'];
    $beatKey = $_POST['beat_key'];
    $beatBpm = $_POST['beat_bpm'];
    $beatCat = $_POST['beat_cat'];
    $beatAutor = $_SESSION['prod_id']; // Pobranie ID autora z sesji

    // Sprawdzenie, czy żadne z wymaganych pól nie jest puste
    if (empty($beatTitle) || empty($beatPrice) || empty($beatKey) || empty($beatBpm) || empty($beatCat)) {
        $_SESSION['message'] = '<span class="error">Wypełnij cały formularz!</span>';
        header("Location: ../admin-panel.php");
        exit();
    }

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

    // Ustawienie daty dodania
    $beatDate = date('Y-m-d H:i:s');

    // Przygotowanie zapytania SQL
    $sql = "INSERT INTO beaty (beat_title, beat_autor, beat_price, beat_cover, beat_music, beat_key, beat_bpm, beat_date, beat_cat) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = $conn->prepare($sql)) {
        // Powiązanie parametrów
        $sqlBeatCover = "uploads/img/".$beatCover;
        $sqlBeatMusic = "uploads/music/".$beatMusic;

        $stmt->bind_param("sisssssss", $beatTitle, $beatAutor, $beatPrice, $sqlBeatCover, $sqlBeatMusic, $beatKey, $beatBpm, $beatDate, $beatCat);

        // Wykonanie zapytania
        if ($stmt->execute()) {
            $_SESSION['message'] = '<span class="noerror">Pomyślnie dodano beat!</span>';
        } else {
            $_SESSION['message'] = '<span class="error">Nieprawidłowo wypełniono formularz: </span>' . $stmt->error;
        }

        // Zamknięcie statement
        $stmt->close();
    } else {
        $_SESSION['message'] = '<span class="error">Nieprawidłowo wypełniono formularz: </span>' . $conn->error;
    }
    $conn->close();

    // Przekierowanie do tego samego skryptu, aby odświeżyć i pokazać komunikat
    header("Location: ../admin-panel.php");
    exit();
}
?>
