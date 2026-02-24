<?php
$host = "localhost";
$dbname = "hotel";
$user = "root";
$pass = "";
try {
$connexion = new PDO(
"mysql:host=$host;dbname=$dbname;charset=utf8mb4",
$user,
$pass
);
$connexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
die("Erreur de connexion : " . $e->getMessage());
}