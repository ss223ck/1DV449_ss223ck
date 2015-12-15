<?php


echo '<!DOCTYPE html>
                <html>
                  <head>
                    <meta charset="utf-8">
                    <link rel="stylesheet" type="text/css" href="style/stylesheet.css">
                    
                    
                  </head>
                  <body>
                    <div id="trafficContainer">
                    <div>
                            <label for="roadTraffic">Vägtraffik</label>
                            <input id="roadTraffic" name="roadTraffic" type="checkbox" checked></input>
                            <label for="collectivTraffic">kollektivtraffik</label>
                            <input id="collectivTraffic" name="collectivTraffic" type="checkbox" checked></input>
                            <label for="PlanedDisturbance">Planerad störningar</label>
                            <input id="PlanedDisturbance" name="PlanedDisturbance" type="checkbox" checked></input>
                            <label for="other">Annat</label>
                            <input id="other" name="other" type="checkbox" checked></input>
                        </div>
                    <div id="trafficMessages">
                        
                    </div>
                    </div>
                    <div id="map"></div>
                    

                    <script src="scripts/GoogleMaps.min.js" ></script>
                    
                    <script async defer
                      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAez0UBVTT-gu5oNjpUmDK42WxmwOpV7xk&callback=initMap">
                    </script>
                                        
                  </body>
                </html>
                                ';