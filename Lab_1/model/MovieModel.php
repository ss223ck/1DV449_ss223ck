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
    
    public function getMovieTitle(){
        return $this->movieTitle;
    }
    public function getMovieTime(){
        return $this->movieTime;
    }
    public function getTableTime(){
        return $this->tableTimes;
    }
    public function getWeekDay(){
        return $this->weekDay;
    }
}