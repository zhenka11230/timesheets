<?php
require_once("includes/view_included.php");
//require_once("includes/PagedResult.php");
//require_once("includes/Setting.php");

$status->destination = "tblSettings";

$fields = array();
$fields['strCompanyName'] = $db->escapeSimple(trim(@$_REQUEST['strCompanyName']));
$fields['strCompanyAddress'] = $db->escapeSimple(trim(@$_REQUEST['strCompanyAddress']));
$fields['strReportFooter'] = $db->escapeSimple(trim(@$_REQUEST['strReportFooter']));
$fields['blnIncludeSignature'] = $db->escapeSimple(trim(@$_REQUEST['blnIncludeSignature']));
$fields['blnDataEntryMode'] = $db->escapeSimple(trim(@$_REQUEST['blnDataEntryMode']));
$fields['blnRequirePIN'] = $db->escapeSimple(trim(@$_REQUEST['blnRequirePIN']));
$fields['blnRequireComment'] = $db->escapeSimple(trim(@$_REQUEST['blnRequireComment']));
$fields['bytCommentRequirements'] = $db->escapeSimple(trim(@$_REQUEST['bytCommentRequirements']));
$fields['blnAllowBlankComments'] = $db->escapeSimple(trim(@$_REQUEST['blnAllowBlankComments']));
$fields['blnTimeFormat'] = $db->escapeSimple(trim(@$_REQUEST['blnTimeFormat']));
$fields['strAdministratorPassword'] = $db->escapeSimple(trim(@$_REQUEST['strAdministratorPassword']));
$fields['blnEmployeesViewHours'] = $db->escapeSimple(trim(@$_REQUEST['blnEmployeesViewHours']));
$fields['blnEmployeesPrintHours'] = $db->escapeSimple(trim(@$_REQUEST['blnEmployeesPrintHours']));
$fields['strEmployeeReportFooter'] = $db->escapeSimple(trim(@$_REQUEST['strEmployeeReportFooter']));
$fields['blnWeeklyOvertime'] = $db->escapeSimple(trim(@$_REQUEST['blnWeeklyOvertime']));
$fields['blnDailyOvertime'] = $db->escapeSimple(trim(@$_REQUEST['blnDailyOvertime']));
$fields['dblWeeklyOTLimit'] = $db->escapeSimple(trim(@$_REQUEST['dblWeeklyOTLimit']));
$fields['dblDailyOTLimit'] = $db->escapeSimple(trim(@$_REQUEST['dblDailyOTLimit']));
$fields['dblHoursPerWeek'] = $db->escapeSimple(trim(@$_REQUEST['dblHoursPerWeek']));
$fields['bytOTCalculation'] = $db->escapeSimple(trim(@$_REQUEST['bytOTCalculation']));
$fields['bytTimeRounding'] = $db->escapeSimple(trim(@$_REQUEST['bytTimeRounding']));
$fields['blnAutomaticBreakDeduction'] = $db->escapeSimple(trim(@$_REQUEST['blnAutomaticBreakDeduction']));
$fields['dblAutomaticBreakLength'] = $db->escapeSimple(trim(@$_REQUEST['dblAutomaticBreakLength']));
$fields['dblApplyAutomaticBreakAfter'] = $db->escapeSimple(trim(@$_REQUEST['dblApplyAutomaticBreakAfter']));
$fields['blnHolidaysEffectOvertime'] = $db->escapeSimple(trim(@$_REQUEST['blnHolidaysEffectOvertime']));
$fields['strDatabaseLocation'] = $db->escapeSimple(trim(@$_REQUEST['strDatabaseLocation']));
$fields['strInLabel'] = $db->escapeSimple(trim(@$_REQUEST['strInLabel']));
$fields['strOutLabel'] = $db->escapeSimple(trim(@$_REQUEST['strOutLabel']));
$fields['strMyHoursLabel'] = $db->escapeSimple(trim(@$_REQUEST['strMyHoursLabel']));
$fields['strLastActionLabel'] = $db->escapeSimple(trim(@$_REQUEST['strLastActionLabel']));
$fields['strSSNLabel'] = $db->escapeSimple(trim(@$_REQUEST['strSSNLabel']));
$fields['lngLastEmployeeID'] = $db->escapeSimple(trim(@$_REQUEST['lngLastEmployeeID']));
$fields['lngStartingEmployeeID'] = $db->escapeSimple(trim(@$_REQUEST['lngStartingEmployeeID']));
$fields['lngEmployeeIDIncrement'] = $db->escapeSimple(trim(@$_REQUEST['lngEmployeeIDIncrement']));
$fields['bytFirstDayOfWeek'] = $db->escapeSimple(trim(@$_REQUEST['bytFirstDayOfWeek']));
$fields['lngFiscalYearMonth'] = $db->escapeSimple(trim(@$_REQUEST['lngFiscalYearMonth']));
$fields['lngFiscalYearDay'] = $db->escapeSimple(trim(@$_REQUEST['lngFiscalYearDay']));
$fields['blnRoundDown'] = $db->escapeSimple(trim(@$_REQUEST['blnRoundDown']));
$fields['blnNoClockSet'] = $db->escapeSimple(trim(@$_REQUEST['blnNoClockSet']));
$fields['bytRequireAdminPassword'] = $db->escapeSimple(trim(@$_REQUEST['bytRequireAdminPassword']));
$fields['blnNoDesktop'] = $db->escapeSimple(trim(@$_REQUEST['blnNoDesktop']));
$fields['strLicenseName'] = $db->escapeSimple(trim(@$_REQUEST['strLicenseName']));
$fields['strKey'] = $db->escapeSimple(trim(@$_REQUEST['strKey']));
$fields['lngDatabaseSize'] = $db->escapeSimple(trim(@$_REQUEST['lngDatabaseSize']));
$fields['lngConnections'] = $db->escapeSimple(trim(@$_REQUEST['lngConnections']));
$fields['blnPaidBreak'] = $db->escapeSimple(trim(@$_REQUEST['blnPaidBreak']));
$fields['sngPaidBreakLength'] = $db->escapeSimple(trim(@$_REQUEST['sngPaidBreakLength']));
$fields['blnPayIfExceedBreak'] = $db->escapeSimple(trim(@$_REQUEST['blnPayIfExceedBreak']));
$fields['blnAlwaysOnTop'] = $db->escapeSimple(trim(@$_REQUEST['blnAlwaysOnTop']));
$fields['blnPasswordCharPIN'] = $db->escapeSimple(trim(@$_REQUEST['blnPasswordCharPIN']));
$fields['blnShutdownWindowsOnClose'] = $db->escapeSimple(trim(@$_REQUEST['blnShutdownWindowsOnClose']));
$fields['blnExclusiveFocus'] = $db->escapeSimple(trim(@$_REQUEST['blnExclusiveFocus']));
$fields['blnPINsEncrypted'] = $db->escapeSimple(trim(@$_REQUEST['blnPINsEncrypted']));
$fields['blnAccessDatabasePassword'] = $db->escapeSimple(trim(@$_REQUEST['blnAccessDatabasePassword']));
$fields['blnSickVacationTimeEffectOvertime'] = $db->escapeSimple(trim(@$_REQUEST['blnSickVacationTimeEffectOvertime']));
$fields['blnUseInternetTimeServer'] = $db->escapeSimple(trim(@$_REQUEST['blnUseInternetTimeServer']));
$fields['lngNTPServer'] = $db->escapeSimple(trim(@$_REQUEST['lngNTPServer']));
$fields['strCustomNTPServer'] = $db->escapeSimple(trim(@$_REQUEST['strCustomNTPServer']));
$fields['lngTimeOutputFormat'] = $db->escapeSimple(trim(@$_REQUEST['lngTimeOutputFormat']));
$fields['blnCheckForUpdatesOnStartup'] = $db->escapeSimple(trim(@$_REQUEST['blnCheckForUpdatesOnStartup']));
$fields['strReportHeaderTemplate'] = $db->escapeSimple(trim(@$_REQUEST['strReportHeaderTemplate']));
$fields['strCompanyHeaderTemplate'] = $db->escapeSimple(trim(@$_REQUEST['strCompanyHeaderTemplate']));
$fields['strEmployeeDetailsTemplate'] = $db->escapeSimple(trim(@$_REQUEST['strEmployeeDetailsTemplate']));
$fields['strEmployeeHeaderTemplate'] = $db->escapeSimple(trim(@$_REQUEST['strEmployeeHeaderTemplate']));
$fields['strEmployeeSummaryTemplate'] = $db->escapeSimple(trim(@$_REQUEST['strEmployeeSummaryTemplate']));
$fields['strEmployeeAccrualsTemplate'] = $db->escapeSimple(trim(@$_REQUEST['strEmployeeAccrualsTemplate']));
$fields['strPayrollInformationTemplate'] = $db->escapeSimple(trim(@$_REQUEST['strPayrollInformationTemplate']));
$fields['strCurrency'] = $db->escapeSimple(trim(@$_REQUEST['strCurrency']));
$fields['bytCaptureImageOn'] = $db->escapeSimple(trim(@$_REQUEST['bytCaptureImageOn']));
$fields['bytKeepImagesFor'] = $db->escapeSimple(trim(@$_REQUEST['bytKeepImagesFor']));
$fields['blnEnableImageCapture'] = $db->escapeSimple(trim(@$_REQUEST['blnEnableImageCapture']));
$fields['strCapturePath'] = $db->escapeSimple(trim(@$_REQUEST['strCapturePath']));
$fields['lngFirstDayStartsAt'] = $db->escapeSimple(trim(@$_REQUEST['lngFirstDayStartsAt']));
$fields['strPayDayAsOvertime'] = $db->escapeSimple(trim(@$_REQUEST['strPayDayAsOvertime']));
$fields['strClockInLabel'] = $db->escapeSimple(trim(@$_REQUEST['strClockInLabel']));
$fields['strClockOutLabel'] = $db->escapeSimple(trim(@$_REQUEST['strClockOutLabel']));
$fields['strActionTypeLabel'] = $db->escapeSimple(trim(@$_REQUEST['strActionTypeLabel']));
$fields['strActionDateLabel'] = $db->escapeSimple(trim(@$_REQUEST['strActionDateLabel']));
$fields['strActionTimeLabel'] = $db->escapeSimple(trim(@$_REQUEST['strActionTimeLabel']));
$fields['strEmployeesInLabel'] = $db->escapeSimple(trim(@$_REQUEST['strEmployeesInLabel']));
$fields['strEmployeesOutLabel'] = $db->escapeSimple(trim(@$_REQUEST['strEmployeesOutLabel']));
$fields['strEmployeesLabel'] = $db->escapeSimple(trim(@$_REQUEST['strEmployeesLabel']));
$fields['strTimeNoteLabel'] = $db->escapeSimple(trim(@$_REQUEST['strTimeNoteLabel']));
$fields['strViewInformationLabel'] = $db->escapeSimple(trim(@$_REQUEST['strViewInformationLabel']));
$fields['strSearchForEmployeeLabel'] = $db->escapeSimple(trim(@$_REQUEST['strSearchForEmployeeLabel']));
$fields['strNoActionLabel'] = $db->escapeSimple(trim(@$_REQUEST['strNoActionLabel']));
$fields['strMothersMaidenName'] = $db->escapeSimple(trim(@$_REQUEST['strMothersMaidenName']));
$fields['strCityYouWereBornIn'] = $db->escapeSimple(trim(@$_REQUEST['strCityYouWereBornIn']));
$fields['blnDailyOvertime2'] = $db->escapeSimple(trim(@$_REQUEST['blnDailyOvertime2']));
$fields['blnSeventhDayOvertime'] = $db->escapeSimple(trim(@$_REQUEST['blnSeventhDayOvertime']));
$fields['dblDailyOTLimit2'] = $db->escapeSimple(trim(@$_REQUEST['dblDailyOTLimit2']));
$fields['dblSeventhDayOTLimit'] = $db->escapeSimple(trim(@$_REQUEST['dblSeventhDayOTLimit']));
$fields['blnUseFingerprintScanner'] = $db->escapeSimple(trim(@$_REQUEST['blnUseFingerprintScanner']));
$fields['strEncryptedAdminPassword'] = $db->escapeSimple(trim(@$_REQUEST['strEncryptedAdminPassword']));
$fields['blnReportEmployeePageBreak'] = $db->escapeSimple(trim(@$_REQUEST['blnReportEmployeePageBreak']));
$fields['blnEnableTimeDataLogging'] = $db->escapeSimple(trim(@$_REQUEST['blnEnableTimeDataLogging']));
$fields['blnShowDepartmentFolders'] = $db->escapeSimple(trim(@$_REQUEST['blnShowDepartmentFolders']));
$fields['blnEmployeeJobCreation'] = $db->escapeSimple(trim(@$_REQUEST['blnEmployeeJobCreation']));
$fields['bytEmployeeListFontSize'] = $db->escapeSimple(trim(@$_REQUEST['bytEmployeeListFontSize']));
$fields['blnPasswordProtectEmployeeSpreadsheet'] = $db->escapeSimple(trim(@$_REQUEST['blnPasswordProtectEmployeeSpreadsheet']));
$fields['blnAutoLogout'] = $db->escapeSimple(trim(@$_REQUEST['blnAutoLogout']));
$fields['blnTipTracking'] = $db->escapeSimple(trim(@$_REQUEST['blnTipTracking']));
$fields['strJobLabel'] = $db->escapeSimple(trim(@$_REQUEST['strJobLabel']));

