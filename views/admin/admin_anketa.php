<?php
    session_start();
    if(isset($_SESSION['korisnik']) && $_SESSION['korisnik']->naziv==='admin'):
        require_once("../../setup/konekcija.php"); 
        require_once("../../modules/anketa/functions.php"); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title> Admin - Anketa</title>
  <link rel="shortcut icon" href="../assets/images/favicon.ico" />
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/42bf19abdf.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> 
    <link href="../../assets/css/style.min.css" rel="stylesheet" type="text/css">
    <link href="../../assets/css/responsive.min.css" rel="stylesheet" type="text/css">
</head>
<body>

    <div class="container-fluid" id="headerAdmin">
        <div class="row col-lg-12">
            <nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
                <a class="navbar-brand col-lg-3  border-right border-dark " href="#">
                    <img src="../../assets/images/favicon.ico" width="40px" height="40px" class="d-inline-block align-middle " alt="logo">
                    Glow&Go
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <form class="form-inline my-2 col-lg-8">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                    </form>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item"> 
                            <i class="fas fa-user pt-1"></i>
                        </li>
                        <li class="nav-item dropdown">
                           
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Admin
                            </a>
                            <div class="dropdown-menu p-2" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="../../modules/logout.php">Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    
    </div>
    <div class="row col-lg-12 pl-0" id="sredinaAdmin">
            <div class="col-lg-3 pl-0" id="sidebarAdmin">
                <nav class="border-right border-bottom border-dark p-0 pt-3 text-center bg-secondary">
                    <ul class="nav d-flex flex-column justify-content-around">
                        <li class="nav-item">
                            <a class="nav-link border-bottom border-dark" href="../admin.php">
                            <i class="mdi mdi-home menu-icon"></i>
                            <span class="menu-titl text-white">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item border-bottom border-dark">
                            <a class="nav-link" href="admin_proizvodi.php">
                            <i class="mdi mdi-chart-pie menu-icon"></i>
                            <span class="menu-title text-white">Proizvodi</span>
                            </a>
                        </li>
                        <li class="nav-item border-bottom border-dark">
                            <a class="nav-link" href="admin_orders.php">
                            <i class="mdi mdi-chart-pie menu-icon"></i>
                            <span class="menu-title text-white">Porudzbine</span>
                            </a>
                        </li>
                        <li class="nav-item border-bottom border-dark">
                            <a class="nav-link" href="admin_brendovi.php">
                            <i class="mdi mdi-grid-large menu-icon"></i>
                            <span class="menu-title text-white">Brendovi</span>
                            </a>
                        </li>
                        <li class="nav-item border-bottom border-dark">
                            <a class="nav-link" href="admin_kat.php">
                            <i class="mdi mdi-emoticon menu-icon"></i>
                            <span class="menu-title text-white">Kategorije</span>
                            </a>
                        </li>
                        <li class="nav-item border-bottom border-dark">
                            <a class="nav-link" href="admin_users.php">
                            <span class="menu-title text-white">Korisnici</span>
                            </a>
                        </li>
                        <li class="nav-item border-bottom border-dark">
                            <a class="nav-link" href="#">
                            <i class="mdi mdi-emoticon menu-icon"></i>
                            <span class="menu-title text-white">Anketa</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="row col-lg-9 bg-light ml-auto" id="sadrzajAdmin">
                    <div class="row col-lg-12">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title  d-flex justify-content-between">Ankete<span></h4>
                                        <div class="row">
                                            <div class="col-md-7" id="anketaForma">
                                                <form method="POST" action="../../modules/ankete/aktiviranje.php">
                                                    <h3>Rezultati aktivnih anketa</h3>
                                                    <div class="form-group">
                                                        <select name='ddlAnketaRez' id='ddlAnketaRez' class=form-control>

                                                        </select>
                                                    </div>
                                                    <input type="button" value="Prikazi odgovore korisnika" name='btnRezAnkete'
                                                    id='btnRezAnkete' class='btn-primary'>
                                                    <input type="button" value="Prikazi brojno stanje" name='btnRezAnketeStanje'
                                                    id='btnRezAnketeStanje' class='btn-primary'>&nbsp;
                                                    <div id="rezAnketeAdmin">
                                                         <!-- rezultati ankete -->
                                                    </div>
                                                   
                                                    <div id="rezAnketeAdminStanje">
                                                         <!-- rezultati ankete -->
                                                    </div>
                                                </form>
                                            </div>
                                    </div> 
                                <?php endif;?>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        </div>

    <!-- JS  -->
    <script src="../../assets/js/jquery-3.4.1.min.js"></script>
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>   
    <script src="../../assets/js/anketa.js" type="text/javascript" ></script>  
</body>
</html>