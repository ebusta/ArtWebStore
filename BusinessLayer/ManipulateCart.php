<?php 
include_once ( $_SERVER['DOCUMENT_ROOT'] . '/assign1_esmis676/DataLayer/DatabaseAccess.php' );
include_once ( $_SERVER['DOCUMENT_ROOT'] . '/assign1_esmis676/PresentationLayer/write.inc.php' );
include_once ( $_SERVER['DOCUMENT_ROOT'] . '/assign1_esmis676/BusinessLayer/cartItem.class.php' );
include_once ( $_SERVER['DOCUMENT_ROOT'] . '/assign1_esmis676/BusinessLayer/cart.class.php' );
include_once ( $_SERVER['DOCUMENT_ROOT'] . '/assign1_esmis676/PresentationLayer/cartButton.php' );


session_start();

/*
Sets up the array that's in the $_SESSION variable. Used to store data about CartItem objects.
*/
function initializeCartArray(){
    if(!isset($_SESSION["cart"])){
        $_SESSION["cart"] = array();
    }
}

/*
Creates a cart Item Object, adds it to the "cart" (the $_SESSION variable)
*/
function addPaintingToCart($paintingID, $quantity, $frame, $glass, $matt){
    if ($frame == -1){
        $frame = 18;
    }
    if ($glass == -1){
        $glass = 5;
    }
    if ($matt == -1){
        $matt = 35;
    }
    $newItem = new cartItem($paintingID, $glass, $frame, $matt, $quantity);
    $newItemString = $newItem->toString();
    if(!in_array($newItemString,$_SESSION["cart"])){
        array_push($_SESSION["cart"],$newItemString);
    }
}

/*
Removes a cart item from the cart. 
*/
function removeSinglePaintingFromCart($paintingID){
    for($i = 0; $i < count($_SESSION["cart"]); $i++){
        $currentItem = explode(":",$_SESSION["cart"][$i]);
        $thisCartItem = new cartItem ($currentItem[0],$currentItem[1],$currentItem[2],$currentItem[3],$currentItem[4]);
        if($thisCartItem->get_painting() == $paintingID){
            array_splice($_SESSION["cart"], $i, 1);
        }
    }
}

/*
Checks if any options have been changed on a cart item and then updates the item accordingly. 
*/
function updateCart(){
    $totalItems = getCartCount()-1;
    for($j=$totalItems; $j>=0; $j--){
        $toCompare = explode(":",$_SESSION["cart"][$j]);
        if ($_POST['quantity'.$j] != $toCompare[4] || $_POST['glass'.$j] != $toCompare[1] || $_POST['frame'.$j] != $toCompare[2] || $_POST['matte'.$j] != $toCompare[3]){
            removeSinglePaintingFromCart($toCompare[0]);
            addPaintingToCart($_POST['paintingID'.$j], $_POST['quantity'.$j], $_POST['frame'.$j], $_POST['glass'.$j], $_POST['matte'.$j]);
            
        }
    }
}

/*
When the cart is emptied, clears the $_SESSION variable. 
*/
function emptyCart(){
    unset($_SESSION["cart"]);
}

?>