<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Profile - Brand</title>

    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
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
                        <ul class="navbar-nav flex-nowrap ms-auto">
                            <li class="nav-item dropdown d-sm-none no-arrow"><a class="dropdown-toggle nav-link"
                                    aria-expanded="false" data-bs-toggle="dropdown" href="#"><i
                                        class="fas fa-search"></i></a>
                                <div class="dropdown-menu dropdown-menu-end p-3 animated--grow-in"
                                    aria-labelledby="searchDropdown">
                                    <form class="me-auto navbar-search w-100">
                                        <div class="input-group"><input class="bg-light form-control border-0 small"
                                                type="text" placeholder="Search for ...">
                                            <div class="input-group-append"><button class="btn btn-primary py-0"
                                                    type="button"><i class="fas fa-search"></i></button></div>
                                        </div>
                                    </form>
                                </div>
                            </li>

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
                                            <a class="dropdown-item" href="index.php">
                                                <i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>&nbsp;Logout
                                            </a>
                                        </div>
                                    </div>';
                                }
                                ?>
                </nav>
                <div class="container-fluid">
                    <h3 class="text-dark mb-4">Liste des administrateurs<button id="openBtn" class="btn btn-primary"
                            style="font-size: 15px; margin-left: 560px">
                            <span
                                style="display: inline-block; width: 30px; height: 30px; border-radius: 50%; background-color: white; text-align: center; line-height: 30px;">
                                <i class="fas fa-plus" style="color: #5A5A5A;"></i>
                            </span>
                            Ajouter un nouvel Admin
                        </button></h3>
                    <div class="table-responsive table mt-2" id="dataTable" role="grid"
                        aria-describedby="dataTable_info">
                        <table class="table my-0" id="dataTable">
                            <?php
                            include('bdd/connexion_bdd.php');
                            $sql = "SELECT * FROM admin ";
                            $sql_admin = mysqli_query($conn, $sql);
                            if ($sql_admin->num_rows > 0) {
                                echo '<echo>
                                        <thead>
                                            <tr>
                                                <th>Username</th>
                                                <th>Password</th>
                                                <th>Modifier</th>
                                            </tr>
                                        </thead>
                                        <tbody>';

                                while ($row_admin = mysqli_fetch_assoc($sql_admin)) {
                                    echo "<tr>";
                                    echo "    <td>" . $row_admin['username'] . "</td>";
                                    echo "    <td>" . $row_admin['mdp'] . "</td>";
                                    echo '    <td>';
                                    echo '    <a href="traitement_profile/modification.php?id_admin=' . $row_admin['id_admin'] . '"><i class="fas fa-pencil-alt fa-lg text-yellow-500"></i></a>';
                                    echo '    <a href="traitement_profile/suppression.php?id_admin=' . $row_admin['id_admin'] . '"><i style="color: #FF5252;" class="fas fa-trash-alt fa-lg text-red-500"></i></a>';
                                    echo '    </td>';
                                    echo "</tr>";
                                }

                                echo '</tbody></table>';
                            }

                            ?>


                            </tbody>
                        </table>
                    </div>
                    <div class="card shadow mb-5"></div>
                </div>
            </div>

            <!--formulaire-->
            <div id="id01" class="w3-modal">
                <div style="width: 500px; border-radius: 10px;" class="w3-modal-content w3-animate-top w3-card-4">
                    <span id="closeBtn" class="w3-button w3-display-topright">&times;</span>
                    <div class="w3-container">
                        <form action="traitement_profile/ajout.php" method="POST">
                            <h2 class="w3-text-blue">Un nouvel administrateur</h2>
                            <p></p>
                            <p>
                                <input class="w3-input w3-border" id="nomi" name="username" type="text"
                                    placeholder="Username">
                            </p>
                            <p><br>
                                <input class="w3-input w3-border" id="pwd" name="mdp" type="text"
                                    placeholder="Mot de passe">
                            </p>
                            <p><br>
                                <button class="add w3-blue">Ajouter</button>
                            </p>
                        </form>
                        <br>
                    </div>
                </div>
            </div>

            <!--formulaire-->
            <!--modification-->


            <?php
            /*

                        $id_admin = $_POST['$id_admin'];

                        $conn = mysqli_connect("localhost", "root", "", "supercar");
                        $sql_admin = "SELECT * FROM admin WHERE id_admin = '$id_admin' ";
                        $admin = mysqli_query($conn, $sql_admin);
                        if ($admin->num_rows > 0) {
                            while ($row_admin = mysqli_fetch_assoc($admin)) {
                                # code...
                                echo '<div id="id02" class="w3-modal">
                                <div style="width: 500px; border-radius: 10px;" class="w3-modal-content w3-animate-top w3-card-4">
                                <span id="closeBtn" class="w3-button w3-display-topright">&times;</span>
                                <div class="w3-container">
                                    <form action="traitement_profile/ajout.php" method="POST">
                                        <h2 class="w3-text-blue">Un nouvel administrateur</h2>
                                        <p></p>
                                        <p>
                                            <input class="w3-input w3-border" id="nomi" name="username" type="text"
                                                placeholder=placeholder="' . $row_admin['username'] . '">
                                        </p>
                                        <p><br>
                                            <input class="w3-input w3-border" id="pwd" name="mdp" type="text"
                                                placeholder=placeholder="' . $row_admin['username'] . '">
                                        </p>
                                        <p><br>
                                            <button class="add w3-blue">Ajouter</button>
                                        </p>
                                    </form>
                                    <br>
                                </div>
                            </div>
                        </div>';

                            }
                        }*/
            ?>
            <!--modification-->


            <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span>Copyright © SuperCar 2023</span></div>
                </div>
            </footer>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <script>
        //Ajout//
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
</body>

</html>