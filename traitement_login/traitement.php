<?php
session_start();

include('../bdd/connexion_bdd.php');

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $mdp = $_POST['mdp'];

    // Utilisation de requêtes préparées pour éviter les injections SQL
    $stmt = $conn->prepare("SELECT * FROM admin WHERE username = ? AND mdp = ?");
    $stmt->bind_param("ss", $username, $mdp);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row = $result->fetch_assoc()) {
        $_SESSION['username'] = $row['username'];
        $_SESSION['mdp'] = $row['mdp'];

        // Appel de la procédure stockée pour enregistrer le log de connexion
        $stmt_log = $conn->prepare("CALL log_login(?)");
        $stmt_log->bind_param("s", $username);
        $stmt_log->execute();

        header("Location: ../acceuil.php");
        exit;
    } else {
        echo "<script>alert('Username ou mot de passe incorrect.')</script>";
        echo "<meta http-equiv='refresh' content='0;url=../login.php'>";
        exit;
    }
}
?>
