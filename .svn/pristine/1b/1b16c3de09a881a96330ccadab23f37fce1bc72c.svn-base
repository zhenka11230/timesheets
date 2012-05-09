<?php
require_once("includes/controller_included.php");
//require_once("includes/TimeNote.php");

$status->destination = "tblTimeNotes";

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

$timeNotes = TimeNote::getTimeNotes(array('lngIDs'=>$ids));

foreach ($timeNotes as $timeNote)
{
	if (!$timeNote->exists)
		continue;

	if (!$timeNote->validate())
	{
		$_SESSION[APPLICATION_NAME]['form_data'] = $_POST;
		$status->message = "<ul><li>".join("</li><li>",$timeNote->errorStack)."</li></ul>";
		$status->status = "Error";
		return $status;
	}
	else
	{
		$timeNote->startTrans();
		
		$result = $timeNote->delete();
		
		if (PEAR::isError($result)) {
			$timeNote->rollbackTrans();
			return handle_error($status, $result);
		}

		$timeNote->commitTrans();

		// LOG
		log_entry("TimeNote", "DELETE", $timeNote->lngID, $timeNote);
	}
}

$status->status = "Success";
$status->message = "TblTimeNote deleted successfully";

return $status;
?>
