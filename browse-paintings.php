<?php

include "BusinessLayer/CheckIfIDExists.php";
include "BusinessLayer/SqlGenerator.php";
include "PresentationLayer/write.inc.php";
include "BusinessLayer/Search.php";

/*
Displays the 20 oldest paintings, based on a string the user searched for. 
Calls a method in the file Search.php to actually do the searching. 
*/
function displaySearchResults(){
	
	echo '<h5>20 Oldest Paintings Containing "'.$_GET['searchValue'].'"</h5>';
	echo '<div class="ui items">';
	searchPaintings($_GET['searchValue']);
	

	echo '</div>';
}
/*
Outputs the complete list of artists that the user can use to filter paintings. 
Calls a method in write.inc.php to actually output the individual select options. 
*/
function writeArtistList() {
	$sql = getArtistList();
	$artists = getGenericInfo($sql);

	while($row = $artists->fetch()){
		$artistName = $row["FirstName"] . ' ' . $row["LastName"];
		outputListNoCurrency($row["ArtistID"], $artistName);
	}
}
/*
Outputs the complete list of museums that the user can use to filter paintings. 
Calls a method in write.inc.php to actually output the individual select options. 
*/
function writeGalleryList() {
	$sql = getGalleryList();
	$galleries = getGenericInfo($sql);
	
	while($row = $galleries->fetch()){
		outputListNoCurrency($row["GalleryID"], $row["GalleryName"]);
	}
}

/*
Outputs the complete list of shapes that the user can use to filter paintings. 
Calls a method in write.inc.php to actually output the individual select options. 
*/
function writeShapeList() {
	$sql = getShapeList();
	$shapes = getGenericInfo($sql);
	
	while($row = $shapes->fetch()){
		outputListNoCurrency($row["ShapeID"], $row["ShapeName"]);
	}
}

/*
Displays paintings when the user has not specified a valid filter. 
Calls a method in write.inc.php to actually output the items for each painting. 
*/
function displayDefaultPaintings() {
	echo '<h5>ALL PAINTINGS [TOP 20]</h5>';
	echo '<div class="ui items">';
	$sql = getGenericPaintingList();
	$paintings = getGenericInfo($sql);
	
	while($row = $paintings->fetch()){
		outputItem($row["PaintingID"], $row["ImageFileName"], $row["Title"], $row["FirstName"], $row["LastName"], $row["Description"]);
	}
	echo '</div>';
}

/*
Displays paintings when the user has filtered them by artist.  
Calls a method in write.inc.php to actually output the items for each painting. 
*/
function displayPaintingsByArtist($artistID) {
	$sql = getPaintingsByArtistLimit20();
	$paintings = getUniqueInfo($sql, $artistID);
	$paintingsAsArray = $paintings->fetchAll();
	
	echo '<h5>ARTIST = ' . $paintingsAsArray[0]["FirstName"] . ' ' . $paintingsAsArray[0]["LastName"] . '</h5>';
	echo '<div class="ui items">';
	foreach($paintingsAsArray as $row) {
		outputItem($row["PaintingID"], $row["ImageFileName"], $row["Title"], $row["FirstName"], $row["LastName"], $row["Description"]);
	}
	echo '</div>';
}

/*
Displays paintings when the user has filtered them by museum.  
Calls a method in write.inc.php to actually output the items for each painting. 
*/
function displayPaintingsByMuseum($museumID) {
	$sql = getPaintingsByMuseumLimit20();
	$paintings = getUniqueInfo($sql, $museumID);
	$paintingsAsArray = $paintings->fetchAll();
	
	echo '<h5>MUSEUM = ' . $paintingsAsArray[0]["GalleryName"] . '</h5>';
	echo '<div class="ui items">';
	foreach($paintingsAsArray as $row) {
		outputItem($row["PaintingID"], $row["ImageFileName"], $row["Title"], $row["FirstName"], $row["LastName"], $row["Description"]);
	}
	echo '</div>';
}

/*
Displays paintings when the user has filtered them by shape.  
Calls a method in write.inc.php to actually output the items for each painting. 
*/
function displayPaintingsByShape($shapeID) {
	$sql = getPaintingsByShapeLimit20();
	$paintings = getUniqueInfo($sql, $shapeID);
	$paintingsAsArray = $paintings->fetchAll();
	
	echo '<h5>SHAPE = ' . $paintingsAsArray[0]["ShapeName"] . '</h5>';
	echo '<div class="ui items">';
	foreach($paintingsAsArray as $row) {
		outputItem($row["PaintingID"], $row["ImageFileName"], $row["Title"], $row["FirstName"], $row["LastName"], $row["Description"]);
	}
	echo '</div>';
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
<section class="ui segment">	
	<form class="ui form" action="browse-paintings.php" method="GET"> 
	<fieldset>
		<h4 class="ui dividing header">Filters</h4>
		<div class="field">
			<label>Artist</label>
			<select class="ui fluid dropdown" name="artist">
				<option value="0">Select Artist</option>
				<?php writeArtistList(); ?>
			</select>
		</div>
		<div class="field">
			<label>Museum</label>
			<select class="ui fluid dropdown" name="museum">
				<option value="0">Select Museum</option>
				<?php writeGalleryList(); ?>
			</select>
		</div>
		<div class="field">
			<label>Shape</label>
			<select class="ui fluid dropdown" name="shape">
				<option value="0">Select Shape</option>
				<?php writeShapeList(); ?>
			</select>
		</div>
		<button class="ui huge orange button" type="submit">
		<i class="filter icon"></i> Filter</button>
	</fieldset>
	</form>	
<section class="ui segment">
	<h1>Paintings</h1>
	
	<?php 
	/*
	This is where the decision is made on what paintings to display. All the functions called are at the top of the page. 
	*/
		if (!$_GET) {
			displayDefaultPaintings();
		}
		elseif (isset($_GET) && $_GET["artist"] != 0 && is_numeric($_GET["artist"]) && idExists($_GET["artist"], "Artist")){
			displayPaintingsByArtist($_GET["artist"]);
		}
		elseif (isset($_GET) && $_GET["museum"] != 0 && is_numeric($_GET["museum"]) && idExists($_GET["museum"], "Gallery")){
			displayPaintingsByMuseum($_GET["museum"]);
		}
		elseif (isset($_GET) && $_GET["shape"] != 0 && is_numeric($_GET["shape"]) && idExists($_GET["shape"], "Shape")){
			displayPaintingsByShape($_GET["shape"]);
		}
		elseif (isset($_GET['searchValue']) && $_GET['searchValue'] != ''){
			displaySearchResults();
		}
		else {
			displayDefaultPaintings();
		}
			
	?>
</section>
</body>