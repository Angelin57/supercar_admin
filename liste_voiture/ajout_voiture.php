<?php
include('../bdd/connexion_bdd.php');


if ($_SERVER["REQUEST_METHOD"] == "POST") {
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

    // Code pour l'envoi des images
    if (!empty($_FILES['image']['name'][0])) {
        $uploadDir = '../../SUPERCAR/img/voitures/';

        $success = true; // Variable pour vérifier si tout s'est bien passé

        // Code pour insérer la voiture et obtenir son ID
        $sql_insert_voiture = "INSERT INTO voiture (voiture_marque, voiture_name, voiture_annee, voiture_transmission, voiture_carburant, voiture_type,
            voiture_km, voiture_puissance, voiture_prix, provenance) 
            VALUES ('$voiture_marque', '$voiture_name', '$voiture_annee', '$voiture_transmission', '$voiture_carburant', '$voiture_type',
            '$voiture_km', '$voiture_puissance','$voiture_prix', '$provenance')";

        if ($conn->query($sql_insert_voiture) == true) {
            // Récupérer l'ID de la voiture insérée
            $voiture_id = mysqli_insert_id($conn);

            foreach ($_FILES['image']['name'] as $key => $fileName) {
                $fileTmpName = $_FILES['image']['tmp_name'][$key];
                $uniqueFileName = uniqid() . '_' . $fileName;
                $uploadPath = $uploadDir . $uniqueFileName;

                if (move_uploaded_file($fileTmpName, $uploadPath)) {
                    $imageUrl = 'img/voitures/' . $uniqueFileName;

                    // Insérer le lien de l'image dans la base de données avec l'ID de la voiture
                    $sql_insert_image = "INSERT INTO image_voiture (id_voiture, sre) VALUES ('$voiture_id', '$imageUrl')";
                    if ($conn->query($sql_insert_image) !== TRUE) {
                        echo "Erreur lors de l'enregistrement du lien de l'image $fileName dans la base de données : " . $conn->error;
                        $success = false;
                    }
                } else {
                    echo "Une erreur est survenue lors de l'envoi de l'image $fileName.";
                    $success = false;
                }
            }

            if ($success) {
                echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
                echo "<script>
            function showSweetAlert() {
                Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'Ajout voiture effectué',
                    showConfirmButton: false,
                    timer: 1700
                }).then(function() {
                    window.location.href = '../menu.php'; // Rediriger après un délai
                });
            }

            document.addEventListener('DOMContentLoaded', showSweetAlert);
        </script>";
            }
        } else {
            echo "Erreur lors de l'insertion de la voiture : " . $conn->error;
        }
    } else {
        echo "Aucun fichier n'a été téléchargé."; // Message déplacé à l'extérieur du bloc if
    }
}
?>