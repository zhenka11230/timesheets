<?php
ob_start();
session_start();
$view_included = 1;

require_once("application_info.php");

$view = @trim($_GET['view']);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
	<title>Timesheets Management System</title>

	<link rel="icon" type="image/x-icon" href="<?=COMMON_FILES_PATH;?>images/library/library.ico">

	<link rel="stylesheet" type="text/css" href="<?=COMMON_FILES_PATH;?>styles/admin.css"/>
	<link rel="stylesheet" type="text/css" href="<?=COMMON_FILES_PATH;?>scripts/jquery/jquery-ui/jquery-ui.css"/>
	<link rel="stylesheet" type="text/css" href="<?=COMMON_FILES_PATH;?>scripts/jquery/fancybox/fancybox.css" />
	<link rel="stylesheet" type="text/css" href="<?=COMMON_FILES_PATH;?>scripts/ddlevelsmenu/ddlevelsmenu.css" />
	<link rel="stylesheet" type="text/css" href="<?=COMMON_FILES_PATH;?>scripts/jquery/poshytip/tip-darkgray/tip-darkgray.css"/>
	<link rel="stylesheet" type="text/css" href="<?=COMMON_FILES_PATH;?>scripts/jquery/poshytip/tip-twitter/tip-twitter.css"/>
	<link rel="stylesheet" type="text/css" href="<?=COMMON_FILES_PATH;?>scripts/jquery/poshytip/tip-maroon/tip-maroon.css"/>
	<!--<link rel="stylesheet" type="text/css" href="<?=COMMON_FILES_PATH;?>scripts/jquery/treeview/jquery.treeview.css"/>-->

	<script type="text/javascript" src="<?=COMMON_FILES_PATH;?>scripts/email.js"></script>
	<script type="text/javascript" src="<?=COMMON_FILES_PATH;?>scripts/common.js"></script>
	<script type="text/javascript" src="<?=COMMON_FILES_PATH;?>scripts/overlib/overlib.js"></script>
	<script type="text/javascript" src="<?=COMMON_FILES_PATH;?>scripts/DateTimeInput.js"></script>
	<!--<script type="text/javascript" src="<?=COMMON_FILES_PATH;?>scripts/tiny_mce/tiny_mce.js"></script>-->
	<!--<script type="text/javascript" src="<?=COMMON_FILES_PATH;?>scripts/ypSlideOutMenusC.js"></script>-->

	<script type="text/javascript" src="<?=COMMON_FILES_PATH;?>scripts/jquery/jquery.js"></script>
	<script type="text/javascript" src="<?=COMMON_FILES_PATH;?>scripts/jquery/jquery-ui/jquery-ui.js"></script>
	<script type="text/javascript" src="<?=COMMON_FILES_PATH;?>scripts/jquery/fancybox/fancybox.js"></script>
	<script type="text/javascript" src="<?=COMMON_FILES_PATH;?>scripts/jquery/poshytip/poshytip.js"></script>
	<script type="text/javascript" src="<?=COMMON_FILES_PATH;?>scripts/ddlevelsmenu/ddlevelsmenu.js"></script>
	<!--<script type="text/javascript" src="<?=COMMON_FILES_PATH;?>scripts/jquery/treeview/jquery.treeview.js"></script>-->
	<!--<script type="text/javascript" src="<?=COMMON_FILES_PATH;?>scripts/jquery/treeview/lib/jquery.cookie.js"></script>-->

	<script type="text/javascript">
	$(document).ready(function() 
	{
		// set default functionality of JQuery UI Datepicker
		$.datepicker.setDefaults({
			showAnim:'slideDown', 
			dateFormat: 'yy-mm-dd', 
			showOn: 'button', 
			buttonImage: '<?=COMMON_FILES_PATH;?>images/calendar/calendar.jpg', 
			buttonImageOnly: true, 
			showButtonPanel: true,
			changeMonth: true, 
			changeYear: true});
		
		// activate datepicker
		$(".datepicker").datepicker();

		// activate fancybox/colorbox/thickbox
		$('.fancybox, .colorbox, .thickbox').fancybox({
				'transitionIn'	: 'elastic',
				'transitionOut'	: 'elastic',
				'padding'		: 3,
				'margin'		: 0,
				'width'		: '90%',
				'height'		: '90%',
				'centerOnScroll' : true,
				'autoScale' : true,
				'modal' 	: true,
				'type'	: 'iframe'
			});
		// show images in a stylish way (just image and title)
		$('img.fancybox, img.colorbox').fancybox({
				'transitionIn'	: 'elastic',
				'transitionOut'	: 'elastic',
				'titlePosition'	: 'over'
			});
			
		// show tooltip if it is set
		$('.poshytip[title!=""]').poshytip({
			className: 'tip-maroon',
			showOn: 'hover',
			alignTo: 'target',
			alignX: 'center',
			alignY: 'top',
			offsetY: 5,	
			allowTipHover: false,
			fade: false,
			slide: false
		});
	});
	</script>
