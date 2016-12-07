<?php

class cart{
    private $numCartItems;
    private $numIndividualPaintings;
    private $totalCost;
    private $shippingCostStandard;
    private $shippingCostExpress;
    
    public function __construct(){
        $this->numCartItems = 0;
        $this->numIndividualPaintings = 0;
        $this->totalCost = 0;
        $this->shippingCostStandard = 0;
        $this->shippingCostExpress = 0;
    }
    
    public function incrementItems(){ $this->numCartItems++; }
    public function decrementItems(){ $this->numCartItems--; }
    public function getNumItems(){ return $this->numCartItems; }
    
    public function increaseIndividualPaintings($increase){ $this->numIndividualPaintings += $increase; }
    public function decreaseIndividualPaintings($decrease){ $this->numIndividualPaintings -= $increase; }
    public function getTotalIndividualPaintings(){ return $this->numIndividualPaintings; }
    
    public function increaseTotalCost($increase){ $this->totalCost += $increase; }
    public function decreaseTotalCost($decrease){ $this->totalCost -= $decrease; }
    public function getTotalCost(){ return $this->totalCost; }
    
    public function setShippingCostStandard($cost){ $this->shippingCostStandard = $cost; }
    public function getShippingCostStandard(){ return $this->shippingCostStandard; }
    
    public function setShippingCostExpress($cost){ $this->shippingCostExpress = $cost; }
    public function getShippingCostExpress(){ return $this->shippingCostExpress; }
    
    public function emptyCart(){
        $this->numCartItems = 0;
        $this->numIndividualPaintings = 0;
        $this->totalCost = 0;
        setShippingCostStandard(0);
        setShippingCostExpress(0);
    }
}

?>