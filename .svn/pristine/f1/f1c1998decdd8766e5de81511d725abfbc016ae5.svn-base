<?php
require_once("includes/controller_included.php");
//require_once("includes/Computer.php");

$status->destination = "add_tblComputer";
$computer = new Computer(@$_GET['id']);
$computer->setPropertyValues($_POST);
if ($computer->exists) {
	$status->destination = "add_tblComputer&id=".$computer->lngID;
}

if (!$computer->validate())
{
	$_SESSION[APPLICATION_NAME]['form_data'] = $_POST;
	$status->message = "<ul><li>".join("</li><li>",$computer->errorStack)."</li></ul>";
	$status->status = "Error";
	return $status;
}
else
{
	$existed = $computer->exists;
	
	$computer->startTrans();
	
	$result = $computer->save();
	
	/**/
	if (!$existed) {
		$computer->lngID = $computer->getLastInsertedId();
	}
	
	if (PEAR::isError($result)) {
		$computer->rollbackTrans();
		return handle_error($status, $result);
	}
	else
	{
		$status->destination= "tblComputers";
		$status->status = "Success";
		$status->message = "TblComputer ".($existed ? "updated" : "added")." successfully, <a href='?view=add_tblComputer&id=".$computer->lngID."'>click here</a> to make additional changes";
		
		$computer->commitTrans();
		
		//LOG
		log_entry("Computer", ($existed ? "UPDATE" : "ADD"), $computer->lngID, $computer);
	}
}

return $status;
?>
