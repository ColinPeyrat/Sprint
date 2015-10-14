$(document).ready(function(){
    $(".addtocart").click(function(){
        var button = $(this);
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
                        button.removeClass();
                        button.addClass('btn btn-success btn-sm');
                        button.text('Ajouté !');
                        $('#myModal').modal();
                    }
            },
            error : function(resultat, statut, erreur){
                window.location = "?r=cli/login";
            }
        });
    });
    $("#gotocart").click(function(){
            window.location = "?r=cli/cart";
    });
});