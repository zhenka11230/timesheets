<?php
require_once("includes/controller_included.php");
//require_once("includes/Connection.php");

$status->destination = "tblConnections";

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

$connections = Connection::getConnections(array('lngIDs'=>$ids));

foreach ($connections as $connection)
{
	if (!$connection->exists)
		continue;

	if (!$connection->validate())
	{
		$_SESSION[APPLICATION_NAME]['form_data'] = $_POST;
		$status->message = "<ul><li>".join("</li><li>",$connection->errorStack)."</li></ul>";
		$status->status = "Error";
		return $status;
	}
	else
	{
		$connection->startTrans();
		
		$result = $connection->delete();
		
		if (PEAR::isError($result)) {
			$connection->rollbackTrans();
			return handle_error($status, $result);
		}

		$connection->commitTrans();

		// LOG
		log_entry("Connection", "DELETE", $connection->lngID, $connection);
	}
}

$status->status = "Success";
$status->message = "TblConnection deleted successfully";

return $status;
?>
