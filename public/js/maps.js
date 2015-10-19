var secret=document.getElementById('secret');

var iduser=secret.getAttribute("data-user");
console.log(iduser);

var map;
var home;

function addMarker(){
   $.getJSON("?r=cli/getAllAddresse", function(json) {
        $.each(json, function(i, value) {

                var LatLng = new google.maps.LatLng(value.latitude, value.longitude);
                var marker = new google.maps.Marker({
                position: LatLng,
                      animation: google.maps.Animation.DROP,

                map: map,
                title: 'Hello World!',
                });
                var infowindow = new google.maps.InfoWindow({
                  content: '<h5>'+value.nom+'</h5></br>'+value.addresse+'<br/>'+value.ville+'<br/>'+value.cp
                });
                marker.addListener('click', function() {
                  infowindow.open(map, marker);
                });
              
    

        });
        // $.each(json,function(i,o){
        //     var text = o.nom;
        //     var pos = {lat:parseFloat(o.latitude),lng:parseFloat(o.longitude)};
        //      var marker = new google.maps.Marker({
        //         position: latLng,
        //         map: map,
        //         title: data.title
        //       });
        //     marker.setMap(map);
        // });
    });
  }

  function initialize(center) {
    var center = center;
    var mapOptions = {
      center: center,  
      zoom: 13,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    map = new google.maps.Map(document.getElementById("googleMap"),
        mapOptions);
  }
  $(document).ready(function() {
        var iconHome = {
        url: "public/img/home2.png",
        anchor: new google.maps.Point(0,49)
      };
        var center = $.ajax ({
        method: "GET",
        dataType: "json",
        url: "?r=cli/getFactureAdresse",
        data: {cli_id: 1},
        success: function(response) {
            var center = {lat:parseFloat(response.latitude),lng:parseFloat(response.longitude)};
            initialize(center);
            var marker = new google.maps.Marker({
              position: center,
              map: map,
                    animation: google.maps.Animation.DROP,

              title: 'Votre adresse de facturation',
              icon : iconHome,
            });
            var infowindow = new google.maps.InfoWindow({
              content: response.nom
            });
            marker.addListener('click', function() {
              infowindow.open(map, marker);
            });

          }     
        });
        addMarker();
    });


// function initialize(responseArray)
//     {
//       var latitude = responseArray['latitude'];
//       var longitude = responseArray['longitude'];
//       var mapProp = {
//         center: new google.maps.LatLng(latitude,longitude),
//         zoom:7,
//         panControl:true,
//         zoomControl:true,
//         mapTypeControl:true,
//         scaleControl:true,
//         streetViewControl:true,
//         overviewMapControl:true,
//         rotateControl:true,    
//         mapTypeId: google.maps.MapTypeId.ROADMAP
//       };
//       map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
//     }

//         $ .ajax ({
//             method: "GET",
//             dataType: "json",
//             url: "?r=cli/getAllAddresse",
//             data: {cli_id: iduser},
//             success: function(response) {
//                 var responseArray = [];
//                 $.each(response, function(key, val){
//                         responseArray.push(val) // you will myarr here, not out side
//                       });
//                       initialize(responseArray);   
//                       console.log(responseArray.length);
//                       for (var i=0, l=responseArray.length; i<l;i++) {
//                         var latLng = new google.maps.LatLng(responseArray[i].lat, responseArray[i].lng); 
//                         var marker = new google.maps.Marker({ position: latLng, map: map});
//                       } 
//                     // if(response == false){
//                     //     $('#errorModal').modal();
//                     // } else {
//                     //     button.removeClass();
//                     //     button.addClass('btn btn-success btn-sm');
//                     //     button.text('Ajouté !');
//                     //     $('#myModal').modal();
//                     // }
//                   },
//                   error: function(error,type,message){
//                     console.log(message);
//                   }
//                 });
//     // Document.ready pour js
//     // google.maps.event.addDomListener(window, 'load', initialize);


