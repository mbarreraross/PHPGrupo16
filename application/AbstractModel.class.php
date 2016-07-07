<?php

abstract class AbstractModel {
  /*
   * @registry object
   */
  protected $registry;
  protected $_magicProperties;
          
  function __construct($registry) {
    $this->registry = $registry;
  }
  
  public function __call($method, $parameters) {
    //for this to be a setSomething or getSomething, the name has to have 
    //at least 4 chars as in, setX or getX
    if(strlen($method) < 4){
      throw new Exception('Method does not exist');
    }
    //take first 3 chars to determine if this is a get or set
    $prefix = substr($method, 0, 3);
 
    //take last chars and convert first char to lower to get required property
    $suffix = substr($method, 3);
    $suffix[0] = strtolower($suffix[0]);
 
    if($prefix == 'get') {
      if(property_exists($this,$suffix) && count($parameters) == 0){
        return $this->_magicProperties[$suffix];
      }else{
        throw new Exception('Getter does not exist');
    
      }
    }
 
    if($prefix == 'set') {
      if(property_exists($this,$suffix) && count($parameters) == 1){
        $this->_magicProperties[$suffix] = $parameters[0];
      }else{
        throw new Exception('Setter does not exist');
      }
    }
  }
 

  public function fromArray(array $array) {
    if (!is_array($array)){
      throw new Exception("Error Processing Request", 1);
    }
    foreach($array as $key => $value) {
      //We need to convert first char of key to upper to get the correct 
      //format required in the setter method name
      $property = $key;
      $property[0] = strtoupper($key);
   
      $mtd = 'set' . $property;
      $this->$mtd($value);
    }
  }
  
  public function toArray(){
      return $this->_magicProperties;
  }
  
  
}

