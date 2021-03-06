<?php
require_once("includes/view_included.php");
//require_once("includes/PagedResult.php");
//require_once("includes/Employee.php");

$status->destination = "tblEmployees";

$fields = array();
$fields['strFullName'] = $db->escapeSimple(trim(@$_REQUEST['strFullName']));
$fields['lngShiftID'] = $db->escapeSimple(trim(@$_REQUEST['lngShiftID']));
$fields['lngDepartmentID'] = $db->escapeSimple(trim(@$_REQUEST['lngDepartmentID']));
$fields['lngEmployeeID'] = $db->escapeSimple(trim(@$_REQUEST['lngEmployeeID']));
$fields['strPIN'] = $db->escapeSimple(trim(@$_REQUEST['strPIN']));
$fields['blnDisabled'] = $db->escapeSimple(trim(@$_REQUEST['blnDisabled']));
$fields['bytPaymentBasis'] = $db->escapeSimple(trim(@$_REQUEST['bytPaymentBasis']));
$fields['dblNormalRatePerHour'] = $db->escapeSimple(trim(@$_REQUEST['dblNormalRatePerHour']));
$fields['dblOTRatePerHour'] = $db->escapeSimple(trim(@$_REQUEST['dblOTRatePerHour']));
$fields['dblSalaryPerPeriod'] = $db->escapeSimple(trim(@$_REQUEST['dblSalaryPerPeriod']));
$fields['bytSalaryPeriod'] = $db->escapeSimple(trim(@$_REQUEST['bytSalaryPeriod']));
$fields['dblOTLoading'] = $db->escapeSimple(trim(@$_REQUEST['dblOTLoading']));
$fields['blnCreditPaidHolidays'] = $db->escapeSimple(trim(@$_REQUEST['blnCreditPaidHolidays']));
$fields['strSSN'] = $db->escapeSimple(trim(@$_REQUEST['strSSN']));
$fields['lngEmploymentType'] = $db->escapeSimple(trim(@$_REQUEST['lngEmploymentType']));
$fields['datBirth'] = $db->escapeSimple(trim(@$_REQUEST['datBirth']));
$fields['datHired'] = $db->escapeSimple(trim(@$_REQUEST['datHired']));
$fields['strNotes'] = $db->escapeSimple(trim(@$_REQUEST['strNotes']));
$fields['strHomePhone'] = $db->escapeSimple(trim(@$_REQUEST['strHomePhone']));
$fields['strAlternatePhone'] = $db->escapeSimple(trim(@$_REQUEST['strAlternatePhone']));
$fields['strCellPhone'] = $db->escapeSimple(trim(@$_REQUEST['strCellPhone']));
$fields['strAddress'] = $db->escapeSimple(trim(@$_REQUEST['strAddress']));
$fields['strEmergencyContact'] = $db->escapeSimple(trim(@$_REQUEST['strEmergencyContact']));
$fields['strEmergencyPhone'] = $db->escapeSimple(trim(@$_REQUEST['strEmergencyPhone']));
$fields['bytMaritalStatus'] = $db->escapeSimple(trim(@$_REQUEST['bytMaritalStatus']));
$fields['bytEmployeeType'] = $db->escapeSimple(trim(@$_REQUEST['bytEmployeeType']));
$fields['strTaxExemptions'] = $db->escapeSimple(trim(@$_REQUEST['strTaxExemptions']));
$fields['blnDeleted'] = $db->escapeSimple(trim(@$_REQUEST['blnDeleted']));
$fields['blnAccrueVacations'] = $db->escapeSimple(trim(@$_REQUEST['blnAccrueVacations']));
$fields['blnAccrueSickLeave'] = $db->escapeSimple(trim(@$_REQUEST['blnAccrueSickLeave']));
$fields['blnDelegate'] = $db->escapeSimple(trim(@$_REQUEST['blnDelegate']));
$fields['sngVacationStartingBalance'] = $db->escapeSimple(trim(@$_REQUEST['sngVacationStartingBalance']));
$fields['sngSickTimeStartingBalance'] = $db->escapeSimple(trim(@$_REQUEST['sngSickTimeStartingBalance']));
$fields['dblOTRatePerHour2'] = $db->escapeSimple(trim(@$_REQUEST['dblOTRatePerHour2']));
$fields['blnAlwaysPaySalary'] = $db->escapeSimple(trim(@$_REQUEST['blnAlwaysPaySalary']));
$fields['blnWaiveAutomaticBreaks'] = $db->escapeSimple(trim(@$_REQUEST['blnWaiveAutomaticBreaks']));
$fields['strPattern1'] = $db->escapeSimple(trim(@$_REQUEST['strPattern1']));
$fields['strPattern2'] = $db->escapeSimple(trim(@$_REQUEST['strPattern2']));
$fields['lngMask1'] = $db->escapeSimple(trim(@$_REQUEST['lngMask1']));
$fields['lngMask2'] = $db->escapeSimple(trim(@$_REQUEST['lngMask2']));
$fields['lngEnrolledMask'] = $db->escapeSimple(trim(@$_REQUEST['lngEnrolledMask']));
$fields['bytJobTracking'] = $db->escapeSimple(trim(@$_REQUEST['bytJobTracking']));
$fields['sngHolidayCreditedHours'] = $db->escapeSimple(trim(@$_REQUEST['sngHolidayCreditedHours']));
$fields['blnOverrideHolidayHours'] = $db->escapeSimple(trim(@$_REQUEST['blnOverrideHolidayHours']));
$fields['strEmailAddress'] = $db->escapeSimple(trim(@$_REQUEST['strEmailAddress']));
$fields['blnOverrideAccrualStart'] = $db->escapeSimple(trim(@$_REQUEST['blnOverrideAccrualStart']));
$fields['datAccrualStart'] = $db->escapeSimple(trim(@$_REQUEST['datAccrualStart']));

