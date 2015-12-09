<?php

namespace model;

class HandleInformation{
  
    public function startToGather() {
        $json_string = $this->gatherInformation("http://api.sr.se/api/v2/traffic/messages");
        $json_object = json_decode($json_string);

        
        echo($json_object);
    }
    private function gatherInformation($url) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        try
        {
            $data = curl_exec($ch);
            curl_close($ch);
            
        } catch (Exception $ex) {
            curl_close($ch);
            throw new Exception("not implemented");
        }
        return $data;
    }
    
    private function gatherElementData($data, $Element, $returnNode = false){
        $dataArray = array();
        
        libxml_use_internal_errors(true);
        $dom = new \DOMDocument;
        $dom->loadHTML($data);
        $xpath = new \DOMXPath($dom);
        $nodes = $xpath->query($Element);
        
        
        
        if($returnNode) {
            return $nodes;
        }
        else
        {
            foreach($nodes as $elemntToFetch) {
                $dataArray[] = $elemntToFetch->nodeValue;
            }
            return $dataArray;
        }
    }
    
    
    
    
}