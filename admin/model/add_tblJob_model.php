<?php
require_once("includes/controller_included.php");
//require_once("includes/Job.php");

$status->destination = "add_tblJob";
$job = new Job(@$_GET['id']);
$job->setPropertyValues($_POST);
if ($job->exists) {
	$status->destination = "add_tblJob&id=".$job->lngID;
}

if (!$job->validate())
{
	$_SESSION[APPLICATION_NAME]['form_data'] = $_POST;
	$status->message = "<ul><li>".join("</li><li>",$job->errorStack)."</li></ul>";
	$status->status = "Error";
	return $status;
}
else
{
	$existed = $job->exists;
	
	$job->startTrans();
	
	$result = $job->save();
	
	/**/
	if (!$existed) {
		$job->lngID = $job->getLastInsertedId();
	}
	
	if (PEAR::isError($result)) {
		$job->rollbackTrans();
		return handle_error($status, $result);
	}
	else
	{
		$status->destination= "tblJobs";
		$status->status = "Success";
		$status->message = "TblJob ".($existed ? "updated" : "added")." successfully, <a href='?view=add_tblJob&id=".$job->lngID."'>click here</a> to make additional changes";
		
		$job->commitTrans();
		
		//LOG
		log_entry("Job", ($existed ? "UPDATE" : "ADD"), $job->lngID, $job);
	}
}

return $status;
?>
