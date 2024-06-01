<?php
if (isset($_GET['id_categorie'])) {
  $id_categorie = $_GET['id_categorie'];

  include('../bdd/connexion_bdd.php');


  // Récupérer le nom de la catégorie à supprimer
  $sql = "SELECT nom_categorie FROM voiture_categorie WHERE id_categorie = '$id_categorie'";
  $result = $conn->query($sql);
  $nom_categorie = $result->fetch_assoc()['nom_categorie'];

  // Supprimer la catégorie
  $sql = "DELETE FROM voiture_categorie WHERE id_categorie = '$id_categorie'";
  $conn->query($sql);

  // Supprimer les voitures de cette catégorie
  $sql = "DELETE FROM voiture WHERE voiture_type = '$nom_categorie'";
  $conn->query($sql);

  $conn->close();

  echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
  echo "<script>
      function showSweetAlert() {
        Swal.fire({
          icon: 'success',
          title: 'Suppression de la catégorie effectuée',
          showConfirmButton: false,
          timer: 1700
        }).then(function() {
          window.location.href = '../menu.php'; // Rediriger vers menu.php après un délai
        });
      }

      document.addEventListener('DOMContentLoaded', showSweetAlert);
    </script>";
} else {
  // Gérer le cas où l'ID n'est pas spécifié correctement
  echo 'ID de catégorie non spécifié';
}
?>