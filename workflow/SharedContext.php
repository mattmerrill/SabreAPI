<?php
class SharedContext {

    private $results = array();
    
    public function __construct() {
        $this->results['SECURITY'] = null;
    }
    
    public function addResult($key, $result) {
        $this->results[$key] =  $result;
    }
    
    public function getResult($key) {
        return $this->results[$key];
    }
}
