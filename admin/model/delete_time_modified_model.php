<?php
require_once("includes/controller_included.php");
//require_once("includes/TimeModified.php");

$status->destination = "time_modified";

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

$timeModifieds = TimeModified::getTimeModifieds(array('time_modified_ids'=>$ids));

foreach ($timeModifieds as $timeModified)
{
	if (!$timeModified->exists)
		continue;

	if (!$timeModified->validate())
	{
		$_SESSION[APPLICATION_NAME]['form_data'] = $_POST;
		$status->message = "<ul><li>".join("</li><li>",$timeModified->errorStack)."</li></ul>";
		$status->status = "Error";
		return $status;
	}
	else
	{
		$timeModified->startTrans();
		
		$result = $timeModified->delete();
		
		if (PEAR::isError($result)) {
			$timeModified->rollbackTrans();
			return handle_error($status, $result);
		}

		$timeModified->commitTrans();

		// LOG
		log_entry("TimeModified", "DELETE", $timeModified->time_modified_id, $timeModified);
	}
}

$status->status = "Success";
$status->message = "Time Modified deleted successfully";

return $status;
?>
