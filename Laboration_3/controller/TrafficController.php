<?php

namespace controller;

class TrafficController{
    private $renderPageView;
    private $composeOutputView;
    private $handleInformation;
    
    public function __construct($renderPage, $composeOutput, $handleInfo) {
        $this->renderPageView = $renderPage;
        $this->composeOutputView = $composeOutput;
        $this->handleInformation = $handleInfo;
    }
    
    public function startTrafficApp(){
        $body = "";      
        $this->handleInformation->startToGather();
        $this->renderPageView->renderOutput($body);
        
    }
}