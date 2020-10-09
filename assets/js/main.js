/*** IIFE - pozivanje anonimne funckije da se izvrsi odmah po ucitavanju stranice ***/
(function ($) {
    console.log("Radi");
    /*------------------
        Preloader
    --------------------*/
    $(window).on('load', function () {
        $(".loader").fadeOut();
        $("#preloder").delay(200).fadeOut("slow");
    });

   /*------------------
        Scroll, navigation and mobile view
    --------------------*/
    $(window).scroll(function(){
        let top = $(this)[0].scrollY;
        if(top > 530){
            $("#scrollTop").show();
        } else {
            $("#scrollTop").hide();
        }

        if(top > 530){
            $("#menu").css({
                "background-color": "#272727",
            });
            $("#menu .nav a").css({
                "color": "#888888",
            });
            $("#menu i.far").css({
                "color": "#f44336;",
            });
            $("#menu i.fas").css({
                "color": "rgb(255, 145, 0);",
            });
        }
        else{
            $("#menu").css({"background-color": '#fff'});
        }
    });
    $("#mob").hide(), 
	$("#mob li a").click(() => {
        $("#mob").slideUp('medium')
    })
    
    $("#hamburgerIkonica").addClass('senka').on("click", (() => {
        $("#mob").animate({
            width: "toggle"
        })
       /** postavljanje loga za mobilne uredjaje u trenutku klika na "hamburger" ikonicu**/
        var slikaLogoMob = `<a href="index.html">
                                <img src="assets/images/logo1Mob.png" alt="logo" class="logoMob"/>
                            </a>`;
        var logoMob = document.getElementsByClassName("logoHeaderMob");
        for(let i=0;i<logoMob.length;i++){
            logoMob[i].innerHTML =  slikaLogoMob;
        }
    }))
    document.getElementById("otvoriNoviTab").addEventListener("click", function(){
        window.open("https://tomicanja-portfolio.netlify.com/", "_blank");
    });
   
    var linkAutor=document.getElementById("autor");
    var zatvori=document.getElementById("zatvori0");
    linkAutor.addEventListener("click",otvoriModal);
    zatvori.addEventListener("click",zatvoriModal);

    ispisiPogodnosti();

  $("#btnRegistracija").on("click",function(){
    console.log("btn");
    function unosKorisnika(){
        console.log("unos");
        let ime=$("#ime").val();
        let prezime=$("#prezime").val();
        let email=$("#email").val();
        let lozinka=$("#lozinka").val();

        let reIme = /^[A-Z][a-z]{2,29}(\s[A-Z][a-z]{2,29})*$/;
        let rePrezime = /^[A-Z][a-z]{2,49}(\s[A-Z][a-z]{2,49})*$/;
        let reEmail = /^[a-z]{3,}(\.)?[a-z\d]{1,}(\.[a-z0-9]{1,})*\@[a-z]{2,7}\.[a-z]{2,3}(\.[a-z]{2,3})?$/;
        let reLozinka = /^\S{5,50}$/;

        var greske=[];
        if(!reIme.test(ime)) {
            greske.push("Ime nije u dobrom formatu");
        }
        if(!rePrezime.test(prezime)) {
            greske.push("Prezime nije u dobrom formatu");
        }
        if(!reLozinka.test(lozinka)) {
            greske.push("Lozinka nije u dobrom formatu");
        }
        if(!reEmail.test(email)) {
            greske.push("Email nije u dobrom formatu");
        }
 
        if(greske.length){
            let ispis=`<ul>`;
                for(let greska of greske){
                    ispis+=`<li>${greska}</li>`
                }
                ispis+=`</ul>`;
                $("#poruka").html(ispis);
        }
        
        var obj={
            ime:ime,
            prezime:prezime,
            email:email,
            lozinka:lozinka,
            send:true
        };
        return obj;
    }

    function callAjax(obj){
        console.log("ajax");
        $.ajax({
            url : "http://localhost/sajtphp1/modules/registracija.php",
            method : "POST",
            data:obj,
            success : function(data) {
                console.log(data);
                alert("Uspesna registracija");
                $("#poruka").html("Uspesna registracija");
            },
            error : function(xhr, status, error) {
                let poruka="Doslo je do greske";
                console.log(status);
                alert(poruka);
                    switch(xhr.status){
                        case 404:
                            poruka="Stranica nije pronadjena";
                            break;
                        case 409:
                            poruka="Username ili email vec postoji";
                            break;
                        case 422:
                            poruka="Podaci nisu validni";
                            break;
                        case 500:
                            poruka="Greska";
                            break;
                    }
                    $("#poruka").html(poruka);
                    console.log(poruka);
                    console.log(xhr.responseText)
                    console.log(xhr.status)
            }
        });
    }
    var formData = unosKorisnika();
    callAjax(formData);
  });

  $("#btnLogin").click(proveraLogin);
  function proveraLogin(){
    console.log("btnLogin");
    
    console.log("unos");
    let email=$("#tbEmail").val();
    let lozinka=$("#tbLozinka").val();

    let reEmail = /^[a-z]{3,}(\.)?[a-z\d]{1,}(\.[a-z0-9]{1,})*\@[a-z]{2,7}\.[a-z]{2,3}(\.[a-z]{2,3})?$/;
    let reLozinka = /^\S{5,50}$/;

    var greske=[];

    if(!reLozinka.test(lozinka)) {
        greske.push("Lozinka nije u dobrom formatu");
    }
    if(!reEmail.test(email)) {
        greske.push("Email nije u dobrom formatu");
    }

    if(greske.length){
        let ispis=`<ul>`;
            for(let greska of greske){
                ispis+=`<li>${greska}</li>`
            }
            ispis+=`</ul>`;
            $("#porukaGreske").html(ispis);
    }
  }


})(jQuery);

  
//modal - autor
function otvoriModal(){
    document.getElementById("modal0").style.display="block"
}
function zatvoriModal(){
    document.getElementById("modal0").style.display="none"
}

