<?php 
include_once ( $_SERVER['DOCUMENT_ROOT'] . '/assign1_esmis676/DataLayer/DatabaseAccess.php' );
include_once ( $_SERVER['DOCUMENT_ROOT'] . '/assign1_esmis676/PresentationLayer/write.inc.php' );

session_start();

//Sets up the favorites array for paintings and artist
function initializeFavArray(){
    if(!isset($_SESSION['favImages'])){
    $_SESSION['favImages'] = array();
    
    }
    if(!isset($_SESSION['favArtists'])){
    $_SESSION['favArtists'] = array();
    
    
    }
    
}

//Adds an painting to favorites. Checks if painting already exists, then pushes to array
function addPaintingToFav($paintingId){
if(!in_array($paintingId,$_SESSION['favImages']))
        array_push($_SESSION['favImages'], $paintingId);
}

//Adds an artist to favorites. Checks if artist already exists, then pushes to array
function addArtistToFav($artistID){
    if(!in_array($artistID,$_SESSION['favArtists']))
    array_push($_SESSION['favArtists'], $artistID);
}

//Removes a single plainting from the favorites session based upon painting ID
function removeSingleFavPainting ($paintingId) {
    for($i=0; $i<count($_SESSION['favImages']); $i++){
        
        
        if($_SESSION['favImages'][$i] == $paintingId){
            
             array_splice($_SESSION['favImages'], $i , 1 );
        
    }
    }
}

//Removes a single artist from the favorites session instance based upon artist ID
function removeSingleFavArtist ($artistID) {
    
    for($i=0; $i<count($_SESSION['favArtists']); $i++){
        
        
        if($_SESSION['favArtists'][$i] == $artistID){
            
             array_splice($_SESSION['favArtists'], $i , 1 );
        
        }
    }
}

//Unsets all favorites leaving favorites session state empty
function removeAllFav(){
    unset($_SESSION['favArtists']);
    unset($_SESSION['favImages']);
}

//Outputs favorites
function printFavorites ($sql, $favType) {
    if($favType == "favImages"){
        
    for($i=0; $i<count($_SESSION['favImages']); $i++) {
 
        
        $statement = getUniqueInfo($sql, $_SESSION['favImages'][$i]);
        
        $painting = $statement->fetch();
        
	    outputFavPaintingCard($painting['PaintingID'], $painting['ImageFileName'], $painting['Title'],$painting['Title'] );
	    
    }}
    else{
    
    for($i=0; $i<count($_SESSION['favArtists']); $i++) {
        

        $statement = getUniqueInfo($sql, $_SESSION['favArtists'][$i]);
        
        $artist = $statement->fetch();
        
	    outputFavArtistCard($artist['ArtistID'],"artist", $artist['ImageFileName'], $artist['FirstName']. ' '. $artist['LastName'], $artist['ArtistName']);
	    
    }
    
    }
    
}

/*
Checks if the ID being submitted to favorites exists. returns true or false
*/
function checkPaintingExists($id){
    $exists = false;
    
    $sql = getPaintingObject();
    $statement = getUniqueInfo($sql, $id);
    $painting = $statement->fetchAll();
    if(count($painting) != 0){
        
        $exists = true;
    }
    
    return $exists;
}

function checkArtistExists($id){
    $exists = false;
    
    $sql = getArtistObject();
    $statement = getUniqueInfo($sql, $id);
    $artist = $statement->fetchAll();
    if(count($artist) != 0){
        
        $exists = true;
    }
    
    return $exists;
}


?>