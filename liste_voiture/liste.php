<?php
session_start();
$categorie = $_POST['categorie'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Dashboard - Brand</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
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
        <div style="margin-left: 220px;">
            <div class="d-flex flex-column" id="content-wrapper">
                <div id="content">
                    <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                        <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle me-3"
                                id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                            <form class="d-none d-sm-inline-block me-auto ms-md-3 my-2 my-md-0 mw-100 navbar-search"
                                action="../recherche/resultat_voiture.php" method="GET">
                                <div class="input-group">
                                    <input class="bg-light form-control border-0 small" type="text" name="query"
                                        placeholder="Search for ..." required>
                                    <button class="btn btn-primary py-0" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </form>
                            <p id="dateHeure"></p>
                            <script>
                                function afficherDateHeure() {
                                    const maintenant = new Date();
                                    const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric', hour: '2-digit', minute: '2-digit', second: '2-digit' };
                                    const dateHeure = maintenant.toLocaleDateString('fr-FR', options);
                                    document.getElementById('dateHeure').textContent = dateHeure;
                                }

                                afficherDateHeure();
                                setInterval(afficherDateHeure, 1000); // Met à jour la date et l'heure chaque seconde
                            </script>
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
                    <div style="margin-left: 10px;">
                        <div class="container">
                            <h2>Tout les voitures avec ses détails <button id="openBtn" class="btn btn-primary"
                                    style="font-size: 15px; margin-left: 560px">
                                    <span
                                        style="display: inline-block; width: 30px; height: 30px; border-radius: 50%; background-color: white; text-align: center; line-height: 30px;">
                                        <i class="fas fa-plus" style="color: #5A5A5A;"></i>
                                    </span>
                                    Ajouter une nouvelle voiture</button></h2>
                            <?php
                            include('../bdd/connexion_bdd.php');
                            $categorie = mysqli_real_escape_string($conn, $_POST['categorie']);

                            $liste = "SELECT voiture.*, GROUP_CONCAT(image_voiture.sre) AS images
                            FROM voiture
                            INNER JOIN image_voiture ON voiture.id_voiture = image_voiture.id_voiture
                            WHERE voiture_type = '$categorie'
                            GROUP BY voiture.id_voiture";

                            $sql = mysqli_query($conn, $liste);

                            if ($sql) {
                                echo '<ul class="responsive-table">';
                                echo '    <li class="table-header">';
                                echo '        <div class="col col-0.5" style="color: white; margin-left: 20px;">Marque</div>';
                                echo '        <div class="col col-0.5" style="color: white; margin-left: 20px;">Nom</div>';
                                echo '        <div class="col col-0.5" style="color: white; margin-left: 20px;">Boîte</div>';
                                echo '        <div class="col col-0.5" style="color: white; margin-left: 20px;">Carburant</div>';
                                echo '        <div class="col col-0.5" style="color: white; margin-left: 20px;">Type</div>';
                                echo '        <div class="col col-0.5" style="color: white; margin-left: 20px;">Km</div>';
                                echo '        <div class="col col-0.5" style="color: white; margin-left: 20px;">Puissance</div>';
                                echo '        <div class="col col-0.5" style="color: white; margin-left: 20px;">Année</div>';
                                echo '        <div class="col col-0.5" style="color: white; margin-left: 20px;">Prix</div>';
                                echo '        <div class="col col-0.5" style="color: white; margin-left: 20px;">Provenance</div>';
                                echo '        <div class="col col-0.5" style="color: white; margin-left: 20px;">Images</div>';
                                echo '        <div class="col col-0.5" style="color: white; margin-left: 20px;">Modifier</div>';
                                echo '    </li>';

                                while ($row = mysqli_fetch_assoc($sql)) {
                                    echo '    <li class="table-row">';
                                    echo '        <div class="col col-0.5" data-label="Marque" style=" margin-right: 5px;">' . $row['voiture_marque'] . '</div>';
                                    echo '        <div class="col col-0.5" data-label="Nom">' . $row['voiture_name'] . '</div>';
                                    echo '        <div class="col col-0.5" data-label="Boîte" style=" margin-right: 5px;">' . $row['voiture_transmission'] . '</div>';
                                    echo '        <div class="col col-0.5" data-label="Carburant">' . $row['voiture_carburant'] . '</div>';
                                    echo '        <div class="col col-0.5" data-label="Type">' . $row['voiture_type'] . '</div>';
                                    echo '        <div class="col col-0.5" data-label="Kilometrage">' . $row['voiture_km'] . '</div>';
                                    echo '        <div class="col col-0.5" data-label="Puissance">' . $row['voiture_puissance'] . '</div>';
                                    echo '        <div class="col col-0.5" data-label="Année">' . $row['voiture_annee'] . '</div>';
                                    echo '        <div class="col col-0.5" data-label="Prix">' . $row['voiture_prix'] . '</div>';
                                    echo '        <div class="col col-0.5" data-label="Provenance">' . $row['provenance'] . '</div>';
                                    echo '        <div class="col col-0.5" data-label="Images">' . $row['images'] . '</div>';
                                    echo '        <div class="col col-0.5" data-label="Edit" style="margin-left: 20px;">';
                                    echo '            <a href="modification.php?id_voiture=' . $row['id_voiture'] . '" ><i class="fas fa-pencil-alt fa-lg text-yellow-500"></i></a> &nbsp';
                                    echo '            <a href="traitement_suprimer.php?id_voiture=' . $row['id_voiture'] . '"><i style="color: #FF5252;" class="fas fa-trash-alt fa-lg text-red-500"></i></a>';
                                    echo '        </div>';
                                    echo '    </li>';
                                }

                                echo '</ul>';
                            }

                            mysqli_close($conn);
                            ?>





                        </div>
                    </div>

                    <!--formulaire ajout-->
                    <div id="id01" class="w3-modal">
                        <div style="width: 500px; border-radius: 10px;"
                            class="w3-modal-content w3-animate-top w3-card-4">
                            <span id="closeBtn" class="w3-button w3-display-topright">&times;</span>
                            <div class="w3-container">
                                <form action="ajout_voiture.php" method="POST" enctype="multipart/form-data">
                                    <h2 class="w3-text-blue">Un nouvel voiture</h2>
                                    <p></p>
                                    <p>
                                        <input class="w3-input w3-border" id="nomi" name="voiture_marque" type="text"
                                            placeholder="Marque">

                                        <input class="w3-input w3-border" id="pwd" name="voiture_name" type="text"
                                            placeholder="Modèle">
                                    </p>
                                    <p>
                                        <input class="w3-input w3-border" id="nomi" name="voiture_annee" type="text"
                                            placeholder="Année">

                                        <input class="w3-input w3-border" id="pwd" name="voiture_transmission"
                                            type="text" placeholder="Boîte de vitesse">
                                    </p>
                                    <p>
                                        <input class="w3-input w3-border" id="nomi" name="voiture_carburant" type="text"
                                            placeholder="Carburant">

                                        <input class="w3-input w3-border" id="pwd" name="voiture_type" type="text"
                                            placeholder="Type">
                                    </p>
                                    <p>
                                        <input class="w3-input w3-border" id="nomi" name="voiture_km" type="text"
                                            placeholder="Kilometrage">

                                        <input class="w3-input w3-border" id="pwd" name="voiture_puissance" type="text"
                                            placeholder="Puissance">
                                    </p>

                                    <p>
                                        <input class="w3-input w3-border" id="nomi" name="voiture_prix" type="text"
                                            placeholder="Prix">

                                        <input class="w3-input w3-border" id="pwd" name="provenance" type="text"
                                            placeholder="Provenance">
                                    </p>

                                    <input type="file" name="image[]" accept="image/*" multiple required>

                                    <p><br>
                                        <button class="add w3-blue">Ajouter</button>
                                    </p>
                                </form>
                                <br>
                            </div>
                        </div>
                    </div>
                    <!--formulaire-->



                    <footer class="bg-white sticky-footer">
                        <div class="container my-auto">
                            <div class="text-center my-auto copyright"><span>Copyright © SuperCar 2023</span></div>
                        </div>
                    </footer>
                </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i
                        class="fas fa-angle-up"></i></a>
            </div>
        </div>
    </div>

    <script>
        //pop up ajout//
        // Pour la première pop-up
        var openBtn = document.getElementById('openBtn');
        var modal1 = document.getElementById('id01'); // Utilisez 'modal1' au lieu de 'modal'
        var closeBtn = document.getElementById('closeBtn');

        openBtn.addEventListener('click', function () {
            modal1.style.display = 'block';
        });

        closeBtn.addEventListener('click', function () {
            modal1.style.display = 'none';
        });



    </script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/theme.js"></script>

</body>

</html>