<?php
require_once("includes/controller_included.php");
//require_once("includes/Bulletin.php");

$status->destination = "add_tblBulletin";
$bulletin = new Bulletin(@$_GET['id']);
$bulletin->setPropertyValues($_POST);
if ($bulletin->exists) {
	$status->destination = "add_tblBulletin&id=".$bulletin->lngID;
}

if (!$bulletin->validate())
{
	$_SESSION[APPLICATION_NAME]['form_data'] = $_POST;
	$status->message = "<ul><li>".join("</li><li>",$bulletin->errorStack)."</li></ul>";
	$status->status = "Error";
	return $status;
}
else
{
	$existed = $bulletin->exists;
	
	$bulletin->startTrans();
	
	$result = $bulletin->save();
	
	/**/
	if (!$existed) {
		$bulletin->lngID = $bulletin->getLastInsertedId();
	}
	
	if (PEAR::isError($result)) {
		$bulletin->rollbackTrans();
		return handle_error($status, $result);
	}
	else
	{
		$status->destination= "tblBulletins";
		$status->status = "Success";
		$status->message = "TblBulletin ".($existed ? "updated" : "added")." successfully, <a href='?view=add_tblBulletin&id=".$bulletin->lngID."'>click here</a> to make additional changes";
		
		$bulletin->commitTrans();
		
		//LOG
		log_entry("Bulletin", ($existed ? "UPDATE" : "ADD"), $bulletin->lngID, $bulletin);
	}
}

return $status;
?>