</head>
<body>

<a name="top"></a>

<div id="shadow_side">
	<div id="overDiv" style="position:absolute;text-align:left;visibility:hidden;z-index:1000;"></div>
	<div id="container">

		<div class="banner wims">
			<div id="banner-heading">Timesheets</div>
			<div id="banner-sub_heading">Management System</div>
			<div id="banner-welcome">Welcome
				<?php
				if($logged_in === 1) {
					$visitor = $login_info->get_user_info();
					echo (!isset($visitor['first_name']) ? $visitor['username'] : $visitor['first_name']);
				}
				else{
					echo " - Please Login";
				}
				?>
			</div>
		</div>

		<div id="navigation">
			<?php include("includes/menu.php"); ?>
		</div>

		<div id="content">

			<div id='my_alert'>
				<img id='my_alert_close' align='right' src='<?=COMMON_FILES_PATH;?>images/icons/cancel_16.gif'/>
				<b></b>:<br/>
				<span></span>
			</div>
			
			<?php
			if(is_object($status) && !$status->blank()){
				echo "<div class='status_box ".@$status->status."'><b>".$status->status.":</b><br/>".$status->message."</div>";
			}
			$status = new Status();

			$view = @$_REQUEST['view'];

			if ($logged_in === 1)
			{
				switch ($view)
				{
					
					case "add_timesheet_form":

					case "timesheet_periods":
					case "add_timesheet_period":

					case "employee_mappings":
					case "add_employee_mapping":

					case "tblBulletinAcceptances":
					case "add_tblBulletinAcceptance":
					case "Timesheet_wrapper":
					case "tblBulletinAssignments":
					case "add_tblBulletinAssignment":
					
					case "tblBulletins":
					case "add_tblBulletin":
					
					case "tblComputers":
					case "add_tblComputer":
					
					case "tblConnections":
					case "add_tblConnection":
					
					case "tblDepartments":
					case "add_tblDepartment":
					
					case "tblEmployees":
					case "add_tblEmployee":
					
					case "tblEmploymentTypes":
					case "add_tblEmploymentType":
					
					case "tblExportFormats":
					case "add_tblExportFormat":
					
					case "tblHolidaies":
					case "add_tblHoliday":
					
					case "tblJobs":
					case "add_tblJob":
					
					case "tblSettings":
					case "add_tblSetting":
					
					case "tblShifts":
					case "add_tblShift":
					
					case "tblTimeLoggings":
					case "add_tblTimeLogging":
					
					case "tblTimeNotes":
					case "add_tblTimeNote":
					
					case "tblTimes":
					case "add_tblTime":
					
					case "tblTipPayments":
					case "add_tblTipPayment":
					
					case "tblTips":
					case "add_tblTip":
					
						$status = include_validated(VIEW_ROOT.'/'.$view.".php", "view");
						break;

					default:
						$view="home";
						$status = require_once(VIEW_ROOT.'/'.$view.".php");
						break;
				}
			}
			else
			{
				// these pages are accessible when not logged in
				switch($view)
				{
					case "help":
					//case "home":
						$status = require_once(VIEW_ROOT.'/'.$view.".php");
						break;
					default:
						$redir = $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'];
						$view = "login";
						$status = require_once(VIEW_ROOT.'/'.$view.".php");
						break;
				}
			}
			?>
		</div>

		<div id="footer">
			<div><a href="mailto:LibraryWebmaster@brooklyn.cuny.edu?subject=Timesheets">Contact Webmaster</a> | <a href="http://library.brooklyn.cuny.edu/" target="_blank">Library Homepage</a> | <a href="http://www.brooklyn.cuny.edu/" target="_blank">Brooklyn College Homepage</a></div>
			<div>Designed and Developed by the <a href="http://ait.brooklyn.cuny.edu/" target="_blank">Office of Academic Information Technologies</a></div>
			<div>Brooklyn College Library, All Rights Reserved &copy; <?=date("Y");?></div>
			<div id="page_last_modified"><?="Last updated: " . date ("M j, Y g:ia", filemtime(VIEW_ROOT.'/'.$view.".php"));?></div>
		</div>
	</div>
</div>
<div id="shadow_bottom">&nbsp;</div>

</body>
</html>
<?php
if (is_object($status) && !$status->blank())
{
	$_SESSION[APPLICATION_NAME]['status'] = serialize($status);
	header("Location: index.php?view=".$status->destination);
	die();
}

unset($_SESSION[APPLICATION_NAME]['form_data']);
ob_end_flush();
?>
