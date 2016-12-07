<?php 

include "BusinessLayer/SqlGenerator.php";
include "DataLayer/DatabaseAccess.php";
include "PresentationLayer/write.inc.php";

function displaySubjects(){
	$sql = getSubjectIDs();
	$subjectIDs = getGenericInfo($sql);
	$subjectIDArray = $subjectIDs->fetchAll();
	
	for($i = 0; $i < count($subjectIDArray); $i++){
		$sql2 = getPaintingsBySubject();
		$painting = getUniqueInfo($sql2, $subjectIDArray[$i][0]);
		$paintingAsArray = $painting->fetch();
		
		$altText = 'A painting showcasing the ' . $paintingAsArray[4] . ' Subject.';
		outputSmallCardV2($paintingAsArray[3], "work",$paintingAsArray[0], $altText, $paintingAsArray[4]);
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
        <h1 class="ui huge header">Subjects</h1>
    </div>  
</div>  

<h2 class="ui horizontal divider"></h2> 

<div class="ui centered cards">

<?php displaySubjects(); ?>

</body>