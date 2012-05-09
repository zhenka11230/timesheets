<?php
require_once("includes/controller_included.php");
//require_once("includes/TimeNote.php");

$status->destination = "add_tblTimeNote";
$timeNote = new TimeNote(@$_GET['id']);
$timeNote->setPropertyValues($_POST);
if ($timeNote->exists) {
	$status->destination = "add_tblTimeNote&id=".$timeNote->lngID;
}

if (!$timeNote->validate())
{
	$_SESSION[APPLICATION_NAME]['form_data'] = $_POST;
	$status->message = "<ul><li>".join("</li><li>",$timeNote->errorStack)."</li></ul>";
	$status->status = "Error";
	return $status;
}
else
{
	$existed = $timeNote->exists;
	
	$timeNote->startTrans();
	
	$result = $timeNote->save();
	
	/**/
	if (!$existed) {
		$timeNote->lngID = $timeNote->getLastInsertedId();
	}
	
	if (PEAR::isError($result)) {
		$timeNote->rollbackTrans();
		return handle_error($status, $result);
	}
	else
	{
		$status->destination= "tblTimeNotes";
		$status->status = "Success";
		$status->message = "TblTimeNote ".($existed ? "updated" : "added")." successfully, <a href='?view=add_tblTimeNote&id=".$timeNote->lngID."'>click here</a> to make additional changes";
		
		$timeNote->commitTrans();
		
		//LOG
		log_entry("TimeNote", ($existed ? "UPDATE" : "ADD"), $timeNote->lngID, $timeNote);
	}
}

return $status;
?>
