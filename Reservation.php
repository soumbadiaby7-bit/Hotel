<?php
   session_start();
   require 'db.php';
   
   $message = "";
    $type_chambre_auto = $_GET['chambre'] ?? '';
   if ($_SERVER["REQUEST_METHOD"] === "POST") {
   
       $date_arrivee = $_POST['date_arrivee'] ?? '';
       $date_depart = $_POST['date_depart'] ?? '';
       $nb_personnes = $_POST['nb_personnes'] ?? '';
       $type_chambre_prix = $_POST['type_chambre_prix'] ?? '';
       $nom = $_POST["nom"] ?? '';
       $prenom = $_POST["prenom"] ?? '';
       $telephone = $_POST["telephone"] ?? '';

       if (!empty($date_arrivee) && !empty($date_depart) && !empty($nb_personnes)
           && !empty($type_chambre_prix) && !empty($nom)
           && !empty($prenom) && !empty($telephone)) {
   
           if ($date_depart < $date_arrivee) {
               $message = "La date de départ doit être après la date d'arrivée.";
           } else {
   
               $sql = "INSERT INTO reservation 
               ( date_arrivee, date_depart, nb_personnes, type_chambre_prix, nom, prenom, telephone)
               VALUES ( :date_arrivee, :date_depart, :nb_personnes, :type_chambre_prix, :nom, :prenom, :telephone)";
   
               $stmt = $connexion->prepare($sql);
               $stmt->execute([
                   ':date_arrivee' => $date_arrivee,
                   ':date_depart' => $date_depart,
                   ':nb_personnes' => $nb_personnes,
                   ':type_chambre_prix' => $type_chambre_prix,
                   ':nom' => $nom,
                   ':prenom' => $prenom,
                   ':telephone' => $telephone
               ]);
   
               $message = "Réservation enregistrée avec succès !";
           }
       } else {
           $message = "Veuillez remplir tous les champs.";
       }
   }
   ?>
<!DOCTYPE html>
<html lang="fr">
   <head>
      <meta charset="UTF-8">
      <title>Réservation | Hôtel_DS</title>
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
   </head>
   <body class="bg-light">
      <header>
         <nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
            <div class="container">
               <a class="navbar-brand" href="Reservation.php">Hôtel_DS</a>
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
      </header>
      <div class="container" style="margin-top: 120px; margin-bottom: 50px;">
         <?php if (!empty($message)): ?>
         <div class="alert alert-success text-center">
            <?= $message ?>
         </div>
         <?php endif; ?>
         <h1 class="text-center bg-primary text-white p-3 mb-4">Formulaire de réservation</h1>
         <form class="row g-3" method="post" action="Reservation.php">
            <div class="col-md-3 mb-3">
               <label>Date d'arrivée</label>
               <input type="date" name="date_arrivee" class="form-control" required>
            </div>
            <div class="col-md-3 mb-3">
               <label>Date de départ</label>
               <input type="date" name="date_depart" class="form-control" required>
            </div>
            <div class="col-md-3 mb-3">
               <label>Nombre de personnes</label>
               <select name="nb_personnes" class="form-control">
                  <option value="1">1 personne</option>
                  <option value="2">2 personnes</option>
                  <option value="3">3 personnes</option>
                  <option value="4">plus de personnes</option>
               </select>
            </div>
            <div class="col-md-3 mb-3">
               <label>Type de chambre</label>
               <input type="text" name="type_chambre_prix"
                  class="form-control"
                  value="<?= htmlspecialchars($type_chambre_auto) ?>"
                  readonly required>
            </div>
            <div class="col-md-3 mb-3">
               <label>Nom</label>
               <input type="text" name="nom" class="form-control" required><br>     
            </div>
            <div class="col-md-3 mb-3">
               <label>Prénom</label>
               <input type="text" name="prenom" class="form-control" required><br>
            </div>
            <div class="col-md-3 mb-3">
               <label>Téléphone</label>
               <input type="text" name="telephone" class="form-control" maxlength="8" required><br>
            </div>
            <div class="col-12 text-center mt-3">
               <button type="submit" class="btn btn-success btn-lg">Envoyer</button>
            </div>
         </form>
      </div>
      <a href="Plats.html" class=" text-blue text-center d-block mt-3 mb-5"> clic pour voir nos plats et commander</a>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
   </body>
   <footer class="bg-primary text-white text-center p-4 ">
      <p>© 2026 Hôtel_DS | Tous droits réservés</p>
   </footer>
</html>