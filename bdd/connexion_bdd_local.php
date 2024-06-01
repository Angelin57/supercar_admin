<?php
$serveur = "supercar";
$utilisateur = "root";
$motDePasse = "";
$baseDeDonnees = "supercar";

$conn = mysqli_connect($serveur, $utilisateur, $motDePasse, $baseDeDonnees);

// Vérifier la connexion
if (!$conn) {
    die("La connexion à la base de données a échoué : " . mysqli_connect_error());
}


$serveur = "mysql-angelin.alwaysdata.net";
$utilisateur = "angelin";
$motDePasse = "Actros5751";
$baseDeDonnees = "angelin_supercar";

$conn = mysqli_connect($serveur, $utilisateur, $motDePasse, $baseDeDonnees);

// Vérifier la connexion
if (!$conn) {
    die("La connexion à la base de données a échoué : " . mysqli_connect_error());
}
?>