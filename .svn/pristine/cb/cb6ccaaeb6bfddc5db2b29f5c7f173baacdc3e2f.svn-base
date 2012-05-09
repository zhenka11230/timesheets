<?php
//require_once(dirname(__FILE__)."/DbObject.php");

class Setting extends DbObject
{
	public static $tableName = "tblSettings";
	public $exists = false;

	/** [[Column=lngID, DataType=int, Description=LngID, ReadOnly=true]]*/
	public $lngID;

	/** [[Column=strCompanyName, DataType=varchar, Description=StrCompanyName, MaxLength=255]]*/
	public $strCompanyName;

	/** [[Column=strCompanyAddress, DataType=varchar, Description=StrCompanyAddress, MaxLength=1073741823]]*/
	public $strCompanyAddress;

	/** [[Column=strReportFooter, DataType=varchar, Description=StrReportFooter, MaxLength=1073741823]]*/
	public $strReportFooter;

	/** [[Column=blnIncludeSignature, DataType=bit, Description=BlnIncludeSignature, Required=true]]*/
	public $blnIncludeSignature;

	/** [[Column=blnDataEntryMode, DataType=bit, Description=BlnDataEntryMode, Required=true]]*/
	public $blnDataEntryMode;

	/** [[Column=blnRequirePIN, DataType=bit, Description=BlnRequirePIN, Required=true]]*/
	public $blnRequirePIN;

	/** [[Column=blnRequireComment, DataType=bit, Description=BlnRequireComment, Required=true]]*/
	public $blnRequireComment;

	/** [[Column=bytCommentRequirements, DataType=smallint, Description=BytCommentRequirements]]*/
	public $bytCommentRequirements;

	/** [[Column=blnAllowBlankComments, DataType=bit, Description=BlnAllowBlankComments, Required=true]]*/
	public $blnAllowBlankComments;

	/** [[Column=blnTimeFormat, DataType=bit, Description=BlnTimeFormat, Required=true]]*/
	public $blnTimeFormat;

	/** [[Column=strAdministratorPassword, DataType=varchar, Description=StrAdministratorPassword, MaxLength=50]]*/
	public $strAdministratorPassword;

	/** [[Column=blnEmployeesViewHours, DataType=bit, Description=BlnEmployeesViewHours, Required=true]]*/
	public $blnEmployeesViewHours;

	/** [[Column=blnEmployeesPrintHours, DataType=bit, Description=BlnEmployeesPrintHours, Required=true]]*/
	public $blnEmployeesPrintHours;

	/** [[Column=strEmployeeReportFooter, DataType=varchar, Description=StrEmployeeReportFooter, MaxLength=1073741823]]*/
	public $strEmployeeReportFooter;

	/** [[Column=blnWeeklyOvertime, DataType=bit, Description=BlnWeeklyOvertime, Required=true]]*/
	public $blnWeeklyOvertime;

	/** [[Column=blnDailyOvertime, DataType=bit, Description=BlnDailyOvertime, Required=true]]*/
	public $blnDailyOvertime;

	/** [[Column=dblWeeklyOTLimit, DataType=float, Description=DblWeeklyOTLimit]]*/
	public $dblWeeklyOTLimit;

	/** [[Column=dblDailyOTLimit, DataType=float, Description=DblDailyOTLimit]]*/
	public $dblDailyOTLimit;

	/** [[Column=dblHoursPerWeek, DataType=float, Description=DblHoursPerWeek]]*/
	public $dblHoursPerWeek;

	/** [[Column=bytOTCalculation, DataType=smallint, Description=BytOTCalculation]]*/
	public $bytOTCalculation;

	/** [[Column=bytTimeRounding, DataType=smallint, Description=BytTimeRounding]]*/
	public $bytTimeRounding;

	/** [[Column=blnAutomaticBreakDeduction, DataType=bit, Description=BlnAutomaticBreakDeduction, Required=true]]*/
	public $blnAutomaticBreakDeduction;

	/** [[Column=dblAutomaticBreakLength, DataType=float, Description=DblAutomaticBreakLength]]*/
	public $dblAutomaticBreakLength;

	/** [[Column=dblApplyAutomaticBreakAfter, DataType=varchar, Description=DblApplyAutomaticBreakAfter, MaxLength=1073741823]]*/
	public $dblApplyAutomaticBreakAfter;

	/** [[Column=blnHolidaysEffectOvertime, DataType=float, Description=BlnHolidaysEffectOvertime]]*/
	public $blnHolidaysEffectOvertime;

