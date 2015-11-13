<?php

namespace model;

class HandleInformation{
    
    public function startGatherInfo($inputUrl){
        $linkData = $this->gatherInformation($inputUrl);
        
        $linkArray = $this->gatherElementData($linkData, "//a/@href");
        
        $possibleDates = $this->getPossibleDates($inputUrl, $linkArray[0]);
                
        
    }
    
    private function getPossibleDates($startUrl, $calenderUrl){
        //get the new link to calendar
        $calendarInfo = $this->gatherExtensionUrl($startUrl, $calenderUrl);
        $newLink = $this->gatherElementData($calendarInfo, "//a/@href");
        
        //array of individual urls
        $linkArrayOfIndividuals = $this->gatherExtensionUrl($startUrl, $newLink[0]);
        $linkArrayOfIndividuals = $this->gatherElementData($linkArrayOfIndividuals, "//a/@href");
        
        //return the dates 
        $possibleDates = $this->checkPossibleDates($linkArrayOfIndividuals, $startUrl . $newLink[0]);
        return $possibleDates;
    }
    
    private function checkPossibleDates($linkArray, $calendarUrl){
        $datesFromCalendar = array();
        $possibleDates = array(0=>"ok", 1=>"ok", 2=>"ok");
        
        foreach($linkArray as $link) {
            $individualCalendarData = $this->gatherExtensionUrl($calendarUrl, $link);
            $datesFromCalendar[] = $this->gatherElementData($individualCalendarData, "//tr/td");
        }
        
        //Loops throught dates to unset value "ok" if the date isnt ok.
        foreach ($datesFromCalendar as $dates) {
            for ($i = 0; $i < count($dates); $i++) {
                if($possibleDates[$i] == "ok" && strcasecmp($dates[$i], "ok") != 0) {
                    $possibleDates[$i] = "";
                }
            }
            
        }
        
        
        return $possibleDates;
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
    
    private function gatherExtensionUrl($url, $extension){
        return $this->gatherInformation($url . $extension);
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