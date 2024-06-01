<?php

if (isset($_GET['id_admin'])) {
  $id_admin = $_GET['id_admin'];
  include('../bdd/connexion_bdd.php');
  $sql = "DELETE FROM admin WHERE id_admin = '$id_admin' ";

  $sql_client = $conn->query($sql);

  if ($sql_client == true) {
    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
    echo "<script>
          function showSweetAlert() {
            Swal.fire({
              icon: 'success',
              title: 'Suppression effectuée',
              showConfirmButton: false,
              timer: 1700
            }).then(function() {
              console.log('Redirection vers profile.php');
              window.location.href = '../profile.php'; 
            });
          }

          document.addEventListener('DOMContentLoaded', showSweetAlert);
        </script>";
  } else {
    echo 'erreur' . $sql . "<br>" . $conn->error;
  }
} else {
  // Gérer le cas où l'ID n'est pas spécifié correctement
  echo 'ID administrateur non spécifié';
}
?>