	/** [[Column=strDatabaseLocation, DataType=varchar, Description=StrDatabaseLocation, MaxLength=255]]*/
	public $strDatabaseLocation;

	/** [[Column=strInLabel, DataType=varchar, Description=StrInLabel, MaxLength=10]]*/
	public $strInLabel;

	/** [[Column=strOutLabel, DataType=varchar, Description=StrOutLabel, MaxLength=10]]*/
	public $strOutLabel;

	/** [[Column=strMyHoursLabel, DataType=varchar, Description=StrMyHoursLabel, MaxLength=20]]*/
	public $strMyHoursLabel;

	/** [[Column=strLastActionLabel, DataType=varchar, Description=StrLastActionLabel, MaxLength=10]]*/
	public $strLastActionLabel;

	/** [[Column=strSSNLabel, DataType=varchar, Description=StrSSNLabel, MaxLength=20]]*/
	public $strSSNLabel;

	/** [[Column=lngLastEmployeeID, DataType=int, Description=LngLastEmployeeID]]*/
	public $lngLastEmployeeID;

	/** [[Column=lngStartingEmployeeID, DataType=int, Description=LngStartingEmployeeID]]*/
	public $lngStartingEmployeeID;

	/** [[Column=lngEmployeeIDIncrement, DataType=int, Description=LngEmployeeIDIncrement]]*/
	public $lngEmployeeIDIncrement;

	/** [[Column=bytFirstDayOfWeek, DataType=smallint, Description=BytFirstDayOfWeek]]*/
	public $bytFirstDayOfWeek;

	/** [[Column=lngFiscalYearMonth, DataType=int, Description=LngFiscalYearMonth]]*/
	public $lngFiscalYearMonth;

	/** [[Column=lngFiscalYearDay, DataType=int, Description=LngFiscalYearDay]]*/
	public $lngFiscalYearDay;

	/** [[Column=blnRoundDown, DataType=bit, Description=BlnRoundDown, Required=true]]*/
	public $blnRoundDown;

	/** [[Column=blnNoClockSet, DataType=bit, Description=BlnNoClockSet, Required=true]]*/
	public $blnNoClockSet;

	/** [[Column=bytRequireAdminPassword, DataType=smallint, Description=BytRequireAdminPassword]]*/
	public $bytRequireAdminPassword;

	/** [[Column=blnNoDesktop, DataType=bit, Description=BlnNoDesktop, Required=true]]*/
	public $blnNoDesktop;

	/** [[Column=strLicenseName, DataType=varchar, Description=StrLicenseName, MaxLength=255]]*/
	public $strLicenseName;

	/** [[Column=strKey, DataType=varchar, Description=StrKey, MaxLength=255]]*/
	public $strKey;

	/** [[Column=lngDatabaseSize, DataType=int, Description=LngDatabaseSize]]*/
	public $lngDatabaseSize;

	/** [[Column=lngConnections, DataType=int, Description=LngConnections]]*/
	public $lngConnections;

	/** [[Column=blnPaidBreak, DataType=bit, Description=BlnPaidBreak, Required=true]]*/
	public $blnPaidBreak;

	/** [[Column=sngPaidBreakLength, DataType=real, Description=SngPaidBreakLength]]*/
	public $sngPaidBreakLength;

	/** [[Column=blnPayIfExceedBreak, DataType=bit, Description=BlnPayIfExceedBreak, Required=true]]*/
	public $blnPayIfExceedBreak;

	/** [[Column=blnAlwaysOnTop, DataType=bit, Description=BlnAlwaysOnTop, Required=true]]*/
	public $blnAlwaysOnTop;

	/** [[Column=blnPasswordCharPIN, DataType=bit, Description=BlnPasswordCharPIN, Required=true]]*/
	public $blnPasswordCharPIN;

	/** [[Column=blnShutdownWindowsOnClose, DataType=bit, Description=BlnShutdownWindowsOnClose, Required=true]]*/
	public $blnShutdownWindowsOnClose;

	/** [[Column=blnExclusiveFocus, DataType=bit, Description=BlnExclusiveFocus, Required=true]]*/
	public $blnExclusiveFocus;

	/** [[Column=blnPINsEncrypted, DataType=bit, Description=BlnPINsEncrypted, Required=true]]*/
	public $blnPINsEncrypted;

