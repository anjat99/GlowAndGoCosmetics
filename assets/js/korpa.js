$(document).ready(function(){
    if(!dohvatiProizvodeIzWishlist()){
        localStorage.setItem("proizvodi",JSON.stringify([]));
    }
    
    $(".dodajUKorpu").click(function(){
        var id=$(this).data("idomiljeno");
        console.log(id);
        $(".nav-right li.heart-icon a").style({
            "color":"#ff0000"
        })
        alert("Drago nam je da Vam se sviđa ovaj proizvod!");
        var nizOmiljenih = [];
        var omiljeniProizvodi =dohvatiProizvodeIzWishlist();
        if(omiljeniProizvodi !== null){
            if((omiljeniProizvodi.filter(p => p.id ==id).length)){
                let omiljeniProizvodi = dohvatiProizvodeIzWishlist();
                for(let brojac  of proizvodi){
                    if(brojac.id == id) {
                        brojac.kolicina++;
                        break;
                    }
                }
                postaviProizvodeUWishlist(omiljeniProizvodi);
            }else{
                for(let omiljeni of omiljeniProizvodi){
                    nizOmiljenih.push(omiljeni);
                }
                nizOmiljenih.push({
                    id:id,
                    kolicina: 1
                });
                postaviProizvodeUWishlist(nizOmiljenih);
            }
        }
    });
    
        popuniKorpu();
    
    $("#korpa1").on("click",".obrisiKorpu",function(){
        let omiljeniProizvodi =dohvatiProizvodeIzWishlist();
        let id=$(this).data("id");
        console.log(id);
        let filtriraniProizvodi =omiljeniProizvodi.filter(p=>p.id!=id);
        localStorage.setItem("proizvodi",JSON.stringify(filtriraniProizvodi));
        popuniKorpu();
    });
    
    $("#kupi").click(function(){
        //id korisnika
        let id=$(this).data("id");
        console.log(id)
            if(dohvatiProizvodeIzWishlist().length){
                $.ajax({
                    url:"http://localhost/sajtphp1/modules/orders/jednaPorudzbina.php",
                    method:"post",
                    dataType:"json",
                    data:{
                        send:true,
                        prod:dohvatiProizvodeIzWishlist(),
                        id:id
                    },
                    success:function(data,status,xhr){
                        if(xhr.status==201){
                            alert("Uspesno ste izvrsili kupovinu");
                        }
                        popuniKorpu();
                        localStorage.removeItem("proizvodi");
                    },
                    error:function(xhr,status,data){
                        console.log(xhr.status + status);
                    }
                });
            }else{
                alert("Ne mozete izvrsiti kupovinu");
            }
    
    });
      
    
    function popuniKorpu(){
        var omiljeniProizvodi=dohvatiProizvodeIzWishlist();
            $.ajax({
                url:"http://localhost/sajtphp1/modules/proizvodi/sviProizvodi.php",
                dataType:"json",
                method:"post",
                success:function(data){
                    data=data.filter(p=>{
                        for(let omiljeni of omiljeniProizvodi ){
                            if(omiljeni.id==p.idProizvod){
                                p.kolicina_proizvoda=omiljeni.kolicina;
                                return true;
                            }
                        }
                        return false;
                    });

                    ispisPodatkeUTabelu(data);
                },
                error:function(xhr,status,data){
                    console.log(xhr.status + status);
                }
            });
    }

    function ispisPodatkeUTabelu(data){
        let ispis= `<table class="korpa table table-hover"  border="1" id="omiljeno">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Slika</th>
                                <th scope="col">Naziv</th>
                                <th scope="col">Cena</th>
                                <th scope="col">Kolicina</th>
                                <th scope="col">UKUPNA CENA</th>
                                <th scope="col">Ukloni</th>
                            </tr>
                        </thead>
                        <tbody>`;
        let rb=1;
        for(let i of data){
            ispis+=`<tr class="rem1">
                        <td>${rb++}</td>
                        <td><img src="${i.mala_putanja}" alt="${i.mala_alt}" class="img-fluid"</td>
                        <td>${i.naziv}</td>
                        <td>${i.stara_cena}</td>
                        <td>${i.kolicina_proizvoda}</td>
                        <td>${Number(i.stara_cena)*Number(i.kolicina_proizvoda)}</td>
                        <td>
                        <a href='#' data-id="${i.idProizvod}"
                    name='link' class='btnAdmin btn-primary obrisiKorpu'><i class="fas fa-trash-alt"></i></a>
                        </td>
                    </tr>`;
        }

        ispis+=`</tbody>
                    </table>`;
            $("#korpa1").html(ispis);
            
    }

           
})

function dohvatiProizvodeIzWishlist(){
    return JSON.parse(localStorage.getItem("proizvodi"));
}

function postaviProizvodeUWishlist(value){
    return localStorage.setItem('proizvodi', JSON.stringify(value));
}
function ispisiObavestenje(){
    $("#sadrzajWishlist").html("<h2>Sorry, you didn't choose any product...</h1>")
}