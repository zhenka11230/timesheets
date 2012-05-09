<?php
require_once("includes/controller_included.php");
//require_once("includes/TimeLogging.php");

$status->destination = "tblTimeLogging";

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

$timeLoggings = TimeLogging::getTimeLoggings(array('lngIDs'=>$ids));

foreach ($timeLoggings as $timeLogging)
{
	if (!$timeLogging->exists)
		continue;

	if (!$timeLogging->validate())
	{
		$_SESSION[APPLICATION_NAME]['form_data'] = $_POST;
		$status->message = "<ul><li>".join("</li><li>",$timeLogging->errorStack)."</li></ul>";
		$status->status = "Error";
		return $status;
	}
	else
	{
		$timeLogging->startTrans();
		
		$result = $timeLogging->delete();
		
		if (PEAR::isError($result)) {
			$timeLogging->rollbackTrans();
			return handle_error($status, $result);
		}

		$timeLogging->commitTrans();

		// LOG
		log_entry("TimeLogging", "DELETE", $timeLogging->lngID, $timeLogging);
	}
}

$status->status = "Success";
$status->message = "TblTimeLogging deleted successfully";

return $status;
?>
