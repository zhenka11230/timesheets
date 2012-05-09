<?php
require_once("includes/controller_included.php");
//require_once("includes/Bulletin.php");

$status->destination = "tblBulletins";

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

$bulletins = Bulletin::getBulletins(array('lngIDs'=>$ids));

foreach ($bulletins as $bulletin)
{
	if (!$bulletin->exists)
		continue;

	if (!$bulletin->validate())
	{
		$_SESSION[APPLICATION_NAME]['form_data'] = $_POST;
		$status->message = "<ul><li>".join("</li><li>",$bulletin->errorStack)."</li></ul>";
		$status->status = "Error";
		return $status;
	}
	else
	{
		$bulletin->startTrans();
		
		$result = $bulletin->delete();
		
		if (PEAR::isError($result)) {
			$bulletin->rollbackTrans();
			return handle_error($status, $result);
		}

		$bulletin->commitTrans();

		// LOG
		log_entry("Bulletin", "DELETE", $bulletin->lngID, $bulletin);
	}
}

$status->status = "Success";
$status->message = "TblBulletin deleted successfully";

return $status;
?>
