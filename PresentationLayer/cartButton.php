<?php 
session_start();
include_once "BusinessLayer/ManipulateCart.php";

/*
Creates the shopping cart button in the header. 
*/
function createCartHeadButton(){
    initializeCartArray();
    $itemsInCart = count($_SESSION["cart"]);
    $cartBut = '<a class="item" href="shopping-cart.php"><i class="shop icon"></i> Cart' . createCartCountLabel() . '</a>';
    return $cartBut;
}

/*
Creates the label that displays how many items are in the shopping cart for the button in the header. 
Doesn't do anything if the cart is empty.
*/
function createCartCountLabel(){
    $count = getCartCount();
    $label = " ";
    
    if($count != 0) {
        $label = '<div class = "ui blue horizontal label">'.$count.'</div>';
    }
    return $label;
}

/*
Creates the button the user uses to empty the cart. 
*/
function createEmptyCartButton(){
    return '<h2 class = "ui horizontal divider"><a class = "ui red button" href ="shopping-cart.php?removeAllCart=1"> Empty Cart</a></h2><br>';
}

/*
Returns how many items are in the "cart", aka the $_SESSION variable. 
*/
function getCartCount(){
    $count = 0;
    
    foreach($_SESSION["cart"] as $value){
        $count++;
    }
    return $count;
}

?>