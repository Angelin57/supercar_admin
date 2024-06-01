<?php
$id_service = $_POST["id_service"];
$titre = $_POST["titre"];
$libelle = $_POST["libelle"];

include('../bdd/connexion_bdd.php');
$titre = mysqli_real_escape_string($conn, $titre);
$libelle = mysqli_real_escape_string($conn, $libelle);

$sql_update = "UPDATE service SET titre = '$titre', libelle = '$libelle' WHERE id_service = '$id_service'";

if (mysqli_query($conn, $sql_update)) {
    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
    echo "<script>
            function showSweetAlert() {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Modification effectué',
                    showConfirmButton: false,
                    timer: 1700
                }).then(function() {
                    window.location.href = '../service.php'; // Rediriger après un délai
                });
            }

            document.addEventListener('DOMContentLoaded', showSweetAlert);
        </script>";
} else {
    echo "Erreur : " . $sql_update . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>