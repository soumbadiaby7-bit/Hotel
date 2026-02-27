<?php
session_start();
require 'db.php'; // connexion à la base

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $mot_de_passe = $_POST['mot_de_passe'] ?? '';

    if ($email && $mot_de_passe) {
        $sql = "SELECT * FROM admin WHERE email = :email LIMIT 1";
        $stmt = $connexion->prepare($sql);
        $stmt->execute([':email' => $email]);
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($admin && $admin['mot_de_passe'] == $mot_de_passe) {
            $_SESSION['admin'] = $admin['prenom'].' '.$admin['nom'];
            header("Location: dashboard_admin.php");
            exit;
        } else {
            $message = "Email ou mot de passe incorrect";
        }
    } else {
        $message = "Veuillez remplir tous les champs";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="UTF-8">
<title>Login Admin | Hôtel_DS</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container" style="margin-top:150px; max-width:400px;">
<?php if($message): ?>
<div class="alert alert-danger text-center"><?= $message ?></div>
<?php endif; ?>
<div class="card shadow p-4">
<h3 class="text-center mb-4">Connexion Admin</h3>
<form method="POST">
<div class="mb-3">
<label>Email</label>
<input type="email" name="email" class="form-control" required>
</div>
<div class="mb-3">
<label>Mot de passe</label>
<input type="password" name="mot_de_passe" class="form-control" required>
</div>
<button type="submit" class="btn btn-primary w-100">Se connecter</button>
</form>
</div>
</div>
</body>
</html>