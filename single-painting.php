<?php 
include "BusinessLayer/painting.class.php";
include "BusinessLayer/CheckIfIDExists.php";
include "BusinessLayer/GenerateStars.php";
include "BusinessLayer/SqlGenerator.php";
include "PresentationLayer/write.inc.php";
include "PresentationLayer/frame-glass-mattLists.inc.php";

/*
Another instance of our cheating debug function. 
*/
function debugAlert($message){
	echo '<script type="text/javascript">alert("' . $message . '")</script>';
}

/*
Gets a painting object upon which the rest of the page will be built. 
Calls the funtion painting.class.php
*/
function getPainting($paintingID) {
	$sql = getPaintingObject();
	$painting = getUniqueInfo($sql, $paintingID);
	$pArray = $painting->fetchAll();
	$pObject = new complexPaintingObject($pArray[0][0],$pArray[0][1],$pArray[0][2],$pArray[0][3],$pArray[0][4],$pArray[0][5],$pArray[0][6],$pArray[0][7],$pArray[0][8],$pArray[0][9],$pArray[0][10],$pArray[0][11],$pArray[0][12],$pArray[0][13],$pArray[0][14],$pArray[0][15],$pArray[0][16],$pArray[0][17],$pArray[0][18],$pArray[0][19]);
	//debugAlert($pObject->get_imageFileName() );
	return $pObject;
}

/*
The page needs to display the name of the artist who drew the painting. This function gets it. 
*/
function getArtistName($paintingID) {
	$sql = getArtistNameSinglePainting();
	$artist = getUniqueInfo($sql, $paintingID);
	$aArray = $artist->fetchAll();
	return $aArray[0][0] . ' ' . $aArray[0][1];
}

/*
The page needs to display the name of the museum that holds the painting. This function gets it. 
*/
function getMuseumName($paintingID) {
	$sql = getMuseumNameSinglePainting();
	$museum = getUniqueInfo($sql, $paintingID);
	$mArray = $museum->fetchAll();
	return $mArray[0][0];
}

/*
Displays the main picture in the top left corner of the page. 
*/
function displayPicture($paintingObj) {
	echo '<div class="nine wide column">';
	echo '<img src="images/art/works/medium/' . $paintingObj->get_imageFileName() . '.jpg" alt="A Painting Depicting ' . $paintingObj->get_title() . '" class="ui big image" id="artwork">';
	echo '<div class="ui fullscreen modal"><div class="image content">';
	echo '<img src="images/art/works/large/' . $paintingObj->get_imageFileName() . '.jpg" alt="A Painting Depicting' . $paintingObj->get_imageFileName() . '" class="image" >';
	echo '<div class="description"><p></p></div></div></div></div>';
}

/*
Displays the info panel in the top right corner of the page. 
Calls functions to calculate how many stars the painting is and then output them. Both functions are in GenerateStars.php
*/
function displayInfo($paintingObj, $artistName){
	echo '<div class="item">';
	echo '<h2 class="header">' . $paintingObj->get_title() . '</h2>';
	echo '<h3>' . $artistName . '</h3><div class="meta"><p>';
	$overallRating = calculateRating($paintingObj->get_paintingID());
	generateStarsOrange($overallRating);
	echo '</p><p>' . $paintingObj->get_excerpt() . '</p></div></div>';
}

/*
Displays the first tab in the centre-right of the page, with details about the painting. 
*/
function displayDetailsTable($paintingObj, $artistName){
	echo '<tbody><tr><td>Artist</td><td><a href="single-artist.php?id=' . $paintingObj->get_artistID() . '">' . $artistName . '</a></td></tr>';
	echo '<tr><td>Year</td><td>' . $paintingObj->get_yearOfWork() . '</td></tr>';
	echo '<tr><td>Medium</td><td>' . $paintingObj->get_medium() . '</td></tr>';
	echo '<tr><td>Dimensions</td><td>' . $paintingObj->get_width() . ' x ' . $paintingObj->get_height() . '</td></tr></tbody>';
}

