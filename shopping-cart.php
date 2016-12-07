<?php 

include("BusinessLayer/SqlGenerator.php");
include("BusinessLayer/cart.class.php");
include("BusinessLayer/CartFunctions.php");
include("DataLayer/DatabaseAccess.php");
include("PresentationLayer/frame-glass-mattLists.inc.php");
include("PresentationLayer/write.inc.php");
include_once ("BusinessLayer/ManipulateCart.php");

/*
A function we used for debugging. Sorry if it's cheating as we used Javascript. 
However, when the finished page is run, it never gets used.
*/
function debugAlert($message){
	echo '<script type="text/javascript">alert("' . $message . '")</script>';
}

/*
Another debugging function. Used to help understand what was going on with our $_SESSION variable. 
*/
function parseAndPrint($objectString){
    $objectStringArray = explode(":",$objectString);
    foreach($objectStringArray as $value){
        echo $value . '<br />';
    }
}
/*
This function is responsible for creating each row in our Cart. 
It calls several functions to actually output final things.
The functions to output the lists of frames, glass and matte options are all in write.inc.php
The final function called to calculate how much each object costs is in CartFunctions.php
*/
function createCartRow($cartItemObj, $cartObj, $i){
    $sql = getPaintingCartItem();
    $paintingDetails = getUniqueInfo($sql, $cartItemObj->get_painting());
    $paintingDetailsAsArray = $paintingDetails->fetchAll();
    
    echo '<tr><td><a href="single-painting.php?id=' . $paintingDetailsAsArray[0][0] . '">';
    echo '<img src="images/art/works/square-small/' . $paintingDetailsAsArray[0][1] . '.jpg" alt="Test picture 1" /></a></td>';
    echo '<td>' . $paintingDetailsAsArray[0][2] . '</td>';
    echo '<td>$' . ((int)$paintingDetailsAsArray[0][3] * $cartItemObj->get_quantity()) . '</td>';
    echo '<td><div class="four fields"><div class="three wide field"><label>Quantity</label><input name ="quantity'.$i.'" type="number" min="1" value="'.$cartItemObj->get_quantity().'"></div>';
    echo '<div class="four wide field"><label>Frame: </label><select name="frame'.$i.'" class="ui search dropdown">';
    
    buildFrameList($cartItemObj->get_frame(), true);
    
    echo '</select></div>';
    echo '<div class="four wide field"><label>Glass: </label><select name="glass'.$i.'" class="ui search dropdown">';
    
    buildGlassList($cartItemObj->get_glass(), true);
    
    echo '</select></div>';
    echo '<div class="four wide field"><label>Matte: </label><select name="matte'.$i.'" class="ui search dropdown">';
    
    buildMattList($cartItemObj->get_matte(), true);
    
    echo '</select></div><input type="hidden" name="paintingID'.$i.'" value="'.$cartItemObj->get_painting().'"></div></td>';
    
    $rowTotal = calculateIndividualAmount($paintingDetailsAsArray[0][3], $cartItemObj, $cartObj);
    
    echo '<td>$' . $rowTotal . '</td></tr>';
    echo '<td><a class = "ui red button" href ="shopping-cart.php?removePainting='.$paintingDetailsAsArray[0][0].'"> Remove </a></td>';
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

<?php 
/*
A series of functions that decide what to do with the page upon loading.
They all call functions in ManipulateCart.php
*/
if($_GET['removeAllCart'] == 1){
    emptyCart();
}
if(isset($_GET['removePainting'])){
    removeSinglePaintingFromCart($_GET['removePainting']);
}
if(isset($_GET["updateCart"]) && $_GET["updateCart"] == 1){
    updateCart();
}
if ($_POST["paintingID"] != null && $_POST["paintingID"] != ""){
    if (itemAlreadyExists($_POST["paintingID"])){
        removeSinglePaintingFromCart($_POST["paintingID"]);
    }
    addPaintingToCart($_POST["paintingID"],$_POST["quantity"],$_POST["frame"],$_POST["glass"],$_POST["matt"]);
}



include 'PresentationLayer/header.inc.php'; ?>

<div class="banner1-container">
    <div class="ui text container">
        <h1 class="ui huge header"><i class="add to cart icon"></i>Your Cart</h1>
    </div>  
</div> 
<br>

<?php

/*
Decides how to display the page. If the session variable is set, it will display a cart. Otherwise it will prompt the user to spend their hard earned cash
Function calls are specified as they happen.
*/
    if (count($_SESSION["cart"]) != 0){
        echo createEmptyCartButton(); //cartButton.php
        outputCartTableHead(); //write.inc.php
        $thisCart = new cart();
        for ($i=0; $i<count($_SESSION["cart"]); $i++){
            $currentItem = explode(":",$_SESSION["cart"][$i]);
            $thisCartItem = new cartItem ($currentItem[0],$currentItem[1],$currentItem[2],$currentItem[3],$currentItem[4]);
            createCartRow($thisCartItem, $thisCart,$i); //top of this page
        }
        outputCartTableBottom($thisCart); //CartFunctions.php
        echo '<br><h1 class="ui horizontal divider"><button class="ui huge blue button">Update Cart</button>';
        echo '<a href="index.php" class="ui huge orange button">Continue Shopping</a>';
        echo '<a href="#" class="ui huge green button">Checkout</a></h1>';
        echo '</form>';
        
    }
    else {
         echo '<h1 class="ui horizontal divider"> You have nothing in your shopping cart! </h3><br>';
         echo '<h1 class="ui horizontal divider"><a href ="browse-paintings.php" class="ui huge orange button" >Shop Now</a>';
    }
?>
</body>