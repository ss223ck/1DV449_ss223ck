<?php

namespace view;

class RenderPage{
    
    public function renderOutput($body){
        echo '<!DOCTYPE html>
                <html>
                  <head>
                    <link rel="stylesheet" type="text/css" href="style/stylesheet.css">
                  </head>
                  <body>
                    <div id="map"></div>
                    
                    <script src="scripts/GoogleMaps.js" > </script>
                    <script async defer
                      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAez0UBVTT-gu5oNjpUmDK42WxmwOpV7xk&callback=initMap">
                    </script>
                  </body>
                </html>
                                ';
    }
}