<?php
require_once("includes/view_included.php");
//require_once("includes/Setting.php");

$status->destination = "add_tblSetting";

$id = $db->escapeSimple(trim(@$_REQUEST['id']));
if ($id > 0) {
	$status->destination = "add_tblSetting&id=".$id;
}

if (isset($_SESSION[APPLICATION_NAME]['form_data']))
{
	$values = $_SESSION[APPLICATION_NAME]['form_data'];
	unset($_SESSION[APPLICATION_NAME]['form_data']);
	
	$setting = new Setting(@$id);
	$setting->setPropertyValues($values);
}
else {
	$setting = new Setting($id);
	$setting->setPropertyValues($_REQUEST);
}
?>
<script type="text/javascript">
	$(document).ready(function() {
		<?php if (!accessible_permission("add_tblSetting_model","model")) { ?>
		$('#save_btn').attr({'class':'button btn-readonly','title':'<?=ERR_READONLY;?>'});
		$('#add_frm').submit(function(){alert('<?=ERR_READONLY;?>');return false;});
		<?php } ?>
		<?php if (!$tblSetting->exists) { ?>
		document.forms[0].strCompanyName.focus();
		<?php } ?>
	});
</script>
<div class="page_title"><?=$setting->exists ? "Update" : "Add"?> TblSetting</div>

<form id="add_frm" action="controller.php?action=<?=$status->destination;?>" method="POST">

<input type="hidden" name="popup_destination" value="<?=@$popup_destination;?>"/>
<input type="hidden" name="force_postback" value=""/>

<table class="grid-def">
<tr class="grid-row_header">
	<td colspan="2">TblSetting Information</td>
