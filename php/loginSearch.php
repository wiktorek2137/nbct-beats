<?php
session_start();

// Sprawdzenie, czy formularz został wysłany
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['email']) && isset($_POST['password'])) {
    require_once('connect.php'); // Plik z połączeniem do bazy danych

    // Oczyszczenie danych formularza
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    // Najpierw sprawdź typ użytkownika bez dołączania tabeli producentów
    $sql = "SELECT * FROM users WHERE user_email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['user_password'])) { // W prawdziwej aplikacji użyj password_verify
            // Ustawienie zmiennych sesji
            $_SESSION['zalogowany'] = true;
            $_SESSION['id'] = $row['user_id'];
            $_SESSION['user'] = $row['user_email'];
            $_SESSION['type'] = $row['user_type'];

            if ($row['user_type'] == "admin") {
                // Zapytanie dla admina
                $sqlAdmin = "SELECT * FROM users INNER JOIN producers ON users.prod_id=producers.producer_id WHERE user_email = '$email'";
                $resultAdmin = $conn->query($sqlAdmin);
                if ($resultAdmin->num_rows > 0) {
                    $rowAdmin = $resultAdmin->fetch_assoc();
                    $_SESSION['prod_id'] = $rowAdmin['prod_id'];
                }
                header('Location: ../admin-panel.php');
                exit();
            } else {
                // Dla zwykłego użytkownika
                header('Location: ../user-panel.php');
                exit();
            }

        } else {
            $_SESSION['error'] = 'Nieprawidłowy login lub hasło!';
            header('Location: ../login_page.php');
            exit();
        }
    } else {
        $_SESSION['error'] = 'Nieprawidłowy login lub hasło!';
        header('Location: ../login_page.php');
        exit();
    }
} else {
    header('Location: ../login_page.php');
    exit();
}
?>
