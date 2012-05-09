<?php
require_once("includes/controller_included.php");
//require_once("includes/Department.php");

$status->destination = "tblDepartments";

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

$departments = Department::getDepartments(array('lngIDs'=>$ids));

foreach ($departments as $department)
{
	if (!$department->exists)
		continue;

	if (!$department->validate())
	{
		$_SESSION[APPLICATION_NAME]['form_data'] = $_POST;
		$status->message = "<ul><li>".join("</li><li>",$department->errorStack)."</li></ul>";
		$status->status = "Error";
		return $status;
	}
	else
	{
		$department->startTrans();
		
		$result = $department->delete();
		
		if (PEAR::isError($result)) {
			$department->rollbackTrans();
			return handle_error($status, $result);
		}

		$department->commitTrans();

		// LOG
		log_entry("Department", "DELETE", $department->lngID, $department);
	}
}

$status->status = "Success";
$status->message = "TblDepartment deleted successfully";

return $status;
?>
