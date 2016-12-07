<?php

include "BusinessLayer/CheckIfIDExists.php";
include "BusinessLayer/SqlGenerator.php";
include "PresentationLayer/write.inc.php";

/*
Creates the blurb about the Subject to be viewed on this page. 
*/
function createBlurb($subjectID){
	$sql = getSubjectDetails();
	$picture = getUniqueInfo($sql, $subjectID);
	$paintingAsArray = $picture->fetchAll();
	
	echo '<section class="ui segment grey100"><div class="ui items">';
	echo '<div class="item"><div class="image"><a href="single-painting.php?id=' . $paintingAsArray[0][3] . '" action="GET">';
	echo '<img src="images/art/works/square-medium/' . $paintingAsArray[0][4] . '.jpg" alt="A Painting Depicting ' . $paintingAsArray[0][2] . '" class="ui medium image"></a></div>';
	echo '<div class="content"><h1 class="header">' . $paintingAsArray[0][1] . '</h1>';
	echo '<div class="description">Paintings that contain or represent ' . $paintingAsArray[0][1] . '</div>';
	echo '</div></div></div></section>';
}

/*
Displays all paintings that feature the selected subject.
Calls a function in write.inc.php to actually output the cards for each painting. 
*/
function displayList($subjectID){
	$sql = getPaintingsBySubject();
	$pictures = getUniqueInfo($sql, $subjectID);
	
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
If the user has selected a Subject, will display the blurb for that. If not, displays the Botanical subject cuz we chill like that
*/
if (isset($_GET["id"]) && is_numeric($_GET["id"]) && idExists($_GET["id"], "Subject")){
	createBlurb($_GET["id"]);
}
else {
	createBlurb(12);
}
?>

<h3>Paintings</h3>
	<div class="ui centered cards">
		
<?php 
/*
If the user has selected a Subject, will display all the paintings for that Subject. If not, it displays all the Botanical paintings.
*/
if (isset($_GET["id"]) && is_numeric($_GET["id"]) && idExists($_GET["id"], "Subject")){
	displayList($_GET["id"]);
}
else {
	displayList(12);
}
?>
	</div>

</body>