<?php

namespace view;

class RenderPage{
    
    public function renderOutput(){
        echo '<!DOCTYPE html>
                <html>
                  <head>
                    <meta charset="utf-8">
                    <link rel="stylesheet" type="text/css" href="style/stylesheet.css">
                  </head>
                  <body>
                    
                    <div id="trafficMessages">
                        <div>
                            <label for="roadTraffic">Vägtraffik</label>
                            <input id="roadTraffic" name="roadTraffic" type="checkbox"></input>
                            <label for="collectivTraffic">kollektivtraffik</label>
                            <input id="collectivTraffic" name="collectivTraffic" type="checkbox"></input>
                            <label for="PlanedDisturbance">Planerad störningar</label>
                            <input id="PlanedDisturbance" name="PlanedDisturbance" type="checkbox"></input>
                            <label for="other">Annat</label>
                            <input id="other" name="other" type="checkbox"></input>
                        </div>
                    </div>
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