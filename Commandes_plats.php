<?php
require 'db.php';
$message = "";

$plat = $_GET['plat'] ?? '';
$prix = $_GET['prix'] ?? '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nom = $_POST['nom_client'];
    $telephone = $_POST['telephone'];
    $plat = $_POST['plat'];
    $quantite = $_POST['quantite'];
    $prix = $_POST['prix'];

    $sql = "INSERT INTO commandes_plats 
            (nom_client, telephone, plat, quantite, prix) 
            VALUES (?, ?, ?, ?, ?)";

    $stmt = $connexion->prepare($sql);

    if ($stmt->execute([$nom, $telephone, $plat, $quantite, $prix])) {
        $message = "Commande envoyée avec succès ! Merci de votre confiance.";
    } else {
        $message = "Erreur lors de la commande.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
   <head>
      <meta charset="UTF-8">
      <title>Commande_plats | Hôtel_DS</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
      <script>
            alert("Commande de plats à l’Hôtel_DS : Savourez notre délicieuse cuisine en commandant vos plats préférés directement depuis votre chambre ou à emporter. Profitez de notre menu varié et de notre service rapide pour une expérience culinaire exceptionnelle !");
        </script>
   </head>
   <body>
      <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
         <div class="container">
            <a class="navbar-brand" href="Commande.php">Hôtel_DS</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
            <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="menu">
               <ul class="navbar-nav ms-auto">
                  <li class="nav-item"><a class="nav-link" href="Accueil.html">Accueil</a></li>
                  <li class="nav-item"><a class="nav-link" href="Appropos.html">À propos</a></li>
                  <li class="nav-item"><a class="nav-link" href="Chambres.html">Chambres</a></li>
                  <li class="nav-item"><a class="nav-link active" href="Reservation.php">Réservation</a></li>
                  <li class="nav-item"><a class="nav-link" href="Plats.html">Plats</a></li>
                  <li class="nav-item"><a class="nav-link" href="Commandes_plats.php">Commande</a></li>
               </ul>
            </div>
         </div>
      </nav>

<div class="container" style="margin-top: 120px; margin-bottom: 50px;">


<?php if (!empty($message)): ?>
    <div class="alert alert-success text-center">
        <?= $message ?>
    </div>
<?php endif; ?>

<div class="card shadow p-4 mx-auto" style="max-width:500px;">
    <h2 class="text-center mb-4">Commande du Plat </h2>

<?php
$plat_selectionne = $_GET['plat'] ?? '';
?>
    <form action="Commandes_plats.php" method="POST">

        <div class="mb-3">
            <label class="form-label">Nom du client</label>
            <input type="text" name="nom_client" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Téléphone</label>
            <input type="text" name="telephone" class="form-control" required>
        </div>

        <div class="mb-3">
    <label class="form-label">Choisir un plat</label>
    <select name="plat" id="plat" class="form-select" required onchange="afficherPrix()">
        <option value="">-- Sélectionnez un plat --</option>
        <option value="Ordeuvre Salade" data-prix="0 FCFA">Ordeuvre Salade</option>
         <option value="sushi" data-prix="0 FCFA">sushi</option>
        <option value="Soupe du Chef" data-prix="0 FCFA">Soupe du Chef</option>
        <option value="Poulet Rôti" data-prix="10000 FCFA">Poulet Rôti</option>
        <option value="Poisson Grillé" data-prix="10000 FCFA">Poisson Grillé</option>
        <option value="Riz à la Sauce Rouge" data-prix="5000 FCFA">Riz à la Sauce Rouge</option>
        <option value="Crevette" data-prix="15000 FCFA">Crevette</option>
        <option value="Humburger" data-prix="3000 FCFA">Humburger</option>
        <option value="Pizza" data-prix="5000 FCFA">Pizza</option>
        <option value="Kfc" data-prix="6000 FCFA">Kfc</option>
        <option value="Gâteau au Chocolat" data-prix="5000 FCFA">Gâteau au Chocolat</option>
        <option value="Gâteau à la Fraise" data-prix="5000 FCFA">Gâteau à la Fraise</option>
        <option value="Pancake" data-prix="3000 FCFA">Pancake</option>
        <option value="Crêpe" data-prix="2000 FCFA">Crêpe</option>
        <option value="Milkshake" data-prix="3000 FCFA">Milkshake</option>
        <option value="Jus d'Orange" data-prix="2000 FCFA">Jus d'Orange</option>
        <option value="Jus d'Ananas" data-prix="3000 FCFA">Jus d'Ananas</option>
        <option value="Fanta Canette" data-prix="2000 FCFA">Fanta Canette</option>
        <option value="Vin Rouge et Blanc" data-prix="10000 FCFA">Vin Rouge et Blanc</option>
    </select>
</div>
        <div class="mb-3">
            <label class="form-label">Quantité</label>
            <input type="number" name="quantite" class="form-control" min="1" value="1" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Prix (FCFA)</label>
            <input type="text" name="prix" class="form-control" 
                   value="<?= htmlspecialchars($prix) ?>" readonly>
        </div>

        <button type="submit" class="btn btn-warning w-100">
            Confirmer la commande
        </button>

    </form>
</div>

</div>


<script>
function afficherPrix() {
    let select = document.getElementById("plat");
    let prix = select.options[select.selectedIndex].getAttribute("data-prix");
    
    if (prix) {
        document.getElementById("prix").value = prix + " FCFA";
    } else {
        document.getElementById("prix").value = "";
    }
}
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
<footer class="bg-dark text-white text-center p-4">
<p>© 2026 Hôtel_DS | Tous droits réservés</p>
</footer>
</html>