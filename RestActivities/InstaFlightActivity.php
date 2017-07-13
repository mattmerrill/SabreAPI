<?php
namespace GrazeTech\SabreAPI\RestActivities;

use GrazeTech\SabreAPI\Rest\RestClient;
use GrazeTech\SabreAPI\Workflow\Activity;
use GrazeTech\SabreAPI\RestActivities\BargainFinderMaxActivity;

class InstaFlightActivity implements Activity
{

    public function run($sharedContext)
    {
        $call = new RestClient;
        $lpcResult = $sharedContext->getResult('LeadPriceCalendar');

        $url = $lpcResult->FareInfo[0]->Links[0]->href;
        $result = $call->executeGetCall($url, null);
        $sharedContext->addResult('InstaFlight', $result);

        return new BargainFinderMaxActivity;
    }
}
