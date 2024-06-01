<?php
$id_voiture = $_POST["id_voiture"];
$voiture_marque = $_POST["voiture_marque"];
$voiture_name = $_POST["voiture_name"];
$voiture_annee = $_POST["voiture_annee"];
$voiture_transmission = $_POST["voiture_transmission"];
$voiture_carburant = $_POST["voiture_carburant"];
$voiture_type = $_POST["voiture_type"];
$voiture_km = $_POST["voiture_km"];
$voiture_puissance = $_POST["voiture_puissance"];
$voiture_prix = $_POST["voiture_prix"];
$provenance = $_POST["provenance"];

include('../bdd/connexion_bdd.php');

// Mettre à jour les informations de base de la voiture
$sql_update = "UPDATE voiture SET 
    voiture_marque= '$voiture_marque',
    voiture_name='$voiture_name',
    voiture_annee = $voiture_annee,
    voiture_transmission ='$voiture_transmission' ,
    voiture_carburant ='$voiture_carburant',
    voiture_type = '$voiture_type',
    voiture_km ='$voiture_km',
    voiture_puissance = '$voiture_puissance',
    voiture_prix ='$voiture_prix',
    provenance = '$provenance'
    WHERE id_voiture = $id_voiture";

if (!mysqli_query($conn, $sql_update)) {
    echo "Erreur : " . $sql_update . "<br>" . mysqli_error($conn);
} else {
    // Vérifiez si des fichiers d'images ont été soumis
    if (!empty($_FILES['voiture_image']['name'][0])) {
        // Supprimez toutes les anciennes images liées à cette voiture
        $sql_delete_images = "DELETE FROM image_voiture WHERE id_voiture = $id_voiture";
        if (!mysqli_query($conn, $sql_delete_images)) {
            echo "Erreur lors de la suppression des anciennes images : " . mysqli_error($conn);
        }

        // Gérez la mise à jour des nouvelles images
        $uploadDir = '../../SUPERCAR/img/voitures/';

        foreach ($_FILES['voiture_image']['name'] as $key => $fileName) {
            $fileTmpName = $_FILES['voiture_image']['tmp_name'][$key];
            $uniqueFileName = uniqid() . '_' . $fileName;
            $uploadPath = $uploadDir . $uniqueFileName;

            if (move_uploaded_file($fileTmpName, $uploadPath)) {
                $imageUrl = 'img/voitures/' . $uniqueFileName;

                // Insérez le lien de la nouvelle image
                $sql_insert_image = "INSERT INTO image_voiture (id_voiture, sre) VALUES ('$id_voiture', '$imageUrl')";

                if (!mysqli_query($conn, $sql_insert_image)) {
                    echo "Erreur lors de l'insertion de l'image $fileName : " . mysqli_error($conn);
                }
            } else {
                echo "Une erreur est survenue lors de l'envoi de l'image $fileName : " . mysqli_error($conn);
            }
        }
    }

    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
    echo "<script>
        function showSweetAlert() {
            Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Modification réussie',
                showConfirmButton: false,
                timer: 1700
            }).then(function() {
                window.location.href = '../menu.php'; // Rediriger après un délai
            });
        }

        document.addEventListener('DOMContentLoaded', showSweetAlert);
    </script>";
}

mysqli_close($conn);

?>