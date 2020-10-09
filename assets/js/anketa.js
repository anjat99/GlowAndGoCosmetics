$(document).ready(function(){
    getAnkete();
    $("#btnRezAnkete").click(rezultatAnkete);
    $("#btnRezAnketeStanje").click(rezultatAnketeBrojnoStanje);
    $("#btnGlasanje").click(glasanje);
    $("#btnRezultatiGlasanja").click(rezultatiGlasanja);
})

    function rezultatAnkete(){
        let id=$("#ddlAnketaRez").val();
        if(id!=0){
            $.ajax({
                url:"../../modules/anketa/jednaAnketaAdmin.php",
                dataType:"json",
                method:"post",
                data:{
                    send:true,
                    id:id
                },
                success:function(data,status,xhr){
                    $("#rezAnketeAdmin").html(ispisRezultataAnkete(data));
                },
                error:function(xhr,status,data){
                    console.log(xhr.status + status);
                    console.log(xhr.status + status);
                    console.log(xhr.status);
                    console.log(xhr.responseText)

                }
            })
        }
    }
    function rezultatAnketeBrojnoStanje(){
        let id=$("#ddlAnketaRez").val();
        if(id!=0){
            $.ajax({
                url:"../../modules/anketa/jednaAnketa.php",
                dataType:"json",
                method:"post",
                data:{
                    send:true,
                    id:id
                },
                success:function(data,status,xhr){
                    $("#rezAnketeAdmin").html(ispisRezultataBrojnoStanje(data));
                    
                },
                error:function(xhr,status,data){
                    console.log(xhr.status + status);
                    console.log(xhr.status + status);
                    console.log(xhr.status);
                    console.log(xhr.responseText)

                }
            })
        }
    }


    function ispisRezultataBrojnoStanje(data){
        let ispis=`<table class="korpa table table-striped" border="1">
                    <thead class="thead-dark">
                        <tr>
                        <th>Odgovor</th>
                        <th>Broj glasova</th>
                        </tr>
                    </thead>
                    <tbody>`;

        for(let i of data){
            ispis+=`<tr class="rem1 py-1">
                        <td>${i.naziv}</td>
                        <td>${i.broj}</td>
                    </tr>`;
        }
        ispis+=`</tbody>
                </table>`;
            $("#rezAnketeAdminStanje").html(ispis);
    }

    function glasanje(){
        var id =$("#skrivenoKorisnikAnketa").val();
        var odgovor=$("input[name='radioAnketa']:checked").val();
        odgovor = parseInt(odgovor);
        console.log(odgovor);
        if(!odgovor){
            $("#rezultatiGlasanja").html("Morate uneti vrednost!");
        }else{
            $.ajax({
                url:"modules/anketa/rezGlasanja.php",
                method:"post",
                dataType:"json",
                data:{
                    id:id,
                    odgovor:odgovor,
                    send:true
                },
                success:function(data,status,xhr){
                    if(xhr.status==201)
                        $("#rezultatiGlasanja").html(data.poruka);
                       
                },
                error:function(xhr,status,data){
                    switch(xhr.status){
                    case 409:
                        $("#rezultatiGlasanja").html("Već ste uneli odgovor");
                        break;
                    default:
                        console.log(xhr.status + status);
                        break;
                    }
                    console.log(xhr.responseText)
                    console.log(xhr.status)
                }
            });
        }
    }

    function rezultatiGlasanja(){
        var id =$("#aktivnaAnketa").val();

            $.ajax({
                url:"modules/anketa/jednaAnketa.php",
                method:"post",
                dataType:"json",
                data:{
                    id:id,
                    send:true
                },
                success:function(data,status,xhr){
                    $("#rezultatiGlasanja").html(ispisRezultataAnketeKorisnici(data));
                },
                error:function(xhr,status,data){
                    console.log(xhr.status);
                    console.log(xhr.responseText)
                    console.log(xhr.status)
                }
            });
    }

    function ispisRezultataAnkete(data){
        let ispis=`<br><br><table class="korpa table table-striped" border="1">
                        <thead class="thead-dark">
                            <tr> 
                                <th>korisnik</th>
                                <th>Odgovor</th>
                            </tr>
                        </thead>
                        <tbody>`;
                        
         for(let i of data){
            ispis+=`<tr class="rem1 py-1">
                        <td>${i.email}</td>
                        <td>${i.naziv}</td>
                    </tr>`;
         }
         ispis+=`</tbody>
                </table>`;
         return ispis;
    }
    function ispisRezultataAnketeKorisnici(data){
        let ispis=`<table class="korpa table table-striped" border="1">
                    <thead class="thead-dark">
                        <tr>
                        <th>Odgovor</th>
                        <th>Broj glasova</th>
                        </tr>
                    </thead>
                    <tbody>`;

        for(let i of data){
            ispis+=`<tr class="rem1 py-1">
                        <td>${i.naziv}</td>
                        <td>${i.broj}</td>
                    </tr>`;
        }
        ispis+=`</tbody>
                </table>`;
            return ispis;
    }

    function getAnkete(){
        $.ajax({
            url:"../../modules/anketa/sveAnkete.php",
            dataType:"json",
            method:"post",
            success:function(data){
                ispisAnketa(data)
                ispisAktivneAnkete(data);
            },
            error:function(xhr,status,data){
                console.log(xhr.status + status);
            }
        });
       
    }

    function ispisAnketa(data){
        let ispis="<option value='0'>Izaberite</option>";
            for(let i of data){
                ispis+=`<option value="${i.idAnketa}">${i.pitanje}</option>`;
            }
        $("#ddlAnketaRez").html(ispis);
    }

    function ispisAktivneAnkete(data){
        let ispis="<option value='0'>Izaberite</option>";
            for(let i of data){
                if(i.aktivna==1){
                    ispis+=`<option selected value="${i.idAnketa}">${i.pitanje}</option>`;
                }else{
                    ispis+=`<option value="${i.idAnketa}">${i.pitanje}</option>`;
                }
            }
        $("#ddlAnketaAktivacija").html(ispis);
    }