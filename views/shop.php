<?php
require_once("head.php");
require_once("nav.php");
?>
 <!-- Content -->
 <main id="sredina" class="container-fluid">
        <div class="row">
             <!-- OPCIJE ZA SORTIRANJE -->
            <div id="sadrzaj" class="col-lg-12  ml-auto bg-gray-dark border-right border rounded border-size-1">
                <div class="row">
                    <div class="col-lg-12">
                        <div class=" row shopTop-toolbar bg-gray-dark border-right border-bottom rounded border-size-1 d-flex justify-content-between" id="views">
                            <h1>PRODAVNICA KOZMETIČKIH PROIZVODA</h1>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <section id="proizvodi" class="col-lg-12 d-flex flex-wrap">
                        <!-- ISPIS PROIZVODA -->
                        <?php echo dohvatiProizvode(); 
                       
                        ?>
                    </section>
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
    <script src="assets/js/korpa.js" type="text/javascript" ></script>  
    <script src="assets/js/proizvodi.js" type="text/javascript" ></script>  
</body>
</html>
