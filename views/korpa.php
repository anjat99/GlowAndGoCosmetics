<?php
    if(isset($_SESSION['korisnik']) && $_SESSION['korisnik']->naziv==='korisnik'){
        
?>
<?php
require_once("head.php");
require_once("nav.php");
?>
<!-- CONTENT -->  

        <!-- Content -->
    <main id="sredinaKorpa" class="container-fluid">
        <div class="row">
            <div id="sadrzajWishlist" class="col-lg-12 ml-auto rounded border-size-1">
                <div class="row" id="korpa1">
                        
                </div><br>
                <button type="button" data-id="<?=$_SESSION['korisnik']->idKorisnik?>" id='kupi' class='btnAdminUpdate'>Kupi</button>
            </div>
        </div>
    </main>

    <?php }else{?>
        <!-- prikaz u korpi pre nego što se uloguje korisnik -->
    <main id="sredinaKorpa" class="container-fluid">
        <div class="row">
            <div id="sadrzajWishlist" class="col-lg-12 ml-auto rounded border-size-1">
                <h1>Morate da se ulogujete da biste videli sadrzaj iz liste zelja!</h1>
            </div>
        </div>
    </main>
    <?php }?>

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
   <script src="assets/js/korpa.js" type="text/javascript" ></script>

</body>
</html>



    
   