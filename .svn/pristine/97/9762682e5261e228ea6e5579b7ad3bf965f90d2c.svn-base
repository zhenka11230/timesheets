<?php
require_once("includes/controller_included.php");
//require_once("includes/Tip.php");

$status->destination = "add_tblTip";
$tip = new Tip(@$_GET['id']);
$tip->setPropertyValues($_POST);
if ($tip->exists) {
	$status->destination = "add_tblTip&id=".$tip->lngID;
}

if (!$tip->validate())
{
	$_SESSION[APPLICATION_NAME]['form_data'] = $_POST;
	$status->message = "<ul><li>".join("</li><li>",$tip->errorStack)."</li></ul>";
	$status->status = "Error";
	return $status;
}
else
{
	$existed = $tip->exists;
	
	$tip->startTrans();
	
	$result = $tip->save();
	
	/**/
	if (!$existed) {
		$tip->lngID = $tip->getLastInsertedId();
	}
	
	if (PEAR::isError($result)) {
		$tip->rollbackTrans();
		return handle_error($status, $result);
	}
	else
	{
		$status->destination= "tblTips";
		$status->status = "Success";
		$status->message = "TblTip ".($existed ? "updated" : "added")." successfully, <a href='?view=add_tblTip&id=".$tip->lngID."'>click here</a> to make additional changes";
		
		$tip->commitTrans();
		
		//LOG
		log_entry("Tip", ($existed ? "UPDATE" : "ADD"), $tip->lngID, $tip);
	}
}

return $status;
?>
