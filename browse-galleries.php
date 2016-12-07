<?php 

include "BusinessLayer/SqlGenerator.php";
include "DataLayer/DatabaseAccess.php";
include "PresentationLayer/write.inc.php";

/*
This function gets all the gallery IDs, and then uses them to output cards via a funciton in write.inc.php
*/
function displayGalleries(){
	$sql = getGalleryIDs();
	$galleries = getGenericInfo($sql);
	
	while ($row = $galleries->fetch()){
	    outputCardNoImage($row["GalleryID"], $row["GalleryName"], $row["GalleryNativeName"], $row["GalleryCity"], $row["GalleryCountry"]);
	}
}
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

<?php include 'PresentationLayer/header.inc.php'; ?>

<div class="banner1-container">
    <div class="ui text container">
        <h1 class="ui huge header">Galleries</h1>
    </div>  
</div>  

<h2 class="ui horizontal divider"></h2> 

<div class="ui centered cards">

<?php displayGalleries(); /*at the top of page*/?>

</div>
</body>