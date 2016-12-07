<?php

include "BusinessLayer/CheckIfIDExists.php";
include "BusinessLayer/SqlGenerator.php";
include "PresentationLayer/write.inc.php";

/*
Creates the blurb about the selected genre. 
*/
function createBlurb($genreID){
	$sql = getGenreDetails();
	$picture = getUniqueInfo($sql, $genreID);
	$paintingAsArray = $picture->fetchAll();
	
	echo '<section class="ui segment grey100"><div class="ui items">';
	echo '<div class="item"><div class="image"><a href="single-painting.php?id=' . $genreID . '" action="GET">';
	echo '<img src="images/art/genres/square-medium/' . $genreID . '.jpg" alt="A Painting Depicting ' . $paintingAsArray[0][3] . '" class="ui medium image"></a></div>';
	echo '<div class="content"><h1 class="header">' . $paintingAsArray[0][1] . '</h1>';
	echo '<div class="description">' . $paintingAsArray[0][2] . '</div>';
	echo '</div></div></div></section>';
}

/*
Displays all paintings that fall within the selected genre.
Calls a function in write.inc.php to actually output the cards for each painting. 
*/
function displayList($genreID){
	$sql = getPaintingsByGenre();
	$pictures = getUniqueInfo($sql, $genreID);
	
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
If the user has selected a genre, will show a blurb about that genre. If not, displays the Romanticism genre.
*/
if (isset($_GET["id"]) && is_numeric($_GET["id"]) && idExists($_GET["id"], "Genre")){
	createBlurb($_GET["id"]);
}
else {
	createBlurb(33);
}
?>

<h3>Paintings</h3>
	<div class="ui centered cards">
		
<?php 
/*
If user has selected a genre, will display the paintings that fall into that genre. If not, shows a whole lotta romantic paintings. 
*/
if (isset($_GET["id"]) && is_numeric($_GET["id"]) && idExists($_GET["id"], "Genre")){
	displayList($_GET["id"]);
}
else {
	displayList(33);
}
?>

	</div>
</body>