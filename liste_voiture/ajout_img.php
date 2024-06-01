<?php
if (isset($_POST['submit'])) {
    // Vérifiez si des fichiers ont été téléchargés
    if (!empty($_FILES['image']['name'][0])) {
        // Définissez le dossier de destination pour les images téléchargées
        $uploadDir = '../../SUPERCAR/img/voitures/';

        // Connexion à la base de données (personnalisez les informations de connexion)
        include('../bdd/connexion_bdd.php');
        // Parcourez chaque fichier téléchargé
        foreach ($_FILES['image']['name'] as $key => $fileName) {
            $fileTmpName = $_FILES['image']['tmp_name'][$key];

            // Générez un nom de fichier unique pour éviter les conflits
            $uniqueFileName = uniqid() . '_' . $fileName;

            // Construisez le chemin complet du fichier
            $uploadPath = $uploadDir . $uniqueFileName;

            // Déplacez le fichier téléchargé vers le dossier de destination
            if (move_uploaded_file($fileTmpName, $uploadPath)) {
                // Le fichier a été téléchargé avec succès
                // Maintenant, vous pouvez enregistrer le lien de l'image dans la base de données
                $imageUrl = '../../SUPERCAR/img/voitures/' . $uniqueFileName;

                // Insertion du lien de l'image dans la base de données
                $sql = "INSERT INTO image_voiture (sre) VALUES ('$imageUrl')";

            } else {
                echo "Une erreur est survenue lors de l'envoi de l'image $fileName.<br>";
            }
        }

        // Fermeture de la connexion à la base de données
        $conn->close();
    } else {
        echo "Aucun fichier n'a été téléchargé.";
    }
}
?>