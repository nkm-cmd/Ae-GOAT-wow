function checkPassword() {
  const input = document.getElementById("password").value;
  const hash = sha256(input);
  const validHash = "ee64acff0212e2859b570b0d64cf01bd59dc3d75fe3626a9701a702f27f0c7dc"; // Hash de Aelaxatif1*

  if (hash === validHash) {
    document.getElementById("login").style.display = "none";
    document.getElementById("admin-content").style.display = "block";
    loadData();
  } else {
    document.getElementById("error").innerText = "Mot de passe incorrect.";
  }
}

function sha256(str) {
  const buffer = new TextEncoder("utf-8").encode(str);
  return crypto.subtle.digest("SHA-256", buffer).then(hash => {
    return Array.from(new Uint8Array(hash))
      .map(b => b.toString(16).padStart(2, "0"))
      .join("");
  });
}

// Chargement des données visiteurs depuis visiteurs.json
async function loadData() {
  const res = await fetch("visiteurs.json");
  const data = await res.json();

  const table = $('#visiteurs-table').DataTable();
  data.forEach(item => {
    table.row.add([
      item.ip,
      item.page,
      item.date,
      item.navigator
    ]).draw(false);
  });
}
