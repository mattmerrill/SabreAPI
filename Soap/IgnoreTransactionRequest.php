<?php
namespace GrazeTech\SACSphp\Soap;

use GrazeTech\SACSphp\Soap\SACSSoapClient;
use GrazeTech\SACSphp\Configuration\SACSConfig;

class IgnoreTransactionRequest
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
     * @param object $security
     */
    public function executeRequest($security)
    {
        $client = new SoapClient(
            'soap/wsdls/IgnoreTransactionLLSRQ/IgnoreTransactionLLS2.0.0RQ.wsdl', [
            'uri' => $this->config->getSoapProperty('environment'),
            'location' => $this->config->getSoapProperty('environment'),
            'encoding' => 'utf-8',
            'trace' => true,
            'cache_wsdl' => WSDL_CACHE_NONE
            ]
        );
        try {
            $client->__soapCall(
                'IgnoreTransactionRQ', $this->createRequestBody(), null, [
                SACSSoapClient::createMessageHeader('IgnoreTransactionLLSRQ'),
                $this->createSecurityHeader($security)
                ]
            );
        } catch (SoapFault $e) {
            var_dump($e);
        }
    }

    /**
     *
     * @param object $security
     * @return \GrazeTech\SACSphp\Soap\SoapHeader
     */
    private function createSecurityHeader($security)
    {
        $securityArray = [
            'BinarySecurityToken' => $security->BinarySecurityToken
        ];
        return new SoapHeader('http://schemas.xmlsoap.org/ws/2002/12/secext', 'Security', $securityArray, 1);
    }

    /**
     *
     * @return array
     */
    private function createRequestBody()
    {
        return [
            'IgnoreTransactionRQ' => [
                '_attributes' => ['Version' => $this->config->getSoapProperty('IgnoreTransactionLLSRQVersion')]
            ]
        ];
    }
}
