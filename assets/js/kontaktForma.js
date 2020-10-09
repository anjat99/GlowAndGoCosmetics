$(document).ready(function(){
    $("#btnKontakt").click(proveriFormu);
})

function proveriFormu(){
    let validFormaKontakt = true;
    let podaci = [];
//polja
    let subjPolje, emailPolje, pitanjaPolje;

    subjPolje = document.getElementById("subj");
    emailPolje = document.getElementById("email");
    pitanjaPolje = document.getElementById("pitanja");

//dohvatanje vrednosti unosa od korisnika
    let subj, email, pitanja;

        subj = document.getElementById("subj").value.trim();
        email = document.getElementById("email").value.trim();
        pitanja = document.getElementById("pitanja").value.trim();

//regularni izrazi
let reSubj, reEmail, rePitanja;

    /* reImePrezime --> mora da se unesu 2 stavke, bez obzira da li je to ime i prezime, ili pak 2 imena/prezimena, ali mogu da se unesu i više imena/prezimena ukoliko ih neko ima */
     reSubj = /^[A-zšđžčć\.\d\s\-]{1,299}$/
        reEmail = /^[a-z]{3,}(\.)?[a-z\d]{1,}(\.[a-z0-9]{1,})*\@[a-z]{2,7}\.[a-z]{2,3}(\.[a-z]{2,3})?$/

    /* reImePrezime --> početno veliko slovo, maximalno 200karaktera */
        rePitanja = /^[A-ZZŠĐŽČĆ][a-zšđžčć\.\d\s\-]{1,}$/

//smestanje greske
    let imePrezimeGreska, emailGreska, pitanjaGreska;

        subjGreska = document.querySelector("#subjGreska");
        emailGreska = document.querySelector("#emailGreska");
        pitanjaGreska = document.querySelector("#pitanjaGreska")

//Validacija imena
    let isValidSubj = reSubj.test(subj);
    if(subj!=""){
        if(isValidSubj){
            subjGreska.textContent = "";
            podaci.push(subj);
        }
        else{
            validFormaKontakt = false;
            subjGreska.textContent = "*Naslov nije validan --:  Max: 300 karaktera, Početno slovo treba da bude veliko";
        }
    }
    else{
        subjGreska.textContent = "Molimo vas da ne ostavljate prazno polje za naslov.";
        validFormaKontakt = false;
    }

    //Validacija email-a
    let isValidEmail = reEmail.test(email);

    if(email!=""){
        if(isValidEmail){
            emailGreska.textContent = "";
            podaci.push(email);
        }
        else{
            emailGreska.textContent="*Email adresa nije validna. Mora da bude ispisana malim slovima u formatu poput: nesto@gmail.com ."
            validFormaKontakt = false;
        }
    }
    else{
        emailGreska.textContent = "Molimo vas da ne ostavljate prazno polje za email";
        validFormaKontakt = false;
    }

    //Validacija polja za pitanja
    let isValidPitanja = rePitanja.test(pitanja);

    if(pitanja!=""){
        if(isValidPitanja){
            pitanjaGreska.textContent = "";
            podaci.push(pitanja);
        }
        else{
            validFormaKontakt = false;
            pitanjaGreska.textContent="*Polje za pitanja nije validno - Prvo slovo mora da bude veliko, a nakon njega može bilo šta. Maksimalna dužina karaktera je 1000. ."
        }
    }
    else{
        pitanjaGreska.textContent = "Molimo vas da ne ostavljate prazno polje za pitanja.";
        validFormaKontakt = false;
    }

    if(validFormaKontakt){
        document.getElementById("formaKontakt").reset();
        $(this).find("button").addClass("bttn");
        alert("Uspesno poslato!");
    }
}