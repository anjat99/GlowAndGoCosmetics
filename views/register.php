
<?php
require_once("head.php");
require_once("nav.php");
?>

<main id="sredina" class="container-fluid">
<div class="container">
    <div class="row align-items-center">
        <div class="col-md-6 mx-auto padding forma">
            <form class='form-horizontal' action="modules/registracija.php" method="post">
                <div class="control-group">
                    <h2>Registracija</h2>
                </div>
                <div class="control-group">
                    <label class='control-label' for='ime'>Ime</label>
                        <div class="form-group">
                            <input type="text"class="form-control" id="ime" name="ime">
                            <p class='help-block'>Ime mora početi velikim slovom - osoba moŽe imati više imena</p>
                        </div>
                </div>
                <div class="control-group">
                    <label class='control-label' for='prezime'>Prezime</label>
                    <div class="form-group">
                    <input type="text"class="form-control" id="prezime" name="prezime">
                    <p class='help-block'>Prezime mora početi velikim slovom - osoba moŽe imati više prezimena</p>
                    </div>
                </div>
                <div class="control-group">
                    <label class='control-label' for='email'>E-mail</label>
                        <div class="form-group">
                        <input type="text"class="form-control" id="email" name="email">
                        <p class='help-block'>Email adresa formata npr. -> neko@gmail.com</p>
                        </div>
                </div>
                <div class="control-group">
                    <label class='control-label' for='lozinka'>Lozinka</label>
                    <div class="form-group">
                    <input type="password"class="form-control" id="lozinka" name="lozinka">
                    <p class='help-block'>Lozinika treba da ima najmanje 6 karaktera</p>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <button class='btn btn-success register' type='button' id="btnRegistracija" name="btnRegistracija">Registruj se</button>
                    </div>
                    <div id="poruka"></div>
                </div>
            </form>

        </div>
    </div>
</div>
</main>
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
    <!-- <script src="assets/js/anketa.js" type="text/javascript" ></script>   -->
</body>
</html>