<?php
session_start();
require 'db.php';

if (!isset($_SESSION['admin'])) {
    header("Location: login_admin.php");
    exit;
}

// Récupérer toutes les réservations
$reservations = $connexion->query("SELECT * FROM reservation ORDER BY date_arrivee DESC")->fetchAll(PDO::FETCH_ASSOC);

// Récupérer toutes les commandes
$commandes = $connexion->query("SELECT * FROM commandes_plats ORDER BY telephone DESC")->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Dashboard Admin | Hôtel_DS</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
<h2>Bienvenue <?= $_SESSION['admin'] ?></h2>
<a href="logout.php" class="btn btn-danger mb-3">Se déconnecter</a>

<h3>Réservations</h3>
<table class="table table-striped">
<thead>
<tr>
</th><th>Nom</th><th>Prénom</th><th>Téléphone</th><th>Date Arrivée</th><th>Date Départ</th><th>Nb Personnes</th><th>Type Chambre</th>
</tr>
</thead>
<tbody>
<?php foreach($reservations as $res): ?>
<tr>

<td><?= $res['nom'] ?></td>
<td><?= $res['prenom'] ?></td>
<td><?= $res['telephone'] ?></td>
<td><?= $res['date_arrivee'] ?></td>
<td><?= $res['date_depart'] ?></td>
<td><?= $res['nb_personnes'] ?></td>
<td><?= $res['type_chambre_prix'] ?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>

<h3>Commandes</h3>
<table class="table table-striped">
<thead>
<tr>
<th>Nom Client</th><th>Téléphone</th><th>Plat</th><th>Quantité</th><th>N°Chambre</th>
</tr>
</thead>
<tbody>
<?php foreach($commandes as $cmd): ?>
<tr>

<td><?= $cmd['nom_client'] ?></td>
<td><?= $cmd['telephone'] ?></td>
<td><?= $cmd['plat'] ?></td>
<td><?= $cmd['quantite'] ?></td>
<td><?= $cmd['N°Chambre'] ?></td>
</tr>
<?php endforeach; ?>
</tbody>
</table>

</div>
</body>
</html>