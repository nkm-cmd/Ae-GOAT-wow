<?php
session_start();

// Mot de passe haché généré depuis "Aelaxatif1*"
$mot_de_passe_hache = '$2y$10$EOzGeSOpqkMpT53uDNMEBuhOUYpb3RE8j0XNLWbdw1okN6J0OJRA2';

if (isset($_POST['password'])) {
    if (password_verify($_POST['password'], $mot_de_passe_hache)) {
        $_SESSION['admin'] = true;
    } else {
        $erreur = "Mot de passe incorrect.";
    }
}

if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: admin.php');
    exit;
}

if (!isset($_SESSION['admin'])) {
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Connexion Admin</title>
  <style>
    body {
      background: #0f0f0f;
      color: #fff;
      font-family: Arial, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    form {
      background: #1e1e1e;
      padding: 30px;
      border-radius: 15px;
      box-shadow: 0 0 15px rgba(255, 0, 122, 0.5);
    }
    input[type="password"] {
      padding: 10px;
      border: none;
      border-radius: 10px;
      margin-bottom: 10px;
      width: 100%;
    }
    button {
      background: #ff007a;
      border: none;
      padding: 10px 20px;
      border-radius: 10px;
      color: white;
      font-weight: bold;
      cursor: pointer;
      width: 100%;
    }
    .erreur {
      color: red;
      margin-bottom: 10px;
    }
  </style>
</head>
<body>
  <form method="post">
    <h2>Connexion Admin</h2>
    <?php if (isset($erreur)) echo "<div class='erreur'>$erreur</div>"; ?>
    <input type="password" name="password" placeholder="Mot de passe" required>
    <button type="submit">Se connecter</button>
  </form>
</body>
</html>
<?php
exit;
}

// Affichage des logs si connecté
$logs = file_exists('logs/visites.log') ? file('logs/visites.log') : [];

?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Espace Admin - Logs</title>
  <style>
    body {
      background: #0f0f0f;
      color: #00f2ff;
      font-family: monospace;
      padding: 30px;
    }
    h1 {
      color: #ff007a;
    }
    pre {
      background: #1e1e1e;
      padding: 20px;
      border-radius: 15px;
      box-shadow: 0 0 10px rgba(0,0,0,0.5);
      max-height: 80vh;
      overflow-y: auto;
    }
    a {
      display: inline-block;
      margin-top: 20px;
      color: #ff007a;
      text-decoration: none;
    }
  </style>
</head>
<body>
  <h1>Logs des visites</h1>
  <pre><?php echo htmlspecialchars(implode("", array_reverse($logs))); ?></pre>
  <a href="?logout=1">Se déconnecter</a>
</body>
</html>
