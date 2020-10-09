
<?php
    if(isset($_SESSION['korisnik']) && $_SESSION['korisnik']->naziv==='korisnik'):
?>
<?php
require_once("head.php");
require_once("nav.php");
?>
<!-- CONTENT -->  
<!-- INTRO -->
<div id="kontakt">
        <div class="intro2">
            <div class="wrapper">
                <div id="over">
                    <h2>Molim vas da odvojite par sekundi i popunite dole navedenu anketu</h2>
                </div>
            </div>
        </div> <!-- end #intro -->
    </div>
<!--// INTRO -->
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 mx-auto padding" id="anketa">
                <?php $anketa=aktivnaAnketa(); ?>
                <h3>
                <?php
                    if($anketa){echo $anketa->pitanje."?";}
                    else{echo "Trenutno nema aktivne ankete";}
                ?>
                </h3>
                <form class='form-horizontal' id="formaGlasanje" action="modules/anketa/rezGlasanja.php" method="POST">
                   
                    <?php
                        $upitOdgovori=aktivnaAnketaOdgovori();
                        static $flag=1;
                            foreach($upitOdgovori as $odgovor):
                    ?>
                    <div class="radio">
                        <label>
                            <input type="radio" class="radioAnketa" name="radioAnketa" value="<?= $odgovor->idOdgovor;?>"/><?= $odgovor->naziv;?>
                        </label>
                    </div>
                            <?php endforeach;?>
                            <?php $flag+=1; ?>
                      
                    <input type="hidden" id="skrivenoKorisnikAnketa"name="skrivenoIdKorisnik"   value="<?=$_SESSION['korisnik']->idKorisnik;?>">
                    <input type="hidden" id="aktivnaAnketa" name="skrivenoIdAnketa" value="<?= $anketa->idAnketa;?>">
                </form>
                <div class="controls">
                    <button class='btn-success register' type='button'id="btnGlasanje">Glasaj</button>
                    <button class='btn-success register' type='button'id="btnRezultatiGlasanja">Rezultati</button>
                </div><br>

                <div id="rezultatiGlasanja">
                </div>
                </div>

            </div>
        </div>
        <?php endif;?>


<?php

require_once("footer.php");
?>
  <!-- JS  -->
  <script src="assets/js/jquery-3.4.1.min.js"></script>
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <!-- Plugins -->
    <script type="text/javascript" src="assets/js/jquery-letterfx.min.js"></script>
    <!-- My js -->
    <script src="assets/js/main.js" type="text/javascript" ></script>
    <script src="assets/js/anketa.js" type="text/javascript" ></script>  
</body>
</html>

