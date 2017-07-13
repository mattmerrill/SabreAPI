<?php
namespace GrazeTech\SACSphp\RestActivities;

use GrazeTech\SACSphp\Rest\RestClient;
use GrazeTech\SACSphp\Workflow\Activity;
use GrazeTech\SACSphp\RestActivities\BargainFinderMaxActivity;

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
