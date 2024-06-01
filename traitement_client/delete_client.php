<?php
if (isset($_GET['idco'])) {
  $idco = $_GET['idco'];
  include('../bdd/connexion_bdd.php');

  $sql = "DELETE FROM inscription WHERE idco = '$idco' ";

  if ($conn->query($sql) === TRUE) {
    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
    echo "<script>
          function showSweetAlert() {
            Swal.fire({
              icon: 'success',
              title: 'Suppression de client effectuée',
              showConfirmButton: false,
              timer: 1700
            }).then(function() {
              console.log('Redirection vers client.php');
              window.location.href = '../client.php'; 
            });
          }

          document.addEventListener('DOMContentLoaded', showSweetAlert);
        </script>";
  } else {
    echo 'Erreur lors de la suppression du client : ' . $conn->error;
  }
} else {
  // Gérer le cas où l'ID n'est pas spécifié correctement
  echo 'ID client non spécifié';
}
?>