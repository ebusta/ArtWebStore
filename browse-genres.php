<?php 

include "BusinessLayer/SqlGenerator.php";
include "DataLayer/DatabaseAccess.php";
include "PresentationLayer/write.inc.php";

/*
This function gets all the genre IDs, and using them gets the pictures that correspond to each genre.
Then, it calls a function in write.inc.php to output all the individual cards.
*/
function displayGenres(){
	$sql = getGenreIDs();
	$genreIDs = getGenericInfo($sql);
	$genreIDArray = $genreIDs->fetchAll();
	
	for($i = 0; $i < count($genreIDArray); $i++){
		$sql2 = getPaintingsForGenres();
		$painting = getUniqueInfo($sql2, $genreIDArray[$i][0]);
		$paintingAsArray = $painting->fetchAll();
		
		$altText = 'A painting showcasing the ' . $paintingAsArray[0]["GenreName"] . ' genre.';
		outputSmallCard($paintingAsArray[0]["GenreID"], "genre", $altText, $paintingAsArray[0]["GenreName"]);
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
        <h1 class="ui huge header">Genres</h1>
    </div>  
</div>  

<h2 class="ui horizontal divider"></h2> 

<div class="ui centered cards">

<?php displayGenres(); /*at top of page */?>

</body>