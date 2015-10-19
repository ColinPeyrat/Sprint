var secret=document.getElementById('secret');

var iduser=secret.getAttribute("data-user");
console.log(iduser);

var map;
var home;
  function initialize() {
    var mapOptions = {
      center: bangalore,
      zoom: 7,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    map = new google.maps.Map(document.getElementById("googleMap"),
        mapOptions);
  }

function addMarker(){
   $.getJSON("?r=cli/getAllAddresse&cli_id=1", function(json) {
            var latLng = new google.maps.LatLng(json.latitude, json.longitude ); 
            // Creating a marker and putting it on the map
            var marker = new google.maps.Marker({
                position: latLng

            });
                var infowindow = new google.maps.InfoWindow({
              content: json.nom
            });
            marker.addListener('click', function() {
              infowindow.open(map, marker);
            });
            marker.setMap(map);
          })
  }
  function initialize() {

      var center = $.ajax ({
            method: "GET",
            dataType: "json",
            url: "?r=cli/getAllAddresse",
            data: {cli_id: 1},
            success: function(response) {
                  initialize(response);
              }     
            });
    console.log(center)
    var center = { lat: 12.97, lng: 77.59 };
    var mapOptions = {
      center: center,  
      zoom: 7,
      mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    map = new google.maps.Map(document.getElementById("googleMap"),
        mapOptions);
  }
  $(document).ready(function() {
        initialize();
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


