<?php
require_once("includes/controller_included.php");
//require_once("includes/Computer.php");

$status->destination = "tblComputers";

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

$computers = Computer::getComputers(array('lngIDs'=>$ids));

foreach ($computers as $computer)
{
	if (!$computer->exists)
		continue;

	if (!$computer->validate())
	{
		$_SESSION[APPLICATION_NAME]['form_data'] = $_POST;
		$status->message = "<ul><li>".join("</li><li>",$computer->errorStack)."</li></ul>";
		$status->status = "Error";
		return $status;
	}
	else
	{
		$computer->startTrans();
		
		$result = $computer->delete();
		
		if (PEAR::isError($result)) {
			$computer->rollbackTrans();
			return handle_error($status, $result);
		}

		$computer->commitTrans();

		// LOG
		log_entry("Computer", "DELETE", $computer->lngID, $computer);
	}
}

$status->status = "Success";
$status->message = "TblComputer deleted successfully";

return $status;
?>