// pager fields
$fields['sort_by'] = (isset($_REQUEST['sort_by']) ? $db->escapeSimple(trim($_REQUEST['sort_by'])) : "strFullName_a");
if (isset($_REQUEST['items_per_page']) && is_numeric($_REQUEST['items_per_page']))
	$fields['items_per_page'] = trim($_REQUEST['items_per_page']);
if (isset($_REQUEST['page']) && is_numeric($_REQUEST['page']))
	$fields['page'] = trim($_REQUEST['page']);

// clear other saved searches
if (!isset($_SESSION[APPLICATION_NAME]['search_options'][$view]) &&
	@count($_SESSION[APPLICATION_NAME]['search_options']) > 0)
	unset($_SESSION[APPLICATION_NAME]['search_options']);
// reset saved search
if (isset($_GET['reset']))
	unset($_SESSION[APPLICATION_NAME]['search_options'][$view]);
// if new search was submitted => save it
else if (isset($_REQUEST['sort_by']))
	$_SESSION[APPLICATION_NAME]['search_options'][$view] = $fields;
// if saved search was found => use it
else if (isset($_SESSION[APPLICATION_NAME]['search_options'][$view]))
	$fields = $_SESSION[APPLICATION_NAME]['search_options'][$view];

// prepare and retrieve paged results
$pager = new PagedResult();

if (isset($fields['items_per_page']))
	$pager->results_per_page = $fields['items_per_page'];
if (isset($fields['page']))
	$pager->current_page = $fields['page'];
//
$pager->OrderBy($fields['sort_by']);

