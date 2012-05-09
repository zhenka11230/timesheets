<?php
require_once("includes/controller_included.php");
//require_once("includes/Employee.php");

$status->destination = "tblEmployees";

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

$employee = Employee::getEmployee(array('lngIDs'=>$ids));

foreach ($employee as $employee)
{
	if (!$employee->exists)
		continue;

	if (!$employee->validate())
	{
		$_SESSION[APPLICATION_NAME]['form_data'] = $_POST;
		$status->message = "<ul><li>".join("</li><li>",$employee->errorStack)."</li></ul>";
		$status->status = "Error";
		return $status;
	}
	else
	{
		$employee->startTrans();
		
		$result = $employee->delete();
		
		if (PEAR::isError($result)) {
			$employee->rollbackTrans();
			return handle_error($status, $result);
		}

		$employee->commitTrans();

		// LOG
		log_entry("Employee", "DELETE", $employee->lngID, $employee);
	}
}

$status->status = "Success";
$status->message = "TblEmployee deleted successfully";

return $status;
?>