/*
Displays the second tab in the centre-right of the page, with details about the painting's museum. 
*/
function displayMuseumTable($paintingObj, $museumName){
	echo '<tbody><tr><td>Museum</td><td><a href="single-gallery.php?id=' . $paintingObj->get_galleryID() . '">' . $museumName . '</td></tr>';
	echo '<tr><td>Accession #</td><td>' . $paintingObj->get_accessionNumber() . '</td></tr>';
	echo '<tr><td>Copyright</td><td>' . $paintingObj->get_copyrightText() . '</td></tr>';
	echo '<tr><td>URL</td><td><a href="' . $paintingObj->get_museumLink() . '">View painting at museum site</a></td></tr></tbody>';
}

/*
Displays the third tab in the centre-right of the page, with details about the genres. 
*/
function displayGenres($pictureID){
	$sql = getGenresOfPainting();
	$genres = getUniqueInfo($sql, $pictureID);
		
	echo '<ul class="ui list">';
	while ($row = $genres->fetch()){
		echo '<li class="item"><a href="single-genre.php?id=' . $row["GenreID"] . '">' . $row["GenreName"] . '</a></li>';
	}
	echo '</ul>';
}

/*
Displays the fourth tab in the centre-right of the page, with details about the subjects. 
*/
function displaySubjects($pictureID){
	$sql = getSubjectsOfPainting();
	$subjects = getUniqueInfo($sql, $pictureID);
		
	echo '<ul class="ui list">';
	while ($row = $subjects->fetch()){
		echo '<li class="item"><a href="single-subject.php?id='.$row["SubjectID"].'">' . $row["SubjectName"] . '</a></li>';
	}
	echo '</ul>';
}

/*
Displays the price box in the bottom-right corner of the page. 
Calls several functions to create the lists of options for purchasing the painting, all are in frame-glass-mattLists.inc.php
*/
function displayPriceBox($paintingObj){
	echo '<form action="shopping-cart.php" method="post">';
	echo '<div class="ui segment"><div class="ui form"><div class="ui tiny statistic"><div  class="value">$' . (int)$paintingObj->get_msrp() . '</div></div>';
	echo '<div class="four fields"><div class="three wide field"><label>Quantity</label><input name ="quantity" type="number" min="1" value="1"></div>';
	echo '<div class="four wide field"><label>Frame</label><select name="frame" class="ui search dropdown">';
	
	buildFrameList(-1, false);
	
	echo '</select></div>';
	echo '<div class="four wide field"><label>Glass</label><select name="glass" class="ui search dropdown">';
	
	buildGlassList(-1, false);
	
	echo '</select></div>';
	echo '<div class="four wide field"><label>Matt</label><select name="matt" class="ui search dropdown">';
	
	buildMattList(-1, false);
	
	echo '</select></div></div></div>';
	echo '<div class="ui divider"></div>';
	echo '<input type="hidden" name="paintingID" value="'.$paintingObj->get_paintingID().'">';
	echo '<button class="ui labeled icon orange button"><i class="add to cart icon"></i>Add to Cart</button>';
	echo '<a href="favorites.php?addFavPainting='.$paintingObj->get_paintingID().'" class="ui right labeled icon button">Add to Favorites<i class="centered heart icon"></i></a></div></form>';
}

/*
Displays the first tab in the bottom of the page, with an in-depth description of the painting. 
*/
function displayDescription($paintingObj){
	echo $paintingObj->get_description();
}

/*
Displays the second tab in the bottom of the page, with links to places the painting can be viewed on other pages.  
*/
function displayOnTheWebTable($paintingObj){
	echo '<tbody><tr><td>Wikipedia Link</td><td><a href="' . $paintingObj->get_wikiLink() . '">View painting on Wikipedia</a></td></tr>';
	echo '<tr><td>Google Link</td><td><a href="' . $paintingObj->get_googleLink()  . '">View painting on Google Art Project</a></td></tr>';
	echo '<tr><td>Google Text</td><td>' . $paintingObj->get_googleDescription() . '</td></tr></tbody>';
}

