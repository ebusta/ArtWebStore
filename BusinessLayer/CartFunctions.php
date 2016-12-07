<?php
/*
Calculates how much each Cart Item is worth in total. Updates the totals in the Cart object. 
*/
function calculateIndividualAmount($msrp, $cartItem, $cartObj){
    $frameCost = getFrameCost($cartItem->get_frame());
    $glassCost = getGlassCost($cartItem->get_glass());
    $mattCost = getMattCost($cartItem->get_matte());
    $price = $cartItem->get_quantity() * ($msrp + $frameCost + $glassCost + $mattCost);
    $cartObj->incrementItems();
    $cartObj->increaseTotalCost($price);
    $cartObj->increaseIndividualPaintings($cartItem->get_quantity());
    return $price;
}

/*
Gets how much a frame type costs. 
*/
function getFrameCost($frameID){
    $sql = getFramePrice();
    $frame = getUniqueInfo($sql, $frameID);
    $frameArray = $frame->fetchAll();
    return $frameArray[0][0];
}

/*
Gets how much a glass type costs. 
*/
function getGlassCost($glassID){
    $sql = getGlassPrice();
    $glass = getUniqueInfo($sql, $glassID);
    $glassArray = $glass->fetchAll();
    return $glassArray[0][0];
}

/*
Determines if a matt has been selected or not.  
*/
function getMattCost($mattID){
    $mattCost = 0;
    if ($mattID > 0 && $mattID < 35){
			$mattCost = 10;
		}
	return $mattCost;
}

/*
Calculates how much the standard shipping will be for the total cart. Updates the cart object. 
*/
function calculateStandardShipping($cartObj){
    if ($cartObj->getTotalCost() < 1500){
        $shipping = ($cartObj->getTotalIndividualPaintings() * 25);
    }
    else {
        $shipping = 0;
    }
    $cartObj->setShippingCostStandard($shipping);
    return $shipping;
}

/*
Calculates how much the express shipping will be for the total cart. Updates the cart object. 
*/
function calculateExpressShipping($cartObj){
    if ($cartObj->getTotalCost() < 2500){
        $shipping = ($cartObj->getTotalIndividualPaintings() * 50);
    }
    else {
        $shipping = 0;
    }
    $cartObj->setShippingCostExpress($shipping);
    return $shipping;
}

/*
Calculates how much the total cost of the order will be after standard shipping.  
*/
function calculateTotalStandard($cartObj){
    return $cartObj->getTotalCost() + $cartObj->getShippingCostStandard();
}

/*
Calculates how much the total cost of the order will be after express shipping.  
*/
function calculateTotalExpress($cartObj){
    return $cartObj->getTotalCost() + $cartObj->getShippingCostExpress();
}

/*
Outputs the final few rows of the Cart table. Stored here as it involves some calculations. 
*/
function outputCartTableBottom($cartObj){
	echo '<tr>
            <td class="negative right aligned" colspan="4">Subtotal</td>
            <td class="negative">$' . $cartObj->getTotalCost() . '</td>
        </tr>
        <tr class="negative">
            <td class=" right aligned" colspan="4">Shipping (Standard)</td>
            <td>$'.calculateStandardShipping($cartObj).'</td>
        </tr>
        <tr class="negative">
            <td class="right aligned" colspan="4">Shipping (Express)</td>
            <td>$'.calculateExpressShipping($cartObj).'</td>
        </tr>
        <tr class="positive">
            <td class="right aligned" colspan="4">Grand Total (Standard)</td>
            <td>$'.calculateTotalStandard($cartObj).'</td>
        </tr>
        <tr class="positive">
            <td class="right aligned" colspan="4">Grand Total (Express)</td>
            <td>$'.calculateTotalExpress($cartObj).'</td>
        </tr>
    </tbody>
</table>
</div>
</section>';
}

/*
Checks if a painting is already in the cart. Returns true if it exists, false otherwise. 
*/
function itemAlreadyExists($newPID){
    $inCart = false;
    for ($i=0; $i<count($_SESSION["cart"]); $i++){
        $itemToCheck = explode(":",$_SESSION["cart"][$i]);
        $pIDToCheck = $itemToCheck[0];
        if($newPID == $pIDToCheck){
            $inCart = true;
            break;
        }
    }
    return $inCart;
}

?>