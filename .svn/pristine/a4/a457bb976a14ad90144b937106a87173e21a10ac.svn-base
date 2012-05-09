
<?php
require_once("includes/view_included.php");
//require_once("includes/Employee.php");

$status->destination = "add_tblEmployee";

$id = $db->escapeSimple(trim(@$_REQUEST['id']));
if ($id > 0) {
	$status->destination = "add_tblEmployee&id=".$id;
}

if (isset($_SESSION[APPLICATION_NAME]['form_data']))
{
	$values = $_SESSION[APPLICATION_NAME]['form_data'];
	unset($_SESSION[APPLICATION_NAME]['form_data']);
	
	$employee = new Employee(@$id);
	$employee->setPropertyValues($values);
}
else {
	$employee = new Employee($id);
	$employee->setPropertyValues($_REQUEST);
}
?>
<script type="text/javascript">
	$(document).ready(function() {
		<?php if (!accessible_permission("add_tblEmployee_model","model")) { ?>
		$('#save_btn').attr({'class':'button btn-readonly','title':'<?=ERR_READONLY;?>'});
		$('#add_frm').submit(function(){alert('<?=ERR_READONLY;?>');return false;});
		<?php } ?>
		<?php if (!$tblEmployee->exists) { ?>
		document.forms[0].strFullName.focus();
		<?php } ?>
	});
</script>
<div class="page_title"><?=$employee->exists ? "Update" : "Add"?> TblEmployee</div>

<form id="add_frm" action="controller.php?action=<?=$status->destination;?>" method="POST">

<input type="hidden" name="popup_destination" value="<?=@$popup_destination;?>"/>
<input type="hidden" name="force_postback" value=""/>

<table class="grid-def">
<tr class="grid-row_header">
	<td colspan="2">TblEmployee Information</td>
