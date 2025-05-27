<?php

// Registrační skript
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $conn = new mysqli("localhost", "root", "", "psi_salon"); // Připojení k databázi
    if ($conn->connect_error) {
        die("Připojení selhalo: " . $conn->connect_error);
    }

    $jmeno = $_POST['jmeno'];
    $heslo = $_POST['heslo'];
    $email = $_POST['email'];

    // Kontrola, zda uživatel již existuje
    $stmt = $conn->prepare("SELECT * FROM uzivatele WHERE jmeno = ?");
    $stmt->bind_param("s", $jmeno);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Uživatel s tímto jménem již existuje.";
    } else {
        // Vložení nového uživatele
        $hash = password_hash($heslo, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("INSERT INTO uzivatele (jmeno, heslo, email) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $jmeno, $hash, $email);

        if ($stmt->execute()) {
            echo "Registrace úspěšná!";
            header("Location: login.php");
            exit;
        } else {
            echo "Chyba při registraci: " . $conn->error;
        }
    }

    $stmt->close();
    $conn->close();
}
