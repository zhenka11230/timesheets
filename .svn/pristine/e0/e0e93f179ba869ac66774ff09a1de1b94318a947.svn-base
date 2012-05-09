<?php

require_once("../includes/view_included.php");
$args = $_REQUEST;
$timesheet_info_data = json_decode($args['timesheet_info'], true);
$timesheet_info = new TimesheetInfo($timesheet_info_data);
$timesheet = new TimesheetTwoWeeks($timesheet_info);
$timesheet->init_selectively_from_db();

echo json_encode($timesheet->get_timesheet_data());
?>
