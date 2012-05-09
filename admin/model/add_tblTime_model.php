<?php
require_once("includes/controller_included.php");
//require_once("includes/Time.php");

$status->destination = "add_tblTime";
$time = new Time(@$_GET['id']);
$time->setPropertyValues($_POST);
if ($time->exists) {
	$status->destination = "add_tblTime&id=".$time->lngID;
}

if (!$time->validate())
{
	$_SESSION[APPLICATION_NAME]['form_data'] = $_POST;
	$status->message = "<ul><li>".join("</li><li>",$time->errorStack)."</li></ul>";
	$status->status = "Error";
	return $status;
}
else
{
	$existed = $time->exists;
	
	$time->startTrans();
	
	$result = $time->save();
	
	/**/
	if (!$existed) {
		$time->lngID = $time->getLastInsertedId();
	}
	
	if (PEAR::isError($result)) {
		$time->rollbackTrans();
		return handle_error($status, $result);
	}
	else
	{
		$status->destination= "tblTimes";
		$status->status = "Success";
		$status->message = "TblTime ".($existed ? "updated" : "added")." successfully, <a href='?view=add_tblTime&id=".$time->lngID."'>click here</a> to make additional changes";
		
		$time->commitTrans();
		
		//LOG
		log_entry("Time", ($existed ? "UPDATE" : "ADD"), $time->lngID, $time);
	}
}

return $status;
?>
