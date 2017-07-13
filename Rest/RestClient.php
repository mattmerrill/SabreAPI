<?php
namespace GrazeTech\SACSphp\Rest;

use GrazeTech\SACSphp\Rest\TokenHolder;
use GrazeTech\SACSphp\Configuration\SACSConfig;

class RestClient
{
    /**
     *
     * @var SACSConfig
     */
    private $config;

    /**
     *
     */
    public function __construct()
    {
        $this->config = SACSConfig::getInstance();
    }

    /**
     *
     * @param string $path
     * @param mixed $request
     * @return mixed
     */
    public function executeGetCall($path, $request)
    {
        $result = curl_exec($this->prepareCall(GET, $path, $request));
        return json_decode($result);
    }

    /**
     *
     * @param string $path
     * @param mixed $request
     * @return mixed
     */
    public function executePostCall($path, $request)
    {
        $result = curl_exec($this->prepareCall(POST, $path, $request));
        return json_decode($result);
    }

    /**
     *
     * @return array
     */
    private function buildHeaders()
    {
        return [
            'Authorization: Bearer ' . TokenHolder::getToken()->access_token,
            'Accept: */*'
        ];
    }

    /**
     *
     * @param string $callType
     * @param string $path
     * @param mixed $request
     * @return resource
     */
    private function prepareCall($callType, $path, $request)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $callType);
        curl_setopt($ch, CURLOPT_VERBOSE, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $headers = $this->buildHeaders();
        switch ($callType){
            case GET:
                $url = $path;
                if ($request != null) {
                    $url = $this->config->getRestProperty("environment") . $path . '?' . http_build_query($request);
                }
                curl_setopt($ch, CURLOPT_URL, $url);
                break;
            case POST:
                curl_setopt($ch, CURLOPT_URL, $this->config->getRestProperty("environment") . $path);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $request);
                array_push($headers, 'Content-Type: application/json');
                break;
        }
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        return $ch;
    }
}
