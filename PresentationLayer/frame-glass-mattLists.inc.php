<?php

/*
Outputs the options in a select list for frames. If it's for the Cart, will not output a "Select" option. 
*/
function buildFrameList($selectedID, $forCart){
	$sql = getFramesList();
	$frames = getGenericInfo($sql);
	if (!$forCart){
		echo '<option value="-1">Select</option>';
	}
	while ($row = $frames->fetch()){
		outputList($row["FrameID"], $row["Title"], $row["Price"], $selectedID);
	}
}

/*
Outputs the options in a select list for glass types. If it's for the Cart, will not output a "Select" option. 
*/
function buildGlassList($selectedID, $forCart){
	$sql = getGlassList();
	$glass = getGenericInfo($sql);
	if (!$forCart){
		echo '<option value="-1">Select</option>';
	}
	while ($row = $glass->fetch()){
		outputList($row["GlassID"], $row["Title"], $row["Price"], $selectedID);
	}
}

/*
Outputs the options in a select list for mattes. If it's for the Cart, will not output a "Select" option. 
*/
function buildMattList($selectedID, $forCart){
	$sql = getMattList();
	$matt = getGenericInfo($sql);
	if (!$forCart){
		echo '<option value="-1">Select</option>';
	}
	while ($row = $matt->fetch()){
		if ($row["MattID"] < 1 || $row["MattID"] > 34){
			outputList($row["MattID"], $row["Title"], 0, $selectedID);
		}
		else {
			outputList($row["MattID"], $row["Title"], 10, $selectedID);
		}
	}
}

function finishTable(){
	echo '<tr>
            <td class="negative right aligned" colspan="4">Subtotal</td>
            <td class="negative">$600</td>
        </tr>
        <tr class="negative">
            <td class="negative right aligned" colspan="4">Shipping</td>
            <td class="negative">$25</td>
        </tr>
        <tr class="positive">
            <td class="right aligned" colspan="4">Grand Total</td>
            <td >$625</td>
        </tr>
    </tbody>
</table>
</section>';
}

?>