	/** [[Column=blnAccessDatabasePassword, DataType=bit, Description=BlnAccessDatabasePassword, Required=true]]*/
	public $blnAccessDatabasePassword;

	/** [[Column=blnSickVacationTimeEffectOvertime, DataType=bit, Description=BlnSickVacationTimeEffectOvertime, Required=true]]*/
	public $blnSickVacationTimeEffectOvertime;

	/** [[Column=blnUseInternetTimeServer, DataType=bit, Description=BlnUseInternetTimeServer, Required=true]]*/
	public $blnUseInternetTimeServer;

	/** [[Column=lngNTPServer, DataType=int, Description=LngNTPServer]]*/
	public $lngNTPServer;

	/** [[Column=strCustomNTPServer, DataType=varchar, Description=StrCustomNTPServer, MaxLength=255]]*/
	public $strCustomNTPServer;

	/** [[Column=lngTimeOutputFormat, DataType=int, Description=LngTimeOutputFormat]]*/
	public $lngTimeOutputFormat;

	/** [[Column=blnCheckForUpdatesOnStartup, DataType=bit, Description=BlnCheckForUpdatesOnStartup, Required=true]]*/
	public $blnCheckForUpdatesOnStartup;

	/** [[Column=strReportHeaderTemplate, DataType=varchar, Description=StrReportHeaderTemplate, MaxLength=1073741823]]*/
	public $strReportHeaderTemplate;

	/** [[Column=strCompanyHeaderTemplate, DataType=varchar, Description=StrCompanyHeaderTemplate, MaxLength=1073741823]]*/
	public $strCompanyHeaderTemplate;

	/** [[Column=strEmployeeDetailsTemplate, DataType=varchar, Description=StrEmployeeDetailsTemplate, MaxLength=1073741823]]*/
	public $strEmployeeDetailsTemplate;

	/** [[Column=strEmployeeHeaderTemplate, DataType=varchar, Description=StrEmployeeHeaderTemplate, MaxLength=1073741823]]*/
	public $strEmployeeHeaderTemplate;

	/** [[Column=strEmployeeSummaryTemplate, DataType=varchar, Description=StrEmployeeSummaryTemplate, MaxLength=1073741823]]*/
	public $strEmployeeSummaryTemplate;

	/** [[Column=strEmployeeAccrualsTemplate, DataType=varchar, Description=StrEmployeeAccrualsTemplate, MaxLength=1073741823]]*/
	public $strEmployeeAccrualsTemplate;

	/** [[Column=strPayrollInformationTemplate, DataType=varchar, Description=StrPayrollInformationTemplate, MaxLength=1073741823]]*/
	public $strPayrollInformationTemplate;

	/** [[Column=strCurrency, DataType=varchar, Description=StrCurrency, MaxLength=10]]*/
	public $strCurrency;

	/** [[Column=bytCaptureImageOn, DataType=smallint, Description=BytCaptureImageOn]]*/
	public $bytCaptureImageOn;

	/** [[Column=bytKeepImagesFor, DataType=smallint, Description=BytKeepImagesFor]]*/
	public $bytKeepImagesFor;

	/** [[Column=blnEnableImageCapture, DataType=bit, Description=BlnEnableImageCapture, Required=true]]*/
	public $blnEnableImageCapture;

	/** [[Column=strCapturePath, DataType=varchar, Description=StrCapturePath, MaxLength=255]]*/
	public $strCapturePath;

	/** [[Column=lngFirstDayStartsAt, DataType=int, Description=LngFirstDayStartsAt]]*/
	public $lngFirstDayStartsAt;

	/** [[Column=strPayDayAsOvertime, DataType=varchar, Description=StrPayDayAsOvertime, MaxLength=7]]*/
	public $strPayDayAsOvertime;

	/** [[Column=strClockInLabel, DataType=varchar, Description=StrClockInLabel, MaxLength=30]]*/
	public $strClockInLabel;

	/** [[Column=strClockOutLabel, DataType=varchar, Description=StrClockOutLabel, MaxLength=30]]*/
	public $strClockOutLabel;

	/** [[Column=strActionTypeLabel, DataType=varchar, Description=StrActionTypeLabel, MaxLength=30]]*/
	public $strActionTypeLabel;

	/** [[Column=strActionDateLabel, DataType=varchar, Description=StrActionDateLabel, MaxLength=30]]*/
	public $strActionDateLabel;

	/** [[Column=strActionTimeLabel, DataType=varchar, Description=StrActionTimeLabel, MaxLength=30]]*/
	public $strActionTimeLabel;

