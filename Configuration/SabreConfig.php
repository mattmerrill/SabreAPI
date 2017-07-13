<?php
namespace GrazeTech\SabreAPI\Configuration;

class SabreConfig
{
    /**
     *
     * @var array
     */
    private $restConfig = [];

    /**
     *
     * @var array
     */
    private $soapConfig = [];

    /**
     *
     * @var SabreConfig
     */
    private static $instance = null;

    /**
     *
     */
    public function __construct()
    {
        $this->restConfig = parse_ini_file("SabreRestConfig.ini");
        $this->soapConfig = parse_ini_file("SabreSoapConfig.ini");
    }

    /**
     *
     * @return SabreConfig
     */
    public static function getInstance()
    {
        return (SabreConfig::$instance === null) ? (SabreConfig::$instance = new SabreConfig) : SabreConfig::$instance;
    }

    /**
     *
     * @param string $propertyName
     * @return string
     */
    public function getRestProperty(string $propertyName)
    {
        return isset($this->restConfig[$propertyName]) ? $this->restConfig[$propertyName] : null;
    }

    /**
     *
     * @param string $propertyName
     * @return string
     */
    public function getSoapProperty(string $propertyName)
    {
        return isset($this->soapConfig[$propertyName]) ? $this->soapConfig[$propertyName] : null;
    }
}
