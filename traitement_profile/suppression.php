<?php

$id_admin = $_GET['id_admin'];

include('../bdd/connexion_bdd.php');

echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
echo "<script>
  function showSweetAlert() {
    Swal.fire({
      title: 'Êtes-vous sûr de vouloir supprimer cet administrateur ?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Confirmer',
      cancelButtonText: 'Annuler'
    }).then((result) => {
      if (result.isConfirmed) {
        // Rediriger vers le script de suppression PHP avec l'ID
        window.location.href = 'delete_admin.php?id_admin=$id_admin';
      } else if (result.dismiss === Swal.DismissReason.cancel) {
        Swal.fire({
          icon: 'info',
          title: 'Annulation de la suppression',
          showConfirmButton: false,
          timer: 1700
        }).then(function() {
          window.location.href = '../profile.php'; // Rediriger vers profiles.php après un délai
        });
      }
    });
  }

  document.addEventListener('DOMContentLoaded', showSweetAlert);
</script>";
?>