<?php
if (isset($_GET['id_dmdessai'])) {
  $id_dmdessai = $_GET['id_dmdessai'];
  include('../bdd/connexion_bdd.php');
  // Supprimer la demande d'essai en fonction de l'ID
  $sql = "DELETE FROM dmdessai WHERE id_dmdessai = '$id_dmdessai'";
  $result = $conn->query($sql);

  if ($result === true) {
    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
    echo "<script>
          Swal.fire({
            icon: 'success',
            title: 'Suppression de la demande d\'essai effectuée',
            showConfirmButton: false,
            timer: 1700
          }).then(function() {
            window.location.href = '../dmdessai.php'; // Rediriger vers la liste des demandes d'essai après la suppression
          });
        </script>";
  } else {
    echo 'Erreur : ' . $conn->error;
  }

  $conn->close();
} else {
  // Gérer le cas où l'ID n'est pas spécifié correctement
  echo 'ID de demande d\'essai non spécifié';
}
?>