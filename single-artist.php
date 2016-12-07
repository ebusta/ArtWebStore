<?php

include "BusinessLayer/CheckIfIDExists.php";
include "BusinessLayer/SqlGenerator.php";
include "PresentationLayer/write.inc.php";

/*
Creates the blurb about the artist at the top of the page.
*/
function createBlurb($artistID){
	$sql = getArtistDetails();
	$details = getUniqueInfo($sql, $artistID);
	$detailsAsArray = $details->fetchAll();
	
	echo '<section class="ui segment grey100"><div class="ui items">';
	echo '<div class="item"><div class="image"><img src="images/art/artists/square-medium/' . $artistID . '.jpg" alt="A picture of ' . $detailsAsArray[0][0] . ' ' . $detailsAsArray[0][1] . '" class="ui medium image"></div>';
	echo '<div class="content"><h1 class="header">' . $detailsAsArray[0][0] . ' ' . $detailsAsArray[0][1] . '</h1>';
	echo '<div class="description">' . $detailsAsArray[0][2] . '</div>';
	echo '</div></div></section>';
}

/*
Creates the list of different paintings the artist has in the database. 
Calls a function in write.inc.php to actually create the cards. 
*/
function displayList($artistID){
	$sql = getPaintingsByArtist();
	$pictures = getUniqueInfo($sql, $artistID);
	
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
    
    
    
</head>

<body>

<?php include 'PresentationLayer/header.inc.php'; ?>

<?php 
/*
Decides whether to display a user selected artist, or default to our boy Pablo Picasso. 
*/
if (isset($_GET["id"]) && is_numeric($_GET["id"]) && idExists($_GET["id"], "Artist")){
	createBlurb($_GET["id"]);
}
else {
	createBlurb(1);
}
echo '<a href="favorites.php?addFavArtist='.$_GET["id"] .'" ><button class="ui right labeled icon button" ><i class="heart icon"></i>Add to Favorites</button></a>';
?>

<h3>Paintings</h3>
	<div class="ui centered cards">
<?php 
/*
If a valid artist is selected, will display paintings by that artist. Otherwise, displays Pablo Picasso's paintings. 
*/
if (isset($_GET["id"]) && is_numeric($_GET["id"]) && idExists($_GET["id"], "Artist")){
	displayList($_GET["id"]);
}
else {
	displayList(1);
}
?>
</div>
</body>