$pager->conditions[] = array(
    'AND' => array(
	'strFullName' => array($fields['strFullName'], 'like'),
	'lngShiftID' => array($fields['lngShiftID'], 'like'),
	'lngDepartmentID' => array($fields['lngDepartmentID'], 'like'),
	'lngEmployeeID' => array($fields['lngEmployeeID'], 'like'),
	'strPIN' => array($fields['strPIN'], 'like'),
	'blnDisabled' => array($fields['blnDisabled'], 'bool'),
	'bytPaymentBasis' => array($fields['bytPaymentBasis'], 'eq'),
	'dblNormalRatePerHour' => array($fields['dblNormalRatePerHour'], 'eq'),
	'dblOTRatePerHour' => array($fields['dblOTRatePerHour'], 'eq'),
	'dblSalaryPerPeriod' => array($fields['dblSalaryPerPeriod'], 'eq'),
	'bytSalaryPeriod' => array($fields['bytSalaryPeriod'], 'eq'),
	'dblOTLoading' => array($fields['dblOTLoading'], 'eq'),
	'blnCreditPaidHolidays' => array($fields['blnCreditPaidHolidays'], 'bool'),
	'strSSN' => array($fields['strSSN'], 'like'),
	'lngEmploymentType' => array($fields['lngEmploymentType'], 'like'),
	'datBirth' => array($fields['datBirth'], 'eq'),
	'datHired' => array($fields['datHired'], 'eq'),
	'strNotes' => array($fields['strNotes'], 'like'),
	'strHomePhone' => array($fields['strHomePhone'], 'like'),
	'strAlternatePhone' => array($fields['strAlternatePhone'], 'like'),
	'strCellPhone' => array($fields['strCellPhone'], 'like'),
	'strAddress' => array($fields['strAddress'], 'like'),
	'strEmergencyContact' => array($fields['strEmergencyContact'], 'like'),
	'strEmergencyPhone' => array($fields['strEmergencyPhone'], 'like'),
	'bytMaritalStatus' => array($fields['bytMaritalStatus'], 'eq'),
	'bytEmployeeType' => array($fields['bytEmployeeType'], 'eq'),
	'strTaxExemptions' => array($fields['strTaxExemptions'], 'like'),
	'blnDeleted' => array($fields['blnDeleted'], 'bool'),
	'blnAccrueVacations' => array($fields['blnAccrueVacations'], 'bool'),
	'blnAccrueSickLeave' => array($fields['blnAccrueSickLeave'], 'bool'),
	'blnDelegate' => array($fields['blnDelegate'], 'bool'),
	'sngVacationStartingBalance' => array($fields['sngVacationStartingBalance'], 'eq'),
	'sngSickTimeStartingBalance' => array($fields['sngSickTimeStartingBalance'], 'eq'),
	'dblOTRatePerHour2' => array($fields['dblOTRatePerHour2'], 'eq'),
	'blnAlwaysPaySalary' => array($fields['blnAlwaysPaySalary'], 'bool'),
	'blnWaiveAutomaticBreaks' => array($fields['blnWaiveAutomaticBreaks'], 'eq'),
	'strPattern1' => array($fields['strPattern1'], 'like'),
	'strPattern2' => array($fields['strPattern2'], 'like'),
	'lngMask1' => array($fields['lngMask1'], 'like'),
	'lngMask2' => array($fields['lngMask2'], 'like'),
	'lngEnrolledMask' => array($fields['lngEnrolledMask'], 'like'),
	'bytJobTracking' => array($fields['bytJobTracking'], 'eq'),
	'sngHolidayCreditedHours' => array($fields['sngHolidayCreditedHours'], 'eq'),
	'blnOverrideHolidayHours' => array($fields['blnOverrideHolidayHours'], 'bool'),
	'strEmailAddress' => array($fields['strEmailAddress'], 'like'),
	'blnOverrideAccrualStart' => array($fields['blnOverrideAccrualStart'], 'bool'),
	'datAccrualStart' => array($fields['datAccrualStart'], 'eq'),
    )
);
$pager->select = "e.lngID, e.strFullName, d.strName as dep_name, t.strName as type_name, e.lngDepartmentID, e.lngEmploymentType";
$pager->table = Employee::$tableName . " e
					inner join " . Department::$tableName . " d on e.lngDepartmentID = d.lngID " . "
					inner join " . EmploymentType::$tableName . " t on e.lngEmploymentType = t.lngID";

$pager->RunSearch();


if (PEAR::isError($pager->results)) {
	return handle_error($status, $pager->results);
}
?>
<script type="text/javascript">
	$(document).ready(function() 
	{
		$('#batch_delete').click(function() 
		{
			if ($('input.tblEmployees:checked').size() == 0)
			{
				alert('Please select at least one item to delete');
				return false;
			}
		
			if (confirm("Are you sure that you want to remove the selected items?")) 
			{
				var link='controller.php?action=delete_tblEmployee';
				$('input.tblEmployees:checked').each(function(){
					link += '&id[]='+$(this).val();
				});
				link += '&popup_destination=<?= @$popup_destination; ?>';
				location.href=(link);
			}
		});
		$('#tblEmployees_all').click(function(){
			$('.tblEmployees').attr('checked', $('#tblEmployees_all').attr('checked'));
		});
		$('.tblEmployees').click(function(){
			if ($(this).attr('checked') == false && $('#tblEmployees_all').attr('checked'))
				$('#tblEmployees_all').removeAttr('checked');
		});
	});
</script>

<div class="page_title">Manage Employees</div>

