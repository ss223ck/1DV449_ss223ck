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
        
        
        if($this->inpView->isRequestPost()) {
            $this->handleInfo->startGatherInfo($this->inpView->getTextBoxURL());
        }
        $body = $this->inpView->createInput();
        $this->rdnPage->renderOutput($body);
        
    }
}