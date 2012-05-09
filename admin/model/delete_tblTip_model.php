<?php
require_once("includes/controller_included.php");
//require_once("includes/Tip.php");

$status->destination = "tblTips";

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

$tips = Tip::getTips(array('lngIDs'=>$ids));

foreach ($tips as $tip)
{
	if (!$tip->exists)
		continue;

	if (!$tip->validate())
	{
		$_SESSION[APPLICATION_NAME]['form_data'] = $_POST;
		$status->message = "<ul><li>".join("</li><li>",$tip->errorStack)."</li></ul>";
		$status->status = "Error";
		return $status;
	}
	else
	{
		$tip->startTrans();
		
		$result = $tip->delete();
		
		if (PEAR::isError($result)) {
			$tip->rollbackTrans();
			return handle_error($status, $result);
		}

		$tip->commitTrans();

		// LOG
		log_entry("Tip", "DELETE", $tip->lngID, $tip);
	}
}

$status->status = "Success";
$status->message = "TblTip deleted successfully";

return $status;
?>