// pager fields
$fields['sort_by'] = (isset($_REQUEST['sort_by']) ? $db->escapeSimple(trim($_REQUEST['sort_by'])) : "strCompanyName_a");
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

$pager->OrderBy($fields['sort_by']);

$pager->conditions[] = array(
	'AND' => array(
		'strCompanyName' => array($fields['strCompanyName'],'like'),
		'strCompanyAddress' => array($fields['strCompanyAddress'],'like'),
		'strReportFooter' => array($fields['strReportFooter'],'like'),
		'blnIncludeSignature' => array($fields['blnIncludeSignature'],'bool'),
		'blnDataEntryMode' => array($fields['blnDataEntryMode'],'bool'),
		'blnRequirePIN' => array($fields['blnRequirePIN'],'bool'),
		'blnRequireComment' => array($fields['blnRequireComment'],'bool'),
		'bytCommentRequirements' => array($fields['bytCommentRequirements'],'eq'),
		'blnAllowBlankComments' => array($fields['blnAllowBlankComments'],'bool'),
		'blnTimeFormat' => array($fields['blnTimeFormat'],'bool'),
		'strAdministratorPassword' => array($fields['strAdministratorPassword'],'like'),
		'blnEmployeesViewHours' => array($fields['blnEmployeesViewHours'],'bool'),
		'blnEmployeesPrintHours' => array($fields['blnEmployeesPrintHours'],'bool'),
		'strEmployeeReportFooter' => array($fields['strEmployeeReportFooter'],'like'),
		'blnWeeklyOvertime' => array($fields['blnWeeklyOvertime'],'bool'),
		'blnDailyOvertime' => array($fields['blnDailyOvertime'],'bool'),
		'dblWeeklyOTLimit' => array($fields['dblWeeklyOTLimit'],'eq'),
		'dblDailyOTLimit' => array($fields['dblDailyOTLimit'],'eq'),
		'dblHoursPerWeek' => array($fields['dblHoursPerWeek'],'eq'),
		'bytOTCalculation' => array($fields['bytOTCalculation'],'eq'),
		'bytTimeRounding' => array($fields['bytTimeRounding'],'eq'),
		'blnAutomaticBreakDeduction' => array($fields['blnAutomaticBreakDeduction'],'bool'),
		'dblAutomaticBreakLength' => array($fields['dblAutomaticBreakLength'],'eq'),
		'dblApplyAutomaticBreakAfter' => array($fields['dblApplyAutomaticBreakAfter'],'like'),
		'blnHolidaysEffectOvertime' => array($fields['blnHolidaysEffectOvertime'],'eq'),
		'strDatabaseLocation' => array($fields['strDatabaseLocation'],'like'),
		'strInLabel' => array($fields['strInLabel'],'like'),
		'strOutLabel' => array($fields['strOutLabel'],'like'),
		'strMyHoursLabel' => array($fields['strMyHoursLabel'],'like'),
		'strLastActionLabel' => array($fields['strLastActionLabel'],'like'),
		'strSSNLabel' => array($fields['strSSNLabel'],'like'),
		'lngLastEmployeeID' => array($fields['lngLastEmployeeID'],'like'),
		'lngStartingEmployeeID' => array($fields['lngStartingEmployeeID'],'like'),
		'lngEmployeeIDIncrement' => array($fields['lngEmployeeIDIncrement'],'like'),
		'bytFirstDayOfWeek' => array($fields['bytFirstDayOfWeek'],'eq'),
		'lngFiscalYearMonth' => array($fields['lngFiscalYearMonth'],'like'),
		'lngFiscalYearDay' => array($fields['lngFiscalYearDay'],'like'),
		'blnRoundDown' => array($fields['blnRoundDown'],'bool'),
		'blnNoClockSet' => array($fields['blnNoClockSet'],'bool'),
		'bytRequireAdminPassword' => array($fields['bytRequireAdminPassword'],'eq'),
		'blnNoDesktop' => array($fields['blnNoDesktop'],'bool'),
		'strLicenseName' => array($fields['strLicenseName'],'like'),
		'strKey' => array($fields['strKey'],'like'),
		'lngDatabaseSize' => array($fields['lngDatabaseSize'],'like'),
		'lngConnections' => array($fields['lngConnections'],'like'),
		'blnPaidBreak' => array($fields['blnPaidBreak'],'bool'),
		'sngPaidBreakLength' => array($fields['sngPaidBreakLength'],'eq'),
		'blnPayIfExceedBreak' => array($fields['blnPayIfExceedBreak'],'bool'),
		'blnAlwaysOnTop' => array($fields['blnAlwaysOnTop'],'bool'),
		'blnPasswordCharPIN' => array($fields['blnPasswordCharPIN'],'bool'),
		'blnShutdownWindowsOnClose' => array($fields['blnShutdownWindowsOnClose'],'bool'),
		'blnExclusiveFocus' => array($fields['blnExclusiveFocus'],'bool'),
		'blnPINsEncrypted' => array($fields['blnPINsEncrypted'],'bool'),
		'blnAccessDatabasePassword' => array($fields['blnAccessDatabasePassword'],'bool'),
		'blnSickVacationTimeEffectOvertime' => array($fields['blnSickVacationTimeEffectOvertime'],'bool'),
		'blnUseInternetTimeServer' => array($fields['blnUseInternetTimeServer'],'bool'),
		'lngNTPServer' => array($fields['lngNTPServer'],'like'),
		'strCustomNTPServer' => array($fields['strCustomNTPServer'],'like'),
		'lngTimeOutputFormat' => array($fields['lngTimeOutputFormat'],'like'),
		'blnCheckForUpdatesOnStartup' => array($fields['blnCheckForUpdatesOnStartup'],'bool'),
		'strReportHeaderTemplate' => array($fields['strReportHeaderTemplate'],'like'),
		'strCompanyHeaderTemplate' => array($fields['strCompanyHeaderTemplate'],'like'),
		'strEmployeeDetailsTemplate' => array($fields['strEmployeeDetailsTemplate'],'like'),
		'strEmployeeHeaderTemplate' => array($fields['strEmployeeHeaderTemplate'],'like'),
		'strEmployeeSummaryTemplate' => array($fields['strEmployeeSummaryTemplate'],'like'),
		'strEmployeeAccrualsTemplate' => array($fields['strEmployeeAccrualsTemplate'],'like'),
		'strPayrollInformationTemplate' => array($fields['strPayrollInformationTemplate'],'like'),
		'strCurrency' => array($fields['strCurrency'],'like'),
		'bytCaptureImageOn' => array($fields['bytCaptureImageOn'],'eq'),
		'bytKeepImagesFor' => array($fields['bytKeepImagesFor'],'eq'),
		'blnEnableImageCapture' => array($fields['blnEnableImageCapture'],'bool'),
		'strCapturePath' => array($fields['strCapturePath'],'like'),
		'lngFirstDayStartsAt' => array($fields['lngFirstDayStartsAt'],'like'),
		'strPayDayAsOvertime' => array($fields['strPayDayAsOvertime'],'like'),
		'strClockInLabel' => array($fields['strClockInLabel'],'like'),
		'strClockOutLabel' => array($fields['strClockOutLabel'],'like'),
		'strActionTypeLabel' => array($fields['strActionTypeLabel'],'like'),
		'strActionDateLabel' => array($fields['strActionDateLabel'],'like'),
		'strActionTimeLabel' => array($fields['strActionTimeLabel'],'like'),
		'strEmployeesInLabel' => array($fields['strEmployeesInLabel'],'like'),
		'strEmployeesOutLabel' => array($fields['strEmployeesOutLabel'],'like'),
		'strEmployeesLabel' => array($fields['strEmployeesLabel'],'like'),
		'strTimeNoteLabel' => array($fields['strTimeNoteLabel'],'like'),
		'strViewInformationLabel' => array($fields['strViewInformationLabel'],'like'),
		'strSearchForEmployeeLabel' => array($fields['strSearchForEmployeeLabel'],'like'),
		'strNoActionLabel' => array($fields['strNoActionLabel'],'like'),
		'strMothersMaidenName' => array($fields['strMothersMaidenName'],'like'),
		'strCityYouWereBornIn' => array($fields['strCityYouWereBornIn'],'like'),
		'blnDailyOvertime2' => array($fields['blnDailyOvertime2'],'bool'),
		'blnSeventhDayOvertime' => array($fields['blnSeventhDayOvertime'],'bool'),
		'dblDailyOTLimit2' => array($fields['dblDailyOTLimit2'],'eq'),
		'dblSeventhDayOTLimit' => array($fields['dblSeventhDayOTLimit'],'eq'),
		'blnUseFingerprintScanner' => array($fields['blnUseFingerprintScanner'],'bool'),
		'strEncryptedAdminPassword' => array($fields['strEncryptedAdminPassword'],'like'),
		'blnReportEmployeePageBreak' => array($fields['blnReportEmployeePageBreak'],'bool'),
		'blnEnableTimeDataLogging' => array($fields['blnEnableTimeDataLogging'],'bool'),
		'blnShowDepartmentFolders' => array($fields['blnShowDepartmentFolders'],'bool'),
		'blnEmployeeJobCreation' => array($fields['blnEmployeeJobCreation'],'bool'),
		'bytEmployeeListFontSize' => array($fields['bytEmployeeListFontSize'],'eq'),
		'blnPasswordProtectEmployeeSpreadsheet' => array($fields['blnPasswordProtectEmployeeSpreadsheet'],'bool'),
		'blnAutoLogout' => array($fields['blnAutoLogout'],'bool'),
		'blnTipTracking' => array($fields['blnTipTracking'],'bool'),
		'strJobLabel' => array($fields['strJobLabel'],'like'),
		)
	);
