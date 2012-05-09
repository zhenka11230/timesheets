<?php
require_once("includes/controller_included.php");
//require_once("includes/ExportFormat.php");

$status->destination = "add_tblExportFormat";
$exportFormat = new ExportFormat(@$_GET['id']);
$exportFormat->setPropertyValues($_POST);
if ($exportFormat->exists) {
	$status->destination = "add_tblExportFormat&id=".$exportFormat->lngID;
}

if (!$exportFormat->validate())
{
	$_SESSION[APPLICATION_NAME]['form_data'] = $_POST;
	$status->message = "<ul><li>".join("</li><li>",$exportFormat->errorStack)."</li></ul>";
	$status->status = "Error";
	return $status;
}
else
{
	$existed = $exportFormat->exists;
	
	$exportFormat->startTrans();
	
	$result = $exportFormat->save();
	
	/**/
	if (!$existed) {
		$exportFormat->lngID = $exportFormat->getLastInsertedId();
	}
	
	if (PEAR::isError($result)) {
		$exportFormat->rollbackTrans();
		return handle_error($status, $result);
	}
	else
	{
		$status->destination= "tblExportFormats";
		$status->status = "Success";
		$status->message = "TblExportFormat ".($existed ? "updated" : "added")." successfully, <a href='?view=add_tblExportFormat&id=".$exportFormat->lngID."'>click here</a> to make additional changes";
		
		$exportFormat->commitTrans();
		
		//LOG
		log_entry("ExportFormat", ($existed ? "UPDATE" : "ADD"), $exportFormat->lngID, $exportFormat);
	}
}

return $status;
?>
