<?php
require_once("includes/controller_included.php");
//require_once("includes/Shift.php");

$status->destination = "tblShifts";

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

$shifts = Shift::getShifts(array('lngIDs'=>$ids));

foreach ($shifts as $shift)
{
	if (!$shift->exists)
		continue;

	if (!$shift->validate())
	{
		$_SESSION[APPLICATION_NAME]['form_data'] = $_POST;
		$status->message = "<ul><li>".join("</li><li>",$shift->errorStack)."</li></ul>";
		$status->status = "Error";
		return $status;
	}
	else
	{
		$shift->startTrans();
		
		$result = $shift->delete();
		
		if (PEAR::isError($result)) {
			$shift->rollbackTrans();
			return handle_error($status, $result);
		}

		$shift->commitTrans();

		// LOG
		log_entry("Shift", "DELETE", $shift->lngID, $shift);
	}
}

$status->status = "Success";
$status->message = "TblShift deleted successfully";

return $status;
?>
