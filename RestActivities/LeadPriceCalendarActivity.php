<?php
namespace GrazeTech\SACSphp\RestActivities;

use GrazeTech\SACSphp\Rest\RestClient;
use GrazeTech\SACSphp\Workflow\Activity;
use GrazeTech\SACSphp\RestActivities\InstaFlightActivity;

class LeadPriceCalendarActivity implements Activity
{
    private $origin, $destination, $departureDate;

    /**
     *
     * @param string $origin
     * @param string $destination
     * @param string $departureDate
     */
    public function __construct($origin, $destination, $departureDate)
    {
        $this->origin = $origin;
        $this->destination = $destination;
        $this->departureDate = $departureDate;
    }

    /**
     *
     * @param SharedContext $sharedContext
     * @return InstaFlightActivity
     */
    public function run($sharedContext)
    {
        $sharedContext->addResult("origin", $this->origin);
        $sharedContext->addResult("destination", $this->destination);
        $sharedContext->addResult("departureDate", $this->departureDate);
        $call = new RestClient;
        $result = $call->executeGetCall("/v2/shop/flights/fares", $this->getRequest($this->origin, $this->destination, $this->departureDate));
        $sharedContext->addResult("LeadPriceCalendar", $result);
        return new InstaFlightActivity;
    }

    /**
     *
     * @param string $origin
     * @param string $destination
     * @param string $departureDate
     * @return array
     */
    private function getRequest($origin, $destination, $departureDate)
    {
        return [
            'lengthofstay' => '5',
            'pointofsalecountry' => 'US',
            'origin' => $origin,
            'destination' => $destination,
            'departuredate' => $departureDate
        ];
    }
}
