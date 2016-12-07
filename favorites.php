<?php 

include_once "BusinessLayer/SqlGenerator.php";
include_once 'PresentationLayer/favoritesButton.php';
include_once 'BusinessLayer/ManipulateFavorites.php';
//include "PresentationLayer/write.inc.php";
?>

<!DOCTYPE html>
<html lang=en>
<head>
<meta charset=utf-8>
    <link href='http://fonts.googleapis.com/css?family=Merriweather' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script src="css/semantic.js"></script>
    <script src="js/misc.js"></script>
    
    <link href="css/semantic.css" rel="stylesheet" >
    <link href="css/icon.css" rel="stylesheet" >
    <link href="css/styles.css" rel="stylesheet">
</head>

<body>

<?php 
/*
A series of If statements that check the query string to determine what to do with the page. 
All call functions in ManipulateFavoites.php
*/
if(isset($_GET['addFavPainting'])){
    if(checkPaintingExists($_GET['addFavPainting'])){
    addPaintingToFav($_GET['addFavPainting']);}
}
if(isset($_GET['removePainting'])){
    
    removeSingleFavPainting($_GET['removePainting']);
 }
if(isset($_GET['addFavArtist'])){
    
    if(checkArtistExists($_GET['addFavArtist'])){
        
   addArtistToFav($_GET['addFavArtist']);}
}
if(isset($_GET['removeArtist'])){
    removeSingleFavArtist($_GET['removeArtist']);
}
if($_GET['removeAllFav'] == 1){
    removeAllFav();
}
include 'PresentationLayer/header.inc.php'; 

?>

<div class="banner1-container">
    <div class="ui text container">
        <h1 class="ui huge header"><i class="heartbeat icon"></i>Favourites</h1>
    </div>  
</div>  

<main>
    
    <h2 class = "ui horizontal divider"><a class = "ui red button" href ="favorites.php?removeAllFav=1"> Remove All Favorites</a></h2>
        <div class ="ui vertical stripe segment">
            <div class ="ui equal width stackable internally celled grid">
                <div class ="center aligned row">
                    <div class ="column">
                        <h2 class = "ui horizontal divider">Favorite Paintings</h2>
                        <div class = "ui grid">
                            
                        <?php
                        /*
                        Determines how to display the page based on whether or not any favorite paintings have been added.
                        If favorites have been added, will call a function in ManipulateFavorites.php
                        */
                        if(count($_SESSION['favImages']) == 0){
                            echo '<h3> No Favorite Paintings Picked </h3>';
                        } else {
                            $sql = getPaintingObject();
                            printFavorites($sql, 'favImages');
                        }
                        ?>
                        
                        </div>
                    </div>
                    <div class ="column">
                        <h2 class = "ui horizontal divider">Favorite Artists</h2>
                        <div class = "ui grid">
                            
                        <?php
                        /*
                        Determines how to display the page based on whether or not any favorite artists have been added.
                        If favorites have been added, will call a function in ManipulateFavorites.php
                        */
                        if(count($_SESSION['favArtists']) == 0){
                            echo '<h3> No Favorite Artists Picked </h3>';
                        }
                        else {
                            $sql = getArtistObject();
                            printFavorites($sql, 'favArtists');
                        }
                        ?>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
</main>
</body>