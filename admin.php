<?php
session_start();
$mot_de_passe_hache = '$2y$10$EOzGeSOpqkMpT53uDNMEBuhOUYpb3RE8j0XNLWbdw1okN6J0OJRA2'; // Aelaxatif1*

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

if (!isset($_SESSION['admin'])):
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Connexion Admin</title>
  <style>
    body {
      background: #121212;
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
      padding: 10px;
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
<?php exit; endif; ?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Espace Admin - Visites</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.css" />
  <style>
    body {
      background: #0f0f0f;
      color: #fff;
      font-family: Arial, sans-serif;
      padding: 20px;
    }
    h1 {
      color: #ff007a;
    }
    .table-container {
      background: #1a1a1a;
      border-radius: 10px;
      padding: 20px;
      box-shadow: 0 0 10px rgba(255,0,122,0.3);
    }
    a.logout {
      color: #ff007a;
      text-decoration: none;
      float: right;
      margin-top: -40px;
    }
  </style>
</head>
<body>
  <h1>Espace Admin</h1>
  <a href="?logout=1" class="logout">Se déconnecter</a>

  <div class="table-container">
    <table id="logsTable" class="datatable">
      <thead>
        <tr>
          <th>IP</th>
          <th>Agent</th>
          <th>Date</th>
          <th>Page visitée</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $logs = file_exists('logs/visites.json') ? json_decode(file_get_contents('logs/visites.json'), true) : [];
        foreach (array_reverse($logs) as $entry) {
            echo "<tr>
                    <td>" . htmlspecialchars($entry['ip']) . "</td>
                    <td>" . htmlspecialchars($entry['agent']) . "</td>
                    <td>" . htmlspecialchars($entry['time']) . "</td>
                    <td>" . htmlspecialchars($entry['page']) . "</td>
                  </tr>";
        }
        ?>
      </tbody>
    </table>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"></script>
  <script>
    const dataTable = new simpleDatatables.DataTable("#logsTable");
  </script>
</body>
</html>
