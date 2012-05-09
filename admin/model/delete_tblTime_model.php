<?php
require_once("includes/controller_included.php");
//require_once("includes/Time.php");

$status->destination = "tblTimes";

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

$times = Time::getTimes(array('lngIDs'=>$ids));

foreach ($times as $time)
{
	if (!$time->exists)
		continue;

	if (!$time->validate())
	{
		$_SESSION[APPLICATION_NAME]['form_data'] = $_POST;
		$status->message = "<ul><li>".join("</li><li>",$time->errorStack)."</li></ul>";
		$status->status = "Error";
		return $status;
	}
	else
	{
		$time->startTrans();
		
		$result = $time->delete();
		
		if (PEAR::isError($result)) {
			$time->rollbackTrans();
			return handle_error($status, $result);
		}

		$time->commitTrans();

		// LOG
		log_entry("Time", "DELETE", $time->lngID, $time);
	}
}

$status->status = "Success";
$status->message = "TblTime deleted successfully";

return $status;
?>
