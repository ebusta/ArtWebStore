<?php

class cartItem {
    private $paintingID;
    private $glassID;
    private $frameID;
    private $matteID;
    private $quantity;
    private $totalCost = 0;
    
    public function __construct($paintingID, $glassID, $frameID, $matteID, $quantity){
        $this->paintingID = $paintingID;
        $this->glassID = $glassID;
        $this->frameID = $frameID;
        $this->matteID = $matteID;
        $this->quantity = $quantity;
    }
    
    public function set_painting($paintingID){ $this->paintingID = $paintingID; }
    public function get_painting(){ return $this->paintingID; }
    
    public function set_glass($glassID){ $this->glassID = $glassID; }
    public function get_glass(){ return $this->glassID; }
    
    public function set_frame($frameID){ $this->frameID = $frameID; }
    public function get_frame(){ return $this->frameID; }
    
    public function set_matte($matteID){ $this->matteID = $matteID; }
    public function get_matte(){ return $this->matteID; }
    
    public function set_quantity($quantity){ $this->quantity = $quantity; }
    public function get_quantity(){ return $this->quantity; }
    
    public function set_totalCost($totalCost){ $this->totalCost = $totalCost; }
    public function get_totalCost(){ return $this->totalCost; }
    
    /*
    Used for storing object data in the $_SESSION array. 
    */
    public function toString(){
        return $this->paintingID.':'.$this->glassID.':'.$this->frameID.':'.$this->matteID.":".$this->quantity;
        
    }
}

?>