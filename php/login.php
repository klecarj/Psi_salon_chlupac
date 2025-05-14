<?php session_start(); ?>
<form method="post" action="login.php">
  <input type="text" name="jmeno" placeholder="Uživatelské jméno" required>
  <input type="password" name="heslo" placeholder="Heslo" required>
  <button type="submit">Přihlásit se</button>
  <a href="register.php">Registrovat se</a>
  <a href="http://localhost/Psi_Salon_Chlupac/index.php">Zpět na domovskou stránku</a>
</form>

<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $conn = new mysqli("localhost", "root", "", "psi_salon"); // přizpůsob si
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