	/** [[Column=strEmployeesInLabel, DataType=varchar, Description=StrEmployeesInLabel, MaxLength=30]]*/
	public $strEmployeesInLabel;

	/** [[Column=strEmployeesOutLabel, DataType=varchar, Description=StrEmployeesOutLabel, MaxLength=30]]*/
	public $strEmployeesOutLabel;

	/** [[Column=strEmployeesLabel, DataType=varchar, Description=StrEmployeesLabel, MaxLength=30]]*/
	public $strEmployeesLabel;

	/** [[Column=strTimeNoteLabel, DataType=varchar, Description=StrTimeNoteLabel, MaxLength=30]]*/
	public $strTimeNoteLabel;

	/** [[Column=strViewInformationLabel, DataType=varchar, Description=StrViewInformationLabel, MaxLength=30]]*/
	public $strViewInformationLabel;

	/** [[Column=strSearchForEmployeeLabel, DataType=varchar, Description=StrSearchForEmployeeLabel, MaxLength=30]]*/
	public $strSearchForEmployeeLabel;

	/** [[Column=strNoActionLabel, DataType=varchar, Description=StrNoActionLabel, MaxLength=30]]*/
	public $strNoActionLabel;

	/** [[Column=strMothersMaidenName, DataType=varchar, Description=StrMothersMaidenName, MaxLength=1073741823]]*/
	public $strMothersMaidenName;

	/** [[Column=strCityYouWereBornIn, DataType=varchar, Description=StrCityYouWereBornIn, MaxLength=1073741823]]*/
	public $strCityYouWereBornIn;

	/** [[Column=blnDailyOvertime2, DataType=bit, Description=BlnDailyOvertime2, Required=true]]*/
	public $blnDailyOvertime2;

	/** [[Column=blnSeventhDayOvertime, DataType=bit, Description=BlnSeventhDayOvertime, Required=true]]*/
	public $blnSeventhDayOvertime;

	/** [[Column=dblDailyOTLimit2, DataType=real, Description=DblDailyOTLimit2]]*/
	public $dblDailyOTLimit2;

	/** [[Column=dblSeventhDayOTLimit, DataType=real, Description=DblSeventhDayOTLimit]]*/
	public $dblSeventhDayOTLimit;

	/** [[Column=blnUseFingerprintScanner, DataType=bit, Description=BlnUseFingerprintScanner, Required=true]]*/
	public $blnUseFingerprintScanner;

	/** [[Column=strEncryptedAdminPassword, DataType=varchar, Description=StrEncryptedAdminPassword, MaxLength=255]]*/
	public $strEncryptedAdminPassword;

	/** [[Column=blnReportEmployeePageBreak, DataType=bit, Description=BlnReportEmployeePageBreak, Required=true]]*/
	public $blnReportEmployeePageBreak;

	/** [[Column=blnEnableTimeDataLogging, DataType=bit, Description=BlnEnableTimeDataLogging, Required=true]]*/
	public $blnEnableTimeDataLogging;

	/** [[Column=blnShowDepartmentFolders, DataType=bit, Description=BlnShowDepartmentFolders, Required=true]]*/
	public $blnShowDepartmentFolders;

	/** [[Column=blnEmployeeJobCreation, DataType=bit, Description=BlnEmployeeJobCreation, Required=true]]*/
	public $blnEmployeeJobCreation;

	/** [[Column=bytEmployeeListFontSize, DataType=smallint, Description=BytEmployeeListFontSize]]*/
	public $bytEmployeeListFontSize;

	/** [[Column=blnPasswordProtectEmployeeSpreadsheet, DataType=bit, Description=BlnPasswordProtectEmployeeSpreadsheet, Required=true]]*/
	public $blnPasswordProtectEmployeeSpreadsheet;

	/** [[Column=blnAutoLogout, DataType=bit, Description=BlnAutoLogout, Required=true]]*/
	public $blnAutoLogout;

	/** [[Column=blnTipTracking, DataType=bit, Description=BlnTipTracking, Required=true]]*/
	public $blnTipTracking;

	/** [[Column=strJobLabel, DataType=varchar, Description=StrJobLabel, MaxLength=30]]*/
	public $strJobLabel;

