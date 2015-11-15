<?php

namespace controller;

class BookingController{
    private $rdnPage;
    private $inpView;
    private $handleInfo;
    
    public function __construct($renderPage, $inputView, $handleInformation) {
        $this->rdnPage = $renderPage;
        $this->inpView = $inputView;
        $this->handleInfo = $handleInformation;
    }
    
    public function startBookingApp(){
        $body;
        $possibleTimesArray;
        
        $body = $this->inpView->createInput();
        if($this->inpView->isRequestPost()) {
            $possibleTimesArray = $this->handleInfo->startGatherInfo($this->inpView->getTextBoxURL());
            $body .= $this->inpView->createBookingLinks($possibleTimesArray);
        }
        
        $this->rdnPage->renderOutput($body);
        
    }
}