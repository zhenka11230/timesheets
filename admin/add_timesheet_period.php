<?php
require_once("includes/view_included.php");
//require_once("includes/TimesheetPeriod.php");

$status->destination = "add_timesheet_period";

$id = $db->escapeSimple(trim(@$_REQUEST['id']));
if ($id > 0) {
	$status->destination = "add_timesheet_period&id=".$id;
}

if (isset($_SESSION[APPLICATION_NAME]['form_data']))
{
	$values = $_SESSION[APPLICATION_NAME]['form_data'];
	unset($_SESSION[APPLICATION_NAME]['form_data']);
	
	$timesheetPeriod = new TimesheetPeriod(@$id);
	$timesheetPeriod->setPropertyValues($values);
}
else {
	$timesheetPeriod = new TimesheetPeriod($id);
	$timesheetPeriod->setPropertyValues($_REQUEST);
}
?>
<script type="text/javascript">
	$(document).ready(function() {
		<?php if (!accessible_permission("add_timesheet_period_model","model")) { ?>
		$('#save_btn').attr({'class':'button btn-readonly','title':'<?=ERR_READONLY;?>'});
		$('#add_frm').submit(function(){alert('<?=ERR_READONLY;?>');return false;});
		<?php } ?>
		<?php if (!$timesheet_period->exists) { ?>
		document.forms[0].start_date.focus();
		<?php } ?>
	});
</script>

<div class="page_title"><?=$timesheetPeriod->exists ? "Update" : "Add"?> Timesheet Period</div>

<form id="add_frm" action="controller.php?action=<?=$status->destination;?>" method="POST">

<input type="hidden" name="popup_destination" value="<?=@$popup_destination;?>"/>
<input type="hidden" name="force_postback" value=""/>

<table class="grid-def">
<tr class="grid-row_header">
	<td colspan="2">Timesheet Period Information</td>
</tr>
<tr>
	<td class="grid-space" width="55%">
		<table class="grid-form">

		<tr>
			<td class="column_label" style="vertical-align:middle;"><?=AttributeReader::PropertyAttributes($timesheetPeriod,'start_date')->Description;?>: <span class="hint" onmouseover="return overlib('Required Field');" onmouseout="return nd();">&nbsp;</span></td>
			<td>
				<script type='text/javascript'>DateTimeInput('start_date', false, 'date', '<?php if($timesheetPeriod->start_date != ''){echo date('Y-m-d G:i:s',strtotime($timesheetPeriod->start_date));}?>')</script>
			</td>
		</tr>
		<tr>
			<td class="column_label" style="vertical-align:middle;"><?=AttributeReader::PropertyAttributes($timesheetPeriod,'end_date')->Description;?>: <span class="hint" onmouseover="return overlib('Required Field');" onmouseout="return nd();">&nbsp;</span></td>
			<td>
				<script type='text/javascript'>DateTimeInput('end_date', false, 'date', '<?php if($timesheetPeriod->end_date != ''){echo date('Y-m-d G:i:s',strtotime($timesheetPeriod->end_date));}?>')</script>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>
				<input type="submit" style="width: 65px;" class="button btn-save" value="Save" id="save_btn" />
				<input type="button" style="width: 80px;" class="button btn-cancel" value="Cancel" onclick="window.location.replace('?view=timesheet_periods');" />
			</td>
		</tr>
		</table>
	</td>
	<?php /*if (@$timesheetPeriod->exists) { ?>
	<td class="grid-space">
		<div class="column_label">Related-view (<a class="fancybox" href="popup_index.php?view=related-view&id=<?=$timesheetPeriod->timesheet_period_id;?>&source=<?=urlencode($status->destination);?>">Manage</a>)</div>
		<ul class="dot">
			<?php
			foreach ($items = RelatedClass::getRelatedObjects(array('timesheet_period_id'=>$timesheetPeriod->timesheet_period_id)) as $r)
			{
				?><li><b><a class="fancybox" href="popup_index.php?view=add_related_view&id=<?=$r->timesheet_period_id;?>&source=<?=urlencode($status->destination);?>"><?=$r->related_name;?></a></li><?php
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
