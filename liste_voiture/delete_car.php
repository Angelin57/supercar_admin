<?php
if (isset($_GET['id_voiture'])) {
  $id_voiture = $_GET['id_voiture'];

  include('../bdd/connexion_bdd.php');

  $sql_delete_images = "DELETE FROM image_voiture WHERE id_voiture = '$id_voiture' ";
  $sql_delete_car = "DELETE FROM voiture WHERE id_voiture = '$id_voiture' ";

  if ($conn->query($sql_delete_images) === TRUE && $conn->query($sql_delete_car) === TRUE) {
    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
    echo "<script>
          function showSweetAlert() {
            Swal.fire({
              icon: 'success',
              title: 'Suppression effectuée',
              showConfirmButton: false,
              timer: 1700
            }).then(function() {
              console.log('Redirection vers menu.php');
              window.location.href = '../menu.php'; 
            });
          }

          document.addEventListener('DOMContentLoaded', showSweetAlert);
        </script>";
  } else {
    echo 'Erreur lors de la suppression de la voiture : ' . $conn->error;
  }
} else {
  // Gérer le cas où l'ID n'est pas spécifié correctement
  echo 'ID de voiture non spécifié';
}
?>