<?php
require_once("includes/controller_included.php");
//require_once("includes/Holiday.php");

$status->destination = "tblHolidays";

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

$holidaies = Holiday::getHolidaies(array('lngIDs'=>$ids));

foreach ($holidaies as $holiday)
{
	if (!$holiday->exists)
		continue;

	if (!$holiday->validate())
	{
		$_SESSION[APPLICATION_NAME]['form_data'] = $_POST;
		$status->message = "<ul><li>".join("</li><li>",$holiday->errorStack)."</li></ul>";
		$status->status = "Error";
		return $status;
	}
	else
	{
		$holiday->startTrans();
		
		$result = $holiday->delete();
		
		if (PEAR::isError($result)) {
			$holiday->rollbackTrans();
			return handle_error($status, $result);
		}

		$holiday->commitTrans();

		// LOG
		log_entry("Holiday", "DELETE", $holiday->lngID, $holiday);
	}
}

$status->status = "Success";
$status->message = "TblHoliday deleted successfully";

return $status;
?>
