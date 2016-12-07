<?php 
include_once ( $_SERVER['DOCUMENT_ROOT'] . '/assign1_esmis676/DataLayer/DatabaseAccess.php' );
include_once ( $_SERVER['DOCUMENT_ROOT'] . '/assign1_esmis676/PresentationLayer/write.inc.php' );


/*
Takes in search parameter and searches through the database for matches
calls the printsearchresults function
*/
function searchPaintings($searchValue){
    $searchTitleSQL = getSearchSQL();
    $matchedPaintingIDsTitle = getSearchInfo($searchTitleSQL,$searchValue);
    
    printSearchResults($matchedPaintingIDsTitle);
}

/*
Outputs the paintings that match the search parameters
*/
function printSearchResults($matchedPaintings){
    while($row = $matchedPaintings->fetch()){
      	outputItem($row["PaintingID"], $row["ImageFileName"], $row["Title"], $row["FirstName"], $row["LastName"], $row["Description"]);  
    }
}

?>