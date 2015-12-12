<?php

namespace model;

class HandleInformation{
    
    public function startToGather() {
        $json_string = $this->gatherInformation("http://api.sr.se/api/v2/traffic/messages?format=json&size=100");
        $json_object = (array)json_decode($json_string);
        $json_MessageArray = $this->formatJsonObjects($json_object);
    }
    
    private function formatJsonObjects($objects) {
        $returnMessages = array();
        foreach ($objects as $key => $object){
            if($key === "messages")
            {
                foreach ($object as $message)
                {
                    $trafficMessage = new TrafficMessage();
                    $trafficMessage->id = $message->id;
                    $trafficMessage->priority = $message->priority;
                    
                    preg_match( "#/Date\((\d{10})\d{3}(.*?)\)/#", $message->createddate, $match );
                    $trafficMessage->createdDate = date( "r", $match[1] );
                    $trafficMessage->originalDate = $match[1];
                    $trafficMessage->title = $message->title;
                    $trafficMessage->exactLocation = $message->exactlocation;
                    $trafficMessage->description = $message->description;
                    $trafficMessage->latitude = $message->latitude;
                    $trafficMessage->longitude = $message->longitude;
                    $trafficMessage->category = $message->category;
                    $trafficMessage->subcategory = $message->subcategory;
                    $returnMessages[] = $trafficMessage;
                }
            }
        }
        usort($returnMessages, function($a, $b){
                    if ($a->originalDate == $b->originalDate) {
                        return 0;
		    }
		    return ($a->originalDate > $b->originalDate) ? -1 : 1;
		});
        return $returnMessages;
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