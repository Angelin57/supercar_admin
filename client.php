<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Client - Brand</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i&amp;display=swap">
    <link rel="stylesheet" href="assets/fonts/fontawesome-all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.js"></script>



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
                    <h3 class="text-dark mb-4">Clients inscrits&nbsp;</h3>
                    <div class="card shadow">

                        <div class="card-body">
                            <div class="row">

                            </div>
                            <div class="table-responsive table mt-2" id="dataTable" role="grid"
                                aria-describedby="dataTable_info">
                                <table class="table my-0" id="dataTable">
                                    <?php
                                    include('bdd/connexion_bdd.php');
                                    $sql = "SELECT * FROM inscription ";
                                    $sql_client = mysqli_query($conn, $sql);
                                    if ($sql_client->num_rows > 0) {
                                        # code...                        
                                        echo '<echo>
                                        <thead>
                                            <tr>
                                                <th>Prenom</th>
                                                <th>Nom</th>
                                                <th>Mail</th>
                                                <th>Telephone</th>
                                                <th>Adresse</th>
                                                <th>Naissance</th>
                                                <th>Sexe</th>
                                                <th>Password</th>
                                                <th>Modifier</th>
                                            </tr>
                                        </thead></echo>';
                                        while ($row_client = mysqli_fetch_assoc($sql_client)) {
                                            # code...
                                            echo '<tbody>
                                                <tr>
                                                    <td>' . $row_client['nom'] . '</td>
                                                    <td>' . $row_client['prenom'] . '</td>
                                                    <td>' . $row_client['mail'] . '</td>
                                                    <td>' . $row_client['telephone'] . '</td>
                                                    <td>' . $row_client['adresse'] . '</td>
                                                    <td>' . $row_client['naissance'] . '</td>
                                                    <td>' . $row_client['sexe'] . '</td>
                                                    <td>' . $row_client['password'] . '</td>
                                                    <td>
                                                  

                                                    <a href="traitement_client/suppression.php?idco=' . $row_client['idco'] . '">
                                                    <i style="color: #FF5252;" class="fas fa-trash-alt fa-lg text-red-500"></i>
                                                    
                                                     
                                                    </td>
                                                </tr>';
                                        }
                                    }
                                    ?>


                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-6 align-self-center">
                                    <p id="dataTable_info" class="dataTables_info" role="status" aria-live="polite">
                                        Showing 1 to 10 of 27</p>
                                </div>
                                <div class="col-md-6">
                                    <nav
                                        class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
                                        <ul class="pagination">
                                            <li class="page-item disabled"><a class="page-link" aria-label="Previous"
                                                    href="#"><span aria-hidden="true">«</span></a></li>
                                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                                            <li class="page-item"><a class="page-link" aria-label="Next" href="#"><span
                                                        aria-hidden="true">»</span></a></li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright"><span>Copyright © SuperCar 2023</span></div>
                </div>
            </footer>
        </div><a class="border rounded d-inline scroll-to-top" href="#page-top"><i class="fas fa-angle-up"></i></a>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.1.5/dist/sweetalert2.min.js"></script>
    <script src="assets/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/js/theme.js"></script>
</body>

</html>