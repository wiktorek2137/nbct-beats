<?php
session_start(); // Rozpoczęcie sesji, aby móc ją modyfikować

// Usunięcie wszystkich zmiennych sesji
$_SESSION = array();

// Jeśli jest to konieczne, usunięcie ciasteczka sesji
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Zniszczenie sesji
session_destroy();

// Przekierowanie do strony głównej lub strony logowania
header('Location: ../login_page.php');
exit();
?>
