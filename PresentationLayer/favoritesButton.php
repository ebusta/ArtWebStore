<?php
session_start();
include_once "BusinessLayer/ManipulateFavorites.php";


/*
Creates the favorites button that is in the header
*/
    function createFavHeadButton (){
        
        initializeFavArray();
        $favCount = count($_SESSION['favImages']);
        $button = '<a class=" item" href="favorites.php"><i class="heartbeat icon"></i> Favorites'.createFavCountLabel().'</a> ';
        
        return $button;
        
    }
    
/*
Adds up the number of favorites that exist in the session state
*/
    function getFavCount(){
        $count = 0;
        
        foreach($_SESSION['favImages'] as $value ){
            $count++;
        }
        foreach($_SESSION['favArtists'] as $value ){
            $count++;
        }
        
        return $count;
    }
    
    /*
    Create the red label that appears next to the header favorite button that appears if there are favorites present
    */
    
    function createFavCountLabel(){
        $count = getFavCount();
        $label = " ";
        
        if($count != 0){
          $label = '<div class = "ui red horizontal label">'.getFavCount().'</div>';
        }
        
        return $label;
    }
  



?>