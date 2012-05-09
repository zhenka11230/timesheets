<?php
require_once("includes/controller_included.php");
//require_once("includes/Shift.php");

$status->destination = "add_tblShift";
$shift = new Shift(@$_GET['id']);
$shift->setPropertyValues($_POST);
if ($shift->exists) {
	$status->destination = "add_tblShift&id=".$shift->lngID;
}

if (!$shift->validate())
{
	$_SESSION[APPLICATION_NAME]['form_data'] = $_POST;
	$status->message = "<ul><li>".join("</li><li>",$shift->errorStack)."</li></ul>";
	$status->status = "Error";
	return $status;
}
else
{
	$existed = $shift->exists;
	
	$shift->startTrans();
	
	$result = $shift->save();
	
	/**/
	if (!$existed) {
		$shift->lngID = $shift->getLastInsertedId();
	}
	
	if (PEAR::isError($result)) {
		$shift->rollbackTrans();
		return handle_error($status, $result);
	}
	else
	{
		$status->destination= "tblShifts";
		$status->status = "Success";
		$status->message = "TblShift ".($existed ? "updated" : "added")." successfully, <a href='?view=add_tblShift&id=".$shift->lngID."'>click here</a> to make additional changes";
		
		$shift->commitTrans();
		
		//LOG
		log_entry("Shift", ($existed ? "UPDATE" : "ADD"), $shift->lngID, $shift);
	}
}

return $status;
?>
