<?php

/*
Outputs a Semantic UI list item. 
*/
function outputList($value, $text, $price, $defaultValue){
	if ($value == $defaultValue) {
    	echo '<option selected="selected" value="' . $value . '">' . $text . ' ($' . (int)$price . ')</option>';
	}
	else {
		echo '<option value="' . $value . '">' . $text . ' ($' . (int)$price . ')</option>';
	}
}

/*
Outputs a Semantic UI list item, but doesn't include the cost of it.  
*/
function outputListNoCurrency($value, $text){
	echo '<option value="' . $value . '">' . $text . '</option>';
}

/*
Outputs a Semantic UI Item. 
*/
function outputItem($paintingID, $imageFileName, $title, $firstName, $lastName, $description){
    echo '<div class="item"><div class="image">';
	echo '<a href="single-painting.php?id=' . $paintingID . '" action="GET"><image src="images/art/works/square-medium/' . $imageFileName . '.jpg" alt="A Picture Depicting ' . $title . '" class ="ui medium image"></a></div>';
	echo '<div class="content"><h2 class="header">' . $title . '</h2>';
	echo '<div class="meta"><span>' . $firstName . ' ' . $lastName . '</span></div>';
	echo '<div class="description"><p>' . $description . '</p></div>';
	echo '<div class="extra"><form class="ui form" action="shopping-cart.php" method="POST">';
	echo '<button class="ui tiny orange button"><i class="centered add to cart icon"></i></button>';
	echo '<input type="hidden" name="paintingID" value="'.$paintingID.'">';
	echo '<input type="hidden" name="quantity" value="1">';
	echo '<input type="hidden" name="frame" value="-1">';
	echo '<input type="hidden" name="glass" value="-1">';
	echo '<input type="hidden" name="matt" value="-1"></form>';
	echo '<a href="favorites.php?addFavPainting='.$paintingID.'" class="ui tiny button"><i class="centered heart icon"></i></a></div></div></div>';
}

/*
Outputs a Semantic UI Card, in a small variety. Designed to be generic. 
*/
function outputSmallCard($id, $cardType, $alt, $cardText){
    echo '<a class = "ui small card" href="single-' . $cardType . '.php?id=' . $id . '" action="GET"><div class = "image">';
	echo '<image src="images/art/' . $cardType . 's/square-medium/' . $id . '.jpg" alt="' . $alt . '.">';
	echo '</div><div class="header"><h2>' . $cardText . '</h2></div></a>';
}

/*
Outputs a Semantic UI Card, in a small variety. Used for Subjects. 
*/
function outputSmallCardV2($id, $cardType, $fileName, $alt, $cardText){
	
    echo '<a class = "ui small card" href="single-subject.php?id=' . $id . '" action="GET"><div class = "image">';
	echo '<image src="images/art/' . $cardType . 's/square-medium/' . $fileName . '.jpg" alt="' . $alt . '.">';
	echo '</div><div class="header"><h2>' . $cardText . '</h2></div></a>';
}

/*
Outputs a Semantic UI Card, of normal size. Designed to be generic. 
*/
function outputCard($id, $imageFileName, $alt){
    echo '<a class = "ui card" href="single-painting.php?id=' . $id . '" action="GET">';
	echo '<img src="images/art/works/square-medium/' . $imageFileName . '.jpg" alt="' . $alt . '" class="ui medium image"></a>';
}

/*
Outputs a Semantic UI Card, of normal size and with no image. Used for museums. 
*/
function outputCardNoImage($id, $name, $realName, $city, $country){
	echo '<div class="ui card"><div class="content"><a href="single-gallery.php?id=' . $id . '" action="GET"><div class="header"><i class="university icon"></i>';
	if ($name == $realName){
		echo $name . '</div></a>';
	}
	else {
		echo $name . ' (' . $realName . ')</div></a>';
	}
	echo '<div class="meta"><span>' . $city . ', ' . $country . '</span></div></div></div>';
}

/*
Outputs a Semantic UI card, used for the Favorites page. 
*/
function outputFavArtistCard($id, $cardType, $alt, $cardText) {
	echo '<div class = "ui five wide column">';
	echo '<a class = "ui small card" href="single-' . $cardType . '.php?id=' . $id . '" action="GET"><div class = "image">';
	echo '<image src="images/art/' . $cardType . 's/square-medium/' . $id . '.jpg" alt="' . $alt . '.">';
	echo '</div>'.$cardText.'</a>';
	echo '<a class = "ui red button" href ="favorites.php?removeArtist='.$id.'"> Remove </a>';
	echo '</div>';
}

/*
Outputs a Semantic UI card, used for the Favorites page. 
*/
function outputFavPaintingCard($id, $imageFileName, $alt, $title) {
	echo '<div class = "ui five wide column">';
	echo '<a class = "ui card" href="single-painting.php?id=' . $id . '" action="GET">';
	echo '<img src="images/art/works/square-medium/' . $imageFileName . '.jpg" alt="' . $alt . '" class="ui medium image">'.$title.'</a>';
	echo '<a class = "ui red button" href ="favorites.php?removePainting='.$id.'"> Remove </a>';
	echo '</div>';
}

/*
Outputs the start of a Cart table. 
*/
function outputCartTableHead(){
	echo '
<form action="shopping-cart.php?updateCart=1" method="post">
<section class="ui one column centered grid">

<div class="ui form" action="POST">
<table class="ui collapsing celled large table">
    <thead>
        <tr>
            <th colspan="2">Product</th>
            <th>Price</th>
            <th>Options</th>
            <th>Amount</th>
        </tr>
    </thead>
    <tbody>';
}

?>