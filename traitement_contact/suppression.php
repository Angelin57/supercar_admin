<?php
$id_contact = $_GET['id_contact'];

include('../bdd/connexion_bdd.php');

echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
echo "<script>
  function showSweetAlert() {
    Swal.fire({
      title: 'Êtes-vous sûr de vouloir supprimer ce contact ?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Confirmer',
      cancelButtonText: 'Annuler'
    }).then((result) => {
      if (result.isConfirmed) {
        // Rediriger vers le script de suppression PHP avec l'ID
        window.location.href = 'delete_contact.php?id_contact=$id_contact';
      } else if (result.dismiss === Swal.DismissReason.cancel) {
        Swal.fire({
          icon: 'info',
          title: 'Annulation de la suppression',
          showConfirmButton: false,
          timer: 1700
        }).then(function() {
          window.location.href = '../contact.php'; // Rediriger vers contact.php après un délai
        });
      }
    });
  }

  document.addEventListener('DOMContentLoaded', showSweetAlert);
</script>";
?>