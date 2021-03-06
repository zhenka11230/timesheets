<link rel="stylesheet" type="text/css" href="<?=COMMON_FILES_PATH?>scripts/jquery/timepicker/timePicker.css" />
<link rel="stylesheet" type="text/css" href="css/timesheet.css" />
<script src="<?=COMMON_FILES_PATH;?>scripts/json2.js" type="text/javascript"></script>
<script src="<?=COMMON_FILES_PATH;?>scripts/jquery/timepicker/jquery.timePicker.js" type="text/javascript"></script>
<script src="<?=COMMON_FILES_PATH;?>scripts/jquery/template/jquery.tmpl.min.js" type="text/javascript"></script>
<script src="<?=COMMON_FILES_PATH;?>scripts/date.js" type="text/javascript"></script>
<?php
require_once("includes/view_included.php");

if (accessible_permission("is_admin", "model")) {

    $departments = Department::getDepartments(array('lngIDs' => $myDepartments));
    if (isset($_GET['departmentID'])) {
        $department_id = $_GET['departmentID'];
    } else {
        $department_id = @$departments[0]->lngID;
    }
    $employees = Employee::getEmployees(array('blnDisabled' => false, 'lngDepartmentID' => $department_id));
} else {

    $employees = Employee::getEmployees(array('lngID' => $myEmployeeID, 'blnDisabled' => false, 'blnDeleted' => false));
    $departments = Department::getDepartments(array('lngID' => $employees[0]->lngDepartmentID));
    if (isset($_GET['departmentID'])) {
        $department_id = $_GET['departmentID'];
    } else {
        $department_id = @$departments[0]->lngID;
    }
}

if (isset($_GET['date'])) {
    $date = $_GET['date'];
} else {
    $date = date('Y-m-d');
}

if (isset($_GET['lngID'])) {
    $lngID = $_GET['lngID'];
} else {
    if (isset($employees[0])) {
        $lngID = $employees[0]->lngID;
    } else {
        return handle_error($status, "No employees in this department.", true);
    }
}

$timesheet_period = @TimesheetPeriod::getTimesheetPeriods(array('date' => $date));
if(empty($timesheet_period)){
    return handle_error($status, "This time period is missing from the database.  See your supervisor.", true);
}
$timesheet_period_id = @$timesheet_period[0]->timesheet_period_id;
$start_date = @$timesheet_period[0]->start_date;
$end_date = @$timesheet_period[0]->end_date;
$start_date = date('m/d/Y', strtotime($start_date));
$end_date = date('m/d/Y', strtotime($end_date));
$payroll_period = date($start_date . " - " . $end_date);

$employee = new Employee($lngID);
;
$employee->getEmploymentType();
$employee->getDepartment();
$full_name = @explode(' ', $employee->strFullName);
$first_name = @ucfirst($full_name[0] . (count($full_name) > 2 ? ' ' . $full_name[1] : ''));
$last_name = @ucfirst($full_name[(count($full_name) > 2 ? 2 : 1)]);
$department = @$employee->department->strName;

if (!accessible_permission("is_admin", "model") && $myEmployeeID === 0)
    return handle_error($status, "Your account is not linked. See your supervisor.", true);

require_once ("scripts/timesheet.tmpl.html"); //jquery-tmpl templates for this file
?>

<script type="text/javascript">
    //to learn jquery templates -> http://api.jquery.com/category/plugins/templates/
    //date.js -> http://www.datejs.com/
    //timepicker -> http://labs.perifer.se/timedatepicker/
    //data from the form
    var timesheet_info = {
        timesheet_period_id:'<?= $timesheet_period_id ?>',
        employee_id:'<?= $employee->lngID ?>',
        payroll_period:"<?= $payroll_period; ?>",
        start_date:"<?= $start_date; ?>",
        end_date:"<?= $end_date; ?>",
        ca_or_sa:"<?= $employee->type->strName; ?>",
        department:"<?= $department; ?>",
        first_name:"<?= $first_name; ?>",
        last_name:"<?= $last_name; ?>",
        lngID:"<?= $lngID; ?>",
        department_id:"<?= $department_id; ?>",
        is_admin:'<?= accessible_permission("is_admin", "model"); ?>'
    }
</script>
<script src="scripts/timesheet.js" type="text/javascript"></script>

<div class="page_title">Manage Timesheets</div>

<div id="error_msg" class="status_box Error" style="display: none;">
    <!-- A place to output errors if json is not constructed properly on an ajax call -->
</div>

