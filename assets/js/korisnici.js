$(document).ready(function(){
    ispisiSveKorisnike();
})


function ispisiSveKorisnike(){
    $.ajax({
        url:"../../modules/korisnici/sviKorisnici.php",
        dataType:"json",
        method:"post",
        success:function(data){
            $(".obrisi").click(obrisiKorisnika);
            $(".podaciJedanKorisnik").click(ispisiJednogKorisnika);

                $("#sakri").click(function(){
                    $("#podaci").slideUp("slow");
                 });

        },
        error:function(xhr,status,data){
            alert(xhr.status + status);
        }
    });
}




   function obrisiKorisnika(e){
        e.preventDefault();
        let poslati=confirm("Da li ste sigurni da zelite da obrisete korisnika?");
        let id=$(this).data("id");
            if(poslati){
                $.ajax({
                    url:"../../modules/korisnici/deleteUser.php",
                    method:"post",
                    dataType:"json",
                    data:{
                        id:id
                    },
                    success:function(data){
                        ispisiSveKorisnike();
                    },
                    error:function(xhr,status,data){
                        if(xhr.status==409){
                            $(".odgovorUpdate").html("Ne možete obrisati korisnika");
                        } 
                        else{
                            alert(xhr.status + status);
                        }
                    }
                });
             }
    }


    function ispisiJednogKorisnika(e){
        e.preventDefault();
        $("#podaci").slideDown("slow");
        var id=$(this).data('id');
            $.ajax({
                url : "../../modules/korisnici/jedanKorisnik.php",
                method : "POST",
                dataType:"json",
                data:{
                    id:id
                },
                success : function(data) {
                    $("#tbIme").val(data.ime);
                    $("#tbPrezime").val(data.prezime);
                    $("#tbEmail").val(data.email);
                    $("#ddlUloga").val(data.idUloga);
                    $("#skrivenoPolje").val(data.idKorisnik);
                },
                error : function(xhr, status, error) {
                    switch(xhr.status){
                        case 404:
                            alert("Stranica nije pronadjena");
                            break;
                        case 500:
                            alert("Greska na serveru.Trenutno nije moguce azurirati podatke o korisniku");
                            break;
                        default:
                            alert("Greska:"+xhr.status+"-"+status);
                            break;
                    }
                }
            });
   
   }