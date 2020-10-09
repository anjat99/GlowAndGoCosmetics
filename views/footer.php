<!-- Footer -->
<footer class="footer container-fluid">
        <div class="row rowFooter">
            <div class="col-xl-4 col-md-5 col-sm-6"id="aboutUs">
                <h3><strong>O nama</strong></h3>
                <p>Osnovna delatnost kojom se bavi Glow&Go je, najkraće rečeno – lepota. Preciznije, bavimo se distribucijom proizvoda za ulepšavanje koji su namenjeni najpre ličnoj upotrebi, a onda i u profesionalne svrhe.Dugogodišnje iskustvo naučilo nas je da pažljivo osluškujemo potrebe svojih klijenata i u skladu sa tim, naša ponuda sadrži više od 35 000 artikala i preko 100 različitih brendova i, zajedno sa nama, neprekidno raste. <br>Ukoliko imate pitanja u vezi sa našim proizvodima, ponudom ili poslovanjem slobodno nas kontaktirajte. Rado ćemo Vam odgovoriti.</p>
                <ul id="mreze" class="d-flex">
         <!-- DINAMIČKI ISPIS DRUŠTVENIH MREŽA -->
                    <?php 
                        $faIkonice = dohvatiFaIkonice();
                        foreach($faIkonice as $ikonica): 
                    ?>
                        <li>
                            <a href="<?= $ikonica->putanja?>" target="_blank">
                                <i class="<?= $ikonica->naziv?>"></i>
                            </a>
                        </li>
                    <?php endforeach;?>
                </ul>
                <p>Copyright &copy;<span>
        <!-- DINAMIČKI ISPIS TEKUĆE GODINE -->
                     <?php echo date("Y"); ?>
                </span><em>All rights reserved.</em> | by Glow&Go </p>
            </div>
            <div class="col-xl-4 col-md-3 col-sm-3 odvoji" >
                <h3><em>Navigacija:</em></h3>
                <div class="nav link"> 
        <!-- DINAMIČKI ISPIS NAVIGACIONIH LINKOVA iz baze-->
                            <?php
                                echo prikazMenija();
                            ?>
                </div>
            </div>
            <div class="col-xl-4 col-md-4 col-sm-3 odvoji">
                <h3><em>Korisni linkovi:</em></h3>
                <div id="links2">
                    <div class="link">
                        <ul>
                            <li>
                                <a href="documentation.pdf">Dokumentacija</a>
                            </li>
                            <li>
                                <a href="sitemap.xml">Sitemap</a>
                            </li>
                            <li>
                                <a id="autor" data-modal="modalAutor">O autoru</a>
                            <div id="modal0"class="modal0">
                                <div class="sadrzajModala0">
                                    <a id="zatvori0">&times;</a>
                                    <figure id="autorImg">
                                        <img src="assets/images/autor.png" alt="autor"/>
                                    </figure>
                                    <h2>Anja Tomić</h2>
                                    <p>Broj indeksa: 7/18</p>
                                    <p>Datum rođenja: 31.08.1999</p>
                                    <a id="otvoriNoviTab">Portfolio</a><br>
                                    <p>
                                        Pozdrav svima! Zovem se Anja Tomić i dolazim iz Pančeva.Ovaj sajt sam napravila za potrebe kursa Web programiranje PHP1. Iako sam do sada naučila dosta stvari iz sfere WEB-a, u budućnosti planiram to znanje da unapređujem i nastavim da radim u sferi istog.<br/>
                                        Ukoliko želite da saznate nešto više o meni, možete posetiti moj portfolio klikom na link iznad...
                                    </p>
                                </div>
                            </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <div id="copyright"></div>
    <div id="scrollTop">
        <a href="#">
            <i class="fas fa-angle-double-up goToTop"></i>
        </a>
    </div>

  