<form method="get" action="<?= $_SERVER['PHP_SELF']; ?>">
	<input type="hidden" name="view" value="tblEmployees"/>
	<input type="hidden" name="sort_by" value="<?= @$fields['sort_by'] ?>"/>

	<div id="search_options" style="display:<?= (array_empty($fields) ? "none" : "block") ?>">
		<div class="text_tabs">
			<ul>
				<li class="left spacer">&nbsp;</li>
				<li><b><span>Search Options</span></b></li>
				<li class="right"><a href="javascript:void(0)" onclick="$('#search_options').fadeOut('fast');">Hide Search Options</a></li>
			</ul>
		</div>
		<div class="tabbed_section_body">

			<div style="search_field_wrapper" id="sf_strFullName">
				<div class="search_field_label">Full Name:</div>
				<div class="search_field"><input type='text' class='textbox' name='strFullName' value='<?= $fields['strFullName']; ?>' maxlength='255'/></div>
			</div>


			<div style="search_field_wrapper" id="sf_lngDepartmentID">
				<div class="search_field_label">Department:</div>
				<div class="search_field">
					<select id="department_id" name='lngDepartmentID' class='textbox' >
						<option value=''/>
						<?php foreach ($departments = Department::getDepartments() as $d) : ?>
							<option value='<?= $d->lngID; ?>' <?= $d->lngID == @$fields['lngDepartmentID'] ? "SELECTED='SELECTED'" : "" ?>><?= $d->strName ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>

			<div style="clear: both;"></div>
			<div style="search_field_wrapper" id="sf_blnDisabled">
				<div class="search_field_label">Disabled:</div>
				<div class="search_field"><label><input type='radio' name='blnDisabled' value='1' <?= ($fields['blnDisabled'] === '1' ? "CHECKED='CHECKED'" : ""); ?> /> Yes</label>
					<label><input type='radio' name='blnDisabled' value='0' <?= ($fields['blnDisabled'] === '0' ? "CHECKED='CHECKED'" : ""); ?> /> No</label>
					<?php /* <label><input type='checkbox' name='blnDisabled' <?php if($fields['blnDisabled'] == 'on' || $fields['blnDisabled'] == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label> */ ?></div>
			</div>

			<div style="search_field_wrapper" id="sf_lngEmploymentType">
				<div class="search_field_label">Employment Type:</div>
				<div class="search_field">
					<select name='lngEmploymentType' class='textbox' >
						<option value=''/>
						<?php foreach ($departments = EmploymentType::getEmploymentTypes() as $d) : ?>
							<option value='<?= $d->lngID; ?>' <?= $d->lngID == @$fields['lngEmploymentType'] ? "SELECTED='SELECTED'" : "" ?>><?= $d->strName ?></option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
			<div style="clear: both;"></div>
			<div style="search_field_wrapper" id="sf_strSSN">
				<div class="search_field_label">SSN:</div>
				<div class="search_field"><input type='text' class='textbox' name='strSSN' value='<?= $fields['strSSN']; ?>' maxlength='20'/></div>
			</div>


			<div style="clear: both;"></div>
			<div style="search_field_wrapper">
				<div class="search_field_label">Results:</div>
				<div class="search_field">
					<?php
					$results = $pager->total_results . " match" . ($pager->total_results != 1 ? "es" : "") . " found.";
					if ($pager->total_results > 0)
						$results .= " Page " . ($pager->current_page) . " of " . $pager->total_pages . ".";
					?>
					<div><?= $results; ?></div>
				</div>
			</div>
			<div style="search_field_wrapper">
				<div class="search_field_label"></div>
				<div class="search_field_label">
					<input type="submit" value="Search" class="button btn-search" style="width:80px;" />
					<input type="button" value="Reset Form" class="button btn-reload" style="width:100px;" onClick="location='?view=tblEmployees&reset'"/>
				</div>
			</div>
			<div style="clear: both;"></div>
		</div>
	</div>

	<br/>

	<div class="filter_box">
		<table width="100%">
			<tr>
				<?php if (accessible_permission("add_tblEmployee", "view")) { ?>
					<td style="padding-right:10px;border-right:solid 1px maroon;width:145px;">
						<input type="button" disabled="disabled" value="Add Employee" onClick="location='?view=add_tblEmployee'" class="button btn-add" style="width:145px;"/>
					</td>
				<?php } ?>
				<td align="center">
					<?php $pager->getPager(); ?>
				</td>
				<td align="right">
					<input type="button" value="Search Options" class="button btn-search" onclick="$('#search_options').fadeIn('fast');" style="width:130px;" />
				</td>
			</tr>
		</table>
	</div>

	<table class="grid-def">
		<tr class="grid-row_header">
			<?php if (accessible_permission("delete_tblEmployee_model", "model")) { ?>
				<td width="50" align="center">Delete</td>
				<!--<td width="40" align="center" style="padding:0"><input type="checkbox" id="tblEmployees_all" title="Select all items on this page"/></td>-->
			<?php } ?>
			<td>
				Full Name
				<input type="image" onclick="sort_by.value='strFullName_a';" src='<?= COMMON_FILES_PATH; ?>images/icons/arrow_up_16.gif' width="10" height="10" />
				<input type="image" onclick="sort_by.value='strFullName_d';" src='<?= COMMON_FILES_PATH; ?>images/icons/arrow_down_16.gif' width="10" height="10" />
			</td>
			<td>
				Department
				<input type="image" onclick="sort_by.value='d.strName_a';" src='<?= COMMON_FILES_PATH; ?>images/icons/arrow_up_16.gif' width="10" height="10" />
				<input type="image" onclick="sort_by.value='d.strName_d';" src='<?= COMMON_FILES_PATH; ?>images/icons/arrow_down_16.gif' width="10" height="10" />
			</td>
			<td>
				Employment Type
				<input type="image" onclick="sort_by.value='t.strName_a';" src='<?= COMMON_FILES_PATH; ?>images/icons/arrow_up_16.gif' width="10" height="10" />
				<input type="image" onclick="sort_by.value='t.strName_d';" src='<?= COMMON_FILES_PATH; ?>images/icons/arrow_down_16.gif' width="10" height="10" />
			</td>
			<!--td>employee->strFullName</td-->
		</tr>

		<?php
		$i = 0;
		foreach ($pager->results as $row) {
			$i++;
			$employee = new Employee();
			$employee->setPropertyValues($row);
			$employee->department = new Department();
			$employee->department->setPropertyValues($row);
			$employee->department->strName = $row['dep_name'];
			$employee->type = new EmploymentType();
			$employee->type->setPropertyValues($row);
			$employee->type->strName = $row['type_name'];
			?>
			<tr class="grid-row<?= ($i % 2) ?>">
			<?php if (accessible_permission("delete_tblEmployee_model", "model")) { ?>
					<td align="center">
						<a href='controller.php?action=delete_tblEmployee&id=<?= $employee->lngID; ?>&popup_destination=<?= @$popup_destination; ?>' onClick='return confirm("Are you sure that you want to delete this tblEmployee?");'><img src='<?= COMMON_FILES_PATH; ?>images/icons/delete.gif' /></a>
						<!--<input type="checkbox" class="tblEmployees" name="id[]" value="<?= $employee->lngID; ?>"/>-->
					</td>
		<?php } ?>
				<td>
				<?php
				if (accessible_permission("add_tblEmployee", "view")) {
					echo "<a href='?view=add_tblEmployee&id=" . $employee->lngID . "'>" . $employee->strFullName . "</a>";
				}
				else
					echo $employee->strFullName;
				?>
				</td>
				<td>
					<?php
					if (accessible_permission("add_tblEmployee", "view")) {
						echo "<a href='?view=add_tblDepartment&id=" . $employee->lngDepartmentID . "'>" . $employee->department->strName . "</a>";
					}
					else
						echo $employee->department->strName;
					?>
				</td>
				<td>
					<?php
					if (accessible_permission("add_tblEmployee", "view")) {
						echo "<a href='?view=add_tblEmploymentType&id=" . $employee->lngEmploymentType . "'>" . $employee->type->strName . "</a>";
					}
					else
						echo $employee->type->strName;
					?>
				</td>
				<!--<td><?php //echo $employee->strFullName; ?></td>-->
			</tr>
			<?php
		}
		if ($pager->total_results == 0) {
			?>
			<tr class="grid-row0">
				<td colspan="7" align="center" height="50">No items found matching your query.</td>
			</tr>
			<?php
		}
		?>
	</table>

	<table class="grid-def" style="margin-top:10px;border:0">
		<tr>
			<td style="padding-left:10px;">
				<?php /* if (accessible_permission("delete_tblEmployee_model","model")) { ?>
				  <b>Action:</b> <a href='javascript:void(0)' class="link btn-delete" id='batch_delete'>Remove selected</a>
				  <?php } */ ?> 
			</td>
			<td colspan="2" align="right"><?= $results; ?></td>
		</tr>
	</table>

</form>
