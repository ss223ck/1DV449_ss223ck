<?php

namespace model;

class HandleInformation{
    
    public function startGatherInfo($inputUrl){
        $linkData;
        $linkData = $this->gatherInformation($inputUrl);
        
        $linkArray = $this->gatherElementData($linkData, '//a/@href');
        var_dump($linkArray);
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
    
    private function gatherElementData($data, $Element){
        $dataArray = array();
        
        $dom = new \DOMDocument;
        $dom->loadHTML($data);
        $xpath = new \DOMXPath($dom);
        $nodes = $xpath->query($Element);
        
        foreach($nodes as $elemntToFetch) {
            $dataArray[] = $elemntToFetch->nodeValue;
        }
        return $dataArray;
    }
}