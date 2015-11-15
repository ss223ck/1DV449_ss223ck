<?php

namespace model;

class HandleInformation{
    
    public function startGatherInfo($inputUrl){
        $linkData = $this->gatherInformation($inputUrl);
        
        $linkArray = $this->gatherElementData($linkData, "//a/@href");
        
        $possibleDates = $this->getPossibleDates($inputUrl, $linkArray[0]);
                
        $possibleMovies = $this->getPossibleMoviesAndTime($possibleDates, $inputUrl . $linkArray[1]);
        
        $possibleTables = $this->getPossiblesTables($inputUrl, $linkArray[2], $possibleMovies, $possibleDates);
        
        return $possibleTables;
    }
    
    private function getPossiblesTables($startUrl, $restaurantUrlExtension, $movies, $Date){
        $restaurantStartData = $this->gatherInformation($startUrl . $restaurantUrlExtension);
        $newRestaurantUrl = $this->gatherElementData($restaurantStartData, "//a/@href");
        
        
        
        $restaurantData = $this->gatherInformation($startUrl . $newRestaurantUrl[0]);
        
        //get the free resturant tables
        $nodeData = $this->gatherElementData($restaurantData, '//input[@name="group1"]', true);
        $freeTableDates = array();
        
        $dateValue = array_search("ok", $Date);
        $dateValueString;
        
        if($dateValue == 1){
            $dateValueString = "fre";
        }
        else if($dateValue == 2)
        {
            $dateValueString = "lor";
        }
        else 
        {
            $dateValueString = "son";
        }
        
        foreach($nodeData as $Item) {
            $value = $Item->getAttribute('value');
            if(substr($value, 0,3) == $dateValueString) {
                foreach ($movies as $movietitle => $movieTimes) {
                    foreach ($movieTimes as $movieBookingObject) {
                        //check if movie is ends before the time start. If so its a possible option
                        if(substr($movieBookingObject->time, 0,2) + 2 <= substr($value, 3, 2)){
                            $freeTableDates[] = new MovieModel($movietitle, $movieBookingObject->time, substr($value, 3), $dateValueString . "dag");
                        }
                    }
                }
            }
        }
        return $freeTableDates;
    }
    
    
    
    private function getPossibleMoviesAndTime($dates, $moviesUrl){
        $MoviesData = $this->gatherInformation($moviesUrl);
        $data = $this->gatherElementData($MoviesData, '//select[@name = "movie"]/option[@value]');
        
        $dateValue = array_search("ok", $dates);
        
        $avaliableMovies = array();
        
        foreach($data as $key => $value) {
            $MoviesData = $this->gatherInformation($moviesUrl . "/check?day=0" . $dateValue . "&movie=0" . ($key + 1));
            $avaliableMovies[$value] = json_decode($MoviesData);
            foreach ($avaliableMovies[$value] as $moviekey => $movieTimes) {
                if($movieTimes->status != 1) {
                    unset($avaliableMovies[$value][$moviekey]);
                }
            }
        }
        
        return $avaliableMovies;
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
        $possibleDates = array(1=>"ok", 2=>"ok", 3=>"ok");
        
        foreach($linkArray as $link) {
            $individualCalendarData = $this->gatherExtensionUrl($calendarUrl, $link);
            $datesFromCalendar[] = $this->gatherElementData($individualCalendarData, "//tr/td");
        }
        
        //Loops throught dates to unset value "ok" if the date isnt ok.
        foreach ($datesFromCalendar as $dates) {
            for ($i = 0; $i < count($dates); $i++) {
                if($possibleDates[$i+1] == "ok" && strcasecmp($dates[$i], "ok") != 0) {
                    $possibleDates[$i+1] = "";
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