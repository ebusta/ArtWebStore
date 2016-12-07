<?php 

include "BusinessLayer/SqlGenerator.php";
include "DataLayer/DatabaseAccess.php";
include "PresentationLayer/write.inc.php";

/*
This function gets all the artist IDs, and using them gets the pictures that correspond to each artist.
Then, it calls a function in write.inc.php to output all the individual cards.
*/
function displayArtists(){
	$sql = getArtistIDs();
	$artistIDs = getGenericInfo($sql);
	$artistIDArray = $artistIDs->fetchAll();
	
	for($i = 0; $i < count($artistIDArray); $i++){
		$sql2 = getPaintingsForArtists();
		$painting = getUniqueInfo($sql2, $artistIDArray[$i][0]);
		$paintingAsArray = $painting->fetchAll();
		
		$name = $paintingAsArray[0]["FirstName"] . ' ' . $paintingAsArray[0]["LastName"];
		$altText = 'A picture of ' . $name . '.';
		outputSmallCard($paintingAsArray[0]["ArtistID"], "artist", $altText, $name);
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
        <h1 class="ui huge header">Artists</h1>
    </div>  
</div>  

<h2 class="ui horizontal divider"></h2> 

<div class="ui centered cards">

<?php displayArtists(); /*at top of page*/ ?>

</body>