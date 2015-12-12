<?php


require_once("controller/TrafficController.php");
require_once("view/ComposeOutput.php");
require_once("view/RenderPage.php");
require_once("model/HandleInformation.php");
require_once("model/TrafficMessage.php");

error_reporting(E_ALL);
ini_set('display_errors', 'On');

$composeOutput = new \view\ComposeOutput();
$renderPage = new \view\RenderPage();
$handleInformation = new \model\HandleInformation();

$controller = new \controller\TrafficController($renderPage, $composeOutput, $handleInformation);

$controller->startTrafficApp();