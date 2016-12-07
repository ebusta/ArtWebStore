<?php

abstract class AbstractDataAccess {
    abstract protected getSelect();
    abstract protected getKeyField();
    private $connect;
    
    public funtion __construct($connect){
        $this->$connect = $connect;
    }
    
    protected function getConnect(){ return $this->connect; }
    
    protected function getAll(){
        $statement = DBHelper::runQuery($this->getConnect(), $this->getSelect(), null);
        return $statement;
    }
    
}

?>