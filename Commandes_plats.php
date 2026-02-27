<?php
   require 'db.php';
   $message = "";
   
   $plat = $_GET['plat'] ?? '';
   $N°Chambre = $_GET['N°Chambre'] ?? '';
   
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
   
       $nom = $_POST['nom_client'];
       $telephone = $_POST['telephone'];
       $plat = $_POST['plat'];
       $quantite = $_POST['quantite'];
       $N°Chambre = $_POST['N°Chambre'];
   
       $sql = "INSERT INTO commandes_plats 
               (nom_client, telephone, plat, quantite, N°Chambre) 
               VALUES (?, ?, ?, ?, ?)";
   
       $stmt = $connexion->prepare($sql);
   
       if ($stmt->execute([$nom, $telephone, $plat, $quantite, $N°Chambre])) {
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
   </head>
   <body class="bg-light">
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
                  <li class="nav-item"><a class="nav-link " href="Reservation.php">Réservation</a></li>
                  <li class="nav-item"><a class="nav-link" href="Plats.html">Plats</a></li>
                  <li class="nav-item"><a class="nav-link active" href="Commandes_plats.php">Commande</a></li>
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
                  <label class="form-label">Type de plat</label>
                  <input type="text" name="plat" class="form-control" value="<?= htmlspecialchars($plat_selectionne) ?>" readonly>
               </div>
               <div class="mb-3">
                  <label class="form-label">Quantité</label>
                  <input type="number" name="quantite" class="form-control" min="1" value="1" required>
               </div>
               <div class="mb-3">
                  <label class="form-label">N°Chambre</label>
                  <input type="text" name="N°Chambre" class="form-control" 
                     required>
               </div>
               <button type="submit" class="btn btn-primary w-100">
               Confirmer la commande
               </button>
            </form>
         </div>
      </div>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
   </body>
   <footer class="bg-primary text-white text-center p-4">
      <p>© 2026 Hôtel_DS | Tous droits réservés</p>
   </footer>
</html>