$pager->table = Setting::$tableName;
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
		if ($('input.tblSettings:checked').size() == 0)
		{
			alert('Please select at least one item to delete');
			return false;
		}
		
		if (confirm("Are you sure that you want to remove the selected items?")) 
		{
			var link='controller.php?action=delete_tblSetting';
			$('input.tblSettings:checked').each(function(){
				link += '&id[]='+$(this).val();
			});
			link += '&popup_destination=<?=@$popup_destination;?>';
			location.href=(link);
		}
	});
	$('#tblSettings_all').click(function(){
			$('.tblSettings').attr('checked', $('#tblSettings_all').attr('checked'));
		});
	$('.tblSettings').click(function(){
			if ($(this).attr('checked') == false && $('#tblSettings_all').attr('checked'))
				$('#tblSettings_all').removeAttr('checked');
		});
});
</script>

<div class="page_title">Manage TblSettings</div>

<form method="get" action="<?=$_SERVER['PHP_SELF'];?>">
	<input type="hidden" name="view" value="tblSettings"/>
	<input type="hidden" name="sort_by" value="<?=@$fields['sort_by']?>"/>
	
	<div id="search_options" style="display:<?= (array_empty($fields) ? "none":"block") ?>">
	<div class="text_tabs">
	<ul>
		<li class="left spacer">&nbsp;</li>
		<li><b><span>Search Options</span></b></li>
		<li class="right"><a href="javascript:void(0)" onclick="$('#search_options').fadeOut('fast');">Hide Search Options</a></li>
	</ul>
	</div>
	<div class="tabbed_section_body">
		
		<div style="search_field_wrapper" id="sf_strCompanyName">
			<div class="search_field_label">StrCompanyName:</div>
			<div class="search_field"><input type='text' class='textbox' name='strCompanyName' value='<?=$fields['strCompanyName'];?>' maxlength='255'/></div>
		</div>
		
		<div style="search_field_wrapper" id="sf_strCompanyAddress">
			<div class="search_field_label">StrCompanyAddress:</div>
			<div class="search_field"><input type='text' class='textbox' name='strCompanyAddress' value='<?=$fields['strCompanyAddress'];?>' maxlength='1073741823'/></div>
		</div>
		<div style="clear: both;"></div>
		<div style="search_field_wrapper" id="sf_strReportFooter">
			<div class="search_field_label">StrReportFooter:</div>
			<div class="search_field"><input type='text' class='textbox' name='strReportFooter' value='<?=$fields['strReportFooter'];?>' maxlength='1073741823'/></div>
		</div>
		
		<div style="search_field_wrapper" id="sf_blnIncludeSignature">
			<div class="search_field_label">BlnIncludeSignature:</div>
			<div class="search_field"><label><input type='radio' name='blnIncludeSignature' value='1' <?=($fields['blnIncludeSignature']==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnIncludeSignature' value='0' <?=($fields['blnIncludeSignature']==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnIncludeSignature' <?php if($fields['blnIncludeSignature'] == 'on' || $fields['blnIncludeSignature'] == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?></div>
		</div>
		<div style="clear: both;"></div>
		<div style="search_field_wrapper" id="sf_blnDataEntryMode">
			<div class="search_field_label">BlnDataEntryMode:</div>
			<div class="search_field"><label><input type='radio' name='blnDataEntryMode' value='1' <?=($fields['blnDataEntryMode']==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnDataEntryMode' value='0' <?=($fields['blnDataEntryMode']==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnDataEntryMode' <?php if($fields['blnDataEntryMode'] == 'on' || $fields['blnDataEntryMode'] == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?></div>
		</div>
		
		<div style="search_field_wrapper" id="sf_blnRequirePIN">
			<div class="search_field_label">BlnRequirePIN:</div>
			<div class="search_field"><label><input type='radio' name='blnRequirePIN' value='1' <?=($fields['blnRequirePIN']==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnRequirePIN' value='0' <?=($fields['blnRequirePIN']==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnRequirePIN' <?php if($fields['blnRequirePIN'] == 'on' || $fields['blnRequirePIN'] == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?></div>
		</div>
		<div style="clear: both;"></div>
		<div style="search_field_wrapper" id="sf_blnRequireComment">
			<div class="search_field_label">BlnRequireComment:</div>
			<div class="search_field"><label><input type='radio' name='blnRequireComment' value='1' <?=($fields['blnRequireComment']==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnRequireComment' value='0' <?=($fields['blnRequireComment']==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnRequireComment' <?php if($fields['blnRequireComment'] == 'on' || $fields['blnRequireComment'] == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?></div>
		</div>
		
		<div style="search_field_wrapper" id="sf_bytCommentRequirements">
			<div class="search_field_label">BytCommentRequirements:</div>
			<div class="search_field">short</div>
		</div>
		<div style="clear: both;"></div>
		<div style="search_field_wrapper" id="sf_blnAllowBlankComments">
			<div class="search_field_label">BlnAllowBlankComments:</div>
			<div class="search_field"><label><input type='radio' name='blnAllowBlankComments' value='1' <?=($fields['blnAllowBlankComments']==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnAllowBlankComments' value='0' <?=($fields['blnAllowBlankComments']==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnAllowBlankComments' <?php if($fields['blnAllowBlankComments'] == 'on' || $fields['blnAllowBlankComments'] == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?></div>
		</div>
		
		<div style="search_field_wrapper" id="sf_blnTimeFormat">
			<div class="search_field_label">BlnTimeFormat:</div>
			<div class="search_field"><label><input type='radio' name='blnTimeFormat' value='1' <?=($fields['blnTimeFormat']==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnTimeFormat' value='0' <?=($fields['blnTimeFormat']==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnTimeFormat' <?php if($fields['blnTimeFormat'] == 'on' || $fields['blnTimeFormat'] == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?></div>
		</div>
		<div style="clear: both;"></div>
		<div style="search_field_wrapper" id="sf_strAdministratorPassword">
			<div class="search_field_label">StrAdministratorPassword:</div>
			<div class="search_field"><input type='text' class='textbox' name='strAdministratorPassword' value='<?=$fields['strAdministratorPassword'];?>' maxlength='50'/></div>
		</div>
		
		<div style="search_field_wrapper" id="sf_blnEmployeesViewHours">
			<div class="search_field_label">BlnEmployeesViewHours:</div>
			<div class="search_field"><label><input type='radio' name='blnEmployeesViewHours' value='1' <?=($fields['blnEmployeesViewHours']==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnEmployeesViewHours' value='0' <?=($fields['blnEmployeesViewHours']==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnEmployeesViewHours' <?php if($fields['blnEmployeesViewHours'] == 'on' || $fields['blnEmployeesViewHours'] == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?></div>
		</div>
		<div style="clear: both;"></div>
		<div style="search_field_wrapper" id="sf_blnEmployeesPrintHours">
			<div class="search_field_label">BlnEmployeesPrintHours:</div>
			<div class="search_field"><label><input type='radio' name='blnEmployeesPrintHours' value='1' <?=($fields['blnEmployeesPrintHours']==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnEmployeesPrintHours' value='0' <?=($fields['blnEmployeesPrintHours']==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnEmployeesPrintHours' <?php if($fields['blnEmployeesPrintHours'] == 'on' || $fields['blnEmployeesPrintHours'] == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?></div>
		</div>
		
		<div style="search_field_wrapper" id="sf_strEmployeeReportFooter">
			<div class="search_field_label">StrEmployeeReportFooter:</div>
			<div class="search_field"><input type='text' class='textbox' name='strEmployeeReportFooter' value='<?=$fields['strEmployeeReportFooter'];?>' maxlength='1073741823'/></div>
		</div>
		<div style="clear: both;"></div>
		<div style="search_field_wrapper" id="sf_blnWeeklyOvertime">
			<div class="search_field_label">BlnWeeklyOvertime:</div>
			<div class="search_field"><label><input type='radio' name='blnWeeklyOvertime' value='1' <?=($fields['blnWeeklyOvertime']==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnWeeklyOvertime' value='0' <?=($fields['blnWeeklyOvertime']==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnWeeklyOvertime' <?php if($fields['blnWeeklyOvertime'] == 'on' || $fields['blnWeeklyOvertime'] == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?></div>
		</div>
		
		<div style="search_field_wrapper" id="sf_blnDailyOvertime">
			<div class="search_field_label">BlnDailyOvertime:</div>
			<div class="search_field"><label><input type='radio' name='blnDailyOvertime' value='1' <?=($fields['blnDailyOvertime']==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnDailyOvertime' value='0' <?=($fields['blnDailyOvertime']==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnDailyOvertime' <?php if($fields['blnDailyOvertime'] == 'on' || $fields['blnDailyOvertime'] == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?></div>
		</div>
		<div style="clear: both;"></div>
		<div style="search_field_wrapper" id="sf_dblWeeklyOTLimit">
			<div class="search_field_label">DblWeeklyOTLimit:</div>
			<div class="search_field">double</div>
		</div>
		
		<div style="search_field_wrapper" id="sf_dblDailyOTLimit">
			<div class="search_field_label">DblDailyOTLimit:</div>
			<div class="search_field">double</div>
		</div>
		<div style="clear: both;"></div>
		<div style="search_field_wrapper" id="sf_dblHoursPerWeek">
			<div class="search_field_label">DblHoursPerWeek:</div>
			<div class="search_field">double</div>
		</div>
		
		<div style="search_field_wrapper" id="sf_bytOTCalculation">
			<div class="search_field_label">BytOTCalculation:</div>
			<div class="search_field">short</div>
		</div>
		<div style="clear: both;"></div>
		<div style="search_field_wrapper" id="sf_bytTimeRounding">
			<div class="search_field_label">BytTimeRounding:</div>
			<div class="search_field">short</div>
		</div>
		
		<div style="search_field_wrapper" id="sf_blnAutomaticBreakDeduction">
			<div class="search_field_label">BlnAutomaticBreakDeduction:</div>
			<div class="search_field"><label><input type='radio' name='blnAutomaticBreakDeduction' value='1' <?=($fields['blnAutomaticBreakDeduction']==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnAutomaticBreakDeduction' value='0' <?=($fields['blnAutomaticBreakDeduction']==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnAutomaticBreakDeduction' <?php if($fields['blnAutomaticBreakDeduction'] == 'on' || $fields['blnAutomaticBreakDeduction'] == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?></div>
		</div>
		<div style="clear: both;"></div>
		<div style="search_field_wrapper" id="sf_dblAutomaticBreakLength">
			<div class="search_field_label">DblAutomaticBreakLength:</div>
			<div class="search_field">double</div>
		</div>
		
		<div style="search_field_wrapper" id="sf_dblApplyAutomaticBreakAfter">
			<div class="search_field_label">DblApplyAutomaticBreakAfter:</div>
			<div class="search_field"><input type='text' class='textbox' name='dblApplyAutomaticBreakAfter' value='<?=$fields['dblApplyAutomaticBreakAfter'];?>' maxlength='1073741823'/></div>
		</div>
		<div style="clear: both;"></div>
		<div style="search_field_wrapper" id="sf_blnHolidaysEffectOvertime">
			<div class="search_field_label">BlnHolidaysEffectOvertime:</div>
			<div class="search_field">double</div>
		</div>
		
		<div style="search_field_wrapper" id="sf_strDatabaseLocation">
			<div class="search_field_label">StrDatabaseLocation:</div>
			<div class="search_field"><input type='text' class='textbox' name='strDatabaseLocation' value='<?=$fields['strDatabaseLocation'];?>' maxlength='255'/></div>
		</div>
		<div style="clear: both;"></div>
		<div style="search_field_wrapper" id="sf_strInLabel">
			<div class="search_field_label">StrInLabel:</div>
			<div class="search_field"><input type='text' class='textbox' name='strInLabel' value='<?=$fields['strInLabel'];?>' maxlength='10'/></div>
		</div>
		
		<div style="search_field_wrapper" id="sf_strOutLabel">
			<div class="search_field_label">StrOutLabel:</div>
			<div class="search_field"><input type='text' class='textbox' name='strOutLabel' value='<?=$fields['strOutLabel'];?>' maxlength='10'/></div>
		</div>
		<div style="clear: both;"></div>
		<div style="search_field_wrapper" id="sf_strMyHoursLabel">
			<div class="search_field_label">StrMyHoursLabel:</div>
			<div class="search_field"><input type='text' class='textbox' name='strMyHoursLabel' value='<?=$fields['strMyHoursLabel'];?>' maxlength='20'/></div>
		</div>
		
		<div style="search_field_wrapper" id="sf_strLastActionLabel">
			<div class="search_field_label">StrLastActionLabel:</div>
			<div class="search_field"><input type='text' class='textbox' name='strLastActionLabel' value='<?=$fields['strLastActionLabel'];?>' maxlength='10'/></div>
		</div>
		<div style="clear: both;"></div>
		<div style="search_field_wrapper" id="sf_strSSNLabel">
			<div class="search_field_label">StrSSNLabel:</div>
			<div class="search_field"><input type='text' class='textbox' name='strSSNLabel' value='<?=$fields['strSSNLabel'];?>' maxlength='20'/></div>
		</div>
		
		<div style="search_field_wrapper" id="sf_lngLastEmployeeID">
			<div class="search_field_label">LngLastEmployeeID:</div>
			<div class="search_field"><input type='text' class='textbox' name='lngLastEmployeeID' value='<?=$fields['lngLastEmployeeID'];?>'/></div>
		</div>
		<div style="clear: both;"></div>
		<div style="search_field_wrapper" id="sf_lngStartingEmployeeID">
			<div class="search_field_label">LngStartingEmployeeID:</div>
			<div class="search_field"><input type='text' class='textbox' name='lngStartingEmployeeID' value='<?=$fields['lngStartingEmployeeID'];?>'/></div>
		</div>
		
		<div style="search_field_wrapper" id="sf_lngEmployeeIDIncrement">
			<div class="search_field_label">LngEmployeeIDIncrement:</div>
			<div class="search_field"><input type='text' class='textbox' name='lngEmployeeIDIncrement' value='<?=$fields['lngEmployeeIDIncrement'];?>'/></div>
		</div>
		<div style="clear: both;"></div>
		<div style="search_field_wrapper" id="sf_bytFirstDayOfWeek">
			<div class="search_field_label">BytFirstDayOfWeek:</div>
			<div class="search_field">short</div>
		</div>
		
		<div style="search_field_wrapper" id="sf_lngFiscalYearMonth">
			<div class="search_field_label">LngFiscalYearMonth:</div>
			<div class="search_field"><input type='text' class='textbox' name='lngFiscalYearMonth' value='<?=$fields['lngFiscalYearMonth'];?>'/></div>
		</div>
		<div style="clear: both;"></div>
		<div style="search_field_wrapper" id="sf_lngFiscalYearDay">
			<div class="search_field_label">LngFiscalYearDay:</div>
			<div class="search_field"><input type='text' class='textbox' name='lngFiscalYearDay' value='<?=$fields['lngFiscalYearDay'];?>'/></div>
		</div>
		
		<div style="search_field_wrapper" id="sf_blnRoundDown">
			<div class="search_field_label">BlnRoundDown:</div>
			<div class="search_field"><label><input type='radio' name='blnRoundDown' value='1' <?=($fields['blnRoundDown']==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnRoundDown' value='0' <?=($fields['blnRoundDown']==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnRoundDown' <?php if($fields['blnRoundDown'] == 'on' || $fields['blnRoundDown'] == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?></div>
		</div>
		<div style="clear: both;"></div>
		<div style="search_field_wrapper" id="sf_blnNoClockSet">
			<div class="search_field_label">BlnNoClockSet:</div>
			<div class="search_field"><label><input type='radio' name='blnNoClockSet' value='1' <?=($fields['blnNoClockSet']==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnNoClockSet' value='0' <?=($fields['blnNoClockSet']==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnNoClockSet' <?php if($fields['blnNoClockSet'] == 'on' || $fields['blnNoClockSet'] == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?></div>
		</div>
		
		<div style="search_field_wrapper" id="sf_bytRequireAdminPassword">
			<div class="search_field_label">BytRequireAdminPassword:</div>
			<div class="search_field">short</div>
		</div>
		<div style="clear: both;"></div>
		<div style="search_field_wrapper" id="sf_blnNoDesktop">
			<div class="search_field_label">BlnNoDesktop:</div>
			<div class="search_field"><label><input type='radio' name='blnNoDesktop' value='1' <?=($fields['blnNoDesktop']==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnNoDesktop' value='0' <?=($fields['blnNoDesktop']==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnNoDesktop' <?php if($fields['blnNoDesktop'] == 'on' || $fields['blnNoDesktop'] == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?></div>
		</div>
		
		<div style="search_field_wrapper" id="sf_strLicenseName">
			<div class="search_field_label">StrLicenseName:</div>
			<div class="search_field"><input type='text' class='textbox' name='strLicenseName' value='<?=$fields['strLicenseName'];?>' maxlength='255'/></div>
		</div>
		<div style="clear: both;"></div>
		<div style="search_field_wrapper" id="sf_strKey">
			<div class="search_field_label">StrKey:</div>
			<div class="search_field"><input type='text' class='textbox' name='strKey' value='<?=$fields['strKey'];?>' maxlength='255'/></div>
		</div>
		
		<div style="search_field_wrapper" id="sf_lngDatabaseSize">
			<div class="search_field_label">LngDatabaseSize:</div>
			<div class="search_field"><input type='text' class='textbox' name='lngDatabaseSize' value='<?=$fields['lngDatabaseSize'];?>'/></div>
		</div>
		<div style="clear: both;"></div>
		<div style="search_field_wrapper" id="sf_lngConnections">
			<div class="search_field_label">LngConnections:</div>
			<div class="search_field"><input type='text' class='textbox' name='lngConnections' value='<?=$fields['lngConnections'];?>'/></div>
		</div>
		
		<div style="search_field_wrapper" id="sf_blnPaidBreak">
			<div class="search_field_label">BlnPaidBreak:</div>
			<div class="search_field"><label><input type='radio' name='blnPaidBreak' value='1' <?=($fields['blnPaidBreak']==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnPaidBreak' value='0' <?=($fields['blnPaidBreak']==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnPaidBreak' <?php if($fields['blnPaidBreak'] == 'on' || $fields['blnPaidBreak'] == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?></div>
		</div>
		<div style="clear: both;"></div>
		<div style="search_field_wrapper" id="sf_sngPaidBreakLength">
			<div class="search_field_label">SngPaidBreakLength:</div>
			<div class="search_field">float</div>
		</div>
		
		<div style="search_field_wrapper" id="sf_blnPayIfExceedBreak">
			<div class="search_field_label">BlnPayIfExceedBreak:</div>
			<div class="search_field"><label><input type='radio' name='blnPayIfExceedBreak' value='1' <?=($fields['blnPayIfExceedBreak']==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnPayIfExceedBreak' value='0' <?=($fields['blnPayIfExceedBreak']==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnPayIfExceedBreak' <?php if($fields['blnPayIfExceedBreak'] == 'on' || $fields['blnPayIfExceedBreak'] == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?></div>
		</div>
		<div style="clear: both;"></div>
		<div style="search_field_wrapper" id="sf_blnAlwaysOnTop">
			<div class="search_field_label">BlnAlwaysOnTop:</div>
			<div class="search_field"><label><input type='radio' name='blnAlwaysOnTop' value='1' <?=($fields['blnAlwaysOnTop']==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnAlwaysOnTop' value='0' <?=($fields['blnAlwaysOnTop']==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnAlwaysOnTop' <?php if($fields['blnAlwaysOnTop'] == 'on' || $fields['blnAlwaysOnTop'] == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?></div>
		</div>
		
		<div style="search_field_wrapper" id="sf_blnPasswordCharPIN">
			<div class="search_field_label">BlnPasswordCharPIN:</div>
			<div class="search_field"><label><input type='radio' name='blnPasswordCharPIN' value='1' <?=($fields['blnPasswordCharPIN']==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnPasswordCharPIN' value='0' <?=($fields['blnPasswordCharPIN']==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnPasswordCharPIN' <?php if($fields['blnPasswordCharPIN'] == 'on' || $fields['blnPasswordCharPIN'] == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?></div>
		</div>
		<div style="clear: both;"></div>
		<div style="search_field_wrapper" id="sf_blnShutdownWindowsOnClose">
			<div class="search_field_label">BlnShutdownWindowsOnClose:</div>
			<div class="search_field"><label><input type='radio' name='blnShutdownWindowsOnClose' value='1' <?=($fields['blnShutdownWindowsOnClose']==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnShutdownWindowsOnClose' value='0' <?=($fields['blnShutdownWindowsOnClose']==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnShutdownWindowsOnClose' <?php if($fields['blnShutdownWindowsOnClose'] == 'on' || $fields['blnShutdownWindowsOnClose'] == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?></div>
		</div>
		
		<div style="search_field_wrapper" id="sf_blnExclusiveFocus">
			<div class="search_field_label">BlnExclusiveFocus:</div>
			<div class="search_field"><label><input type='radio' name='blnExclusiveFocus' value='1' <?=($fields['blnExclusiveFocus']==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnExclusiveFocus' value='0' <?=($fields['blnExclusiveFocus']==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnExclusiveFocus' <?php if($fields['blnExclusiveFocus'] == 'on' || $fields['blnExclusiveFocus'] == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?></div>
		</div>
		<div style="clear: both;"></div>
		<div style="search_field_wrapper" id="sf_blnPINsEncrypted">
			<div class="search_field_label">BlnPINsEncrypted:</div>
			<div class="search_field"><label><input type='radio' name='blnPINsEncrypted' value='1' <?=($fields['blnPINsEncrypted']==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnPINsEncrypted' value='0' <?=($fields['blnPINsEncrypted']==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnPINsEncrypted' <?php if($fields['blnPINsEncrypted'] == 'on' || $fields['blnPINsEncrypted'] == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?></div>
		</div>
		
		<div style="search_field_wrapper" id="sf_blnAccessDatabasePassword">
			<div class="search_field_label">BlnAccessDatabasePassword:</div>
			<div class="search_field"><label><input type='radio' name='blnAccessDatabasePassword' value='1' <?=($fields['blnAccessDatabasePassword']==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnAccessDatabasePassword' value='0' <?=($fields['blnAccessDatabasePassword']==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnAccessDatabasePassword' <?php if($fields['blnAccessDatabasePassword'] == 'on' || $fields['blnAccessDatabasePassword'] == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?></div>
		</div>
		<div style="clear: both;"></div>
		<div style="search_field_wrapper" id="sf_blnSickVacationTimeEffectOvertime">
			<div class="search_field_label">BlnSickVacationTimeEffectOvertime:</div>
			<div class="search_field"><label><input type='radio' name='blnSickVacationTimeEffectOvertime' value='1' <?=($fields['blnSickVacationTimeEffectOvertime']==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnSickVacationTimeEffectOvertime' value='0' <?=($fields['blnSickVacationTimeEffectOvertime']==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnSickVacationTimeEffectOvertime' <?php if($fields['blnSickVacationTimeEffectOvertime'] == 'on' || $fields['blnSickVacationTimeEffectOvertime'] == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?></div>
		</div>
		
		<div style="search_field_wrapper" id="sf_blnUseInternetTimeServer">
			<div class="search_field_label">BlnUseInternetTimeServer:</div>
			<div class="search_field"><label><input type='radio' name='blnUseInternetTimeServer' value='1' <?=($fields['blnUseInternetTimeServer']==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnUseInternetTimeServer' value='0' <?=($fields['blnUseInternetTimeServer']==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnUseInternetTimeServer' <?php if($fields['blnUseInternetTimeServer'] == 'on' || $fields['blnUseInternetTimeServer'] == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?></div>
		</div>
		<div style="clear: both;"></div>
		<div style="search_field_wrapper" id="sf_lngNTPServer">
			<div class="search_field_label">LngNTPServer:</div>
			<div class="search_field"><input type='text' class='textbox' name='lngNTPServer' value='<?=$fields['lngNTPServer'];?>'/></div>
		</div>
		
		<div style="search_field_wrapper" id="sf_strCustomNTPServer">
			<div class="search_field_label">StrCustomNTPServer:</div>
			<div class="search_field"><input type='text' class='textbox' name='strCustomNTPServer' value='<?=$fields['strCustomNTPServer'];?>' maxlength='255'/></div>
		</div>
		<div style="clear: both;"></div>
		<div style="search_field_wrapper" id="sf_lngTimeOutputFormat">
			<div class="search_field_label">LngTimeOutputFormat:</div>
			<div class="search_field"><input type='text' class='textbox' name='lngTimeOutputFormat' value='<?=$fields['lngTimeOutputFormat'];?>'/></div>
		</div>
		
		<div style="search_field_wrapper" id="sf_blnCheckForUpdatesOnStartup">
			<div class="search_field_label">BlnCheckForUpdatesOnStartup:</div>
			<div class="search_field"><label><input type='radio' name='blnCheckForUpdatesOnStartup' value='1' <?=($fields['blnCheckForUpdatesOnStartup']==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnCheckForUpdatesOnStartup' value='0' <?=($fields['blnCheckForUpdatesOnStartup']==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnCheckForUpdatesOnStartup' <?php if($fields['blnCheckForUpdatesOnStartup'] == 'on' || $fields['blnCheckForUpdatesOnStartup'] == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?></div>
		</div>
		<div style="clear: both;"></div>
		<div style="search_field_wrapper" id="sf_strReportHeaderTemplate">
			<div class="search_field_label">StrReportHeaderTemplate:</div>
			<div class="search_field"><input type='text' class='textbox' name='strReportHeaderTemplate' value='<?=$fields['strReportHeaderTemplate'];?>' maxlength='1073741823'/></div>
		</div>
		
		<div style="search_field_wrapper" id="sf_strCompanyHeaderTemplate">
			<div class="search_field_label">StrCompanyHeaderTemplate:</div>
			<div class="search_field"><input type='text' class='textbox' name='strCompanyHeaderTemplate' value='<?=$fields['strCompanyHeaderTemplate'];?>' maxlength='1073741823'/></div>
		</div>
		<div style="clear: both;"></div>
		<div style="search_field_wrapper" id="sf_strEmployeeDetailsTemplate">
			<div class="search_field_label">StrEmployeeDetailsTemplate:</div>
			<div class="search_field"><input type='text' class='textbox' name='strEmployeeDetailsTemplate' value='<?=$fields['strEmployeeDetailsTemplate'];?>' maxlength='1073741823'/></div>
		</div>
		
		<div style="search_field_wrapper" id="sf_strEmployeeHeaderTemplate">
			<div class="search_field_label">StrEmployeeHeaderTemplate:</div>
			<div class="search_field"><input type='text' class='textbox' name='strEmployeeHeaderTemplate' value='<?=$fields['strEmployeeHeaderTemplate'];?>' maxlength='1073741823'/></div>
		</div>
		<div style="clear: both;"></div>
		<div style="search_field_wrapper" id="sf_strEmployeeSummaryTemplate">
			<div class="search_field_label">StrEmployeeSummaryTemplate:</div>
			<div class="search_field"><input type='text' class='textbox' name='strEmployeeSummaryTemplate' value='<?=$fields['strEmployeeSummaryTemplate'];?>' maxlength='1073741823'/></div>
		</div>
		
		<div style="search_field_wrapper" id="sf_strEmployeeAccrualsTemplate">
			<div class="search_field_label">StrEmployeeAccrualsTemplate:</div>
			<div class="search_field"><input type='text' class='textbox' name='strEmployeeAccrualsTemplate' value='<?=$fields['strEmployeeAccrualsTemplate'];?>' maxlength='1073741823'/></div>
		</div>
		<div style="clear: both;"></div>
		<div style="search_field_wrapper" id="sf_strPayrollInformationTemplate">
			<div class="search_field_label">StrPayrollInformationTemplate:</div>
			<div class="search_field"><input type='text' class='textbox' name='strPayrollInformationTemplate' value='<?=$fields['strPayrollInformationTemplate'];?>' maxlength='1073741823'/></div>
		</div>
		
		<div style="search_field_wrapper" id="sf_strCurrency">
			<div class="search_field_label">StrCurrency:</div>
			<div class="search_field"><input type='text' class='textbox' name='strCurrency' value='<?=$fields['strCurrency'];?>' maxlength='10'/></div>
		</div>
		<div style="clear: both;"></div>
		<div style="search_field_wrapper" id="sf_bytCaptureImageOn">
			<div class="search_field_label">BytCaptureImageOn:</div>
			<div class="search_field">short</div>
		</div>
		
		<div style="search_field_wrapper" id="sf_bytKeepImagesFor">
			<div class="search_field_label">BytKeepImagesFor:</div>
			<div class="search_field">short</div>
		</div>
		<div style="clear: both;"></div>
		<div style="search_field_wrapper" id="sf_blnEnableImageCapture">
			<div class="search_field_label">BlnEnableImageCapture:</div>
			<div class="search_field"><label><input type='radio' name='blnEnableImageCapture' value='1' <?=($fields['blnEnableImageCapture']==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnEnableImageCapture' value='0' <?=($fields['blnEnableImageCapture']==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnEnableImageCapture' <?php if($fields['blnEnableImageCapture'] == 'on' || $fields['blnEnableImageCapture'] == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?></div>
		</div>
		
		<div style="search_field_wrapper" id="sf_strCapturePath">
			<div class="search_field_label">StrCapturePath:</div>
			<div class="search_field"><input type='text' class='textbox' name='strCapturePath' value='<?=$fields['strCapturePath'];?>' maxlength='255'/></div>
		</div>
		<div style="clear: both;"></div>
		<div style="search_field_wrapper" id="sf_lngFirstDayStartsAt">
			<div class="search_field_label">LngFirstDayStartsAt:</div>
			<div class="search_field"><input type='text' class='textbox' name='lngFirstDayStartsAt' value='<?=$fields['lngFirstDayStartsAt'];?>'/></div>
		</div>
		
		<div style="search_field_wrapper" id="sf_strPayDayAsOvertime">
			<div class="search_field_label">StrPayDayAsOvertime:</div>
			<div class="search_field"><input type='text' class='textbox' name='strPayDayAsOvertime' value='<?=$fields['strPayDayAsOvertime'];?>' maxlength='7'/></div>
		</div>
		<div style="clear: both;"></div>
		<div style="search_field_wrapper" id="sf_strClockInLabel">
			<div class="search_field_label">StrClockInLabel:</div>
			<div class="search_field"><input type='text' class='textbox' name='strClockInLabel' value='<?=$fields['strClockInLabel'];?>' maxlength='30'/></div>
		</div>
		
		<div style="search_field_wrapper" id="sf_strClockOutLabel">
			<div class="search_field_label">StrClockOutLabel:</div>
			<div class="search_field"><input type='text' class='textbox' name='strClockOutLabel' value='<?=$fields['strClockOutLabel'];?>' maxlength='30'/></div>
		</div>
		<div style="clear: both;"></div>
		<div style="search_field_wrapper" id="sf_strActionTypeLabel">
			<div class="search_field_label">StrActionTypeLabel:</div>
			<div class="search_field"><input type='text' class='textbox' name='strActionTypeLabel' value='<?=$fields['strActionTypeLabel'];?>' maxlength='30'/></div>
		</div>
		
		<div style="search_field_wrapper" id="sf_strActionDateLabel">
			<div class="search_field_label">StrActionDateLabel:</div>
			<div class="search_field"><input type='text' class='textbox' name='strActionDateLabel' value='<?=$fields['strActionDateLabel'];?>' maxlength='30'/></div>
		</div>
		<div style="clear: both;"></div>
		<div style="search_field_wrapper" id="sf_strActionTimeLabel">
			<div class="search_field_label">StrActionTimeLabel:</div>
			<div class="search_field"><input type='text' class='textbox' name='strActionTimeLabel' value='<?=$fields['strActionTimeLabel'];?>' maxlength='30'/></div>
		</div>
		
		<div style="search_field_wrapper" id="sf_strEmployeesInLabel">
			<div class="search_field_label">StrEmployeesInLabel:</div>
			<div class="search_field"><input type='text' class='textbox' name='strEmployeesInLabel' value='<?=$fields['strEmployeesInLabel'];?>' maxlength='30'/></div>
		</div>
		<div style="clear: both;"></div>
		<div style="search_field_wrapper" id="sf_strEmployeesOutLabel">
			<div class="search_field_label">StrEmployeesOutLabel:</div>
			<div class="search_field"><input type='text' class='textbox' name='strEmployeesOutLabel' value='<?=$fields['strEmployeesOutLabel'];?>' maxlength='30'/></div>
		</div>
		
		<div style="search_field_wrapper" id="sf_strEmployeesLabel">
			<div class="search_field_label">StrEmployeesLabel:</div>
			<div class="search_field"><input type='text' class='textbox' name='strEmployeesLabel' value='<?=$fields['strEmployeesLabel'];?>' maxlength='30'/></div>
		</div>
		<div style="clear: both;"></div>
		<div style="search_field_wrapper" id="sf_strTimeNoteLabel">
			<div class="search_field_label">StrTimeNoteLabel:</div>
			<div class="search_field"><input type='text' class='textbox' name='strTimeNoteLabel' value='<?=$fields['strTimeNoteLabel'];?>' maxlength='30'/></div>
		</div>
		
		<div style="search_field_wrapper" id="sf_strViewInformationLabel">
			<div class="search_field_label">StrViewInformationLabel:</div>
			<div class="search_field"><input type='text' class='textbox' name='strViewInformationLabel' value='<?=$fields['strViewInformationLabel'];?>' maxlength='30'/></div>
		</div>
		<div style="clear: both;"></div>
		<div style="search_field_wrapper" id="sf_strSearchForEmployeeLabel">
			<div class="search_field_label">StrSearchForEmployeeLabel:</div>
			<div class="search_field"><input type='text' class='textbox' name='strSearchForEmployeeLabel' value='<?=$fields['strSearchForEmployeeLabel'];?>' maxlength='30'/></div>
		</div>
		
		<div style="search_field_wrapper" id="sf_strNoActionLabel">
			<div class="search_field_label">StrNoActionLabel:</div>
			<div class="search_field"><input type='text' class='textbox' name='strNoActionLabel' value='<?=$fields['strNoActionLabel'];?>' maxlength='30'/></div>
		</div>
		<div style="clear: both;"></div>
		<div style="search_field_wrapper" id="sf_strMothersMaidenName">
			<div class="search_field_label">StrMothersMaidenName:</div>
			<div class="search_field"><input type='text' class='textbox' name='strMothersMaidenName' value='<?=$fields['strMothersMaidenName'];?>' maxlength='1073741823'/></div>
		</div>
		
		<div style="search_field_wrapper" id="sf_strCityYouWereBornIn">
			<div class="search_field_label">StrCityYouWereBornIn:</div>
			<div class="search_field"><input type='text' class='textbox' name='strCityYouWereBornIn' value='<?=$fields['strCityYouWereBornIn'];?>' maxlength='1073741823'/></div>
		</div>
		<div style="clear: both;"></div>
		<div style="search_field_wrapper" id="sf_blnDailyOvertime2">
			<div class="search_field_label">BlnDailyOvertime2:</div>
			<div class="search_field"><label><input type='radio' name='blnDailyOvertime2' value='1' <?=($fields['blnDailyOvertime2']==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnDailyOvertime2' value='0' <?=($fields['blnDailyOvertime2']==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnDailyOvertime2' <?php if($fields['blnDailyOvertime2'] == 'on' || $fields['blnDailyOvertime2'] == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?></div>
		</div>
		
		<div style="search_field_wrapper" id="sf_blnSeventhDayOvertime">
			<div class="search_field_label">BlnSeventhDayOvertime:</div>
			<div class="search_field"><label><input type='radio' name='blnSeventhDayOvertime' value='1' <?=($fields['blnSeventhDayOvertime']==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnSeventhDayOvertime' value='0' <?=($fields['blnSeventhDayOvertime']==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnSeventhDayOvertime' <?php if($fields['blnSeventhDayOvertime'] == 'on' || $fields['blnSeventhDayOvertime'] == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?></div>
		</div>
		<div style="clear: both;"></div>
		<div style="search_field_wrapper" id="sf_dblDailyOTLimit2">
			<div class="search_field_label">DblDailyOTLimit2:</div>
			<div class="search_field">float</div>
		</div>
		
		<div style="search_field_wrapper" id="sf_dblSeventhDayOTLimit">
			<div class="search_field_label">DblSeventhDayOTLimit:</div>
			<div class="search_field">float</div>
		</div>
		<div style="clear: both;"></div>
		<div style="search_field_wrapper" id="sf_blnUseFingerprintScanner">
			<div class="search_field_label">BlnUseFingerprintScanner:</div>
			<div class="search_field"><label><input type='radio' name='blnUseFingerprintScanner' value='1' <?=($fields['blnUseFingerprintScanner']==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnUseFingerprintScanner' value='0' <?=($fields['blnUseFingerprintScanner']==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnUseFingerprintScanner' <?php if($fields['blnUseFingerprintScanner'] == 'on' || $fields['blnUseFingerprintScanner'] == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?></div>
		</div>
		
		<div style="search_field_wrapper" id="sf_strEncryptedAdminPassword">
			<div class="search_field_label">StrEncryptedAdminPassword:</div>
			<div class="search_field"><input type='text' class='textbox' name='strEncryptedAdminPassword' value='<?=$fields['strEncryptedAdminPassword'];?>' maxlength='255'/></div>
		</div>
		<div style="clear: both;"></div>
		<div style="search_field_wrapper" id="sf_blnReportEmployeePageBreak">
			<div class="search_field_label">BlnReportEmployeePageBreak:</div>
			<div class="search_field"><label><input type='radio' name='blnReportEmployeePageBreak' value='1' <?=($fields['blnReportEmployeePageBreak']==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnReportEmployeePageBreak' value='0' <?=($fields['blnReportEmployeePageBreak']==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnReportEmployeePageBreak' <?php if($fields['blnReportEmployeePageBreak'] == 'on' || $fields['blnReportEmployeePageBreak'] == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?></div>
		</div>
		
		<div style="search_field_wrapper" id="sf_blnEnableTimeDataLogging">
			<div class="search_field_label">BlnEnableTimeDataLogging:</div>
			<div class="search_field"><label><input type='radio' name='blnEnableTimeDataLogging' value='1' <?=($fields['blnEnableTimeDataLogging']==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnEnableTimeDataLogging' value='0' <?=($fields['blnEnableTimeDataLogging']==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnEnableTimeDataLogging' <?php if($fields['blnEnableTimeDataLogging'] == 'on' || $fields['blnEnableTimeDataLogging'] == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?></div>
		</div>
		<div style="clear: both;"></div>
		<div style="search_field_wrapper" id="sf_blnShowDepartmentFolders">
			<div class="search_field_label">BlnShowDepartmentFolders:</div>
			<div class="search_field"><label><input type='radio' name='blnShowDepartmentFolders' value='1' <?=($fields['blnShowDepartmentFolders']==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnShowDepartmentFolders' value='0' <?=($fields['blnShowDepartmentFolders']==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnShowDepartmentFolders' <?php if($fields['blnShowDepartmentFolders'] == 'on' || $fields['blnShowDepartmentFolders'] == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?></div>
		</div>
		
		<div style="search_field_wrapper" id="sf_blnEmployeeJobCreation">
			<div class="search_field_label">BlnEmployeeJobCreation:</div>
			<div class="search_field"><label><input type='radio' name='blnEmployeeJobCreation' value='1' <?=($fields['blnEmployeeJobCreation']==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnEmployeeJobCreation' value='0' <?=($fields['blnEmployeeJobCreation']==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnEmployeeJobCreation' <?php if($fields['blnEmployeeJobCreation'] == 'on' || $fields['blnEmployeeJobCreation'] == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?></div>
		</div>
		<div style="clear: both;"></div>
		<div style="search_field_wrapper" id="sf_bytEmployeeListFontSize">
			<div class="search_field_label">BytEmployeeListFontSize:</div>
			<div class="search_field">short</div>
		</div>
		
		<div style="search_field_wrapper" id="sf_blnPasswordProtectEmployeeSpreadsheet">
			<div class="search_field_label">BlnPasswordProtectEmployeeSpreadsheet:</div>
			<div class="search_field"><label><input type='radio' name='blnPasswordProtectEmployeeSpreadsheet' value='1' <?=($fields['blnPasswordProtectEmployeeSpreadsheet']==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnPasswordProtectEmployeeSpreadsheet' value='0' <?=($fields['blnPasswordProtectEmployeeSpreadsheet']==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnPasswordProtectEmployeeSpreadsheet' <?php if($fields['blnPasswordProtectEmployeeSpreadsheet'] == 'on' || $fields['blnPasswordProtectEmployeeSpreadsheet'] == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?></div>
		</div>
		<div style="clear: both;"></div>
		<div style="search_field_wrapper" id="sf_blnAutoLogout">
			<div class="search_field_label">BlnAutoLogout:</div>
			<div class="search_field"><label><input type='radio' name='blnAutoLogout' value='1' <?=($fields['blnAutoLogout']==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnAutoLogout' value='0' <?=($fields['blnAutoLogout']==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnAutoLogout' <?php if($fields['blnAutoLogout'] == 'on' || $fields['blnAutoLogout'] == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?></div>
		</div>
		
		<div style="search_field_wrapper" id="sf_blnTipTracking">
			<div class="search_field_label">BlnTipTracking:</div>
			<div class="search_field"><label><input type='radio' name='blnTipTracking' value='1' <?=($fields['blnTipTracking']==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnTipTracking' value='0' <?=($fields['blnTipTracking']==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnTipTracking' <?php if($fields['blnTipTracking'] == 'on' || $fields['blnTipTracking'] == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?></div>
		</div>
		<div style="clear: both;"></div>
		<div style="search_field_wrapper" id="sf_strJobLabel">
			<div class="search_field_label">StrJobLabel:</div>
			<div class="search_field"><input type='text' class='textbox' name='strJobLabel' value='<?=$fields['strJobLabel'];?>' maxlength='30'/></div>
		</div>
		
		<div style="clear: both;"></div>
		<div style="search_field_wrapper">
			<div class="search_field_label">Results:</div>
			<div class="search_field">
				<?php
				$results = $pager->total_results." match".($pager->total_results!=1?"es":"")." found.";
				if ($pager->total_results > 0)
					$results .= " Page ".($pager->current_page)." of ".$pager->total_pages.".";
				?>
				<div><?=$results;?></div>
			</div>
		</div>
		<div style="search_field_wrapper">
			<div class="search_field_label"></div>
			<div class="search_field_label">
				<input type="submit" value="Search" class="button btn-search" style="width:80px;" />
				<input type="button" value="Reset Form" class="button btn-reload" style="width:100px;" onClick="location='?view=tblSettings&reset'"/>
			</div>
		</div>
		<div style="clear: both;"></div>
	</div>
	</div>

	<br/>
	
	<div class="filter_box">
	<table width="100%">
		<tr>
			<?php if (accessible_permission("add_tblSetting","view")) { ?>
				<td style="padding-right:10px;border-right:solid 1px maroon;width:138px;">
					<input type="button" value="Add TblSetting" onClick="location='?view=add_tblSetting'" class="button btn-add" style="width:138px;"/>
				</td>
			<?php } ?>
			<td align="center">
				<?php $pager->getPager();?>
			</td>
			<td align="right">
				<input type="button" value="Search Options" class="button btn-search" onclick="$('#search_options').fadeIn('fast');" style="width:130px;" />
			</td>
		</tr>
	</table>
	</div>

	<table class="grid-def">
		<tr class="grid-row_header">
			<?php if (accessible_permission("delete_tblSetting_model","model")) { ?>
				<td width="50" align="center">Delete</td>
				<!--<td width="40" align="center" style="padding:0"><input type="checkbox" id="tblSettings_all" title="Select all items on this page"/></td>-->
			<?php } ?>
			<td>
			  StrCompanyName
				<input type="image" onclick="sort_by.value='strCompanyName_a';" src='<?=COMMON_FILES_PATH;?>images/icons/arrow_up_16.gif' width="10" height="10" />
				<input type="image" onclick="sort_by.value='strCompanyName_d';" src='<?=COMMON_FILES_PATH;?>images/icons/arrow_down_16.gif' width="10" height="10" />
			</td>
			<!--td>setting->strCompanyName</td-->
		</tr>

		<?php
		$i=0;
		foreach($pager->results as $row)
		{
			$i++;
			$setting = new Setting();
			$setting->setPropertyValues($row);
			?>
			<tr class="grid-row<?= ($i%2) ?>">
				<?php if (accessible_permission("delete_tblSetting_model","model")) { ?>
					<td align="center">
						<a href='controller.php?action=delete_tblSetting&id=<?=$setting->lngID;?>&popup_destination=<?=@$popup_destination;?>' onClick='return confirm("Are you sure that you want to delete this tblSetting?");'><img src='<?=COMMON_FILES_PATH;?>images/icons/delete.gif' /></a>
						<!--<input type="checkbox" class="tblSettings" name="id[]" value="<?=$setting->lngID;?>"/>-->
					</td>
				<?php } ?>
				<td>
					<?php if (accessible_permission("add_tblSetting","view")) {
						echo "<a href='?view=add_tblSetting&id=".$setting->lngID."'>".$setting->strCompanyName."</a>";
					}
					else
						echo $setting->strCompanyName;
				?>
				</td>
				<!--<td><?php //echo $setting->strCompanyName;?></td>-->
			</tr>
		<?php
		}
		if ($pager->total_results == 0) 
		{
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
				<?php /*if (accessible_permission("delete_tblSetting_model","model")) { ?>
				<b>Action:</b> <a href='javascript:void(0)' class="link btn-delete" id='batch_delete'>Remove selected</a>
				<?php }*/ ?> 
			</td>
			<td colspan="2" align="right"><?=$results;?></td>
		</tr>
	</table>

</form>
