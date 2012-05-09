<?php
require_once("includes/controller_included.php");
//require_once("includes/ExportFormat.php");

$status->destination = "tblExportFormats";

$ids = array();

if (isset($_GET['id'])) {
	if (!is_array($_GET['id']) && is_numeric($_GET['id']))
		$ids[] = (int)$_GET['id'];
	else if (is_array($_GET['id']))
		$ids = $_GET['id'];
}
else {
	return handle_error($status, 'ID(s) missing');
}

$exportFormats = ExportFormat::getExportFormats(array('lngIDs'=>$ids));

foreach ($exportFormats as $exportFormat)
{
	if (!$exportFormat->exists)
		continue;

	if (!$exportFormat->validate())
	{
		$_SESSION[APPLICATION_NAME]['form_data'] = $_POST;
		$status->message = "<ul><li>".join("</li><li>",$exportFormat->errorStack)."</li></ul>";
		$status->status = "Error";
		return $status;
	}
	else
	{
		$exportFormat->startTrans();
		
		$result = $exportFormat->delete();
		
		if (PEAR::isError($result)) {
			$exportFormat->rollbackTrans();
			return handle_error($status, $result);
		}

		$exportFormat->commitTrans();

		// LOG
		log_entry("ExportFormat", "DELETE", $exportFormat->lngID, $exportFormat);
	}
}

$status->status = "Success";
$status->message = "TblExportFormat deleted successfully";

return $status;
?>
