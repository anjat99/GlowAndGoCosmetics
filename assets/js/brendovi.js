$(document).ready(function(){
    ispisiSveBrendove();
    $("#dodajBrend").click(ispisiAddFormu);

    
})

function ispisiAddFormu(e){
    e.preventDefault();
    $("#podaciBrendDodaj").slideDown("slow");
    $('html,body').animate({
        scrollTop: $("#podaciBrendDodaj").offset().top
    },'fast');
}
function ispisiSveBrendove(){
    $.ajax({
        url:"../../modules/brendovi/sviBrendovi.php",
        dataType:"json",
        method:"post",
        success:function(data){
            $(".podaciJedanBrend").click(ispisiJedanBrend);

                $("#sakrijFormuZaBrendove").click(function(){
                    $("#podaciBrend").slideUp("slow");
                 });
                $("#sakrijFormuZaBrendoveDodaj").click(function(){
                    $("#podaciBrendDodaj").slideUp("slow");
                 });

        },
        error:function(xhr,status,data){
            console.log(xhr.status + status);
        }
    });
}

    function ispisiJedanBrend(e){
        e.preventDefault();
        $("#podaciBrend").slideDown("slow");
        var id=$(this).data('id');
            $.ajax({
                url : "../../modules/brendovi/jedanBrend.php",
                method : "POST",
                dataType:"json",
                data:{
                    id:id
                },
                success : function(data) {
                    $("#tbNazivBrend").val(data.naziv);
                    $("#skrivenoPoljeBrend").val(data.idBrend);
                },
                error : function(xhr, status, error) {
                    switch(xhr.status){
                        case 404:
                            alert("Stranica nije pronadjena");
                            break;
                        case 500:
                            alert("Greska na serveru.Trenutno nije moguce azurirati podatke o brendovima");
                            break;
                        default:
                            alert("Greska:"+xhr.status+"-"+status);
                            break;
                    }
                }
            });
   
   }