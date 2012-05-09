<?php
require_once("includes/controller_included.php");
//require_once("includes/BulletinAssignment.php");

$status->destination = "add_tblBulletinAssignment";
$bulletinAssignment = new BulletinAssignment(@$_GET['id']);
$bulletinAssignment->setPropertyValues($_POST);
if ($bulletinAssignment->exists) {
	$status->destination = "add_tblBulletinAssignment&id=".$bulletinAssignment->lngID;
}

if (!$bulletinAssignment->validate())
{
	$_SESSION[APPLICATION_NAME]['form_data'] = $_POST;
	$status->message = "<ul><li>".join("</li><li>",$bulletinAssignment->errorStack)."</li></ul>";
	$status->status = "Error";
	return $status;
}
else
{
	$existed = $bulletinAssignment->exists;
	
	$bulletinAssignment->startTrans();
	
	$result = $bulletinAssignment->save();
	
	/**/
	if (!$existed) {
		$bulletinAssignment->lngID = $bulletinAssignment->getLastInsertedId();
	}
	
	if (PEAR::isError($result)) {
		$bulletinAssignment->rollbackTrans();
		return handle_error($status, $result);
	}
	else
	{
		$status->destination= "tblBulletinAssignments";
		$status->status = "Success";
		$status->message = "TblBulletinAssignment ".($existed ? "updated" : "added")." successfully, <a href='?view=add_tblBulletinAssignment&id=".$bulletinAssignment->lngID."'>click here</a> to make additional changes";
		
		$bulletinAssignment->commitTrans();
		
		//LOG
		log_entry("BulletinAssignment", ($existed ? "UPDATE" : "ADD"), $bulletinAssignment->lngID, $bulletinAssignment);
	}
}

return $status;
?>
