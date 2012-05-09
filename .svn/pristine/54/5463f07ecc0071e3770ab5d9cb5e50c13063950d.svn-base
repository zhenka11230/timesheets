<?php
require_once("includes/controller_included.php");
//require_once("includes/Job.php");

$status->destination = "tblJobs";

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

$jobs = Job::getJobs(array('lngIDs'=>$ids));

foreach ($jobs as $job)
{
	if (!$job->exists)
		continue;

	if (!$job->validate())
	{
		$_SESSION[APPLICATION_NAME]['form_data'] = $_POST;
		$status->message = "<ul><li>".join("</li><li>",$job->errorStack)."</li></ul>";
		$status->status = "Error";
		return $status;
	}
	else
	{
		$job->startTrans();
		
		$result = $job->delete();
		
		if (PEAR::isError($result)) {
			$job->rollbackTrans();
			return handle_error($status, $result);
		}

		$job->commitTrans();

		// LOG
		log_entry("Job", "DELETE", $job->lngID, $job);
	}
}

$status->status = "Success";
$status->message = "TblJob deleted successfully";

return $status;
?>
