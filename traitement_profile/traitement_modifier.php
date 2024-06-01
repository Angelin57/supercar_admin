<?php
session_start(); // Démarrez la session si ce n'est pas déjà fait

$id_admin = $_POST["id_admin"];
$username = $_POST["username"];
$mdp = $_POST["mdp"];

include('../bdd/connexion_bdd.php');

// Obtenez l'username de l'utilisateur connecté à partir de la variable de session
if(isset($_SESSION["username"])){
    $username_utilisateur = $_SESSION["username"];
} else {
    // Gérer le cas où l'username de l'utilisateur n'est pas défini
    // Peut-être rediriger vers une page de connexion
}

$sql_update = "UPDATE admin SET 
                username= '$username',
                mdp = '$mdp'
                WHERE id_admin = $id_admin
                AND username = '$username_utilisateur'"; 

if (mysqli_query($conn, $sql_update)) {
    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
    echo "<script>
            function showSweetAlert() {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Modification effectuée',
                    showConfirmButton: false,
                    timer: 1700
                }).then(function() {
                    window.location.href = '../profile.php'; // Rediriger après un délai
                });
            }

            document.addEventListener('DOMContentLoaded', showSweetAlert);
        </script>";
} else {
    echo "Erreur : " . $sql_update . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>
