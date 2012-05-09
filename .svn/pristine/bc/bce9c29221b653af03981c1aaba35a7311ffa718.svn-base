<?php
ob_start();
session_start();
$view_included = 1;

require_once("application_info.php");

$view = @trim($_GET['view']);
$popup_destination = "popup_index";

// save source view in session until postback
if (isset($_REQUEST['source'])) {
	$_SESSION['source'] = urlencode($_REQUEST['source']);
}
// after successful action, postback original form
if ($status->status == "Success")
{
	if (isset($_SESSION['source']))
	{
		$status->destination = $_SESSION['source'];
		unset($_SESSION['source']);
		$_SESSION[APPLICATION_NAME]['status'] = serialize($status);

		die("
			<script>
			if (top.window.document.forms.length > 0 && top.window.document.forms[0].force_postback) {
				top.window.document.forms[0].force_postback.value='true';
				top.window.document.forms[0].submit();
			}
			else {
				top.window.location.reload();// = 'index.php?view=".urldecode($status->destination)."';//
			}
			</script>
			<p align='center'><img src='".COMMON_FILES_PATH."images/loading-maroon.gif' style='border:0;width:25px;'/><br/>Loading, please wait...</p>");
	}
}
//print_r($_GET);
//echo $_SESSION['source'];
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
	<script type="text/javascript" src="<?=COMMON_FILES_PATH;?>scripts/calendarDateInput.js"></script>
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
<body style="background-color:#FFF7EF;">
	<div style="background:#5F0000;padding:2px;">
		<div style="float:left;width:32%;text-align:left;">
			<!-- <input type="button" class="button btn-go_prev" style="width:85px;" onclick="self.history.back(-1)" value="Go Back"> -->
			<input type="button" class="button btn-reload" style="width:82px;" onclick="location.reload()" value="Refresh">
		</div>

		<div style="float:right;width:32%;text-align:right;">
			<input type="button" class="button btn-cancel" style="width:65px;" onclick="parent.$.fancybox.close();//top.window.tb_remove();//" value="Close" title="Close this Window">
		</div>
		
		<div style="float:right;width:34%;padding-right:10px;"></div>
		<span style="line-height:25px;">&nbsp;</span>
	</div>
	<div id="overDiv" style="position:absolute;visibility:hidden;z-index:1000;"></div>
	<div id="content">

		<div id='my_alert'>
			<img id='my_alert_close' align='right' src='<?=COMMON_FILES_PATH;?>images/icons/cancel_16.gif'/>
			<b></b>:<br/>
			<span></span>
		</div>
		
		<?php
		// Display any error messages stored in status
		if(is_object($status) && !$status->blank()){
			echo "<div id='status_box' class='status_box ".@$status->status."'>".$status->status.":<br/>".$status->message."</div>";
		}
		$status = new Status();

		if ($logged_in === 1)
		{
			switch($view)
			{	
				case "tblBulletinAcceptances":
				case "add_tblBulletinAcceptance":
				
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
				
				case "tblEmployee":
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
				
					break;

				// If input is unknown, force it to a known case.
				default:
					$view = "home";
			}
			$status = require_once(VIEW_ROOT.'/'.$view.".php");
		}
		?>
		<!-- <div align="center" style="margin-top:20px;">
			<input type="button" class="button btn-cancel" style="width:150px" onclick="parent.$.fancybox.close();//top.window.tb_remove();//" value="Close this Window">
		</div> -->
	</div>
</body>
</html>
<?php
if (is_object($status) && !$status->blank())
{
	$_SESSION[APPLICATION_NAME]['status'] = serialize($status);
	header("Location: popup_index.php?view=".$status->destination);
	die();
}

unset($_SESSION[APPLICATION_NAME]['form_data']);
ob_end_flush();
?>
