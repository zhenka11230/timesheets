<?php
require_once("includes/controller_included.php");
//require_once("includes/Setting.php");

$status->destination = "tblSettings";

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

$settings = Setting::getSettings(array('lngIDs'=>$ids));

foreach ($settings as $setting)
{
	if (!$setting->exists)
		continue;

	if (!$setting->validate())
	{
		$_SESSION[APPLICATION_NAME]['form_data'] = $_POST;
		$status->message = "<ul><li>".join("</li><li>",$setting->errorStack)."</li></ul>";
		$status->status = "Error";
		return $status;
	}
	else
	{
		$setting->startTrans();
		
		$result = $setting->delete();
		
		if (PEAR::isError($result)) {
			$setting->rollbackTrans();
			return handle_error($status, $result);
		}

		$setting->commitTrans();

		// LOG
		log_entry("Setting", "DELETE", $setting->lngID, $setting);
	}
}

$status->status = "Success";
$status->message = "TblSetting deleted successfully";

return $status;
?>
