<?php
$id_acceuil = $_POST["id_acceuil"];
$libelle_1 = $_POST["libelle_1"];
$libelle_2 = $_POST["libelle_2"];
$libelle_3 = $_POST["libelle_3"];
$libelle_4 = $_POST["libelle_4"];

include('../bdd/connexion_bdd.php');



$sql_update = "UPDATE acceuil SET 
libelle_1= '$libelle_1',
libelle_2= '$libelle_2',
libelle_3= '$libelle_3',
libelle_4= '$libelle_4'
 WHERE id_acceuil = $id_acceuil";




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
                    window.location.href = '../acceuil.php'; // Rediriger après un délai
                });
            }

            document.addEventListener('DOMContentLoaded', showSweetAlert);
        </script>";
} else {
    echo "Erreur : " . $sql_update . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>