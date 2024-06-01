<?php
session_start();

$id_voiture = $_GET["id_voiture"];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Dashboard - Brand</title>
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
                    <div style="margin-left: 180px; ">
                        <div class="login-box">
                            <div class="form">
                                <u>
                                    <h2>Modification voiture </h2>
                                </u>
                                <br>
                                <?php
                                include('../bdd/connexion_bdd.php');
                                $liste = "SELECT * FROM voiture WHERE id_voiture  = '$id_voiture' ";

                                $sql = mysqli_query($conn, $liste);

                                while ($row = mysqli_fetch_assoc($sql)) {
                                    # code...
                                    echo '<form class="login-form" action="traitement_modifier.php" method="POST" enctype="multipart/form-data">
                                <div class="input-group">
                                    <input type="text" placeholder="Marque" required name="voiture_marque" value="' . $row['voiture_marque'] . '" />
                                    <input type="text" placeholder="Nom" required name="voiture_name" value="' . $row['voiture_name'] . '" />
                                </div>
                                <div class="input-group">
                                    <input type="text" placeholder="Boîte" required name="voiture_transmission" value="' . $row['voiture_transmission'] . '" />
                                    <input type="text" placeholder="Carburant" required name="voiture_carburant" value="' . $row['voiture_carburant'] . '" />
                                </div>
                                <div class="input-group">
                                    <input type="text" placeholder="Type" required name="voiture_type" value="' . $row['voiture_type'] . '" />
                                    <input type="text" placeholder="Kilometrages" required name="voiture_km" value="' . $row['voiture_km'] . '" />
                                </div>
                                <div class="input-group">
                                    <input type="text" placeholder="Puissance" required name="voiture_puissance" value="' . $row['voiture_puissance'] . '" />
                                    <input type="text" placeholder="Année" required name="voiture_annee" value="' . $row['voiture_annee'] . '" />
                                </div>
                                <div class="input-group">
                                    <input type="text" placeholder="Prix" required name="voiture_prix" value="' . $row['voiture_prix'] . '" />
                                    <input type="text" placeholder="Provenances" required name="provenance" value="' . $row['provenance'] . '" />
                                </div>
                                
                                <input type="file" name="voiture_image[]" accept="image/*" multiple>
                                <input type="hidden" value="' . $row['id_voiture'] . '" name="id_voiture">

                                <button type="submit">Enregistrer</button>
                            </form>';
                                }




                                ?>
                            </div>
                        </div>
                    </div>
                    <footer class="bg-white sticky-footer">
                        <div class="container my-auto">
                            <div class="text-center my-auto copyright"><span>Copyright © SuperCar 2023</span></div>
                        </div>
                    </footer>

                    <a class="border rounded d-inline scroll-to-top" href="#page-top"><i
                            class="fas fa-angle-up"></i></a>
                </div>
            </div>
        </div>



        <script src="assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/js/theme.js"></script>
</body>

</html>