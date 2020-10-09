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
                    <h2>Kontaktirajte nas!</h2>
                </div>
            </div>
        </div> <!-- end #intro -->
    </div>
<!--// INTRO -->
<div class="central" class="col-lg-12">
        <div class="wrapperMain container-fluid">
            <main id="mainContact" class="col-lg-7 ml-auto">
                <h2>Popunite ovaj formular ukoliko želite da kontaktirate administratora .......</h2>
                    <article id="forma">
                        <form method="get" action="#"  id="formaKontakt">
                            <input type="text" name="email" id="email" placeholder="petar.petrovic@gmail.com"/><br/>
                            <p class="text-danger" id="emailGreska"></p>
                            <input type="text" name="subj" id="subj" placeholder="Naslov"/>
                            <p class="text-danger" id="subjGreska"></p>
                            <textarea cols="225" rows="10" placeholder="Vaše sugestije ili neko pitanje, ukoliko ih imate..." id="pitanja"></textarea>
                            <p class="text-danger podebljaj" id="pitanjaGreska"></p>
                            <button type="button" id="btnKontakt"><i class="fab fa-telegram-plane"></i></button>
                        </form>
                    </article>
            </main>
        </div>
    </div>
<!--// CONTENT -->  

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
    <script src="assets/js/kontaktForma.js" type="text/javascript" ></script>
</body>
</html>