var modal = document.getElementById('modal0');
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

    //dinamicki ispisivanje pogodnosti
function ispisiPogodnosti(){
    let pogodnostiBlok = document.getElementById("pogodnosti");
    let ispisPogodnosti="";
    const pogodnosti = [
        {
            id:1,
            slika:{
                putanja:"assets/images/offer.png ",
                alt:" ponuda"
            },
            naslov:"Zagarantovano najbolje cene ",
            opis: " Stalne akcije, sniženja cena i poklona uz kupovinu, promocije uz asistenciju obučenih promotera i konsultanata, specijalne mogućnosti tokom Happy Day, uslovi plaćanja uskladjeni sa mogućnostima kupaca....odlika su Glow&Go kozmetičkih prodavnica."
        },
        {
            id:2,
            slika:{
                putanja:"assets/images/like.png ",
                alt:"ljubav prema klijentima "
            },
            naslov:"Iskustvo i lojalnost ",
            opis: " Verujemo da je dobra komunikacija značajan preduslov uspešnog poslovanja - profesionalnost i timski rad su razlozi zbog kojih uspešno gradimo mrežu lojalnih klijenata. Svaki kupac nam je važan, stoga je naše ljubazno osoblje uvek spremno da Vam pomogne i prepozna Vaše potrebe."
        },
        {
            id:3,
            slika:{
                putanja:"assets/images/call-center.png ",
                alt:"dostupnost"
            },
            naslov:"Stalno usavršavanje ",
            opis: " Jedna od ključnih vrednosti naše kompanije je konstantan proces učenja i usavršavanja, zbog čega smo redovni posetioci najznačajnijih svetskih dešavanja iz oblasti lepote. Redovno komuniciramo sa istaknutim svetskim i domaćim stručnjacima, kako bi samo pažljivo odabrani brendovi ušli u našu ponudu."
        },
        {
            id:4,
            slika:{
                putanja:"assets/images/support.png ",
                alt:"podrska "
            },
            naslov:"Naša posvećena podrška ",
            opis: "Želimo da su naši kupci uvek zadovoljni i zato im pružamo niz različitih mogućnosti kao što je vraćanje proizvoda uz priloženi račun. Veoma nam je stalo da obezbedimo dobru uslugu našim kupcima i zato Vam zaposleni u dm prodavnicama stoje na raspolaganju za svaki savet i svako pitanje. "
        }
    ]

    for(const pogodnost of pogodnosti){
        ispisPogodnosti += 
        `
            <article class="adventage col-xl-3 col-lg-4 col-ms-6 col-sm-12">
                <img src=${pogodnost.slika.putanja} alt=${pogodnost.slika.alt} \/>
                <h3><strong>${pogodnost.naslov}</strong></h3>
                <p>${pogodnost.opis}</p>
            </article>
        `;
    }
    pogodnostiBlok.innerHTML = ispisPogodnosti;   
   
}
//end

  /*------------------
        Plugins:
    1. Letterfx JQuery plugin for typewritting text based on settings
    --------------------*/

    $(document).ready(function(){
        $('#typewriteText').letterfx({
            "fx":"fade",
            "backwards":false,
            "timing":50,
            "fx_duration":"50ms",
            "letter_end":"restore",
            "element_end":"restore"
        });

        /*-----------------
        1. Postavljanje tooltipa na button liste želja
        2. Generisanje trenutne godine i prikaz iste u footer u deo za copyright
        --------------------------*/
        $('[data-toggle="tooltip"]').tooltip();

    });    
    