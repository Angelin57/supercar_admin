<?php
$id_dmdessai = $_POST["id_dmdessai"];
$statut = $_POST["statut"];

include('../bdd/connexion_bdd.php');

$sql_update = "UPDATE dmdessai SET 
statut = '$statut'
 WHERE id_dmdessai = $id_dmdessai";

if (mysqli_query($conn, $sql_update)) {
    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
    echo "<script>
            function showSweetAlert() {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Changement de statut effectué',
                    showConfirmButton: false,
                    timer: 1700
                }).then(function() {
                    window.location.href = '../dmdessai.php'; // Rediriger après un délai
                });
            }

            document.addEventListener('DOMContentLoaded', showSweetAlert);
        </script>";
} else {
    echo "Erreur : " . $sql_update . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>