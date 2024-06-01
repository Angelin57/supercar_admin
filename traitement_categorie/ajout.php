<?php
include('../bdd/connexion_bdd.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nom_categorie = $_POST["nom_categorie"];

    $sql = "INSERT INTO voiture_categorie (nom_categorie) VALUES ('$nom_categorie')";

    if ($conn->query($sql) == TRUE) {
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
        echo "<script>
            function showSweetAlert() {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Ajout nouvel categorie effectué',
                    showConfirmButton: false,
                    timer: 1700
                }).then(function() {
                    window.location.href = '../menu.php'; // Rediriger après un délai
                });
            }

            document.addEventListener('DOMContentLoaded', showSweetAlert);
        </script>";
    } else {
        # code...
        echo "ERREUR" . $conn->error;
    }

}

?>