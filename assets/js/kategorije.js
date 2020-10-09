$(document).ready(function(){
    ispisiSveKategorije();
    $("#dodajKategoriju").click(ispisiAddFormu);
})

function ispisiAddFormu(e){
    e.preventDefault();
    $("#podaciKatDodaj").slideDown("slow");
    $('html,body').animate({
        scrollTop: $("#podaciKatDodaj").offset().top
    },'fast');
}

function ispisiSveKategorije(){
    $.ajax({
        url:"../../modules/kategorije/sveKat.php",
        dataType:"json",
        method:"post",
        success:function(data){
            $("#tabelaKategorije").html(vratiSveKategorijeTabela(data));
            $(".podaciJednaKategorija").click(ispisiJednuKategoriju);

                $("#sakrijFormuZaKategorije").click(function(){
                    $("#podaciKat").slideUp("slow");
                 });
                $("#sakrijFormuZaKatDodaj").click(function(){
                    $("#podaciKatDodaj").slideUp("slow");
                 });

        },
        error:function(xhr,status,data){
            console.log(xhr.status + status);
        }
    });
}


   function vratiSveKategorijeTabela(data){
        let rb=1;
        let ispis=`<table class="korpa table table-striped" border="1">
                    <thead class="thead-dark">
                        <tr>
                        <th>Redni broj</th>
                        <th>Naziv kategorije</th>
                        <th>Izmeni</th>
                        </tr>
                    </thead>
                    <tbody>`;

        for(let i of data){
            ispis+=`<tr class="rem1 py-1">
                        <td>${rb++}</td>
                        <td>${i.naziv}</td>
                        <td>
                            <a href='#' data-id="${i.idKategorija}"class='btnAdmin btn-primary podaciJednaKategorija'><i class="far fa-edit"></i></a>
                        </td>
                    </tr>`;
        }
        ispis+=`</tbody>
                </table>`;
                return ispis;
   }

    function ispisiJednuKategoriju(e){
        e.preventDefault();
        $("#podaciKat").slideDown("slow");
        var id=$(this).data('id');
            $.ajax({
                url : "../../modules/kategorije/jednaKat.php",
                method : "POST",
                dataType:"json",
                data:{
                    id:id
                },
                success : function(data) {
                    $("#tbNazivKat").val(data.naziv);
                    $("#skrivenoPoljeKat").val(data.idKategorija);
                },
                error : function(xhr, status, error) {
                    switch(xhr.status){
                        case 404:
                            alert("Stranica nije pronadjena");
                            break;
                        case 500:
                            alert("Greska na serveru.Trenutno nije moguce azurirati podatke o kategorijama");
                            break;
                        default:
                            alert("Greska:"+xhr.status+"-"+status);
                            break;
                    }
                }
            });
   
   }