<?php
include('../bdd/connexion_bdd.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $titre = $_POST["titre"];
    $libelle = $_POST["libelle"];


    $sql = "INSERT INTO service (titre, libelle) VALUES ('$titre', '$libelle')";

    if ($conn->query($sql) === TRUE) {
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
        echo "<script>
                function showSweetAlert() {
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'Ajout effectué',
                        showConfirmButton: false,
                        timer: 1700
                    }).then(function() {
                        window.location.href = '../service.php'; // Rediriger après un délai
                    });
                }
    
                document.addEventListener('DOMContentLoaded', showSweetAlert);
            </script>";

    } else {
        echo "Erreur lors de l'enregistrement : " . $conn->error;
    }
}

?>