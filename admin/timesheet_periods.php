<?php
//try
require_once("includes/view_included.php");
//require_once("includes/PagedResult.php");
//require_once("includes/TimesheetPeriod.php");

$status->destination = "timesheet_periods";

$fields = array();
$fields['start_date'] = $db->escapeSimple(trim(@$_REQUEST['start_date']));
$fields['end_date'] = $db->escapeSimple(trim(@$_REQUEST['end_date']));

// pager fields
$fields['sort_by'] = (isset($_REQUEST['sort_by']) ? $db->escapeSimple(trim($_REQUEST['sort_by'])) : "start_date_a");
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
	'start_date' => array($fields['start_date'], 'eq'),
	'end_date' => array($fields['end_date'], 'eq'),
    )
);
$pager->table = TimesheetPeriod::$tableName;
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
			if ($('input.timesheet_periods:checked').size() == 0)
			{
				alert('Please select at least one item to delete');
				return false;
			}
		
			if (confirm("Are you sure that you want to remove the selected items?")) 
			{
				var link='controller.php?action=delete_timesheet_period';
				$('input.timesheet_periods:checked').each(function(){
					link += '&id[]='+$(this).val();
				});
				link += '&popup_destination=<?= @$popup_destination; ?>';
				location.href=(link);
			}
		});
		$('#timesheet_periods_all').click(function(){
			$('.timesheet_periods').attr('checked', $('#timesheet_periods_all').attr('checked'));
		});
		$('.timesheet_periods').click(function(){
			if ($(this).attr('checked') == false && $('#timesheet_periods_all').attr('checked'))
				$('#timesheet_periods_all').removeAttr('checked');
		});
	});
</script>

<div class="page_title">Manage Timesheet Periods</div>

<form method="get" action="<?= $_SERVER['PHP_SELF']; ?>">
	<input type="hidden" name="view" value="timesheet_periods"/>
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

			<div style="search_field_wrapper" id="sf_start_date">
				<div class="search_field_label">Start Date:</div>
				<div class="search_field"><script type='text/javascript'>DateTimeInput('start_date', false, 'date', '<?php if ($fields['start_date'] != '') {
	echo date('Y-m-d G:i:s', strtotime($fields['start_date']));
} ?>')</script></div>
			</div>

			<div style="search_field_wrapper" id="sf_end_date">
				<div class="search_field_label">End Date:</div>
				<div class="search_field"><script type='text/javascript'>DateTimeInput('end_date', false, 'date', '<?php if ($fields['end_date'] != '') {
	echo date('Y-m-d G:i:s', strtotime($fields['end_date']));
} ?>')</script></div>
			</div>
			<div style="clear: both;"></div>
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
					<input type="button" value="Reset Form" class="button btn-reload" style="width:100px;" onClick="location='?view=timesheet_periods&reset'"/>
				</div>
			</div>
			<div style="clear: both;"></div>
		</div>
	</div>

	<br/>

	<div class="filter_box">
		<table width="100%">
			<tr>
				<?php if (accessible_permission("add_timesheet_period", "view")) { ?>
					<td style="padding-right:10px;border-right:solid 1px maroon;width:180px;">
						<input type="button" value="Add Timesheet Period" onClick="location='?view=add_timesheet_period'" class="button btn-add" style="width:180px;"/>
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
<?php if (accessible_permission("delete_timesheet_period_model", "model")) { ?>
				<td width="50" align="center">Delete</td>
				<!--<td width="40" align="center" style="padding:0"><input type="checkbox" id="timesheet_periods_all" title="Select all items on this page"/></td>-->
<?php } ?>
			<td>
				Start Date
				<input type="image" onclick="sort_by.value='start_date_a';" src='<?= COMMON_FILES_PATH; ?>images/icons/arrow_up_16.gif' width="10" height="10" />
				<input type="image" onclick="sort_by.value='start_date_d';" src='<?= COMMON_FILES_PATH; ?>images/icons/arrow_down_16.gif' width="10" height="10" />
			</td>
			<td>
				End Date
				<input type="image" onclick="sort_by.value='end_date_a';" src='<?= COMMON_FILES_PATH; ?>images/icons/arrow_up_16.gif' width="10" height="10" />
				<input type="image" onclick="sort_by.value='end_date_d';" src='<?= COMMON_FILES_PATH; ?>images/icons/arrow_down_16.gif' width="10" height="10" />
			</td>
			<td>
				View Timesheet
			</td>
			<!--td>timesheetPeriod->start_date</td-->
		</tr>

		<?php
		$i = 0;
		foreach ($pager->results as $row) {
			$i++;
			$timesheetPeriod = new TimesheetPeriod();
			$timesheetPeriod->setPropertyValues($row);
			?>
			<tr class="grid-row<?= ($i % 2) ?>">
	<?php if (accessible_permission("delete_timesheet_period_model", "model")) { ?>
					<td align="center">
						<a href='controller.php?action=delete_timesheet_period&id=<?= $timesheetPeriod->timesheet_period_id; ?>&popup_destination=<?= @$popup_destination; ?>' onClick='return confirm("Are you sure that you want to delete this timesheet_period?");'><img src='<?= COMMON_FILES_PATH; ?>images/icons/delete.gif' /></a>
						<!--<input type="checkbox" class="timesheet_periods" name="id[]" value="<?= $timesheetPeriod->timesheet_period_id; ?>"/>-->
					</td>
					<?php } ?>
				<td>
					<?php
					if (accessible_permission("add_timesheet_period", "view")) {
						echo "<a href='?view=add_timesheet_period&id=" . $timesheetPeriod->timesheet_period_id . "'>" . date('m/d/Y', strtotime($timesheetPeriod->start_date)) . "</a>";
					}
					else
						echo date('m/d/Y', strtotime($timesheetPeriod->start_date));
					?>
				</td>
				<td>
					<?php
					if (accessible_permission("add_timesheet_period", "view")) {
						echo "<a href='?view=add_timesheet_period&id=" . $timesheetPeriod->timesheet_period_id . "'>" . date('m/d/Y', strtotime($timesheetPeriod->end_date)) . "</a>";
					}
					else
						echo date('m/d/Y', strtotime($timesheetPeriod->end_date));
					?>
				</td>
				<td>
					<?php
					if (accessible_permission("add_timesheet_form", "view")) {
						echo "<a href='?view=add_timesheet_form&date=". date('Y-m-d', strtotime($timesheetPeriod->start_date)) . "'> view timesheet </a>";
					}
					?>
				</td>
				<!--<td><?php //echo $timesheetPeriod->start_date;?></td>-->
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
<?php /* if (accessible_permission("delete_timesheet_period_model","model")) { ?>
  <b>Action:</b> <a href='javascript:void(0)' class="link btn-delete" id='batch_delete'>Remove selected</a>
  <?php } */ ?> 
			</td>
			<td colspan="2" align="right"><?= $results; ?></td>
		</tr>
	</table>

</form>
