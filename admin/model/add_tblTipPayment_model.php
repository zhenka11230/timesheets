<?php
require_once("includes/controller_included.php");
//require_once("includes/TipPayment.php");

$status->destination = "add_tblTipPayment";
$tipPayment = new TipPayment(@$_GET['id']);
$tipPayment->setPropertyValues($_POST);
if ($tipPayment->exists) {
	$status->destination = "add_tblTipPayment&id=".$tipPayment->lngID;
}

if (!$tipPayment->validate())
{
	$_SESSION[APPLICATION_NAME]['form_data'] = $_POST;
	$status->message = "<ul><li>".join("</li><li>",$tipPayment->errorStack)."</li></ul>";
	$status->status = "Error";
	return $status;
}
else
{
	$existed = $tipPayment->exists;
	
	$tipPayment->startTrans();
	
	$result = $tipPayment->save();
	
	/**/
	if (!$existed) {
		$tipPayment->lngID = $tipPayment->getLastInsertedId();
	}
	
	if (PEAR::isError($result)) {
		$tipPayment->rollbackTrans();
		return handle_error($status, $result);
	}
	else
	{
		$status->destination= "tblTipPayments";
		$status->status = "Success";
		$status->message = "TblTipPayment ".($existed ? "updated" : "added")." successfully, <a href='?view=add_tblTipPayment&id=".$tipPayment->lngID."'>click here</a> to make additional changes";
		
		$tipPayment->commitTrans();
		
		//LOG
		log_entry("TipPayment", ($existed ? "UPDATE" : "ADD"), $tipPayment->lngID, $tipPayment);
	}
}

return $status;
?>
