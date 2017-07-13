<?php
namespace GrazeTech\SACSphp\Configuration;

class SACSConfig
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
     * @var SACSConfig
     */
    private static $instance = null;

    /**
     *
     */
    public function __construct()
    {
        $this->restConfig = parse_ini_file("SACSRestConfig.ini");
        $this->soapConfig = parse_ini_file("SACSSoapConfig.ini");
    }

    /**
     *
     * @return SACSConfig
     */
    public static function getInstance()
    {
        return (SACSConfig::$instance === null) ? (SACSConfig::$instance = new SACSConfig) : SACSConfig::$instance;
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
