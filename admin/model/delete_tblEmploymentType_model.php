<?php
require_once("includes/controller_included.php");
//require_once("includes/EmploymentType.php");

$status->destination = "tblEmploymentTypes";

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

$employmentTypes = EmploymentType::getEmploymentTypes(array('lngIDs'=>$ids));

foreach ($employmentTypes as $employmentType)
{
	if (!$employmentType->exists)
		continue;

	if (!$employmentType->validate())
	{
		$_SESSION[APPLICATION_NAME]['form_data'] = $_POST;
		$status->message = "<ul><li>".join("</li><li>",$employmentType->errorStack)."</li></ul>";
		$status->status = "Error";
		return $status;
	}
	else
	{
		$employmentType->startTrans();
		
		$result = $employmentType->delete();
		
		if (PEAR::isError($result)) {
			$employmentType->rollbackTrans();
			return handle_error($status, $result);
		}

		$employmentType->commitTrans();

		// LOG
		log_entry("EmploymentType", "DELETE", $employmentType->lngID, $employmentType);
	}
}

$status->status = "Success";
$status->message = "TblEmploymentType deleted successfully";

return $status;
?>
