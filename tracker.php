<?php
// Récupérer les infos
$ip = $_SERVER['REMOTE_ADDR'];
$user_agent = $_SERVER['HTTP_USER_AGENT'];
$date = date('Y-m-d H:i:s');

// Sauvegarde dans un fichier
$log = "$date | IP: $ip | UA: $user_agent\n";
file_put_contents('logs/visites.log', $log, FILE_APPEND);
?>
