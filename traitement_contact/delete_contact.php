<?php
if (isset($_GET['id_contact'])) {
  $id_contact = $_GET['id_contact'];

  include('../bdd/connexion_bdd.php');
  $sql = "DELETE FROM contact WHERE id_contact = '$id_contact' ";

  if ($conn->query($sql) === TRUE) {
    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
    echo "<script>
          function showSweetAlert() {
            Swal.fire({
              icon: 'success',
              title: 'Suppression contact seffectuée',
              showConfirmButton: false,
              timer: 1700
            }).then(function() {
              console.log('Redirection vers contact.php');
              window.location.href = '../contact.php'; 
            });
          }

          document.addEventListener('DOMContentLoaded', showSweetAlert);
        </script>";
  } else {
    echo 'Erreur lors de la suppression du contact : ' . $conn->error;
  }

  $conn->close();
} else {
  // Gérer le cas où l'ID n'est pas spécifié correctement
  echo 'ID contact non spécifié';
}
?>