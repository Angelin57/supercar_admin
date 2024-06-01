<?php
$id_acceuil = $_GET['id_acceuil'];

include('../bdd/connexion_bdd.php');

$sql = "DELETE FROM acceuil WHERE id_acceuil = '$id_acceuil' ";

$sql_client = $conn->query($sql);

if ($sql_client == true) {
    // Suppression réussie
    header("Location: ../acceuil.php");
} else {
    echo 'erreur' . $sql . "<br>" . $conn->error;
}
?>