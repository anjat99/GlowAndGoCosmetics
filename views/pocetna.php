

<div class="intro container-fluid">
        <div class="wrapper row">
            <div id="over" class="col-lg-12">
                <h1 id="typewriteText">Planirate da kupite nešto posebno za vas ili vaše najmilije? Naša Glow&Go online kozmetička prodavnica je pravo mesto za to....</h1>
            </div>
        </div>
</div> <!-- end #intro -->
  <!-- ABOUT -->
  <section id="adventages">
        <div class="wrapper">
             <h2>Zašto da nas odaberete?</h2>
            <div class="advWrap" id="pogodnosti">
            </div>
        </div><!-- end .wrapper -->
    </section><!-- end #adventages -->
<br>
<section id="recent">
        <div class="wrapper">
            <h2>Proizvodi na akciji</h2>
            <div class="advWrap col-xl-12 ml-auto" id="cenaDesc">  
                <!-- DINAMIČKI ISPIS 4 NAJNOVIJA PROIZVODA NA AKCIJI -->
                <?php echo dohvatiCetiriProizvoda(); 
            
                ?>
            </div>
        </div><!-- end .wrapper -->
</section><!-- end #recent -->


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