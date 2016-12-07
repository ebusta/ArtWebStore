<?php

/*
Outputs the correct number of grey and empty stars requested. 
*/
function generateStarsGrey($numStars){
    for($i = 0; $i < $numStars; $i++){
		echo '<i class="star icon"></i>';
	}
	for ($j = 5; $j > $numStars; $j--){
		echo '<i class="empty star icon"></i>';
	}
}

/*
Outputs the correct number of orange and empty stars requested. 
*/
function generateStarsOrange($numStars){
    for($i = 0; $i < $numStars; $i++){
		echo '<i class="orange star icon"></i>';
	}
	for ($j = 5; $j > $numStars; $j--){
		echo '<i class="empty star icon"></i>';
	}
}

/*
Calculates what a paintings overall rating should be, based upon scores from individual reviews. 
*/
function calculateRating($paintingID){
	$reviewCount = 0;
	$ratingSum = 0;
	$sql = getPaintingReviews();
	$reviews = getUniqueInfo($sql, $paintingID);
	
	while ($row = $reviews->fetch()){
		$reviewCount += 1;
		$ratingSum += $row["Rating"];
	}
	
	$actualRating = $ratingSum / $reviewCount;
	return ceil($actualRating);
}

?>