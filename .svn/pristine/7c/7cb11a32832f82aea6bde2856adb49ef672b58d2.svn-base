<?php
require_once("includes/controller_included.php");
//require_once("includes/TimeLogging.php");

$status->destination = "add_tblTimeLogging";
$timeLogging = new TimeLogging(@$_GET['id']);
$timeLogging->setPropertyValues($_POST);
if ($timeLogging->exists) {
	$status->destination = "add_tblTimeLogging&id=".$timeLogging->lngID;
}

if (!$timeLogging->validate())
{
	$_SESSION[APPLICATION_NAME]['form_data'] = $_POST;
	$status->message = "<ul><li>".join("</li><li>",$timeLogging->errorStack)."</li></ul>";
	$status->status = "Error";
	return $status;
}
else
{
	$existed = $timeLogging->exists;
	
	$timeLogging->startTrans();
	
	$result = $timeLogging->save();
	
	/**/
	if (!$existed) {
		$timeLogging->lngID = $timeLogging->getLastInsertedId();
	}
	
	if (PEAR::isError($result)) {
		$timeLogging->rollbackTrans();
		return handle_error($status, $result);
	}
	else
	{
		$status->destination= "tblTimeLogging";
		$status->status = "Success";
		$status->message = "TblTimeLogging ".($existed ? "updated" : "added")." successfully, <a href='?view=add_tblTimeLogging&id=".$timeLogging->lngID."'>click here</a> to make additional changes";
		
		$timeLogging->commitTrans();
		
		//LOG
		log_entry("TimeLogging", ($existed ? "UPDATE" : "ADD"), $timeLogging->lngID, $timeLogging);
	}
}

return $status;
?>
