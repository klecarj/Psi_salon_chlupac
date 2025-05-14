
<?php
session_start();

// Kontrola přihlášení
if (!isset($_SESSION['username'])) {
    // Není přihlášený -> přesměrování
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="cs">
<head>
  <meta charset="UTF-8">
  <title>Admin – Psí salon Chlupáč</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body>
  <div class="container">
    <h1>Vítej, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
    <p>Toto je chráněná admin stránka.</p>
    <p><a href="logout.php">Odhlásit se</a></p>
  </div>
</body>
</html>