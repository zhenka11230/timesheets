<?php
require_once("includes/controller_included.php");
//require_once("includes/TipPayment.php");

$status->destination = "tblTipPayments";

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

$tipPayments = TipPayment::getTipPayments(array('lngIDs'=>$ids));

foreach ($tipPayments as $tipPayment)
{
	if (!$tipPayment->exists)
		continue;

	if (!$tipPayment->validate())
	{
		$_SESSION[APPLICATION_NAME]['form_data'] = $_POST;
		$status->message = "<ul><li>".join("</li><li>",$tipPayment->errorStack)."</li></ul>";
		$status->status = "Error";
		return $status;
	}
	else
	{
		$tipPayment->startTrans();
		
		$result = $tipPayment->delete();
		
		if (PEAR::isError($result)) {
			$tipPayment->rollbackTrans();
			return handle_error($status, $result);
		}

		$tipPayment->commitTrans();

		// LOG
		log_entry("TipPayment", "DELETE", $tipPayment->lngID, $tipPayment);
	}
}

$status->status = "Success";
$status->message = "TblTipPayment deleted successfully";

return $status;
?>
