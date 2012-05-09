<?php
//ob_start();
//session_start();
$view_included = 1;

require_once("../application_info.php");

$args = $_REQUEST;
$query = @trim($args['query']);

switch($query)
{
	case "get_timesheet":
	case "recalculate_day":
	break;

	// If input is unknown, force it to a known case.
	default:
		die("{'Error':'Could not find file'}");
}
require_once($query."_ajax.php");
?>
