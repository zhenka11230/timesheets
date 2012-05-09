<?php
require_once("includes/controller_included.php");
//require_once("includes/BulletinAcceptance.php");

$status->destination = "add_tblBulletinAcceptance";
$bulletinAcceptance = new BulletinAcceptance(@$_GET['id']);
$bulletinAcceptance->setPropertyValues($_POST);
if ($bulletinAcceptance->exists) {
	$status->destination = "add_tblBulletinAcceptance&id=".$bulletinAcceptance->lngID;
}

if (!$bulletinAcceptance->validate())
{
	$_SESSION[APPLICATION_NAME]['form_data'] = $_POST;
	$status->message = "<ul><li>".join("</li><li>",$bulletinAcceptance->errorStack)."</li></ul>";
	$status->status = "Error";
	return $status;
}
else
{
	$existed = $bulletinAcceptance->exists;
	
	$bulletinAcceptance->startTrans();
	
	$result = $bulletinAcceptance->save();
	
	/**/
	if (!$existed) {
		$bulletinAcceptance->lngID = $bulletinAcceptance->getLastInsertedId();
	}
	
	if (PEAR::isError($result)) {
		$bulletinAcceptance->rollbackTrans();
		return handle_error($status, $result);
	}
	else
	{
		$status->destination= "tblBulletinAcceptances";
		$status->status = "Success";
		$status->message = "TblBulletinAcceptance ".($existed ? "updated" : "added")." successfully, <a href='?view=add_tblBulletinAcceptance&id=".$bulletinAcceptance->lngID."'>click here</a> to make additional changes";
		
		$bulletinAcceptance->commitTrans();
		
		//LOG
		log_entry("BulletinAcceptance", ($existed ? "UPDATE" : "ADD"), $bulletinAcceptance->lngID, $bulletinAcceptance);
	}
}

return $status;
?>
