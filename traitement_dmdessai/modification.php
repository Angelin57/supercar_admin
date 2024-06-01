<?php
session_start();

$id_dmdessai = $_GET["id_dmdessai"];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Demande d'essai - Brand</title>
    <link rel="stylesheet" href="assets/bootstrap/css/styles.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />



</head>

<body id="page-top">
    <div id="wrapper">
        <?php
        include_once("../hd/header1.php")
            ?>
        <div style="margin-left: 220px; width: 100%; ">
            <div class="d-flex flex-column" id="content-wrapper">
                <div id="content">
                    <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                        <div class="container-fluid">
                            <form class="d-none d-sm-inline-block me-auto ms-md-3 my-2 my-md-0 mw-100 navbar-search">
                                <div class="input-group"><input class="bg-light form-control border-0 small" type="text"
                                        placeholder="Search for ..."><button class="btn btn-primary py-0"
                                        type="button"><i class="fas fa-search"></i></button></div>
                            </form>
                            <div class="d-none d-sm-block topbar-divider"></div>
                            <li class="nav-item dropdown no-arrow">

                                <?php
                                if (isset($_SESSION['username'])) {
                                    echo '<div class="nav-item dropdown no-arrow">
                                        <a class="dropdown-toggle nav-link" aria-expanded="false" data-bs-toggle="dropdown" href="#">
                                            <span class="d-none d-lg-inline me-2 text-gray-600 small">' . $_SESSION['username'] . '<i class="fas fa-user"></i></span>
                                        </a>
                                        <div class="dropdown-menu shadow dropdown-menu-end animated--grow-in">
                                            <a class="dropdown-item" href="#">
                                                <i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Profile
                                            </a>
                                            <a class="dropdown-item" href="#">
                                                <i class="fas fa-cogs fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Settings
                                            </a>
                                            <a class="dropdown-item" href="#">
                                                <i class="fas fa-list fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Activity log
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="../index.php">
                                                <i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout
                                            </a>
                                        </div>
                                    </div>';
                                }
                                ?>
                    </nav>
                    <div style="margin-left: 30px; width: 100%; ">

                        <div class="login-box">
                            <div class="form">
                                <u>
                                    <h2>Modification statut </h2>
                                </u>
                                <br>
                                <?php
                                include('../bdd/connexion_bdd.php');
                                $liste = "SELECT * FROM dmdessai WHERE id_dmdessai  = '$id_dmdessai' ";

                                $sql = mysqli_query($conn, $liste);

                                while ($row = mysqli_fetch_assoc($sql)) {
                                    # code...
                                    echo '<form class="login-form" action="traitement_modification.php" method="POST">
                                <div class="input-group">
                                <p>Statut:</p>
                                    <input type="text" name="statut" value="' . $row['statut'] . '" />
                                  
                                </div>
                            
                                <input type="hidden" value="' . $row['id_dmdessai'] . '" name="id_dmdessai">

                                <button type="submit">Enregistrer</button>
                            </form>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <br><br><br><br><br><br><br><br><br><br><br><br>

                    <footer class="bg-white sticky-footer">
                        <div class="container my-auto">
                            <div class="text-center my-auto copyright"><span>Copyright © SuperCar 2023</span></div>
                        </div>
                    </footer>
                </div>
                <a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
            </div>
        </div>
    </div>


    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>