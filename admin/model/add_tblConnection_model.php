<?php
require_once("includes/controller_included.php");
//require_once("includes/Connection.php");

$status->destination = "add_tblConnection";
$connection = new Connection(@$_GET['id']);
$connection->setPropertyValues($_POST);
if ($connection->exists) {
	$status->destination = "add_tblConnection&id=".$connection->lngID;
}

if (!$connection->validate())
{
	$_SESSION[APPLICATION_NAME]['form_data'] = $_POST;
	$status->message = "<ul><li>".join("</li><li>",$connection->errorStack)."</li></ul>";
	$status->status = "Error";
	return $status;
}
else
{
	$existed = $connection->exists;
	
	$connection->startTrans();
	
	$result = $connection->save();
	
	/**/
	if (!$existed) {
		$connection->lngID = $connection->getLastInsertedId();
	}
	
	if (PEAR::isError($result)) {
		$connection->rollbackTrans();
		return handle_error($status, $result);
	}
	else
	{
		$status->destination= "tblConnections";
		$status->status = "Success";
		$status->message = "TblConnection ".($existed ? "updated" : "added")." successfully, <a href='?view=add_tblConnection&id=".$connection->lngID."'>click here</a> to make additional changes";
		
		$connection->commitTrans();
		
		//LOG
		log_entry("Connection", ($existed ? "UPDATE" : "ADD"), $connection->lngID, $connection);
	}
}

return $status;
?>
