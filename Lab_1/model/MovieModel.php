<?php

namespace model;

class MovieModel{
    private $movieTitle;
    private $movieTime;
    private $tableTimes;
    private $weekDay;
    
    public function __construct($title, $movietime, $tabletime, $dayOfWeek){
        $this->movieTitle = $title;
        $this->movieTime = $movietime;
        $this->tableTimes = $tabletime;
        $this->weekDay = $dayOfWeek;
    }
}