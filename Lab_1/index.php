<?php

 function tryCURL(){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "www.google.se");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    
    $data = curl_exec($ch);
    curl_close($ch);
    
    var_dump($data);
}

tryCURL();