</tr>
<tr>
	<td class="grid-space" width="55%">
		<table class="grid-form">

		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($employee,'strFullName')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='strFullName' value='<?=$employee->strFullName;?>' maxlength='255'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($employee,'lngShiftID')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='lngShiftID' value='<?=$employee->lngShiftID;?>'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($employee,'lngDepartmentID')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='lngDepartmentID' value='<?=$employee->lngDepartmentID;?>'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($employee,'lngEmployeeID')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='lngEmployeeID' value='<?=$employee->lngEmployeeID;?>'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($employee,'strPIN')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='strPIN' value='<?=$employee->strPIN;?>' maxlength='255'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($employee,'blnDisabled')->Description;?>: <span class="hint" onmouseover="return overlib('Required Field');" onmouseout="return nd();">&nbsp;</span></td>
			<td>
				<label><input type='radio' name='blnDisabled' value='1' <?=($employee->blnDisabled==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnDisabled' value='0' <?=($employee->blnDisabled==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnDisabled' <?php if($employee->blnDisabled == 'on' || $employee->blnDisabled == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($employee,'bytPaymentBasis')->Description;?>: </td>
			<td>
				short
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($employee,'dblNormalRatePerHour')->Description;?>: </td>
			<td>
				double
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($employee,'dblOTRatePerHour')->Description;?>: </td>
			<td>
				double
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($employee,'dblSalaryPerPeriod')->Description;?>: </td>
			<td>
				double
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($employee,'bytSalaryPeriod')->Description;?>: </td>
			<td>
				short
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($employee,'dblOTLoading')->Description;?>: </td>
			<td>
				double
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($employee,'blnCreditPaidHolidays')->Description;?>: <span class="hint" onmouseover="return overlib('Required Field');" onmouseout="return nd();">&nbsp;</span></td>
			<td>
				<label><input type='radio' name='blnCreditPaidHolidays' value='1' <?=($employee->blnCreditPaidHolidays==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnCreditPaidHolidays' value='0' <?=($employee->blnCreditPaidHolidays==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnCreditPaidHolidays' <?php if($employee->blnCreditPaidHolidays == 'on' || $employee->blnCreditPaidHolidays == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($employee,'strSSN')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='strSSN' value='<?=$employee->strSSN;?>' maxlength='20'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($employee,'lngEmploymentType')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='lngEmploymentType' value='<?=$employee->lngEmploymentType;?>'/>
			</td>
		</tr>
		<tr>
			<td class="column_label" style="vertical-align:middle;"><?=AttributeReader::PropertyAttributes($employee,'datBirth')->Description;?>: </td>
			<td>
				<input type='text' class='datepicker' name='datBirth' value='<?php if($employee->datBirth != ''){echo date('Y-m-d',strtotime($employee->datBirth));}?>' />
			</td>
		</tr>
		<tr>
			<td class="column_label" style="vertical-align:middle;"><?=AttributeReader::PropertyAttributes($employee,'datHired')->Description;?>: </td>
			<td>
				<input type='text' class='datepicker' name='datHired' value='<?php if($employee->datHired != ''){echo date('Y-m-d',strtotime($employee->datHired));}?>' />
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($employee,'strNotes')->Description;?>: </td>
			<td>
				<textarea rows='3' class='textbox' name='strNotes'><?=$employee->strNotes;?></textarea>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($employee,'strHomePhone')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='strHomePhone' value='<?=$employee->strHomePhone;?>' maxlength='255'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($employee,'strAlternatePhone')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='strAlternatePhone' value='<?=$employee->strAlternatePhone;?>' maxlength='255'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($employee,'strCellPhone')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='strCellPhone' value='<?=$employee->strCellPhone;?>' maxlength='255'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($employee,'strAddress')->Description;?>: </td>
			<td>
				<textarea rows='3' class='textbox' name='strAddress'><?=$employee->strAddress;?></textarea>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($employee,'strEmergencyContact')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='strEmergencyContact' value='<?=$employee->strEmergencyContact;?>' maxlength='255'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($employee,'strEmergencyPhone')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='strEmergencyPhone' value='<?=$employee->strEmergencyPhone;?>' maxlength='255'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($employee,'bytMaritalStatus')->Description;?>: </td>
			<td>
				short
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($employee,'bytEmployeeType')->Description;?>: </td>
			<td>
				short
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($employee,'strTaxExemptions')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='strTaxExemptions' value='<?=$employee->strTaxExemptions;?>' maxlength='255'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($employee,'blnDeleted')->Description;?>: <span class="hint" onmouseover="return overlib('Required Field');" onmouseout="return nd();">&nbsp;</span></td>
			<td>
				<label><input type='radio' name='blnDeleted' value='1' <?=($employee->blnDeleted==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnDeleted' value='0' <?=($employee->blnDeleted==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnDeleted' <?php if($employee->blnDeleted == 'on' || $employee->blnDeleted == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($employee,'blnAccrueVacations')->Description;?>: <span class="hint" onmouseover="return overlib('Required Field');" onmouseout="return nd();">&nbsp;</span></td>
			<td>
				<label><input type='radio' name='blnAccrueVacations' value='1' <?=($employee->blnAccrueVacations==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnAccrueVacations' value='0' <?=($employee->blnAccrueVacations==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnAccrueVacations' <?php if($employee->blnAccrueVacations == 'on' || $employee->blnAccrueVacations == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($employee,'blnAccrueSickLeave')->Description;?>: <span class="hint" onmouseover="return overlib('Required Field');" onmouseout="return nd();">&nbsp;</span></td>
			<td>
				<label><input type='radio' name='blnAccrueSickLeave' value='1' <?=($employee->blnAccrueSickLeave==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnAccrueSickLeave' value='0' <?=($employee->blnAccrueSickLeave==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnAccrueSickLeave' <?php if($employee->blnAccrueSickLeave == 'on' || $employee->blnAccrueSickLeave == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($employee,'blnDelegate')->Description;?>: <span class="hint" onmouseover="return overlib('Required Field');" onmouseout="return nd();">&nbsp;</span></td>
			<td>
				<label><input type='radio' name='blnDelegate' value='1' <?=($employee->blnDelegate==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnDelegate' value='0' <?=($employee->blnDelegate==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnDelegate' <?php if($employee->blnDelegate == 'on' || $employee->blnDelegate == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($employee,'sngVacationStartingBalance')->Description;?>: </td>
			<td>
				float
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($employee,'sngSickTimeStartingBalance')->Description;?>: </td>
			<td>
				float
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($employee,'dblOTRatePerHour2')->Description;?>: </td>
			<td>
				float
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($employee,'blnAlwaysPaySalary')->Description;?>: <span class="hint" onmouseover="return overlib('Required Field');" onmouseout="return nd();">&nbsp;</span></td>
			<td>
				<label><input type='radio' name='blnAlwaysPaySalary' value='1' <?=($employee->blnAlwaysPaySalary==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnAlwaysPaySalary' value='0' <?=($employee->blnAlwaysPaySalary==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnAlwaysPaySalary' <?php if($employee->blnAlwaysPaySalary == 'on' || $employee->blnAlwaysPaySalary == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($employee,'blnWaiveAutomaticBreaks')->Description;?>: </td>
			<td>
				float
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($employee,'strPattern1')->Description;?>: </td>
			<td>
				<textarea rows='3' class='textbox' name='strPattern1'><?=$employee->strPattern1;?></textarea>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($employee,'strPattern2')->Description;?>: </td>
			<td>
				<textarea rows='3' class='textbox' name='strPattern2'><?=$employee->strPattern2;?></textarea>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($employee,'lngMask1')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='lngMask1' value='<?=$employee->lngMask1;?>'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($employee,'lngMask2')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='lngMask2' value='<?=$employee->lngMask2;?>'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($employee,'lngEnrolledMask')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='lngEnrolledMask' value='<?=$employee->lngEnrolledMask;?>'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($employee,'bytJobTracking')->Description;?>: </td>
			<td>
				short
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($employee,'sngHolidayCreditedHours')->Description;?>: </td>
			<td>
				float
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($employee,'blnOverrideHolidayHours')->Description;?>: <span class="hint" onmouseover="return overlib('Required Field');" onmouseout="return nd();">&nbsp;</span></td>
			<td>
				<label><input type='radio' name='blnOverrideHolidayHours' value='1' <?=($employee->blnOverrideHolidayHours==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnOverrideHolidayHours' value='0' <?=($employee->blnOverrideHolidayHours==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnOverrideHolidayHours' <?php if($employee->blnOverrideHolidayHours == 'on' || $employee->blnOverrideHolidayHours == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($employee,'strEmailAddress')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='strEmailAddress' value='<?=$employee->strEmailAddress;?>' maxlength='255'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($employee,'blnOverrideAccrualStart')->Description;?>: <span class="hint" onmouseover="return overlib('Required Field');" onmouseout="return nd();">&nbsp;</span></td>
			<td>
				<label><input type='radio' name='blnOverrideAccrualStart' value='1' <?=($employee->blnOverrideAccrualStart==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnOverrideAccrualStart' value='0' <?=($employee->blnOverrideAccrualStart==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnOverrideAccrualStart' <?php if($employee->blnOverrideAccrualStart == 'on' || $employee->blnOverrideAccrualStart == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?>
			</td>
		</tr>
		<tr>
			<td class="column_label" style="vertical-align:middle;"><?=AttributeReader::PropertyAttributes($employee,'datAccrualStart')->Description;?>: </td>
			<td>
				<input type='text' class='datepicker' name='datAccrualStart' value='<?php if($employee->datAccrualStart != ''){echo date('Y-m-d',strtotime($employee->datAccrualStart));}?>' />
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>
				<input type="submit" style="width: 65px;" class="button btn-save" value="Save" id="save_btn" />
				<input type="button" style="width: 80px;" class="button btn-cancel" value="Cancel" onclick="window.location.replace('?view=tblEmployees');" />
			</td>
		</tr>
		</table>
	</td>
	<?php /*if (@$employee->exists) { ?>
	<td class="grid-space">
		<div class="column_label">Related-view (<a class="fancybox" href="popup_index.php?view=related-view&id=<?=$employee->lngID;?>&source=<?=urlencode($status->destination);?>">Manage</a>)</div>
		<ul class="dot">
			<?php
			foreach ($items = RelatedClass::getRelatedObjects(array('lngID'=>$employee->lngID)) as $r)
			{
				?><li><b><a class="fancybox" href="popup_index.php?view=add_related_view&id=<?=$r->lngID;?>&source=<?=urlencode($status->destination);?>"><?=$r->related_name;?></a></li><?php
			}
			if (count($items) == 0) {
				?><i>(none)</i><?php
			}
			?>
		</ul>
	</td>
	<?php }*/ ?>
</tr>
</table>

</form>
