<?php
session_start();

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

</head>

<body id="page-top">
    <div id="wrapper">
        <?php
        include_once("hd/header.php")
            ?>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid"><button class="btn btn-link d-md-none rounded-circle me-3"
                            id="sidebarToggleTop" type="button"><i class="fas fa-bars"></i></button>
                        <form class="d-none d-sm-inline-block me-auto ms-md-3 my-2 my-md-0 mw-100 navbar-search"
                            action="recherche/resultat_voiture.php" method="GET">
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
                                            <span class="d-none d-lg-inline me-2 text-gray-600 small">' . $_SESSION['username'] . '<i class="fas fa-user"></i>
                                            </span>
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
                                            <a class="dropdown-item" href="index.php">
                                                <i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout
                                            </a>
                                        </div>
                                    </div>';
                            }
                            ?>


                </nav>

                <div class="container-fluid">
                    <div class="d-sm-flex justify-content-between align-items-center mb-4">
                        <h3 class="text-dark mb-0">Liste du categorie voitures<button id="openBtn"
                                class="btn btn-primary" style="font-size: 15px; margin-left: 560px">
                                <span
                                    style="display: inline-block; width: 30px; height: 30px; border-radius: 50%; background-color: white; text-align: center; line-height: 30px;">
                                    <i class="fas fa-plus" style="color: #5A5A5A;"></i>
                                </span>
                                Ajouter une nouvelle categorie</button></h3>

                    </div>

                    <div class="row">

                        <?php
                        include('bdd/connexion_bdd.php');
                        $sql_categorie = "SELECT * FROM voiture_categorie";
                        $detail = mysqli_query($conn, $sql_categorie);
                        if ($detail->num_rows > 0) {
                            while ($row_voiture = mysqli_fetch_assoc($detail)) {
                                echo '<div class="col-md-6 col-xl-3 mb-4">';
                                echo '    <div class="card shadow border-start-primary py-2">';
                                echo '        <div class="card-body">';
                                echo '            <div class="row align-items-center no-gutters">';
                                echo '                <div class="col me-2">';
                                echo '                    <form action="liste_voiture/liste.php" method="post">';
                                echo '                        <div class="text-uppercase text-primary fw-bold text-xs mb-1 d-flex justify-content-between align-items-center">';
                                echo '                            <span>' . $row_voiture['nom_categorie'] . '</span>';
                                echo '                        </div>';
                                echo '                        <input type="submit" class="btn btn-primary px-3" value="Voir plus de détail">';
                                echo '                        <input type="hidden" value="' . $row_voiture['nom_categorie'] . '" name="categorie">';
                                echo '<a href="traitement_categorie/suppression.php?id_categorie=' . $row_voiture['id_categorie'] . '"><i style="color: #FF5252;" class="fas fa-trash-alt fa-lg text-red-500"></i></a>';
                                echo '                    </form>';
                                echo '                </div>';
                                echo '                <div class="col-auto"><i class="fas fa-car-side fa-2x text-gray-300"></i></div>';
                                echo '            </div>';
                                echo '        </div>';
                                echo '    </div>';
                                echo '</div>';

                            }
                        }
                        ?>

                    </div>
                </div>
            </div>

            <!--formulaire-->
            <div id="id01" class="w3-modal">
                <div style="width: 500px; border-radius: 10px;" class="w3-modal-content w3-animate-top w3-card-4">
                    <span id="closeBtn" class="w3-button w3-display-topright">&times;</span>
                    <div class="w3-container">
                        <form action="traitement_categorie/ajout.php" method="POST">
                            <center>
                                <h2 class="w3-text-blue">Un nouvel categorie</h2>
                                <br>
                                <p>
                                    <input class="w3-input w3-border" id="nomi" name="nom_categorie" type="text"
                                        placeholder="Nom du categorie">
                                </p>
                                <br><br>
                                <button class="add w3-blue" style='width:120px ; height:60px'>Ajouter</button>
                                </p>
                            </center>
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
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <script>
        var openBtn = document.getElementById('openBtn');
        var modal = document.getElementById('id01');
        var closeBtn = document.getElementById('closeBtn');

        openBtn.addEventListener('click', function () {
            modal.style.display = 'block';
        });

        closeBtn.addEventListener('click', function () {
            modal.style.display = 'none';
        });
    </script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/theme.js"></script>
    <script>
        function afficherHeure() {
            var date = new Date();
            var heure = date.getHours();
            var minutes = date.getMinutes();
            var secondes = date.getSeconds();

            // Ajout d'un zéro devant les chiffres < 10 pour une meilleure lisibilité
            heure = heure < 10 ? "0" + heure : heure;
            minutes = minutes < 10 ? "0" + minutes : minutes;
            secondes = secondes < 10 ? "0" + secondes : secondes;

            var heureActuelle = heure + ":" + minutes + ":" + secondes;

            // Affichage de l'heure dans l'élément avec l'ID "heure"
            document.getElementById("heure").innerHTML = heureActuelle;

            // Actualisation de l'heure toutes les secondes
            setTimeout(afficherHeure, 1000);
        }

        // Appel de la fonction afficherHeure au chargement de la page
        window.onload = afficherHeure;
    </script>


</body>

</html>