/*
Displays the third tab in the bottom of the page, with reviews about the painting. 
Calls a function in GenerateStars.php to display the stars for each review. 
*/
function displayReviews($pictureID){
	$sql = getPaintingReviews();
	$reviews = getUniqueInfo($sql, $pictureID);

	while ($row = $reviews->fetch()){
		$date = strtotime($row["ReviewDate"]);
		$dateToWrite = date("Y-m-d", $date);
		echo '<div class="event"><div class="content"><div class="date">' . $dateToWrite . '</div>';
		echo '<div class="meta"><a class="like">';
		generateStarsGrey($row["Rating"]);
		echo '</a></div><div class="summary">' . $row["Comment"] . '</div></div></div>';
		echo '<div class="ui divider"></div>'; 
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
<body >
<?php include 'PresentationLayer/header.inc.php'; ?>
    
<main >
    <!-- Main section about painting -->
    <?php 
    /*
    Sets up the page.
    If the user has selected a painting to view, will get that object. If not, gets the object for Rembrandt's The Anatomy Lesson of Dr. Nicolaes Tulp
    */
		if (isset($_GET["id"]) && is_numeric($_GET["id"]) && idExists($_GET["id"], "Painting")){
			$pObj = getPainting($_GET["id"]); 
			$artistName = getArtistName($_GET["id"]);
			$museumName = getMuseumName($_GET["id"]);
		}
		else {
			$pObj = getPainting(420);
			$artistName = getArtistName(420);
			$museumName = getMuseumName(420);
		}
	?>
    <section class="ui segment grey100">
        <div class="ui doubling stackable grid container">
        	
		<?php displayPicture($pObj); ?>
			
            <div class="seven wide column">
                <?php displayInfo($pObj, $artistName); ?>                    
                  
                <!-- Tabs For Details, Museum, Genre, Subjects -->
                <div class="ui top attached tabular menu ">
                    <a class="active item" data-tab="details"><i class="image icon"></i>Details</a>
                    <a class="item" data-tab="museum"><i class="university icon"></i>Museum</a>
                    <a class="item" data-tab="genres"><i class="theme icon"></i>Genres</a>
                    <a class="item" data-tab="subjects"><i class="cube icon"></i>Subjects</a>    
                </div>
                
                <div class="ui bottom attached active tab segment" data-tab="details">
                    <table class="ui definition very basic collapsing celled table">
						<?php displayDetailsTable($pObj, $artistName); ?> 
					</table>
                </div>
					
                <div class="ui bottom attached tab segment" data-tab="museum">
                    <table class="ui definition very basic collapsing celled table">
						<?php displayMuseumTable($pObj, $museumName); ?> 
                    </table>    
                </div>     
                <div class="ui bottom attached tab segment" data-tab="genres">
					<?php displayGenres($pObj->get_paintingID()); ?> 
                </div>  
                <div class="ui bottom attached tab segment" data-tab="subjects">
					<?php displaySubjects($pObj->get_paintingID()); ?> 
                </div>  
                
                <!-- Cart and Price -->
				<?php displayPriceBox($pObj); ?>
				<!-- END Cart -->                      
                          
            </div>	<!-- END RIGHT data Column --> 
        </div>		<!-- END Grid --> 
    </section>		<!-- END Main Section --> 
    
    <!-- Tabs for Description, On the Web, Reviews -->
    <section class="ui doubling stackable grid container">
        <div class="sixteen wide column">
        
            <div class="ui top attached tabular menu ">
              <a class="active item" data-tab="first">Description</a>
              <a class="item" data-tab="second">On the Web</a>
              <a class="item" data-tab="third">Reviews</a>
            </div>
			
            <div class="ui bottom attached active tab segment" data-tab="first">
				<?php displayDescription($pObj); ?>
            </div>	<!-- END DescriptionTab --> 
			
            <div class="ui bottom attached tab segment" data-tab="second">
				<table class="ui definition very basic collapsing celled table">
					<?php displayOnTheWebTable($pObj); ?> 
                </table>
            </div>   <!-- END On the Web Tab --> 
			
            <div class="ui bottom attached tab segment" data-tab="third">   
				<div class="ui feed">
					<?php displayReviews($pObj->get_paintingID()); ?>   
				</div>                                
            </div>   <!-- END Reviews Tab -->          
        
        </div>        
    </section> <!-- END Description, On the Web, Reviews Tabs --> 
    
    <!-- Related Images ... will implement this in assignment 2 -->    
    <section class="ui container">
    <h3 class="ui dividing header">Related Works</h3>        
	</section>  
	
</main>    
  <footer class="ui black inverted segment">
      <div class="ui container"></div>
  </footer>
</body>
</html>