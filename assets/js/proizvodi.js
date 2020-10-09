$(document).ready(function(){
    ispisiSveProizvode();
    $("#dodajProizvod").click(ispisiAddFormu);
})

function ispisiAddFormu(e){
    e.preventDefault();
    $("#podaciProizvodDodaj").slideDown("slow");
    $('html,body').animate({
        scrollTop: $("#podaciProizvodDodaj").offset().top
    },'fast');
    $("#izmenaProizvodaForma").slideUp("slow");
}

function ispisiSveProizvode(){
    $.ajax({
        url:"http://localhost/sajtphp1/modules/proizvodi/sviProizvodi.php",
        dataType:"json",
        method:"post",
        success:function(data){
            
            $(".obrisiArtikal").click(obrisiProizvod);
            $(".azurirajArtikal").click(ispisiJedanProizvod);
            $("#btnUnosProizvoda").click(unesi)
       

            $("#sakriAzuriranjeProizvoda").click(function(){
                $("#izmenaProizvodaForma").slideUp("slow");
            });
            $("#sakrijFormuZaProizvodeDodaj").click(function(){
                $("#podaciProizvodDodaj").slideUp("slow");
             });

        },
        error:function(xhr,status,data){
            console.log(xhr.status + status);
        }
    });
}

function obrisiProizvod(e){
    e.preventDefault();
    let poslati=confirm("Da li ste sigurni da zelite da obrisete atrikal?");
    let id=$(this).data("id");

        if(poslati){
            $.ajax({
                url:"../../modules/proizvodi/obrisiProizvod.php",
                method:"post",
                dataType:"json",
                data:{
                    id:id,
                },
                success:function(data){
                    ispisiSveProizvode();
                },
                error:function(xhr,status,data){
                    if(xhr.status==409){
                        $(".odgovorUpdateProizvod").html("Ne možete obrisati proizvod jer se koristi u porudžbinama!")
                    }else{
                    console.log(xhr.status + status);
                    }
                }
            });
        }
}

function ispisiJedanProizvod(e){
    e.preventDefault();
    $("#izmenaProizvodaForma").slideDown('slow');
    $("#podaciProizvodDodaj").slideUp("slow");
    $('html,body').animate({
        scrollTop: $("#izmenaProizvodaForma").offset().top
    },'fast');

    var id=$(this).data('id');
        $.ajax({
            url : "../../modules/proizvodi/jedanProizvod.php",
            method : "POST",
            data:{
                id:id
            },
            success : function(data,status, xhr) {
                $("#nazivArtiklaUpdate").val(data.naziv)
                $("#cenaArtiklaUpdate").val(data.cena)
                $("#cenaStaraArtiklaUpdate").val(data.stara_cena)
                $("#opisArtiklaUpdate").val(data.opis)
                $("#ddlKategorijaUpdate").val(data.kat_id)
                $("#ddlBrendUpdate").val(data.brend_id);
                $("#skrivenoPoljeProizvod").val(data.idProizvod);

                console.log(xhr.status);

                if(xhr.status == 201){
                    alert("Uspesno azuriran proizvod!");
                }
               
            },
            error : function(xhr, status, error) {
                switch(xhr.status){
                    case 404:
                        alert("Stranica nije pronadjena");
                        break;
                    case 500:
                        alert("Greska na serveru.Trenutno nije moguce azurirati podatke o proizvodu");
                        break;
                    default:
                        alert("Greska: "+xhr.status+"-"+status);
                        break;
                }
                console.log(xhr.responseText)
                    console.log(xhr.status)
            }
        });
}

function unesi(){
    let stanje = $("input[name='chStanje']:checked");
    let selectedStanje = [];

    for(let s of stanje){
        selectedStanje.push(s.value);
    }
        
    $.ajax({
        url: '../../modules/proizvodi/addProizvod.php',
        method: 'POST',
        data: {
            naziv: $("#nazivProizvoda").val(),
            slika_id: $("#slikaProizvoda").val(),
            thumbnail_id:$("#slikaProizvodaMala").val(),
            cena: $("#cenaProizvoda").val(),
            stara_cena: $("#cenaProizvodaStara").val(),
            opis: $("#opisProizvoda").val(),
            uk_kolicina: $("#kolicina").val(),
            kat_id: $("#ddlKategorija").val(),
            brend_id: $("#ddlBrend").val(),
            na_stanju: selectedStanje,
            send: true
        },
        success: function(data, status, xhr){
            $("input[name='chStanje']").removeAttr('checked');
                if(data.na_stanju==1){
                    $("input[name='chStanje']").attr('checked',true);
                }

                var datumAdd=data.datum_unosa.split(" ");
                $("#datumAdd").val(datumAdd[0]);
                $("#skrivenoAdd").val(data.idProizvod);
            console.warn("Statusni kod:");
            console.log(xhr.status);

            if(xhr.status == 201){
                alert("Uspesno unet proizvod!");
            }

            ispisiSveProizvode();
        },
        error: function(xhr, status, statusText){
            console.error('----> GRESKA <----');
            console.log(xhr);
        }
    })
}

