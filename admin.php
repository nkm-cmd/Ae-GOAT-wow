<?php
$mot_de_passe = "superadmin"; // Change ce mot de passe

if (!isset($_GET['pass']) || $_GET['pass'] !== $mot_de_passe) {
  die("Accès refusé.");
}

$logs = file('logs/visites.log');
echo "<h1>Visites :</h1><pre>";
foreach (array_reverse($logs) as $log) {
    echo htmlspecialchars($log);
}
echo "</pre>";
?>
