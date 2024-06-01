<?php
if (isset($_GET['id_service'])) {
  $id_service = $_GET['id_service'];
  include('../bdd/connexion_bdd.php');
  $sql = "DELETE FROM service WHERE id_service = '$id_service' ";

  if ($conn->query($sql) === TRUE) {
    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
    echo "<script>
          function showSweetAlert() {
            Swal.fire({
              icon: 'success',
              title: 'Suppression service effectuée',
              showConfirmButton: false,
              timer: 1700
            }).then(function() {
              console.log('Redirection vers service.php');
              window.location.href = '../service.php'; 
            });
          }

          document.addEventListener('DOMContentLoaded', showSweetAlert);
        </script>";
  } else {
    echo 'Erreur lors de la suppression du service : ' . $conn->error;
  }
} else {
  // Gérer le cas où l'ID n'est pas spécifié correctement
  echo 'ID service non spécifié';
}
?>