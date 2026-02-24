<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil | Hôtel Zante</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

   
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  
</head>
<body>
<header>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
    <div class="container">
        <a class="navbar-brand" href="Accueil.html">HôtelDS</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#menu">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menu">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link active" href="Accueil.html">Accueil</a></li>
                <li class="nav-item"><a class="nav-link" href="Appropos.html">À propos</a></li>
                <li class="nav-item"><a class="nav-link" href="Chambres.html">Chambres</a></li>
                <li class="nav-item"><a class="nav-link" href="Réservation.html">Réservation</a></li>
            </ul>
        </div>
    </div>
</nav>
    </header>

    <!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
  
    <title>Contacts IPLAP</title>
    
</head>
<body>

        <h1>Contactez-nous pour la validation final de votre Réservation</h1>
		<p>Nous sommes là pour répondre à toutes vos questions et vous accompagner</p>
      
        <p> <a href="hotelDs@gmail.com">Google</a></p>

		    <p>Horaires  <br> Lun-Dim : 24h/24h<a href="hotelDs@gmail.com"></a></p>
          
<?php
require 'db.php';
$message = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nom = $_POST["nom"] ?? '';
    $prenom = $_POST["prenom"] ?? '';
    $telephone = $_POST["telephone"] ?? '';

    if (!empty($nom) && !empty($prenom) && !empty($telephone)) {

        $sql = "INSERT INTO contact (nom, prenom, telephone)
                VALUES (:nom, :prenom, :telephone)";
        $stmt = $connexion->prepare($sql);

        $stmt->execute([
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':telephone' => $telephone
        ]);

        $message = "Votre message a été envoyé avec succès.";
    } else {
        $message = "Veuillez remplir tous les champs.";
    }
}
?>
<form action="Contact.php" method="post">
    <label>Nom</label>
    <input type="text" name="nom" required><br><br>

    <label>Prénom</label>
    <input type="text" name="prenom" required><br><br>

    <label>Téléphone</label>
    <input type="text" name="telephone" required><br><br>

    <button type="submit" class="btn btn-success">Envoyer</button>
</form>
<p><?php echo $message; ?></p>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
<footer class="bg-dark text-white text-center p-4">
    <p>© 2026 HôtelDs | Tous droits réservés</p>
</footer>
</html>