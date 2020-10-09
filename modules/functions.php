
<?php
    function prikazMenija(){
        global $konekcija;

        $upitZaMeni = "SELECT * FROM meni";
        $rez = $konekcija -> query($upitZaMeni)->fetchAll();
        //   var_dump($rez);
        $ispisMenija = "<ul>";
            foreach($rez as $li){
                $ispisMenija.="<li><a href=\"$li->putanja\">$li->naziv</a></li>";
            }
            if(isset($_SESSION['korisnik']) && $_SESSION['korisnik']->uloga_id == 2){
                $korisnik = $_SESSION['korisnik'];
                $ispisMenija.="<li><a href=\"modules/logout.php\">Logout</a></li>";
                $ispisMenija.="<li><a href=\"index.php?page=korisnik\" class=\"korisnikIme\">Hello $korisnik->ime</a></li>";
            }else{
                $ispisMenija.="<li><a href=\"index.php?page=registracija\">Registracija</a></li>";
            $ispisMenija.="<li><a href=\"index.php?page=login\">Login</a></li>";
            }
            $ispisMenija.="</ul>";
            return $ispisMenija;
    }

    function dohvatiFaIkonice(){
        return izvrsiUpit("SELECT * FROM famreze");
    }
    function dohvatiKategorije(){
        return izvrsiUpit("SELECT * FROM kategorije");
        }
    function dohvatiBrendove(){
        return izvrsiUpit("SELECT * FROM brendovi");
        }
       
    function dohvatiProizvode(){
        global $konekcija;

        $upitZaProizvode = "SELECT p.*, s.*, k.naziv as kategorija, b.naziv as brend FROM proizvodi p inner join slike s  ON s.idProizvod = p.idProizvod inner join kategorije k  ON k.idKategorija = p.kat_id inner join brendovi b  ON b.idBrend = p.brend_id";
        $rez = $konekcija -> query($upitZaProizvode)->fetchAll();
        // var_dump($rez);
        $ispisProizvoda = "";
            foreach($rez as $p){
              
                $ispisProizvoda.=" <article class=\"proizvod col-xl-2 col-lg-3 col-md-6 col-sm-12\">
                <div class=\"image\">
                      <a href=\"#\">
                        <img src=\"$p->putanja\" alt=\"$p->alt\" class=\"img-fluid product\" />
                      </a>
                </div>
                <div class=\"tekstProizvod\">
                    <h2>$p->naziv</h2><br>
                    <h3><b>Kategorija:</b> $p->kategorija</h3>
                    <h3><b>Brend:</b>$p->brend </h3>
                    <div class=\"info-product-price my-2\">
                        <span class=\".text-danger font-weight-bold\">$p->cena RSD</span>
                        <sup><del>$p->stara_cena 'RSD'</del></sup>
                    </div>
                    <div class=\"hvr-outline-out\">
                        <input type=\"button\" title=\"dodaj u listu želja\" data-toggle=\"tooltip\" data-placement=\"bottom\" value=\"Dodaj u omiljene\" class=\"button btn dodajUKorpu\"  data-idomiljeno=\"$p->idProizvod\" />
                    </div>
                </div>
            </article> ";
          
            }
            return $ispisProizvoda;
        
    }

    function dohvatiCetiriProizvoda(){
        global $konekcija;

        $upitZaProizvodeNajnovije = "SELECT * FROM proizvodi p inner join slike s  ON s.idProizvod = p.idProizvod  ORDER BY p.datum_unosa DESC LIMIT 0,4";
        $rez = $konekcija -> query($upitZaProizvodeNajnovije)->fetchAll();
        // var_dump($rez);
        $ispisProizvoda = "";
            foreach($rez as $p){
              
                $ispisProizvoda.=" <article class=\"proizvod-top col-xl-3 col-lg-4 col-md-6 col-sm-12\">
                <div class=\"image\">
                      <a href=\"#\">
                        <img src=\"$p->putanja\" alt=\"$p->alt\" class=\"img-fluid product\" />
                      </a>
                      <div class=\"overImage-top\">
                        <img src=\"assets/images/oznaka.png\" alt=\"flag\"/>
                   </div>
                </div>
                <div class=\"tekstProizvod-top\">
                    <h2>$p->naziv</h2>
                    <div class=\"info-product-price my-2\">
                        <span class=\"text-dark font-weight-bold\">$p->cena RSD</span>
                        <sup><del>$p->stara_cena RSD</del></sup>
                    </div>
                    <a href=\"shop.php\">
                        <input type=\"button\" title=\"pogledaj u prodavnici\" data-toggle=\"tooltip\" data-placement=\"bottom\" value=\"Prodavnica\" class=\"button btn see-in-shop\" />
                    </a>
                </div>
            </article> ";
               
            }
            return $ispisProizvoda;
    }
?>
