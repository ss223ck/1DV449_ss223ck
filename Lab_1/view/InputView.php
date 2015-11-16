<?php

namespace view;

class InputView{
    private static $inputURLTextBox = "urlTextBox";
    
    
    public function isRequestPost(){
        return $_SERVER["REQUEST_METHOD"] === "POST";
    }
    public function getTextBoxURL(){
        if($this->isRequestPost()) {
            return $_POST[self::$inputURLTextBox];
        }
        return "";
    }
    
    
    public function createInput(){
        $returnInput = "";
        $returnInput = $this->createUrlInput();
        return $returnInput;
    }
    
    public function createUrlInput(){
        $returnUrlInput = "";
        $returnUrlInput = "<label for='". self::$inputURLTextBox ."'>Ange Url:</label>"
                . "<input type='text' name='". self::$inputURLTextBox ."' value='". $this->getTextBoxURL() ."'><input type='submit'>";
        return $returnUrlInput;
    }
    
    public function createBookingLinks($bookingArray) {
        $returnLinks = "<ul>";
        foreach($bookingArray as $possibleTime) {
            $returnLinks .= '<li><p>Filmen '. $possibleTime->getMovieTitle() .' kan ses kl: '. $possibleTime->getMovieTime() .' på '. $possibleTime->getWeekDay() .' och bordstiden är kl: '. $possibleTime->getTableTime() .'</p></li>';
        }
        $returnLinks .= "</ul>";
        return $returnLinks;
    }
}