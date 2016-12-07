<?php

include "BusinessLayer/CheckIfIDExists.php";
include "BusinessLayer/SqlGenerator.php";
include "PresentationLayer/write.inc.php";
include "PresentationLayer/map.inc.php";

/*
Creates the blurb about the museum at the top of the page. 
Calls a function in map.inc.php to actually create the map. 
*/
function createBlurb($galleryID){
	$sql = getGalleryObject();
	$picture = getUniqueInfo($sql, $galleryID);
	$paintingAsArray = $picture->fetchAll();
	
	echo '<section class="ui segment grey100"><div class="ui items">';
	echo '<div class="item">';
	$name = "gallery" . $paintingAsArray[0][0];
	echo '<div id="map"></div>';
	createMap($paintingAsArray[0][5], $paintingAsArray[0][6], $name);
	echo '<div class="content"><h1 class="header">' . $paintingAsArray[0][1] . '</h1>';
	echo '<div class="description">' . $paintingAsArray[0][3] . ', ' . $paintingAsArray[0][4] . '</div>';
	echo '<div><a href="' . $paintingAsArray[0][7] . '">Website</a>';
	echo '</div></div></div>';
	echo '</section>';
}

/*
Displays the list of paintings that the museum holds.
Calls a function in write.inc.php to create the cards for each painting. 
*/
function displayList($galleryID){
	$sql = getPaintingsByGallery();
	$pictures = getUniqueInfo($sql, $galleryID);
	
	while($row = $pictures->fetch()){
		$altText = 'A Painting Depicting ' . $row["Title"] . '.';
		outputCard($row["PaintingID"], $row["ImageFileName"], $row["Title"]);
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
    <style>
      #map {
        height: 400px;
        width: 40%;
       }
    </style>
    
    
    
</head>

<body>

<?php include 'PresentationLayer/header.inc.php'; ?>

<?php 
/*
Decides whether to display a user selected gallery, or default to the Uffizi Museum
*/
if (isset($_GET["id"]) && is_numeric($_GET["id"]) && idExists($_GET["id"], "Gallery")){
	createBlurb($_GET["id"]);
}
else {
	createBlurb(4);
}
?>

<h3>Paintings</h3>
	<div class="ui centered cards">
		
<?php 
/*
Decides whether to display the paintings in a user selected gallery, or default to the paintings in the Uffizi
*/
if (isset($_GET["id"]) && is_numeric($_GET["id"]) && idExists($_GET["id"], "Gallery")){
	displayList($_GET["id"]);
}
else {
	displayList(4);
}
?>
	</div>

</body>