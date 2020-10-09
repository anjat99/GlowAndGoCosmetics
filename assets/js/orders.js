$(document).ready(function(){
    ispisiSvePorudzbine();
})

function ispisiSvePorudzbine(){
    $.ajax({
        url:"../../modules/orders/svePorudzbine.php",
        method:"post",
        success:function(data){
        
            $("#tabelaZaPorudzbine").html(vratiSvePorudzbineTabela(data));
            $(".obrisiPor").click(obrisiPoruzdbinu);
            $(".detaljnijePor").click(detaljiJednePorudzbine)
        
         },
         error:function(xhr,status,data){
         console.log(xhr.status + status);
         }
         }); 
}

function vratiSvePorudzbineTabela(data){
    let rb=1;
    let ispis=`<table class="korpa table table-striped" border="1">
                    <thead class="thead-dark">
                        <tr>
                            <th>RB</th>
                            <th>Ime</th>
                            <th>Prezime</th>
                            <th>Datum</th>
                            <th>Obrisi</th>
                            <th>Detaljnije</th>
                        </tr>
                    </thead>
                    <tbody>`;
                for(let i of data){
                    ispis+=`<tr>
                                <td>${rb++}</td>
                                <td>${i.ime}</td>
                                <td>${i.prezime}</td>
                                <td>${i.datumVreme_kupovine}</td>
                                <td>
                                    <a href='#' data-id="${i.idKupovine}" class='btn btn-primary obrisiPor'><i class="fas fa-trash-alt"></i></a>
                                </td>
                                <td>
                                    <a href='#' data-id="${i.idKupovine}" class='btn btn-primary detaljnijePor'><i class="fas fa-info-circle"></i></a>
                                </td>
                            </tr>`;
                }
                ispis+=`</tbody>
                            </table>`;
                return ispis;
}

function obrisiPoruzdbinu(e){
    e.preventDefault();
    let id=$(this).data("id");
        $.ajax({
            url:"http://localhost/sajtphp1/modules/orders/obrisi.php",
            dataType:"json",
            method:"post",
            data:{
                id:id
            },
            success:function(data){
                    ispisiSvePorudzbine();
            },
            error:function(xhr,status,data){
                console.log(xhr.status + status);
            }
        });
}

function detaljiJednePorudzbine(e){
    e.preventDefault();
    let id=$(this).data("id");
            $.ajax({
                url:"http://localhost/sajtphp1/modules/orders/detaljno.php",
                dataType:"json",
                method:"post",
                data:{
                    id:id
                },
                success:function(data){
                    $("#podaciPorudbine").hide();
                    $("#podaciPorudbine").html(detaljiJednePorudzbineTabela(data))
                    $("#podaciPorudbine").slideDown("slow");

                    $("#sakriDP").click(function(){
                        $("#podaciPorudbine").slideUp("slow");
                    })
                },
                error:function(xhr,status,data){
                    console.log(xhr.status + status);
                }
            });
}

function detaljiJednePorudzbineTabela(data){
    let ispis=`<table class="korpa table table-striped" border="1" id="tabelaDP">
                    <thead class="thead-dark">
                        <tr>
                            <td colspan="3">${data[0].ime} ${data[0].prezime}, ${data[0].email}</td>
                        </tr>
                        <tr>
                            <td colspan='2'>Proizvod</td>
                            <td>Kolicina</td>
                        </tr>
                    </thead>
                    <tbody>
                    `;
                    for(let i of data){
                        ispis+=`<tr>
                                    <td>${i.naziv}</td><td><img src="../../${i.mala_putanja}" alt="../../${i.mala_alt}" class="img-fluid"/></td>
                                    <td>${i.kolicina_proizvoda}</td>
                                </tr>`;
                    }
                    ispis+=`</tbody></table>
                            <button type="button" id="sakriDP" class="btn btnprimary">Sakri</button>`;
                    return ispis;
}