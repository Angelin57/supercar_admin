<?php
include('../bdd/connexion_bdd.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST["username"]);
    $mdp = mysqli_real_escape_string($conn, $_POST["mdp"]);

    $sql = "INSERT INTO admin (username, mdp) VALUES ('$username', '$mdp')";

    if ($conn->query($sql) === TRUE) {
        echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
        echo "<script>
            function showSweetAlert() {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Ajout nouvel admin effectué',
                    showConfirmButton: false,
                    timer: 1700
                }).then(function() {
                    window.location.href = '../profile.php'; // Rediriger après un délai
                });
            }

            document.addEventListener('DOMContentLoaded', showSweetAlert);
        </script>";
    } else {
        echo "Erreur lors de l'enregistrement : " . $conn->error;
    }
}
?>