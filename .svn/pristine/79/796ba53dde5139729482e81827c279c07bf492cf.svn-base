<?php
require_once("includes/controller_included.php");
//require_once("includes/Setting.php");

$status->destination = "add_tblSetting";
$setting = new Setting(@$_GET['id']);
$setting->setPropertyValues($_POST);
if ($setting->exists) {
	$status->destination = "add_tblSetting&id=".$setting->lngID;
}

if (!$setting->validate())
{
	$_SESSION[APPLICATION_NAME]['form_data'] = $_POST;
	$status->message = "<ul><li>".join("</li><li>",$setting->errorStack)."</li></ul>";
	$status->status = "Error";
	return $status;
}
else
{
	$existed = $setting->exists;
	
	$setting->startTrans();
	
	$result = $setting->save();
	
	/**/
	if (!$existed) {
		$setting->lngID = $setting->getLastInsertedId();
	}
	
	if (PEAR::isError($result)) {
		$setting->rollbackTrans();
		return handle_error($status, $result);
	}
	else
	{
		$status->destination= "tblSettings";
		$status->status = "Success";
		$status->message = "TblSetting ".($existed ? "updated" : "added")." successfully, <a href='?view=add_tblSetting&id=".$setting->lngID."'>click here</a> to make additional changes";
		
		$setting->commitTrans();
		
		//LOG
		log_entry("Setting", ($existed ? "UPDATE" : "ADD"), $setting->lngID, $setting);
	}
}

return $status;
?>
