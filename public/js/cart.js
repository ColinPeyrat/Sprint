$(document).ready(function(){
    $(".addtocart").click(function(){

        var val = $(this).val();
        $.ajax ({
            method: "GET",
            dataType: "json",
            url: "?r=cli/addtocart",
            data: {jeu_id: val},
            success: function(response) {
                console.log(response);
                    if(response == false){
                        $('#errorModal').modal();
                    } else {
                        $('#myModal').modal();
                        $('#addtocart').removeClass();
                        $('#addtocart').addClass('btn btn-success btn-sm');
                        $('#addtocart').text('Ajouté !');
                    }
            },
            error : function(resultat, statut, erreur){
                alert('boufon');
            }
        });
    });
    $("#gotocart").click(function(){
            window.location = "?r=cli/cart";
    });
});