</tr>
<tr>
	<td class="grid-space" width="55%">
		<table class="grid-form">

		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'strCompanyName')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='strCompanyName' value='<?=$setting->strCompanyName;?>' maxlength='255'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'strCompanyAddress')->Description;?>: </td>
			<td>
				<textarea rows='3' class='textbox' name='strCompanyAddress'><?=$setting->strCompanyAddress;?></textarea>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'strReportFooter')->Description;?>: </td>
			<td>
				<textarea rows='3' class='textbox' name='strReportFooter'><?=$setting->strReportFooter;?></textarea>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'blnIncludeSignature')->Description;?>: <span class="hint" onmouseover="return overlib('Required Field');" onmouseout="return nd();">&nbsp;</span></td>
			<td>
				<label><input type='radio' name='blnIncludeSignature' value='1' <?=($setting->blnIncludeSignature==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnIncludeSignature' value='0' <?=($setting->blnIncludeSignature==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnIncludeSignature' <?php if($setting->blnIncludeSignature == 'on' || $setting->blnIncludeSignature == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'blnDataEntryMode')->Description;?>: <span class="hint" onmouseover="return overlib('Required Field');" onmouseout="return nd();">&nbsp;</span></td>
			<td>
				<label><input type='radio' name='blnDataEntryMode' value='1' <?=($setting->blnDataEntryMode==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnDataEntryMode' value='0' <?=($setting->blnDataEntryMode==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnDataEntryMode' <?php if($setting->blnDataEntryMode == 'on' || $setting->blnDataEntryMode == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'blnRequirePIN')->Description;?>: <span class="hint" onmouseover="return overlib('Required Field');" onmouseout="return nd();">&nbsp;</span></td>
			<td>
				<label><input type='radio' name='blnRequirePIN' value='1' <?=($setting->blnRequirePIN==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnRequirePIN' value='0' <?=($setting->blnRequirePIN==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnRequirePIN' <?php if($setting->blnRequirePIN == 'on' || $setting->blnRequirePIN == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'blnRequireComment')->Description;?>: <span class="hint" onmouseover="return overlib('Required Field');" onmouseout="return nd();">&nbsp;</span></td>
			<td>
				<label><input type='radio' name='blnRequireComment' value='1' <?=($setting->blnRequireComment==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnRequireComment' value='0' <?=($setting->blnRequireComment==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnRequireComment' <?php if($setting->blnRequireComment == 'on' || $setting->blnRequireComment == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'bytCommentRequirements')->Description;?>: </td>
			<td>
				short
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'blnAllowBlankComments')->Description;?>: <span class="hint" onmouseover="return overlib('Required Field');" onmouseout="return nd();">&nbsp;</span></td>
			<td>
				<label><input type='radio' name='blnAllowBlankComments' value='1' <?=($setting->blnAllowBlankComments==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnAllowBlankComments' value='0' <?=($setting->blnAllowBlankComments==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnAllowBlankComments' <?php if($setting->blnAllowBlankComments == 'on' || $setting->blnAllowBlankComments == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'blnTimeFormat')->Description;?>: <span class="hint" onmouseover="return overlib('Required Field');" onmouseout="return nd();">&nbsp;</span></td>
			<td>
				<label><input type='radio' name='blnTimeFormat' value='1' <?=($setting->blnTimeFormat==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnTimeFormat' value='0' <?=($setting->blnTimeFormat==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnTimeFormat' <?php if($setting->blnTimeFormat == 'on' || $setting->blnTimeFormat == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'strAdministratorPassword')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='strAdministratorPassword' value='<?=$setting->strAdministratorPassword;?>' maxlength='50'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'blnEmployeesViewHours')->Description;?>: <span class="hint" onmouseover="return overlib('Required Field');" onmouseout="return nd();">&nbsp;</span></td>
			<td>
				<label><input type='radio' name='blnEmployeesViewHours' value='1' <?=($setting->blnEmployeesViewHours==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnEmployeesViewHours' value='0' <?=($setting->blnEmployeesViewHours==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnEmployeesViewHours' <?php if($setting->blnEmployeesViewHours == 'on' || $setting->blnEmployeesViewHours == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'blnEmployeesPrintHours')->Description;?>: <span class="hint" onmouseover="return overlib('Required Field');" onmouseout="return nd();">&nbsp;</span></td>
			<td>
				<label><input type='radio' name='blnEmployeesPrintHours' value='1' <?=($setting->blnEmployeesPrintHours==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnEmployeesPrintHours' value='0' <?=($setting->blnEmployeesPrintHours==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnEmployeesPrintHours' <?php if($setting->blnEmployeesPrintHours == 'on' || $setting->blnEmployeesPrintHours == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'strEmployeeReportFooter')->Description;?>: </td>
			<td>
				<textarea rows='3' class='textbox' name='strEmployeeReportFooter'><?=$setting->strEmployeeReportFooter;?></textarea>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'blnWeeklyOvertime')->Description;?>: <span class="hint" onmouseover="return overlib('Required Field');" onmouseout="return nd();">&nbsp;</span></td>
			<td>
				<label><input type='radio' name='blnWeeklyOvertime' value='1' <?=($setting->blnWeeklyOvertime==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnWeeklyOvertime' value='0' <?=($setting->blnWeeklyOvertime==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnWeeklyOvertime' <?php if($setting->blnWeeklyOvertime == 'on' || $setting->blnWeeklyOvertime == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'blnDailyOvertime')->Description;?>: <span class="hint" onmouseover="return overlib('Required Field');" onmouseout="return nd();">&nbsp;</span></td>
			<td>
				<label><input type='radio' name='blnDailyOvertime' value='1' <?=($setting->blnDailyOvertime==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnDailyOvertime' value='0' <?=($setting->blnDailyOvertime==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnDailyOvertime' <?php if($setting->blnDailyOvertime == 'on' || $setting->blnDailyOvertime == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'dblWeeklyOTLimit')->Description;?>: </td>
			<td>
				double
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'dblDailyOTLimit')->Description;?>: </td>
			<td>
				double
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'dblHoursPerWeek')->Description;?>: </td>
			<td>
				double
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'bytOTCalculation')->Description;?>: </td>
			<td>
				short
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'bytTimeRounding')->Description;?>: </td>
			<td>
				short
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'blnAutomaticBreakDeduction')->Description;?>: <span class="hint" onmouseover="return overlib('Required Field');" onmouseout="return nd();">&nbsp;</span></td>
			<td>
				<label><input type='radio' name='blnAutomaticBreakDeduction' value='1' <?=($setting->blnAutomaticBreakDeduction==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnAutomaticBreakDeduction' value='0' <?=($setting->blnAutomaticBreakDeduction==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnAutomaticBreakDeduction' <?php if($setting->blnAutomaticBreakDeduction == 'on' || $setting->blnAutomaticBreakDeduction == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'dblAutomaticBreakLength')->Description;?>: </td>
			<td>
				double
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'dblApplyAutomaticBreakAfter')->Description;?>: </td>
			<td>
				<textarea rows='3' class='textbox' name='dblApplyAutomaticBreakAfter'><?=$setting->dblApplyAutomaticBreakAfter;?></textarea>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'blnHolidaysEffectOvertime')->Description;?>: </td>
			<td>
				double
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'strDatabaseLocation')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='strDatabaseLocation' value='<?=$setting->strDatabaseLocation;?>' maxlength='255'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'strInLabel')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='strInLabel' value='<?=$setting->strInLabel;?>' maxlength='10'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'strOutLabel')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='strOutLabel' value='<?=$setting->strOutLabel;?>' maxlength='10'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'strMyHoursLabel')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='strMyHoursLabel' value='<?=$setting->strMyHoursLabel;?>' maxlength='20'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'strLastActionLabel')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='strLastActionLabel' value='<?=$setting->strLastActionLabel;?>' maxlength='10'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'strSSNLabel')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='strSSNLabel' value='<?=$setting->strSSNLabel;?>' maxlength='20'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'lngLastEmployeeID')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='lngLastEmployeeID' value='<?=$setting->lngLastEmployeeID;?>'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'lngStartingEmployeeID')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='lngStartingEmployeeID' value='<?=$setting->lngStartingEmployeeID;?>'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'lngEmployeeIDIncrement')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='lngEmployeeIDIncrement' value='<?=$setting->lngEmployeeIDIncrement;?>'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'bytFirstDayOfWeek')->Description;?>: </td>
			<td>
				short
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'lngFiscalYearMonth')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='lngFiscalYearMonth' value='<?=$setting->lngFiscalYearMonth;?>'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'lngFiscalYearDay')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='lngFiscalYearDay' value='<?=$setting->lngFiscalYearDay;?>'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'blnRoundDown')->Description;?>: <span class="hint" onmouseover="return overlib('Required Field');" onmouseout="return nd();">&nbsp;</span></td>
			<td>
				<label><input type='radio' name='blnRoundDown' value='1' <?=($setting->blnRoundDown==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnRoundDown' value='0' <?=($setting->blnRoundDown==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnRoundDown' <?php if($setting->blnRoundDown == 'on' || $setting->blnRoundDown == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'blnNoClockSet')->Description;?>: <span class="hint" onmouseover="return overlib('Required Field');" onmouseout="return nd();">&nbsp;</span></td>
			<td>
				<label><input type='radio' name='blnNoClockSet' value='1' <?=($setting->blnNoClockSet==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnNoClockSet' value='0' <?=($setting->blnNoClockSet==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnNoClockSet' <?php if($setting->blnNoClockSet == 'on' || $setting->blnNoClockSet == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'bytRequireAdminPassword')->Description;?>: </td>
			<td>
				short
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'blnNoDesktop')->Description;?>: <span class="hint" onmouseover="return overlib('Required Field');" onmouseout="return nd();">&nbsp;</span></td>
			<td>
				<label><input type='radio' name='blnNoDesktop' value='1' <?=($setting->blnNoDesktop==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnNoDesktop' value='0' <?=($setting->blnNoDesktop==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnNoDesktop' <?php if($setting->blnNoDesktop == 'on' || $setting->blnNoDesktop == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'strLicenseName')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='strLicenseName' value='<?=$setting->strLicenseName;?>' maxlength='255'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'strKey')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='strKey' value='<?=$setting->strKey;?>' maxlength='255'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'lngDatabaseSize')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='lngDatabaseSize' value='<?=$setting->lngDatabaseSize;?>'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'lngConnections')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='lngConnections' value='<?=$setting->lngConnections;?>'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'blnPaidBreak')->Description;?>: <span class="hint" onmouseover="return overlib('Required Field');" onmouseout="return nd();">&nbsp;</span></td>
			<td>
				<label><input type='radio' name='blnPaidBreak' value='1' <?=($setting->blnPaidBreak==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnPaidBreak' value='0' <?=($setting->blnPaidBreak==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnPaidBreak' <?php if($setting->blnPaidBreak == 'on' || $setting->blnPaidBreak == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'sngPaidBreakLength')->Description;?>: </td>
			<td>
				float
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'blnPayIfExceedBreak')->Description;?>: <span class="hint" onmouseover="return overlib('Required Field');" onmouseout="return nd();">&nbsp;</span></td>
			<td>
				<label><input type='radio' name='blnPayIfExceedBreak' value='1' <?=($setting->blnPayIfExceedBreak==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnPayIfExceedBreak' value='0' <?=($setting->blnPayIfExceedBreak==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnPayIfExceedBreak' <?php if($setting->blnPayIfExceedBreak == 'on' || $setting->blnPayIfExceedBreak == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'blnAlwaysOnTop')->Description;?>: <span class="hint" onmouseover="return overlib('Required Field');" onmouseout="return nd();">&nbsp;</span></td>
			<td>
				<label><input type='radio' name='blnAlwaysOnTop' value='1' <?=($setting->blnAlwaysOnTop==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnAlwaysOnTop' value='0' <?=($setting->blnAlwaysOnTop==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnAlwaysOnTop' <?php if($setting->blnAlwaysOnTop == 'on' || $setting->blnAlwaysOnTop == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'blnPasswordCharPIN')->Description;?>: <span class="hint" onmouseover="return overlib('Required Field');" onmouseout="return nd();">&nbsp;</span></td>
			<td>
				<label><input type='radio' name='blnPasswordCharPIN' value='1' <?=($setting->blnPasswordCharPIN==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnPasswordCharPIN' value='0' <?=($setting->blnPasswordCharPIN==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnPasswordCharPIN' <?php if($setting->blnPasswordCharPIN == 'on' || $setting->blnPasswordCharPIN == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'blnShutdownWindowsOnClose')->Description;?>: <span class="hint" onmouseover="return overlib('Required Field');" onmouseout="return nd();">&nbsp;</span></td>
			<td>
				<label><input type='radio' name='blnShutdownWindowsOnClose' value='1' <?=($setting->blnShutdownWindowsOnClose==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnShutdownWindowsOnClose' value='0' <?=($setting->blnShutdownWindowsOnClose==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnShutdownWindowsOnClose' <?php if($setting->blnShutdownWindowsOnClose == 'on' || $setting->blnShutdownWindowsOnClose == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'blnExclusiveFocus')->Description;?>: <span class="hint" onmouseover="return overlib('Required Field');" onmouseout="return nd();">&nbsp;</span></td>
			<td>
				<label><input type='radio' name='blnExclusiveFocus' value='1' <?=($setting->blnExclusiveFocus==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnExclusiveFocus' value='0' <?=($setting->blnExclusiveFocus==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnExclusiveFocus' <?php if($setting->blnExclusiveFocus == 'on' || $setting->blnExclusiveFocus == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'blnPINsEncrypted')->Description;?>: <span class="hint" onmouseover="return overlib('Required Field');" onmouseout="return nd();">&nbsp;</span></td>
			<td>
				<label><input type='radio' name='blnPINsEncrypted' value='1' <?=($setting->blnPINsEncrypted==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnPINsEncrypted' value='0' <?=($setting->blnPINsEncrypted==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnPINsEncrypted' <?php if($setting->blnPINsEncrypted == 'on' || $setting->blnPINsEncrypted == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'blnAccessDatabasePassword')->Description;?>: <span class="hint" onmouseover="return overlib('Required Field');" onmouseout="return nd();">&nbsp;</span></td>
			<td>
				<label><input type='radio' name='blnAccessDatabasePassword' value='1' <?=($setting->blnAccessDatabasePassword==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnAccessDatabasePassword' value='0' <?=($setting->blnAccessDatabasePassword==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnAccessDatabasePassword' <?php if($setting->blnAccessDatabasePassword == 'on' || $setting->blnAccessDatabasePassword == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'blnSickVacationTimeEffectOvertime')->Description;?>: <span class="hint" onmouseover="return overlib('Required Field');" onmouseout="return nd();">&nbsp;</span></td>
			<td>
				<label><input type='radio' name='blnSickVacationTimeEffectOvertime' value='1' <?=($setting->blnSickVacationTimeEffectOvertime==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnSickVacationTimeEffectOvertime' value='0' <?=($setting->blnSickVacationTimeEffectOvertime==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnSickVacationTimeEffectOvertime' <?php if($setting->blnSickVacationTimeEffectOvertime == 'on' || $setting->blnSickVacationTimeEffectOvertime == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'blnUseInternetTimeServer')->Description;?>: <span class="hint" onmouseover="return overlib('Required Field');" onmouseout="return nd();">&nbsp;</span></td>
			<td>
				<label><input type='radio' name='blnUseInternetTimeServer' value='1' <?=($setting->blnUseInternetTimeServer==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnUseInternetTimeServer' value='0' <?=($setting->blnUseInternetTimeServer==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnUseInternetTimeServer' <?php if($setting->blnUseInternetTimeServer == 'on' || $setting->blnUseInternetTimeServer == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'lngNTPServer')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='lngNTPServer' value='<?=$setting->lngNTPServer;?>'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'strCustomNTPServer')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='strCustomNTPServer' value='<?=$setting->strCustomNTPServer;?>' maxlength='255'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'lngTimeOutputFormat')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='lngTimeOutputFormat' value='<?=$setting->lngTimeOutputFormat;?>'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'blnCheckForUpdatesOnStartup')->Description;?>: <span class="hint" onmouseover="return overlib('Required Field');" onmouseout="return nd();">&nbsp;</span></td>
			<td>
				<label><input type='radio' name='blnCheckForUpdatesOnStartup' value='1' <?=($setting->blnCheckForUpdatesOnStartup==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnCheckForUpdatesOnStartup' value='0' <?=($setting->blnCheckForUpdatesOnStartup==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnCheckForUpdatesOnStartup' <?php if($setting->blnCheckForUpdatesOnStartup == 'on' || $setting->blnCheckForUpdatesOnStartup == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'strReportHeaderTemplate')->Description;?>: </td>
			<td>
				<textarea rows='3' class='textbox' name='strReportHeaderTemplate'><?=$setting->strReportHeaderTemplate;?></textarea>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'strCompanyHeaderTemplate')->Description;?>: </td>
			<td>
				<textarea rows='3' class='textbox' name='strCompanyHeaderTemplate'><?=$setting->strCompanyHeaderTemplate;?></textarea>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'strEmployeeDetailsTemplate')->Description;?>: </td>
			<td>
				<textarea rows='3' class='textbox' name='strEmployeeDetailsTemplate'><?=$setting->strEmployeeDetailsTemplate;?></textarea>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'strEmployeeHeaderTemplate')->Description;?>: </td>
			<td>
				<textarea rows='3' class='textbox' name='strEmployeeHeaderTemplate'><?=$setting->strEmployeeHeaderTemplate;?></textarea>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'strEmployeeSummaryTemplate')->Description;?>: </td>
			<td>
				<textarea rows='3' class='textbox' name='strEmployeeSummaryTemplate'><?=$setting->strEmployeeSummaryTemplate;?></textarea>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'strEmployeeAccrualsTemplate')->Description;?>: </td>
			<td>
				<textarea rows='3' class='textbox' name='strEmployeeAccrualsTemplate'><?=$setting->strEmployeeAccrualsTemplate;?></textarea>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'strPayrollInformationTemplate')->Description;?>: </td>
			<td>
				<textarea rows='3' class='textbox' name='strPayrollInformationTemplate'><?=$setting->strPayrollInformationTemplate;?></textarea>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'strCurrency')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='strCurrency' value='<?=$setting->strCurrency;?>' maxlength='10'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'bytCaptureImageOn')->Description;?>: </td>
			<td>
				short
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'bytKeepImagesFor')->Description;?>: </td>
			<td>
				short
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'blnEnableImageCapture')->Description;?>: <span class="hint" onmouseover="return overlib('Required Field');" onmouseout="return nd();">&nbsp;</span></td>
			<td>
				<label><input type='radio' name='blnEnableImageCapture' value='1' <?=($setting->blnEnableImageCapture==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnEnableImageCapture' value='0' <?=($setting->blnEnableImageCapture==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnEnableImageCapture' <?php if($setting->blnEnableImageCapture == 'on' || $setting->blnEnableImageCapture == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'strCapturePath')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='strCapturePath' value='<?=$setting->strCapturePath;?>' maxlength='255'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'lngFirstDayStartsAt')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='lngFirstDayStartsAt' value='<?=$setting->lngFirstDayStartsAt;?>'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'strPayDayAsOvertime')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='strPayDayAsOvertime' value='<?=$setting->strPayDayAsOvertime;?>' maxlength='7'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'strClockInLabel')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='strClockInLabel' value='<?=$setting->strClockInLabel;?>' maxlength='30'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'strClockOutLabel')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='strClockOutLabel' value='<?=$setting->strClockOutLabel;?>' maxlength='30'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'strActionTypeLabel')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='strActionTypeLabel' value='<?=$setting->strActionTypeLabel;?>' maxlength='30'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'strActionDateLabel')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='strActionDateLabel' value='<?=$setting->strActionDateLabel;?>' maxlength='30'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'strActionTimeLabel')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='strActionTimeLabel' value='<?=$setting->strActionTimeLabel;?>' maxlength='30'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'strEmployeesInLabel')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='strEmployeesInLabel' value='<?=$setting->strEmployeesInLabel;?>' maxlength='30'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'strEmployeesOutLabel')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='strEmployeesOutLabel' value='<?=$setting->strEmployeesOutLabel;?>' maxlength='30'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'strEmployeesLabel')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='strEmployeesLabel' value='<?=$setting->strEmployeesLabel;?>' maxlength='30'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'strTimeNoteLabel')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='strTimeNoteLabel' value='<?=$setting->strTimeNoteLabel;?>' maxlength='30'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'strViewInformationLabel')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='strViewInformationLabel' value='<?=$setting->strViewInformationLabel;?>' maxlength='30'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'strSearchForEmployeeLabel')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='strSearchForEmployeeLabel' value='<?=$setting->strSearchForEmployeeLabel;?>' maxlength='30'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'strNoActionLabel')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='strNoActionLabel' value='<?=$setting->strNoActionLabel;?>' maxlength='30'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'strMothersMaidenName')->Description;?>: </td>
			<td>
				<textarea rows='3' class='textbox' name='strMothersMaidenName'><?=$setting->strMothersMaidenName;?></textarea>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'strCityYouWereBornIn')->Description;?>: </td>
			<td>
				<textarea rows='3' class='textbox' name='strCityYouWereBornIn'><?=$setting->strCityYouWereBornIn;?></textarea>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'blnDailyOvertime2')->Description;?>: <span class="hint" onmouseover="return overlib('Required Field');" onmouseout="return nd();">&nbsp;</span></td>
			<td>
				<label><input type='radio' name='blnDailyOvertime2' value='1' <?=($setting->blnDailyOvertime2==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnDailyOvertime2' value='0' <?=($setting->blnDailyOvertime2==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnDailyOvertime2' <?php if($setting->blnDailyOvertime2 == 'on' || $setting->blnDailyOvertime2 == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'blnSeventhDayOvertime')->Description;?>: <span class="hint" onmouseover="return overlib('Required Field');" onmouseout="return nd();">&nbsp;</span></td>
			<td>
				<label><input type='radio' name='blnSeventhDayOvertime' value='1' <?=($setting->blnSeventhDayOvertime==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnSeventhDayOvertime' value='0' <?=($setting->blnSeventhDayOvertime==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnSeventhDayOvertime' <?php if($setting->blnSeventhDayOvertime == 'on' || $setting->blnSeventhDayOvertime == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'dblDailyOTLimit2')->Description;?>: </td>
			<td>
				float
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'dblSeventhDayOTLimit')->Description;?>: </td>
			<td>
				float
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'blnUseFingerprintScanner')->Description;?>: <span class="hint" onmouseover="return overlib('Required Field');" onmouseout="return nd();">&nbsp;</span></td>
			<td>
				<label><input type='radio' name='blnUseFingerprintScanner' value='1' <?=($setting->blnUseFingerprintScanner==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnUseFingerprintScanner' value='0' <?=($setting->blnUseFingerprintScanner==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnUseFingerprintScanner' <?php if($setting->blnUseFingerprintScanner == 'on' || $setting->blnUseFingerprintScanner == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'strEncryptedAdminPassword')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='strEncryptedAdminPassword' value='<?=$setting->strEncryptedAdminPassword;?>' maxlength='255'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'blnReportEmployeePageBreak')->Description;?>: <span class="hint" onmouseover="return overlib('Required Field');" onmouseout="return nd();">&nbsp;</span></td>
			<td>
				<label><input type='radio' name='blnReportEmployeePageBreak' value='1' <?=($setting->blnReportEmployeePageBreak==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnReportEmployeePageBreak' value='0' <?=($setting->blnReportEmployeePageBreak==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnReportEmployeePageBreak' <?php if($setting->blnReportEmployeePageBreak == 'on' || $setting->blnReportEmployeePageBreak == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'blnEnableTimeDataLogging')->Description;?>: <span class="hint" onmouseover="return overlib('Required Field');" onmouseout="return nd();">&nbsp;</span></td>
			<td>
				<label><input type='radio' name='blnEnableTimeDataLogging' value='1' <?=($setting->blnEnableTimeDataLogging==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnEnableTimeDataLogging' value='0' <?=($setting->blnEnableTimeDataLogging==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnEnableTimeDataLogging' <?php if($setting->blnEnableTimeDataLogging == 'on' || $setting->blnEnableTimeDataLogging == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'blnShowDepartmentFolders')->Description;?>: <span class="hint" onmouseover="return overlib('Required Field');" onmouseout="return nd();">&nbsp;</span></td>
			<td>
				<label><input type='radio' name='blnShowDepartmentFolders' value='1' <?=($setting->blnShowDepartmentFolders==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnShowDepartmentFolders' value='0' <?=($setting->blnShowDepartmentFolders==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnShowDepartmentFolders' <?php if($setting->blnShowDepartmentFolders == 'on' || $setting->blnShowDepartmentFolders == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'blnEmployeeJobCreation')->Description;?>: <span class="hint" onmouseover="return overlib('Required Field');" onmouseout="return nd();">&nbsp;</span></td>
			<td>
				<label><input type='radio' name='blnEmployeeJobCreation' value='1' <?=($setting->blnEmployeeJobCreation==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnEmployeeJobCreation' value='0' <?=($setting->blnEmployeeJobCreation==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnEmployeeJobCreation' <?php if($setting->blnEmployeeJobCreation == 'on' || $setting->blnEmployeeJobCreation == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'bytEmployeeListFontSize')->Description;?>: </td>
			<td>
				short
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'blnPasswordProtectEmployeeSpreadsheet')->Description;?>: <span class="hint" onmouseover="return overlib('Required Field');" onmouseout="return nd();">&nbsp;</span></td>
			<td>
				<label><input type='radio' name='blnPasswordProtectEmployeeSpreadsheet' value='1' <?=($setting->blnPasswordProtectEmployeeSpreadsheet==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnPasswordProtectEmployeeSpreadsheet' value='0' <?=($setting->blnPasswordProtectEmployeeSpreadsheet==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnPasswordProtectEmployeeSpreadsheet' <?php if($setting->blnPasswordProtectEmployeeSpreadsheet == 'on' || $setting->blnPasswordProtectEmployeeSpreadsheet == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'blnAutoLogout')->Description;?>: <span class="hint" onmouseover="return overlib('Required Field');" onmouseout="return nd();">&nbsp;</span></td>
			<td>
				<label><input type='radio' name='blnAutoLogout' value='1' <?=($setting->blnAutoLogout==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnAutoLogout' value='0' <?=($setting->blnAutoLogout==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnAutoLogout' <?php if($setting->blnAutoLogout == 'on' || $setting->blnAutoLogout == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'blnTipTracking')->Description;?>: <span class="hint" onmouseover="return overlib('Required Field');" onmouseout="return nd();">&nbsp;</span></td>
			<td>
				<label><input type='radio' name='blnTipTracking' value='1' <?=($setting->blnTipTracking==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnTipTracking' value='0' <?=($setting->blnTipTracking==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnTipTracking' <?php if($setting->blnTipTracking == 'on' || $setting->blnTipTracking == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($setting,'strJobLabel')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='strJobLabel' value='<?=$setting->strJobLabel;?>' maxlength='30'/>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>
				<input type="submit" style="width: 65px;" class="button btn-save" value="Save" id="save_btn" />
				<input type="button" style="width: 80px;" class="button btn-cancel" value="Cancel" onclick="window.location.replace('?view=tblSettings');" />
			</td>
		</tr>
		</table>
	</td>
	<?php /*if (@$setting->exists) { ?>
	<td class="grid-space">
		<div class="column_label">Related-view (<a class="fancybox" href="popup_index.php?view=related-view&id=<?=$setting->lngID;?>&source=<?=urlencode($status->destination);?>">Manage</a>)</div>
		<ul class="dot">
			<?php
			foreach ($items = RelatedClass::getRelatedObjects(array('lngID'=>$setting->lngID)) as $r)
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
