<?php
require 'vendor/autoload.php';
use GrazeTech\SACSphp\Workflow\Workflow;
use GrazeTech\SACSphp\RestActivities\LeadPriceCalendarActivity;

define("GET", "GET");
define("POST", "POST");
define("PUT", "PUT");
define("DELETE", "DELETE");

$origin = filter_input(INPUT_POST, "origin");
$destination = filter_input(INPUT_POST, "destination");
$departureDate = filter_input(INPUT_POST, "departureDate");

$workflow = new Workflow(new LeadPriceCalendarActivity($origin, $destination, $departureDate));

$result = $workflow->runWorkflow();
ob_start();
var_dump($result);
$dump = ob_get_clean();

echo $dump;
flush();
