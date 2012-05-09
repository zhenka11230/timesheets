<?php
require_once("includes/controller_included.php");
//require_once("includes/BulletinAssignment.php");

$status->destination = "tblBulletinAssignments";

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

$bulletinAssignments = BulletinAssignment::getBulletinAssignments(array('lngIDs'=>$ids));

foreach ($bulletinAssignments as $bulletinAssignment)
{
	if (!$bulletinAssignment->exists)
		continue;

	if (!$bulletinAssignment->validate())
	{
		$_SESSION[APPLICATION_NAME]['form_data'] = $_POST;
		$status->message = "<ul><li>".join("</li><li>",$bulletinAssignment->errorStack)."</li></ul>";
		$status->status = "Error";
		return $status;
	}
	else
	{
		$bulletinAssignment->startTrans();
		
		$result = $bulletinAssignment->delete();
		
		if (PEAR::isError($result)) {
			$bulletinAssignment->rollbackTrans();
			return handle_error($status, $result);
		}

		$bulletinAssignment->commitTrans();

		// LOG
		log_entry("BulletinAssignment", "DELETE", $bulletinAssignment->lngID, $bulletinAssignment);
	}
}

$status->status = "Success";
$status->message = "TblBulletinAssignment deleted successfully";

return $status;
?>
