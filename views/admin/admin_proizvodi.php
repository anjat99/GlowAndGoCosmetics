<?php
    session_start();
    if(isset($_SESSION['korisnik']) && $_SESSION['korisnik']->naziv==='admin'):
        require_once("../../setup/konekcija.php"); 
        require_once("../../modules/proizvodi/functions.php"); 
        $upit = "SELECT COUNT(*) as broj from proizvodi";
        $obj = $konekcija->query($upit)->fetch();
        $poStrani = 3;
        $brojLink = ceil($obj->broj/$poStrani);
        $strana = isset($_GET['page']) ? $_GET['page'] : 1;
        $od = $poStrani*($strana-1);
        $upit = "SELECT p.*, s.putanja AS velika_putanja, t.putanja as mala_putanja, s.alt as velika_alt, t.alt as mala_alt, k.naziv as nazivKat, b.naziv as nazivBrend FROM proizvodi p inner join slike s  ON s.idProizvod = p.idProizvod inner join slike_thumbnail t  ON t.idProizvod = p.idProizvod inner join kategorije k  ON k.idKategorija = p.kat_id inner join brendovi b  ON b.idBrend = p.brend_id LIMIT $od, $poStrani;";
        $proizvodi= $konekcija->query($upit)->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title> Admin - Proizvodi</title>
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
                    LifeOfBeauty
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
                            <a class="nav-link" href="#">
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
                            <a class="nav-link" href="admin_anketa.php">
                            <i class="mdi mdi-emoticon menu-icon"></i>
                            <span class="menu-title text-white">Anketa</span>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
            <div class="row col-lg-9 bg-light ml-auto" id="sadrzajAdmin">
                    <div class="row">
                        <div>
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title d-flex justify-content-between">Proizvodi<span>
                                    <input type="button" value="Dodaj" id='dodajProizvod'class='btnAdminUpdate btn-primary col-lg-12'>
                                    </span></h4>
                                    
                                        <div class="table-responsive" id="tabelaProizvodi">
                                            <table class="korpa table table-striped" border="1">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th>Slika</th>
                                                        <th>Naziv</th>
                                                        <th>Cena</th>
                                                        <th>Stara cena</th>
                                                        <th>Ukupna kolicina</th>
                                                        <th>Kategorija</th>
                                                        <th>Brend</th>
                                                        <th>Izmeni</th>
                                                        <th>Obrisi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    foreach($proizvodi as $i) :?>
                                                       
                                                        <tr class="rem1  py-1">
                                                            <td><img src="../../<?=$i->velika_putanja?>" alt="../../<?=$i->velika_alt?>" class="img-fluid"/></td>
                                                            <td><?=$i->naziv?></td>
                                                            <td><?=$i->cena?></td>
                                                            <td><?=$i->stara_cena?></td>
                                                            <td><?=$i->uk_kolicina?></td>
                                                            <td><?=$i->nazivKat?></td>
                                                            <td><?=$i->nazivBrend?></td>
                                                            <td>
                                                                <a href='#' data-id="<?=$i->idProizvod?>" class='btnAdmin btn-primary azurirajArtikal'><i class="far fa-edit"></i></a>
                                                            </td>
                                                            <td>
                                                                <a href='#' data-id="<?=$i->idProizvod?>" class='btnAdmin btn-primary obrisiArtikal'><i class="fas fa-trash-alt"></i></a>
                                                            </td>
                                                        
                                                        </tr>
                                                    <?php endforeach; ?>   
                                                    </tbody>
                                            </table>
                                        </div>
                                        <div id="paginacija">
                                            <ul class="pagination d-flex justify-content-center ml-auto" id="paginacija2">
                                                        
                                                <?php
                                                    for($i=0;$i<$brojLink;$i++):?>
                                                        <li class="pr-2 str" >
                                                            <a href="admin_proizvodi.php?page=<?=$i+1?>" class="pagee" >
                                                                <?=$i+1 ?>
                                                            </a>
                                                        </li>
                                                    <?php endfor;?>
                                            </ul> 
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 ml-auto" id="izmenaProizvodaForma">
                                                <h2>Azuriranje proizvoda</h2>
                                                <form method="post" action="../../modules/proizvodi/updateProduct.php">
                                                <div class="form-group">
                                                        <input type="hidden" name="skrivenoPoljeProizvod" id="skrivenoPoljeProizvod" class=form-control>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Naziv proizvoda: </label>
                                                        <input type="text" name="nazivArtiklaUpdate" id="nazivArtiklaUpdate" placeholder='Naziv proizvoda' class='form-control'>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Cena proizvoda: </label>
                                                        <input type="text" name="cenaArtiklaUpdate" id="cenaArtiklaUpdate" placeholder='Cena proizvoda' class='form-control'>
                                                    </div>
                                                    <div class="form-group">
                                                    <label>Stara cena proizvoda: </label>
                                                        <input type="text" name="cenaStaraArtiklaUpdate" id="cenaStaraArtiklaUpdate" placeholder='Stara cena proizvoda' class='form-control'>
                                                    </div>
                                                    <div class="form-group">
                                                    <label>Opis proizvoda: </label>
                                                        <textarea class="tekstForme brisanje" rows="7" id="opisArtiklaUpdate" name="opisArtiklaUpdate" placeholder="Opis proizvodaUpdate" class='form-control'></textarea>
                                                    </div>
                                                    <label>Kategorija proizvoda : </label>
                                                    <div class="form-group">
                                                        <select name='ddlKategorijaUpdate' id='ddlKategorijaUpdate' class=form-control>
                                                            <option value='0'>Izaberite</option>
                                                                <?php
                                                                    $upitKat=dohvatiSveKategorije();
                                                                    foreach ($upitKat as $kat):?>
                                                                        <option value="<?=$kat->idKategorija?>"><?=$kat->naziv?></option>
                                                                    <?php endforeach;
                                                                ?>
                                                        </select>
                                                    </div>
                                                    <label>Brend proizvoda : </label>
                                                    <div class="form-group">
                                                        <select name='ddlBrendUpdate' id='ddlBrendUpdate' class=form-control>
                                                            <option value='0'>Izaberite</option>
                                                                <?php
                                                                    $upitBrend=dohvatiSveBrendove();
                                                                    foreach ($upitBrend as $b):?>
                                                                        <option value="<?=$b->idBrend?>"><?=$b->naziv?></option>
                                                                    <?php endforeach;
                                                                ?>
                                                        </select>
                                                    </div>
                                                    <input type="submit" value="Izmeni" name='btnIzmenaProizvoda'
                                                    id='btnIzmenaProizvoda' class='btnAdminUpdate btn-primary'>
                                                    <input type="button" value="Sakrij formu" id='sakriAzuriranjeProizvoda'
                                                    class='btnAdminUpdate btn-primary'>
                                                </form>
                                            </div>
                                            <div class="odgovorUpdateProizvod">
                                                <?php

                                                if(isset($_SESSION['greskeUpdate'])){
                                                $greskeUpdate=$_SESSION['greskeUpdate'];
                                                echo "<p>$greskeUpdate</p>";
                                                unset($_SESSION['greskeUpdate']);
                                                }
                                                ?>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6 ml-auto" id="podaciProizvodDodaj">
                                                <h2>Dodaj proizvod</h2>
                                                <form method="POST" action="../../modules/proizvodi/addProizvod.php" enctype='multipart/form-data'>
                                                    <div class="form-group">
                                                        <label>Naziv proizvoda: </label>
                                                        <input type="text" name="nazivProizvoda" id="nazivProizvoda" placeholder='Naziv proizvoda' class='form-control'>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Slika proizvoda : &nbsp;</label> <input type="text" name="slikaProizvoda" id="slikaProizvoda" placeholder='Putanja velike slike' class='form-control'>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Thumbnail proizvoda: &nbsp;</label> <input type="text" name="slikaProizvodaMala" id="slikaProizvodaMala" placeholder='Putanja thumbnail slike' class='form-control'>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Cena proizvoda: </label>
                                                        <input type="text" name="cenaProizvoda" id="cenaProizvoda" placeholder='Cena proizvoda' class='form-control'>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Stara cena proizvoda: </label>
                                                        <input type="text" name="cenaProizvodaStara" id="cenaProizvodaStara" placeholder='Stara cena proizvoda' class='form-control'>
                                                    </div>
                                                    <div class="form-group">
                                                        <textarea class="form-control tekstForme" rows="7" name="opisProizvoda" placeholder="Opis proizvoda"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Datum unosa proizvoda: </label>
                                                        <input type="date" name="datumAdd" id="datumAdd" class=form-control>
                                                    </div>
                                                    <label>Kategorija proizvoda : </label>
                                                    <div class="form-group">
                                                        <select name='ddlKategorija' id='ddlKategorija' class=form-control>
                                                            <option value='0'>Izaberite kategoriju</option>
                                                            <?php
                                                                $upitKat=dohvatiSveKategorije();
                                                                foreach ($upitKat as $kat):?>
                                                                    <option value="<?=$kat->idKategorija?>"><?=$kat->naziv?></option>
                                                            <?php endforeach;
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <label>Brend proizvoda : </label>
                                                    <div class="form-group">
                                                        <select name='ddlBrend' id='ddlBrend' class=form-control>
                                                            <option value='0'>Izaberite brend</option>
                                                            <?php
                                                                $upitBrend=dohvatiSveBrendove();
                                                                foreach ($upitBrend as $b):?>
                                                                    <option value="<?=$b->idBrend?>"><?=$b->naziv?></option>
                                                            <?php endforeach;
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <label>Kolicina: </label>
                                                    <div class="form-group">
                                                        <input type="number" name="kolicina" id="kolicina" placeholder="Unesi kolicinu" class="validate">
                                                    </div>
                                                    <label>Na stanju?: </label>
                                                    <div class="form-group">
                                                        <input type="checkbox" name="chStanje" id="chStanje" value='1' />Da
                                                    </div>
                                                    <input type="submit" value="Unesi" name='btnUnosProizvoda' id='btnUnosProizvoda' class='btnAdmin btnIzmenaStyle'>&nbsp;
                                                    <input type="button" value="Otkazi" id='sakrijFormuZaProizvodeDodaj' class='btnAdmin btnIzmenaStyle'>

                                                    <?php
                                                        if(isset($_GET['poruka'])){
                                                            echo $_GET['poruka'];
                                                        }
                                                        if(isset($_SESSION['greskeUnos'])){
                                                            $greskeUnos=$_SESSION['greskeUnos'];

                                                            foreach($greskeUnos as $jednaGreska){
                                                                echo "<p>$jednaGreska</p>";
                                                        }
                                                        unset($_SESSION['greskeUnos']);
                                                        }
                                                    ?>
                                                </form>
                                            </div>

                                            <div class="odgovorAddProduct">
                                                <?php if(isset($_SESSION['poruka'])):
                                                    echo $_SESSION['poruka'];
                                                    unset($_SESSION['poruka']);

                                                     endif; ?>
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
    <script src="../../assets/js/proizvodi.js" type="text/javascript" ></script>   
</body>
</html>