<!DOCTYPE html>
<html lang="cs">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Přihlášení – Psí salon Chlupáč</title>
  <link rel="stylesheet" href="../css/login.css" />

</head>



<body>
  <div class="container">
    <h1>Přihlášení</h1>
    <form class="login" method="post" action="login.php">
      <label for="jmeno">Uživatelské jméno:</label>
      <input type="text" name="jmeno" placeholder="Uživatelské jméno" required><br />
      <label for="heslo">Heslo:</label>
      <input type="password" name="heslo" placeholder="Heslo" required><br />

      <button type="submit">Přihlásit se</button> <br />
      <p>Nemáte účet?</p>
      <a href="register.php">Registrovat se</a>
      <a href="http://localhost/Psi_Salon_Chlupac/index.php">Zpět na domovskou stránku</a>
    </form>
  </div>
  <br>
  <br>

</body>

</html>

<?php
session_start(); // Spuštění relace
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $conn = new mysqli("localhost", "root", "", "psi_salon"); // Připojení k databázi
  if ($conn->connect_error) {
    die("Připojení selhalo: " . $conn->connect_error);
  }
  $jmeno = $_POST['jmeno'];
  $heslo = $_POST['heslo'];

  $stmt = $conn->prepare("SELECT heslo FROM uzivatele WHERE jmeno = ?");
  $stmt->bind_param("s", $jmeno);
  $stmt->execute();
  $stmt->bind_result($hash);
  if ($stmt->fetch() && password_verify($heslo, $hash)) {
    $_SESSION['uzivatel'] = $jmeno;
    header("Location: admin.php");
    exit;
  } else {
    echo "Neplatné přihlašovací údaje.";
  }
}
?>