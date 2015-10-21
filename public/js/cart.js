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
                        button.text('Ajouté au panier !');
                        $('#myModalCart').modal();
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



    $(".addtofav").click(function(){
        var button = $(this);
        var val = $(this).val();
        $.ajax ({
            method: "GET",
            dataType: "json",
            url: "?r=cli/addtofav",
            data: {jeu_id: val},
            success: function(response) {
                console.log(response);
                    if(response == false){
                        $('#errorModal').modal();
                    } else {
                        button.removeClass();
                        button.addClass('btn btn-success btn-sm');
                        button.text('Ajouté au favoris !');
                        $('#myModalFav').modal();
                    }
            },
            error : function(resultat, statut, erreur){
                console.log("erreur");
                window.location = "?r=cli/login";
            }
        });
    });
    $("#gotofav").click(function(){
            window.location = "?r=cli/fav";
    });
});