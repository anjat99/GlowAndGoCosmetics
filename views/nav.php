<body>
     <!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>
    <!-- HEADER SECTION BEGIN -->
    <nav class="container-fluid" id="menu" >
        <div class="logoHeader col-lg-2">
        <a href="index.php">
            <img src="assets/images/logo1.png" alt="logo" class="logo"/>
        </a>
        </div>
        <div class="nav ml-auto">
            <?php
                echo prikazMenija();
            ?>
        </div>
        <div id="blokDesno" class="text-right">
            <ul class="nav-right">
                <li class="heart-icon col-lg-1">
                    <a href="index.php?page=korpa"title="Lista želja" data-toggle="tooltip" data-placement="bottom">
                        <i class="far fa-heart"></i>
                    </a>
                </li>
            </ul>
        </div>
    </nav>
    <!--navigacija za mobilne uredjaje i logo-->
    <nav id="mob">
        <div class="logoHeaderMob">
        </div>
        <div class="nav">
        <?php
              echo prikazMenija();
          ?>
        </div>
        <div id="ikonice">
            <ul class="nav-rightMob">
                <li class="col-lg-1 heart-icon">
                    <a href="index.php?page=korpa"title="Lista želja" data-toggle="tooltip" data-placement="bottom">
                    <i class="far fa-heart"></i>
                </a>
                </li>
            </ul>
        </div>
    </nav>
    <!--// HEADER SECTION END -->
    <!--hamburger ikonica-->   
    <div id="hamburgerIkonica">
        <a href="#"><i class="fas fa-bars"></i></a>
    </div>  
    <br><br><br><br>