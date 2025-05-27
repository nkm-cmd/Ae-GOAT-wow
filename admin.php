<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <title>Espace Admin</title>
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="style.css">
  <style>
    #admin-content { display: none; padding: 20px; }
    #login { text-align: center; margin-top: 50px; }
    input[type="password"] { padding: 8px; width: 200px; }
    button { padding: 8px 16px; margin-top: 10px; }
  </style>
</head>
<body>
  <div id="login">
    <h2>Connexion Admin</h2>
    <input type="password" id="password" placeholder="Mot de passe admin" />
    <br>
    <button onclick="checkPassword()">Connexion</button>
    <p id="error" style="color: red;"></p>
  </div>

  <div id="admin-content">
    <h2>Visiteurs</h2>
    <table id="visiteurs-table" class="display" style="width:100%">
      <thead>
        <tr>
          <th>Adresse IP</th>
          <th>Page visitée</th>
          <th>Date</th>
          <th>Navigator</th>
        </tr>
      </thead>
      <tbody></tbody>
    </table>
  </div>

  <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="script.js"></script>
</body>
</html>
