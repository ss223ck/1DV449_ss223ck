<?php

require_once("controller/BookingController.php");
require_once("view/InputView.php");
require_once("view/RenderPage.php");
require_once("model/HandleInformation.php");
require_once("model/MovieModel.php");


error_reporting(E_ALL);
ini_set('display_errors', 'On');

$inputView = new \view\InputView();
$renderPage = new \view\RenderPage();
$handleInformation = new \model\HandleInformation();

$controller = new \controller\BookingController($renderPage, $inputView, $handleInformation);

$controller->startBookingApp();