	// foreign key fields (will be populated upon request)
	
	
	public function fetchData($id)
	{
		//list($arg1, $arg2) = $args;
		$query="SELECT * FROM ".self::$tableName." WHERE lngID=".$id;

		$row = $this->db->getRow($query);
		
		if (count($row) > 0)
			$this->setPropertyValues($row);

		if ($this->lngID > 0)
			$this->exists = true;
	}
	
	
	public function getSettings($args=array())
	{
		global $db;
		
		$query = "SELECT * 
			FROM ".self::$tableName." t 
			WHERE 1=1 
				".(@$args['lngID'] != '' ? " AND lngID={$args['lngID']} " : "")."
				".(@$args['strCompanyName'] != '' ? " AND strCompanyName='{$args['strCompanyName']}' " : "")."
				".(@$args['strCompanyAddress'] != '' ? " AND strCompanyAddress='{$args['strCompanyAddress']}' " : "")."
				".(@$args['strReportFooter'] != '' ? " AND strReportFooter='{$args['strReportFooter']}' " : "")."
				".(@$args['blnIncludeSignature'] != '' ? " AND blnIncludeSignature={$args['blnIncludeSignature']} " : "")."
				".(@$args['blnDataEntryMode'] != '' ? " AND blnDataEntryMode={$args['blnDataEntryMode']} " : "")."
				".(@$args['blnRequirePIN'] != '' ? " AND blnRequirePIN={$args['blnRequirePIN']} " : "")."
				".(@$args['blnRequireComment'] != '' ? " AND blnRequireComment={$args['blnRequireComment']} " : "")."
				".(@$args['bytCommentRequirements'] != '' ? " AND bytCommentRequirements={$args['bytCommentRequirements']} " : "")."
				".(@$args['blnAllowBlankComments'] != '' ? " AND blnAllowBlankComments={$args['blnAllowBlankComments']} " : "")."
				".(@$args['blnTimeFormat'] != '' ? " AND blnTimeFormat={$args['blnTimeFormat']} " : "")."
				".(@$args['strAdministratorPassword'] != '' ? " AND strAdministratorPassword='{$args['strAdministratorPassword']}' " : "")."
				".(@$args['blnEmployeesViewHours'] != '' ? " AND blnEmployeesViewHours={$args['blnEmployeesViewHours']} " : "")."
				".(@$args['blnEmployeesPrintHours'] != '' ? " AND blnEmployeesPrintHours={$args['blnEmployeesPrintHours']} " : "")."
				".(@$args['strEmployeeReportFooter'] != '' ? " AND strEmployeeReportFooter='{$args['strEmployeeReportFooter']}' " : "")."
				".(@$args['blnWeeklyOvertime'] != '' ? " AND blnWeeklyOvertime={$args['blnWeeklyOvertime']} " : "")."
				".(@$args['blnDailyOvertime'] != '' ? " AND blnDailyOvertime={$args['blnDailyOvertime']} " : "")."
				".(@$args['dblWeeklyOTLimit'] != '' ? " AND dblWeeklyOTLimit={$args['dblWeeklyOTLimit']} " : "")."
				".(@$args['dblDailyOTLimit'] != '' ? " AND dblDailyOTLimit={$args['dblDailyOTLimit']} " : "")."
				".(@$args['dblHoursPerWeek'] != '' ? " AND dblHoursPerWeek={$args['dblHoursPerWeek']} " : "")."
				".(@$args['bytOTCalculation'] != '' ? " AND bytOTCalculation={$args['bytOTCalculation']} " : "")."
				".(@$args['bytTimeRounding'] != '' ? " AND bytTimeRounding={$args['bytTimeRounding']} " : "")."
				".(@$args['blnAutomaticBreakDeduction'] != '' ? " AND blnAutomaticBreakDeduction={$args['blnAutomaticBreakDeduction']} " : "")."
				".(@$args['dblAutomaticBreakLength'] != '' ? " AND dblAutomaticBreakLength={$args['dblAutomaticBreakLength']} " : "")."
				".(@$args['dblApplyAutomaticBreakAfter'] != '' ? " AND dblApplyAutomaticBreakAfter='{$args['dblApplyAutomaticBreakAfter']}' " : "")."
				".(@$args['blnHolidaysEffectOvertime'] != '' ? " AND blnHolidaysEffectOvertime={$args['blnHolidaysEffectOvertime']} " : "")."
				".(@$args['strDatabaseLocation'] != '' ? " AND strDatabaseLocation='{$args['strDatabaseLocation']}' " : "")."
				".(@$args['strInLabel'] != '' ? " AND strInLabel='{$args['strInLabel']}' " : "")."
				".(@$args['strOutLabel'] != '' ? " AND strOutLabel='{$args['strOutLabel']}' " : "")."
				".(@$args['strMyHoursLabel'] != '' ? " AND strMyHoursLabel='{$args['strMyHoursLabel']}' " : "")."
				".(@$args['strLastActionLabel'] != '' ? " AND strLastActionLabel='{$args['strLastActionLabel']}' " : "")."
				".(@$args['strSSNLabel'] != '' ? " AND strSSNLabel='{$args['strSSNLabel']}' " : "")."
				".(@$args['lngLastEmployeeID'] != '' ? " AND lngLastEmployeeID={$args['lngLastEmployeeID']} " : "")."
				".(@$args['lngStartingEmployeeID'] != '' ? " AND lngStartingEmployeeID={$args['lngStartingEmployeeID']} " : "")."
				".(@$args['lngEmployeeIDIncrement'] != '' ? " AND lngEmployeeIDIncrement={$args['lngEmployeeIDIncrement']} " : "")."
				".(@$args['bytFirstDayOfWeek'] != '' ? " AND bytFirstDayOfWeek={$args['bytFirstDayOfWeek']} " : "")."
				".(@$args['lngFiscalYearMonth'] != '' ? " AND lngFiscalYearMonth={$args['lngFiscalYearMonth']} " : "")."
				".(@$args['lngFiscalYearDay'] != '' ? " AND lngFiscalYearDay={$args['lngFiscalYearDay']} " : "")."
				".(@$args['blnRoundDown'] != '' ? " AND blnRoundDown={$args['blnRoundDown']} " : "")."
				".(@$args['blnNoClockSet'] != '' ? " AND blnNoClockSet={$args['blnNoClockSet']} " : "")."
				".(@$args['bytRequireAdminPassword'] != '' ? " AND bytRequireAdminPassword={$args['bytRequireAdminPassword']} " : "")."
				".(@$args['blnNoDesktop'] != '' ? " AND blnNoDesktop={$args['blnNoDesktop']} " : "")."
				".(@$args['strLicenseName'] != '' ? " AND strLicenseName='{$args['strLicenseName']}' " : "")."
				".(@$args['strKey'] != '' ? " AND strKey='{$args['strKey']}' " : "")."
				".(@$args['lngDatabaseSize'] != '' ? " AND lngDatabaseSize={$args['lngDatabaseSize']} " : "")."
				".(@$args['lngConnections'] != '' ? " AND lngConnections={$args['lngConnections']} " : "")."
				".(@$args['blnPaidBreak'] != '' ? " AND blnPaidBreak={$args['blnPaidBreak']} " : "")."
				".(@$args['sngPaidBreakLength'] != '' ? " AND sngPaidBreakLength={$args['sngPaidBreakLength']} " : "")."
				".(@$args['blnPayIfExceedBreak'] != '' ? " AND blnPayIfExceedBreak={$args['blnPayIfExceedBreak']} " : "")."
				".(@$args['blnAlwaysOnTop'] != '' ? " AND blnAlwaysOnTop={$args['blnAlwaysOnTop']} " : "")."
				".(@$args['blnPasswordCharPIN'] != '' ? " AND blnPasswordCharPIN={$args['blnPasswordCharPIN']} " : "")."
				".(@$args['blnShutdownWindowsOnClose'] != '' ? " AND blnShutdownWindowsOnClose={$args['blnShutdownWindowsOnClose']} " : "")."
				".(@$args['blnExclusiveFocus'] != '' ? " AND blnExclusiveFocus={$args['blnExclusiveFocus']} " : "")."
				".(@$args['blnPINsEncrypted'] != '' ? " AND blnPINsEncrypted={$args['blnPINsEncrypted']} " : "")."
				".(@$args['blnAccessDatabasePassword'] != '' ? " AND blnAccessDatabasePassword={$args['blnAccessDatabasePassword']} " : "")."
				".(@$args['blnSickVacationTimeEffectOvertime'] != '' ? " AND blnSickVacationTimeEffectOvertime={$args['blnSickVacationTimeEffectOvertime']} " : "")."
				".(@$args['blnUseInternetTimeServer'] != '' ? " AND blnUseInternetTimeServer={$args['blnUseInternetTimeServer']} " : "")."
				".(@$args['lngNTPServer'] != '' ? " AND lngNTPServer={$args['lngNTPServer']} " : "")."
				".(@$args['strCustomNTPServer'] != '' ? " AND strCustomNTPServer='{$args['strCustomNTPServer']}' " : "")."
				".(@$args['lngTimeOutputFormat'] != '' ? " AND lngTimeOutputFormat={$args['lngTimeOutputFormat']} " : "")."
				".(@$args['blnCheckForUpdatesOnStartup'] != '' ? " AND blnCheckForUpdatesOnStartup={$args['blnCheckForUpdatesOnStartup']} " : "")."
				".(@$args['strReportHeaderTemplate'] != '' ? " AND strReportHeaderTemplate='{$args['strReportHeaderTemplate']}' " : "")."
				".(@$args['strCompanyHeaderTemplate'] != '' ? " AND strCompanyHeaderTemplate='{$args['strCompanyHeaderTemplate']}' " : "")."
				".(@$args['strEmployeeDetailsTemplate'] != '' ? " AND strEmployeeDetailsTemplate='{$args['strEmployeeDetailsTemplate']}' " : "")."
				".(@$args['strEmployeeHeaderTemplate'] != '' ? " AND strEmployeeHeaderTemplate='{$args['strEmployeeHeaderTemplate']}' " : "")."
				".(@$args['strEmployeeSummaryTemplate'] != '' ? " AND strEmployeeSummaryTemplate='{$args['strEmployeeSummaryTemplate']}' " : "")."
				".(@$args['strEmployeeAccrualsTemplate'] != '' ? " AND strEmployeeAccrualsTemplate='{$args['strEmployeeAccrualsTemplate']}' " : "")."
				".(@$args['strPayrollInformationTemplate'] != '' ? " AND strPayrollInformationTemplate='{$args['strPayrollInformationTemplate']}' " : "")."
				".(@$args['strCurrency'] != '' ? " AND strCurrency='{$args['strCurrency']}' " : "")."
				".(@$args['bytCaptureImageOn'] != '' ? " AND bytCaptureImageOn={$args['bytCaptureImageOn']} " : "")."
				".(@$args['bytKeepImagesFor'] != '' ? " AND bytKeepImagesFor={$args['bytKeepImagesFor']} " : "")."
				".(@$args['blnEnableImageCapture'] != '' ? " AND blnEnableImageCapture={$args['blnEnableImageCapture']} " : "")."
				".(@$args['strCapturePath'] != '' ? " AND strCapturePath='{$args['strCapturePath']}' " : "")."
				".(@$args['lngFirstDayStartsAt'] != '' ? " AND lngFirstDayStartsAt={$args['lngFirstDayStartsAt']} " : "")."
				".(@$args['strPayDayAsOvertime'] != '' ? " AND strPayDayAsOvertime='{$args['strPayDayAsOvertime']}' " : "")."
				".(@$args['strClockInLabel'] != '' ? " AND strClockInLabel='{$args['strClockInLabel']}' " : "")."
				".(@$args['strClockOutLabel'] != '' ? " AND strClockOutLabel='{$args['strClockOutLabel']}' " : "")."
				".(@$args['strActionTypeLabel'] != '' ? " AND strActionTypeLabel='{$args['strActionTypeLabel']}' " : "")."
				".(@$args['strActionDateLabel'] != '' ? " AND strActionDateLabel='{$args['strActionDateLabel']}' " : "")."
				".(@$args['strActionTimeLabel'] != '' ? " AND strActionTimeLabel='{$args['strActionTimeLabel']}' " : "")."
				".(@$args['strEmployeesInLabel'] != '' ? " AND strEmployeesInLabel='{$args['strEmployeesInLabel']}' " : "")."
				".(@$args['strEmployeesOutLabel'] != '' ? " AND strEmployeesOutLabel='{$args['strEmployeesOutLabel']}' " : "")."
				".(@$args['strEmployeesLabel'] != '' ? " AND strEmployeesLabel='{$args['strEmployeesLabel']}' " : "")."
				".(@$args['strTimeNoteLabel'] != '' ? " AND strTimeNoteLabel='{$args['strTimeNoteLabel']}' " : "")."
				".(@$args['strViewInformationLabel'] != '' ? " AND strViewInformationLabel='{$args['strViewInformationLabel']}' " : "")."
				".(@$args['strSearchForEmployeeLabel'] != '' ? " AND strSearchForEmployeeLabel='{$args['strSearchForEmployeeLabel']}' " : "")."
				".(@$args['strNoActionLabel'] != '' ? " AND strNoActionLabel='{$args['strNoActionLabel']}' " : "")."
				".(@$args['strMothersMaidenName'] != '' ? " AND strMothersMaidenName='{$args['strMothersMaidenName']}' " : "")."
				".(@$args['strCityYouWereBornIn'] != '' ? " AND strCityYouWereBornIn='{$args['strCityYouWereBornIn']}' " : "")."
				".(@$args['blnDailyOvertime2'] != '' ? " AND blnDailyOvertime2={$args['blnDailyOvertime2']} " : "")."
				".(@$args['blnSeventhDayOvertime'] != '' ? " AND blnSeventhDayOvertime={$args['blnSeventhDayOvertime']} " : "")."
				".(@$args['dblDailyOTLimit2'] != '' ? " AND dblDailyOTLimit2={$args['dblDailyOTLimit2']} " : "")."
				".(@$args['dblSeventhDayOTLimit'] != '' ? " AND dblSeventhDayOTLimit={$args['dblSeventhDayOTLimit']} " : "")."
				".(@$args['blnUseFingerprintScanner'] != '' ? " AND blnUseFingerprintScanner={$args['blnUseFingerprintScanner']} " : "")."
				".(@$args['strEncryptedAdminPassword'] != '' ? " AND strEncryptedAdminPassword='{$args['strEncryptedAdminPassword']}' " : "")."
				".(@$args['blnReportEmployeePageBreak'] != '' ? " AND blnReportEmployeePageBreak={$args['blnReportEmployeePageBreak']} " : "")."
				".(@$args['blnEnableTimeDataLogging'] != '' ? " AND blnEnableTimeDataLogging={$args['blnEnableTimeDataLogging']} " : "")."
				".(@$args['blnShowDepartmentFolders'] != '' ? " AND blnShowDepartmentFolders={$args['blnShowDepartmentFolders']} " : "")."
				".(@$args['blnEmployeeJobCreation'] != '' ? " AND blnEmployeeJobCreation={$args['blnEmployeeJobCreation']} " : "")."
				".(@$args['bytEmployeeListFontSize'] != '' ? " AND bytEmployeeListFontSize={$args['bytEmployeeListFontSize']} " : "")."
				".(@$args['blnPasswordProtectEmployeeSpreadsheet'] != '' ? " AND blnPasswordProtectEmployeeSpreadsheet={$args['blnPasswordProtectEmployeeSpreadsheet']} " : "")."
				".(@$args['blnAutoLogout'] != '' ? " AND blnAutoLogout={$args['blnAutoLogout']} " : "")."
				".(@$args['blnTipTracking'] != '' ? " AND blnTipTracking={$args['blnTipTracking']} " : "")."
				".(@$args['strJobLabel'] != '' ? " AND strJobLabel='{$args['strJobLabel']}' " : "")."
			ORDER BY strCompanyName";
		$results = $db->getAll($query);
		
		$items = array();
		foreach ($results as $r) {
			$obj = new Setting();
			$obj->setPropertyValues($r);
			$obj->exists = true;
			
			array_push($items, $obj);
		}
		
		return $items;
	}
	