<table style="width:99.9%;" align="center">
    <tr>
        <td>
            <form id="select_timesheet_form" method='GET' action='index.php?view=add_timesheet_form'>
                <input type="hidden" name="view" value="add_timesheet_form"/>
                <div id="search_options" style="display:block;">
                    <div class="text_tabs">
                        <ul>
                            <li class="left spacer">&nbsp;</li>
                            <li><b><span>Search Options</span></b></li>
                        </ul>
                    </div>
                    <div class="tabbed_section_body select_timesheet">
                        <div style="search_field_wrapper" id="sf_end_date">
                            <div class="search_field_label">Department:</div>
                            <div class="search_field">
                                <select id="department_id" name='departmentID' class='selector'>
                                    <?php foreach ($departments as $d) { ?>
                                    <option value='<?= $d->lngID; ?>'><?= $d->strName ?></option><?php } ?>
                                </select>
                            </div>
                        </div>
                        <div style="search_field_wrapper" id="sf_start_date">
                            <div class="search_field_label">Date:</div>
                            <div class="search_field"><input id="date" type="text" class="datepicker selector"
                                                             name="date" value="<?= $date; ?>"/>&nbsp
                                <button style="width: 10px;" type="button" class="previous_period button btn-go_prev">
                                    &nbsp
                                </button>
                                <button style="width: 10px;" type="button" class="next_period button btn-go_next">
                                    &nbsp
                                </button>
                            </div>
                        </div>
                        <div style="clear: both;"></div>
                        <div style="search_field_wrapper">
                            <div class="search_field_label">Employee:</div>
                            <div class="search_field">
                                <select id="employee_id" name='lngID' class='selector'>
                                    <?php foreach ($employees as $e) { ?>
                                    <option value='<?= $e->lngID; ?>'><?= $e->strFullName ?></option><?php } ?>
                                </select>
                                <button style="width: 10px;" type="button" class="previous_employee button btn-go_prev">
                                    &nbsp
                                </button>
                                <button style="width: 10px;" type="button" class="next_employee button btn-go_next">
                                    &nbsp
                                </button>
                            </div>
                        </div>
                        <div style="clear: both;"></div>
                    </div>
                </div>
            </form>
        </td>
    </tr>
</table>

<div id="timesheet">
    <table style="width:99.9%;" align="center">
        <tr>
            <td>
                <table class="grid-def day_grid">
                    <tr class="grid-row_header">
                        <td align="center" colspan="11">Week One</td>
                    </tr>
                    <tbody>
                    <tr>
                        <th>Day</th>
                        <th>Date</th>
                        <th>Time<br/> In</th>
                        <th>Meal<br/> Period</th>
                        <th>Time<br/> Out</th>
                        <th>Hours<br/> Worked</th>
                        <th>Sick<br/> Hours</th>
                        <th>Annual<br/> Hours</th>
                        <th>Total</th>
                        <th>Shift <br/>Hours</th>
                        <th>Notice</th>
                    </tr>
                    </tbody>
                    <tbody id="week1"></tbody>
                    <tbody class=" day_grid totals_css" id="week1_totals">
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table class="grid-def day_grid">
                    <tr class="grid-row_header">
                        <td align="center" colspan="11">Week Two</td>
                    </tr>
                    <tbody>
                    <tr>
                        <th>Day</th>
                        <th>Date</th>
                        <th>Time<br/> In</th>
                        <th>Meal<br/> Period</th>
                        <th>Time<br/> Out</th>
                        <th>Hours<br/> Worked</th>
                        <th>Sick<br/> Hours</th>
                        <th>Annual<br/> Hours</th>
                        <th>Total</th>
                        <th>Shift<br/> Hours</th>
                        <th>Notice</th>
                    </tr>
                    </tbody>
                    <tbody id="week2"></tbody>
                    <tbody class="day_grid totals_css" id="week2_totals"></tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td>
                <table class="grid-def day_grid" id="totals" style="border: 0;"></table>
            </td>
        </tr>
    </table>
    <form id="pdf_form" method="POST" action="generate_pdf/dl_pdf.php" target="_blank">
        <input id="week_data1" name="week_data1" type="hidden"/>
        <input id="week_total1" name="week_total1" type="hidden"/>
        <input id="week_total2" name="week_total2" type="hidden"/>
        <input id="week_data2" name="week_data2" type="hidden"/>
        <input id="two_week_total" name="two_week_total" type="hidden"/>
        <input id="last_name_data" name="last_name" type="hidden"/>
        <input id="ca_or_sa_data" name="ca_or_sa" type="hidden"/>
        <input id="first_name_data" name="first_name" type="hidden"/>
        <input id="payroll_period_data" name="payroll_period" type="hidden"/>
        <input id="department_data" name="department" type="hidden"/>
    </form>
    <div class='filter_box'>
        <table id="footer_interface">
            <tr>
                <td style="text-align: left; width: 10%;">
                    <button style="width: auto;" type="button" class="previous_employee button btn-go_prev">Previous
                    </button>
                </td>
                <td>
                    <button id="download" type="button" class="button btn-export" style="width: 110px;">Create PDF
                    </button>
                    <?php if (accessible_permission("is_admin", "model")) { ?>
                    <button id="trim_hours_options" type="button" class="button btn-cut" style="width: 110px;">Trim
                        Hours
                    </button>
                    <?php } ?>
                </td>
                <td style="text-align: right; width: 10%;">
                    <button style="width: auto;" type="button" class="next_employee button btn-go_next">Next</button>
                </td>
            </tr>
        </table>
    </div>

    <div id="trim_hours_modal" style="text-align: left;" title="Trim working days">

        From <input id="up_hours_cut" type="text" value="8:00 am" class="time_picker" style="width: 60px;"/>
        to <input id="down_hours_cut" type="text" value="6:00 pm" class="time_picker" style="width: 60px;"/>
        <button type="button" id="trim_hours_btn" class="button btn-cut" style="width: 70px;">Trim</button>

    </div>

    <div id="day_raw_modal" title="Edit Data">
        <div id="day_raw_modal_data">
        </div>
    </div>
</div>

