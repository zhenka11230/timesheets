<?php
require_once("includes/controller_included.php");
//require_once("includes/BulletinAcceptance.php");

$status->destination = "tblBulletinAcceptances";

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

$bulletinAcceptances = BulletinAcceptance::getBulletinAcceptances(array('lngIDs'=>$ids));

foreach ($bulletinAcceptances as $bulletinAcceptance)
{
	if (!$bulletinAcceptance->exists)
		continue;

	if (!$bulletinAcceptance->validate())
	{
		$_SESSION[APPLICATION_NAME]['form_data'] = $_POST;
		$status->message = "<ul><li>".join("</li><li>",$bulletinAcceptance->errorStack)."</li></ul>";
		$status->status = "Error";
		return $status;
	}
	else
	{
		$bulletinAcceptance->startTrans();
		
		$result = $bulletinAcceptance->delete();
		
		if (PEAR::isError($result)) {
			$bulletinAcceptance->rollbackTrans();
			return handle_error($status, $result);
		}

		$bulletinAcceptance->commitTrans();

		// LOG
		log_entry("BulletinAcceptance", "DELETE", $bulletinAcceptance->lngID, $bulletinAcceptance);
	}
}

$status->status = "Success";
$status->message = "TblBulletinAcceptance deleted successfully";

return $status;
?>
