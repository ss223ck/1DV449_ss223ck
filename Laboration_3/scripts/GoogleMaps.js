var map;
function initMap() {
    map = new google.maps.Map(document.getElementById('map'), {
      center: {lat: 59.329333, lng: 18.068633},
      zoom: 8
    });
  
  

  
    
    var xmlhttp = new XMLHttpRequest();
    var url = "http://api.sr.se/api/v2/traffic/messages?format=json&size=100";
    var trafficInformation;
    
    xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            trafficInformation = JSON.parse(xmlhttp.responseText);
        }
    };
    xmlhttp.open("GET", url, true);
    xmlhttp.send();
    
    
    trafficInformation["messages"].forEach(function(obj){
        var description = "";
        if(obj.description != "")
        {
            description = obj.decription;
        }
        var contentString = '<div id="content">'+
            '<div id="siteNotice">'+
            '</div>'+
            '<h1 id="firstHeading" class="firstHeading">'+ obj.title +'</h1>'+
            '<div id="bodyContent">'+
            '<p>'+ description +'</p>'+
            '<p>' + obj.exactlocation + '</p>'
            '</div>'+
            '</div>';
      
        var infowindow = new google.maps.InfoWindow({
          content: contentString
          });

          var marker = new google.maps.Marker({
            position: {lat: obj.latitude , lng: obj.longitude},
            map: map,
            title: obj.title
          });
          marker.addListener('click', function() {
            infowindow.open(map, marker);
            });
        
        
    });
    
    var marker = new google.maps.Marker({
            position: {lat: 56.665498 , lng: 16.354889},
            map: map,
            title: "hej"
          });
    marker.addListener('click', function() {
            infowindow.open(map, marker);
            });
}
