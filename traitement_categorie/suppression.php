<?php

$id_categorie = $_GET['id_categorie'];

include('../bdd/connexion_bdd.php');


echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
echo "<script>
  function showSweetAlert() {
    Swal.fire({
      title: 'Êtes-vous sûr de vouloir supprimer cette catégorie de voitures ?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Confirmer',
      cancelButtonText: 'Annuler'
    }).then((result) => {
      if (result.isConfirmed) {
        // Rediriger vers le script de suppression de catégorie PHP avec l'ID
        window.location.href = 'delete_categorie.php?id_categorie=$id_categorie';
      } else if (result.dismiss === Swal.DismissReason.cancel) {
        Swal.fire({
          icon: 'info',
          title: 'Annulation de la suppression',
          showConfirmButton: false,
          timer: 1700
        }).then(function() {
          window.location.href = '../menu.php'; // Rediriger vers menu.php après un délai
        });
      }
    });
  }

  document.addEventListener('DOMContentLoaded', showSweetAlert);
</script>";
?>