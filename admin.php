<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Admin - Jl influence AE</title>
  <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@500&display=swap" rel="stylesheet" />
  <style>
    body {
      font-family: Arial, Helvetica, sans-serif;
      background: linear-gradient(135deg, #0f0f0f, #1a1a1a);
      color: #fff;
      margin: 0; padding: 0;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    #adminContent {
      display: none;
      max-width: 800px;
      padding: 20px;
      background: rgba(32, 32, 32, 0.9);
      border-radius: 15px;
      box-shadow: 0 0 20px #ff007a;
      text-align: center;
    }
    #loginPanel {
      max-width: 300px;
      background: rgba(32,32,32,0.9);
      padding: 20px;
      border-radius: 15px;
      box-shadow: 0 0 20px #ff007a;
      text-align: center;
    }
    input[type="password"] {
      width: 100%;
      padding: 10px;
      font-size: 1em;
      margin: 10px 0;
      border-radius: 8px;
      border: none;
    }
    button {
      background: #ff007a;
      border: none;
      padding: 10px 20px;
      color: white;
      font-weight: bold;
      border-radius: 10px;
      cursor: pointer;
      box-shadow: 0 0 10px #ff007a;
      transition: background 0.3s;
      font-size: 1em;
    }
    button:hover {
      background: #ff3399;
    }
    #errorMsg {
      color: #ff3399;
      margin-top: 10px;
    }
    h1 {
      color: #ff007a;
      text-shadow: 1px 1px 10px #ff007a;
    }
  </style>
</head>
<body>

  <div id="loginPanel">
    <h1>Connexion Admin</h1>
    <input type="password" id="passwordInput" placeholder="Mot de passe" />
    <button id="loginBtn">Se connecter</button>
    <p id="errorMsg"></p>
  </div>

  <div id="adminContent">
    <h1>Bienvenue dans le panneau Admin</h1>
    <p>Contenu confidentiel ici.</p>
    <!-- Ici tu peux mettre tes données admin, tableau, logs, etc. -->
    <button id="logoutBtn">Déconnexion</button>
  </div>

<script>
  // Hash mot de passe (SHA-256) = hash de "Aelaxatif1*"
  const adminHash = 'd306c5f5372bbd8f468f521541b4189c88279979e1e9e5a6dd8af1a0e0c4e97a';

  // Convertir ArrayBuffer en hex string
  function bufferToHex(buffer) {
    return Array.from(new Uint8Array(buffer))
      .map(b => b.toString(16).padStart(2, '0'))
      .join('');
  }

  // Hash en SHA-256
  async function hashPassword(password) {
    const encoder = new TextEncoder();
    const data = encoder.encode(password);
    const hashBuffer = await crypto.subtle.digest('SHA-256', data);
    return bufferToHex(hashBuffer);
  }

  const loginPanel = document.getElementById('loginPanel');
  const adminContent = document.getElementById('adminContent');
  const passwordInput = document.getElementById('passwordInput');
  const loginBtn = document.getElementById('loginBtn');
  const errorMsg = document.getElementById('errorMsg');
  const logoutBtn = document.getElementById('logoutBtn');

  // Fonction pour montrer admin
  function showAdmin() {
    loginPanel.style.display = 'none';
    adminContent.style.display = 'block';
  }

  // Fonction pour déconnexion
  function logout() {
    adminContent.style.display = 'none';
    loginPanel.style.display = 'block';
    passwordInput.value = '';
    errorMsg.textContent = '';
  }

  loginBtn.addEventListener('click', async () => {
    const pwd = passwordInput.value.trim();
    if (!pwd) {
      errorMsg.textContent = 'Veuillez entrer un mot de passe.';
      return;
    }
    const hashed = await hashPassword(pwd);
    if (hashed === adminHash) {
      errorMsg.textContent = '';
      showAdmin();
    } else {
      errorMsg.textContent = 'Mot de passe incorrect.';
    }
  });

  // Permet submit avec touche Entrée
  passwordInput.addEventListener('keydown', (e) => {
    if (e.key === 'Enter') loginBtn.click();
  });

  logoutBtn.addEventListener('click', () => {
    logout();
  });

  // Optionnel : Si tu veux mémoriser la session admin, tu peux utiliser localStorage
  // Mais attention, ce n'est pas très sécurisé côté front
</script>

</body>
</html>
