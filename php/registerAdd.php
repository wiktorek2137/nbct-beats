<?php
session_start();

// Sprawdzenie, czy formularz został wysłany
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['repassword'])) {
    require_once('connect.php'); // Plik z połączeniem do bazy danych

    // Oczyszczenie danych formularza
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];
    $repassword = $_POST['repassword'];

    // Sprawdzenie, czy hasła się zgadzają
    if ($password !== $repassword) {
        $_SESSION['error'] = 'Hasła nie są identyczne!';
        header('Location: ../register_page.php');
        exit();
    }

    // Sprawdzenie, czy użytkownik o takim emailu już istnieje
    $sql = "SELECT * FROM users WHERE user_email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $_SESSION['error'] = 'Użytkownik o podanym adresie email już istnieje!';
        header('Location: ../register_page.php');
        exit();
    }
    $stmt->close();

    // Hashowanie hasła
    $passwordHash = password_hash($password, PASSWORD_DEFAULT);

    // Dodanie użytkownika do bazy danych z domyślnym typem "user"
    $sql = "INSERT INTO users (user_email, user_password, user_type) VALUES (?, ?, 'user')";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $email, $passwordHash);
    $result = $stmt->execute();

    if ($result) {
        $_SESSION['success'] = 'Rejestracja przebiegła pomyślnie. Możesz się teraz zalogować.';
        header('Location: ../login_page.php');
    } else {
        $_SESSION['error'] = 'Wystąpił błąd podczas rejestracji: ' . $conn->error;
        header('Location: ../register_page.php');
    }

    $stmt->close();
    $conn->close();
} else {
    header('Location: ../register_page.php');
    exit();
}
?>
