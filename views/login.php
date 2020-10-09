<?php
require_once("head.php");
require_once("nav.php");
?>
<div class="container">
    <div class="row">
        <div class="col-lg-4 forma" id="login">
           
                <h2>Logovanje</h2>
                <form method='POST' action='modules/logovanje.php'>
                    <div class="form-group">
                        <input type="text" name="tbEmail" id="tbEmail" placeholder='Vas email' class='form-control'>
                    </div>
                    <div class="form-group">
                        <input type="password" name="tbLozinka" id="tbLozinka" placeholder='Vasa Lozinka' class='form-control'>
                    </div>
                    <input type="submit" value="Ulogujte se" name='btnLogin' class='btnUpdate register'>
                    <div id="porukaGreske"></div>
                </form>
            
        </div>
    </div>
</div>

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