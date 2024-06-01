<?php
if (isset($_GET['id_dmdessai'])) {
  $id_dmdessai = $_GET['id_dmdessai'];
  include('../bdd/connexion_bdd.php');

  // Supprimer la demande d'essai en fonction de l'ID
  $sql = "DELETE FROM dmdessai WHERE id_dmdessai = '$id_dmdessai'";
  $result = $conn->query($sql);

  if ($result === true && $conn->affected_rows > 0) {
    // Succès de la suppression

    echo '<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>';
    echo '<script>';
    echo 'Swal.fire({
      position: "center",
      icon: "success",
      title: "Suppression demande d\'essai effectuée",
      showConfirmButton: false,
      timer: 1700
    }).then(function () {
      window.location.href = "../dmdessai.php"; // Rediriger après un délai
    });';
    echo '</script>';


  } else {
    // Erreur
    echo 'Erreur : ' . $conn->error;
  }

  $conn->close();
} else {
  // Gérer le cas où l'ID n'est pas spécifié correctement
  echo 'ID de demande d\'essai non spécifié';
}
?>