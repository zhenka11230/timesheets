<?php

ob_start();
session_start();
ini_set('max_execution_time', '120');

$controller_included = 1;

require_once("application_info.php");

$action = trim($_REQUEST['action']);

$popup_destination = (@trim($_REQUEST['popup_destination']) != "" ? trim($_REQUEST['popup_destination']) : "");

// Logged in
if ($logged_in === 1) {
	// if a postback is required, don't include any model files
	// simply save the current form and redirect back to source
	if (@trim($_REQUEST['force_postback']) != "") {
		$_SESSION[APPLICATION_NAME]['form_data'] = $_POST;
	} else {
		switch ($action) {
			// list models that DO NOT require login
			case "login":
			case "logout":
				require_once(MODEL_ROOT . '/' . $action . '_model.php');
				break;

			// list models that DO require login

			case "add_tblBulletinAcceptance":
			case "delete_tblBulletinAcceptance":

			case "add_tblBulletinAssignment":
			case "delete_tblBulletinAssignment":

			case "add_tblBulletin":
			case "delete_tblBulletin":

			case "add_tblComputer":
			case "delete_tblComputer":

			case "add_tblConnection":
			case "delete_tblConnection":

			case "add_tblDepartment":
			case "delete_tblDepartment":

			case "add_tblEmployee":
			case "delete_tblEmployee":

			case "add_tblEmploymentType":
			case "delete_tblEmploymentType":

			case "add_tblExportFormat":
			case "delete_tblExportFormat":

			case "add_tblHoliday":
			case "delete_tblHoliday":

			case "add_tblJob":
			case "delete_tblJob":

			case "add_tblSetting":
			case "delete_tblSetting":

			case "add_tblShift":
			case "delete_tblShift":

			case "add_tblTimeLogging":
			case "delete_tblTimeLogging":

			case "add_tblTimeNote":
			case "delete_tblTimeNote":

			case "add_tblTime":
			case "delete_tblTime":

			case "add_tblTipPayment":
			case "delete_tblTipPayment":

			case "add_tblTip":
			case "delete_tblTip":

			case "add_time_modified":
			case "delete_time_modified":

			case "discard_day":
			case "restore_day":
			case "update_comment_day":
				
			case "save_day":
			case "trim_hours_timesheet":

				$status = include_validated(MODEL_ROOT . '/' . $action . '_model.php', 'model');
				break;

			// Invalid input
			default:
				$status->destination = "home";
				$status->status = "Error";
				$status->message = "Invalid controller request";
				break;
		}
	}
}
// Not logged in
else {
	switch ($action) {
		// list models that DO NOT require login
		case "login":
		case "logout":
			require_once(MODEL_ROOT . '/' . $action . '_model.php');
			break;

		// Invalid input
		default:
			$status->destination = "home";
			$status->status = "Error";
			$status->message = "Invalid request";
			break;
	}
}

//$_SESSION[APPLICATION_NAME]['status'] = serialize($status);
// go back to home by default
if ($status->destination == "") {
	$status->destination = "home";
}

$final_destination = ($popup_destination != "" ? $popup_destination : "index");

//$header_location = (preg_match('|^http://|', $status->destination) ? $status->destination : $final_destination.".php?view=".urldecode($status->destination));
//die("<a href='$header_location'>$header_location</a>".($status->status=="Success"?"<br><a href='javascript:clearTimeout(t)'>Success, don't redirect</a><script>t=setTimeout('window.location.replace(\"$header_location\")',3000)</script>":$status->message));
//header("Location: ".$header_location);

echo json_encode($status);
ob_end_flush();
?>