	public function getCount()
	{
		global $db;
		
		$query = "SELECT count(*) FROM ".self::$tableName;
		return $db->getOne($query);
	}
	
	public function save($delete=0)
	{	
		/*
		global $login_info;

		$user = $login_info->get_user_info();
		
		$this->modified_by = (isset($user['first_name']) ? $user['first_name'].' '.$user['last_name'] : $user['username']);
		*/
		//$this->last_modified = date("Y-m-d G:i:s");
		//$this->deleted = ($delete == 1 || $delete === true ? '1' : '0');
		
		// create query
		$query = ($this->exists ? $this->updateString(self::$tableName, 'lngID') : $this->insertString(self::$tableName));

		// prepare query
		$stmt = $this->db->prepare($query);

		// execute statement
		$result =& $this->db->execute($stmt);
		
		/*if (PEAR::isError($result)) {
			throw new Exception($result->getMessage());
		}*/
		
		return $result;
	}
	
	public function delete($method='hard')
	{
		if ($method == 'soft')
			return $this->save(1);
			
		// create query
		$query="DELETE FROM ".self::$tableName." WHERE lngID=".$this->lngID;

		// prepare query
		$stmt = $this->db->prepare($query);

		// execute statement
		$result =& $this->db->execute($stmt);
		
		/*if (PEAR::isError($result)) {
			throw new Exception($result->getMessage());
		}*/
		
		return $result;
	}
}
