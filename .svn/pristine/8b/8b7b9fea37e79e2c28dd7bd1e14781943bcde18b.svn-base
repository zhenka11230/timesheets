<?php
$tabs = array(
	//"TblBulletinAcceptances" => array("tblBulletinAcceptances", "add_tblBulletinAcceptance"),
	//"TblBulletinAssignments" => array("tblBulletinAssignments", "add_tblBulletinAssignment"),
	//"TblBulletins" => array("tblBulletins", "add_tblBulletin"),
	//"TblComputers" => array("tblComputers", "add_tblComputer"),
	//"TblConnections" => array("tblConnections", "add_tblConnection"),
	"Timesheets" => array("add_timesheet_form"),
	//"Employee-User Mappings" => array("employee_mappings", "add_employee_mapping"),
	"Pay Periods" => array("timesheet_periods", "add_timesheet_period"),
	"Employees" => array("tblEmployees", "add_tblEmployee"),
	"Times IN/OUT" => array("tblTimes", "add_tblTime"),
	"Employment Types" => array("tblEmploymentTypes", "add_tblEmploymentType"),
	"Departments" => array("tblDepartments", "add_tblDepartment"),
	//"TblExportFormats" => array("tblExportFormats", "add_tblExportFormat"),
	//"TblHolidaies" => array("tblHolidaies", "add_tblHoliday"),
	//"TblJobs" => array("tblJobs", "add_tblJob"),
	//"TblSettings" => array("tblSettings", "add_tblSetting"),
	//"TblShifts" => array("tblShifts", "add_tblShift"),
	//"TblTimeLoggings" => array("tblTimeLoggings", "add_tblTimeLogging"),
	//"TblTimeNotes" => array("tblTimeNotes", "add_tblTimeNote"),
	//"TblTipPayments" => array("tblTipPayments", "add_tblTipPayment"),
	//"TblTips" => array("tblTips", "add_tblTip"),
);
$sub_tabs = array(
	/*"[main-view]" => array(
		array("TblBulletinAcceptances", "tblBulletinAcceptances"),
		array("TblBulletinAssignments", "tblBulletinAssignments"),
		array("TblBulletins", "tblBulletins"),
		array("TblComputers", "tblComputers"),
		array("TblConnections", "tblConnections"),
		array("TblDepartments", "tblDepartments"),
		array("TblEmployee", "tblEmployee"),
		array("TblEmploymentTypes", "tblEmploymentTypes"),
		array("TblExportFormats", "tblExportFormats"),
		array("TblHolidaies", "tblHolidaies"),
		array("TblJobs", "tblJobs"),
		array("TblSettings", "tblSettings"),
		array("TblShifts", "tblShifts"),
		array("TblTimeLoggings", "tblTimeLoggings"),
		array("TblTimeNotes", "tblTimeNotes"),
		array("TblTimes", "tblTimes"),
		array("TblTipPayments", "tblTipPayments"),
		array("TblTips", "tblTips"),
	),*/
);
?>
<div id="ddtopmenubar" class="tabs">
<ul>
	<li class="left spacer">&nbsp;</li>
	<?php if ($logged_in != 0) { ?>
		<li><a href='?view=home' <?=(in_array($view, array("", "home", "login", "error"))?"class='active'":"");?>><span>Home</span></a></li>
		<li class="left spacer">&nbsp;</li>
		<?php
		// for every tab
		foreach($tabs as $key => $r) 
		{
			// go thru all sub menu items and display the main tab if user has access to at least one sub menu item
			foreach($r as $sub_menu) 
			{
				if (accessible_permission($sub_menu, "view")) {
					?><li><a <?=(in_array($view, $r) ? "class='active'":"");?> <?=(in_array($r[0],array_keys($sub_tabs)) ? "rel='ddsubmenu-{$r[0]}'":"");?> href='?view=<?=$r[0];?>'><span><?=$key;?></span></a></li><?php
					break;
				}
			}
		}
	}
	?>
	<li class="right spacer">&nbsp;</li>
	<?php if ($logged_in == 0) { ?>
		<li class="right"><a href="?view=login" class="active"><span>Login</span></a></li>
	<?php } else { ?>
		<li class="right"><a href="http://<?=$_SERVER['SERVER_NAME']?>/mylibrary/controller.php?action=logout&redir=<?=urlencode($_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING']);?>&app=<?=APPLICATION_NAME;?>"><span>Logout</span></a></li>
	<?php } ?>
	<li class="right"><a href="http://<?=$_SERVER['SERVER_NAME']?>/mylibrary/" rel='ddsubmenu-mylibrary'><span>MyLibrary</span></a></li>
</ul>
</div>

<script type="text/javascript">
//ddlevelsmenu.setup("mainmenuid", "topbar|sidebar")
ddlevelsmenu.setup("ddtopmenubar", "topbar") 
</script>

<?php
	if ($logged_in != 1) return;

	foreach($sub_tabs as $mainview => $subviews)
	{
		echo '<ul id="ddsubmenu-'.$mainview.'" class="ddsubmenustyle">';
		foreach($subviews as $r)
		{
			$v = $r[1];
			// possible parameters sent to submenu items, should check only view itself
			if (strpos($r[1], '&') > 0)
				$v = substr($r[1], 0, strpos($r[1], '&'));
			if (accessible_permission($v, "view")) {
				?><li><a href='?view=<?=$r[1];?>'><span><?=$r[0];?></span></a></li><?php
			}
		}
		echo '</ul>';
	}
?>

<ul id="ddsubmenu-mylibrary" class="ddsubmenustyle">
<?php
foreach ($login_info->get_application_list() as $app_id)
{
	$app = $login_info->get_application_info($app_id);

	// show everything except current app
	if ($app_id == APPLICATION_ID) continue;
	?>
	<li><?php
		if (@$app['application_path'] != "") {
			if (@$app['application_icon'] == "") $app['application_icon'] = 'wims.png';
			?><a href="<?=$app['application_path'];?>" title="<?=@$app['application_note'];?>" <?=(preg_match('/http:/',@$app['application_path'])?"target='_blank'":"")?>><img src="/mylibrary/images/icons/<?=@$app['application_icon'];?>" height="20" align="top"/>&nbsp;<span><?=$app['application_name'];?></span></a><?php
		}
		else {
			?><span><?=$app['application_name'];?></span><?php
		}
		?>
	</li>
	<?php
}
?>
</ul>
