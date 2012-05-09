<?php
require_once("includes/view_included.php");
//require_once("includes/PagedResult.php");
//require_once("includes/Time.php");

$status->destination = "tblTimes";

$fields = array();
//$fields['lngEmployeeID'] = (isset($_REQUEST['lngEmployeeID']) && !empty($_REQUEST['lngEmployeeID'][0]) ? $_REQUEST['lngEmployeeID']:array());
$fields['lngEmployeeID'] = (trim(@$_REQUEST['lngEmployeeID']) != "" ? (int)$_REQUEST['lngEmployeeID']:"");
$fields['datEvent'] = $db->escapeSimple(trim(@$_REQUEST['datEvent']));
$fields['blnEventType'] = $db->escapeSimple(trim(@$_REQUEST['blnEventType']));
$fields['blnEdited'] = $db->escapeSimple(trim(@$_REQUEST['blnEdited']));
$fields['lngClassificationID'] = $db->escapeSimple(trim(@$_REQUEST['lngClassificationID']));
$fields['lngDelegateID'] = $db->escapeSimple(trim(@$_REQUEST['lngDelegateID']));
$fields['strHash'] = $db->escapeSimple(trim(@$_REQUEST['strHash']));
$fields['lngDepartmentID'] = $db->escapeSimple(trim(@$_REQUEST['lngDepartmentID']));
$fields['bytOvertimeCalculationMethod'] = $db->escapeSimple(trim(@$_REQUEST['bytOvertimeCalculationMethod']));
$fields['lngComputerID'] = $db->escapeSimple(trim(@$_REQUEST['lngComputerID']));
$fields['lngJobID'] = $db->escapeSimple(trim(@$_REQUEST['lngJobID']));
$fields['strFullName'] = $db->escapeSimple(trim(@$_REQUEST['strFullName']));

// pager fields
$fields['sort_by'] = (isset($_REQUEST['sort_by']) ? $db->escapeSimple(trim($_REQUEST['sort_by'])) : "datEvent_a");
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
		'lngEmployeeID' => array($fields['lngEmployeeID'],'='),
		'datEvent' => array($fields['datEvent'],'date_eq'),
		'blnEventType' => array($fields['blnEventType'],'bool'),
		'blnEdited' => array($fields['blnEdited'],'bool'),
		'lngClassificationID' => array($fields['lngClassificationID'],'like'),
		'lngDelegateID' => array($fields['lngDelegateID'],'like'),
		'strHash' => array($fields['strHash'],'like'),
		'lngDepartmentID' => array($fields['lngDepartmentID'],'like'),
		'bytOvertimeCalculationMethod' => array($fields['bytOvertimeCalculationMethod'],'eq'),
		'lngComputerID' => array($fields['lngComputerID'],'like'),
		'lngJobID' => array($fields['lngJobID'],'like'),
		'strFullName' => array($fields['strFullName'], 'like'),
		)
	);
$pager->select = "t.*, e.strFullName";

$pager->table = Time::$tableName . " t
					inner join " . Employee::$tableName . " e on t.lngEmployeeID = e.lngID";
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
		if ($('input.tblTimes:checked').size() == 0)
		{
			alert('Please select at least one item to delete');
			return false;
		}
		
		if (confirm("Are you sure that you want to remove the selected items?")) 
		{
			var link='controller.php?action=delete_tblTime';
			$('input.tblTimes:checked').each(function(){
				link += '&id[]='+$(this).val();
			});
			link += '&popup_destination=<?=@$popup_destination;?>';
			location.href=(link);
		}
	});
	$('#tblTimes_all').click(function(){
			$('.tblTimes').attr('checked', $('#tblTimes_all').attr('checked'));
		});
	$('.tblTimes').click(function(){
			if ($(this).attr('checked') == false && $('#tblTimes_all').attr('checked'))
				$('#tblTimes_all').removeAttr('checked');
		});
});
</script>

<div class="page_title">Manage Times</div>

<form method="get" action="<?=$_SERVER['PHP_SELF'];?>">
	<input type="hidden" name="view" value="tblTimes"/>
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
		
		<div style="search_field_wrapper" id="sf_strFullName">
			<div class="search_field_label">Employee Name:</div>
			<div class="search_field"><input type='text' class='textbox' name='strFullName' value='<?=$fields['strFullName'];?>'/></div>
		</div>
		
		<div style="search_field_wrapper" id="sf_datEvent">
			<div class="search_field_label">Date:</div>
			<div class="search_field"><input type='text' class='datepicker' name='datEvent' value='<?php if($fields['datEvent'] != ''){echo date('Y-m-d',strtotime($fields['datEvent']));}?>' /></div>
		</div>
		<div style="clear: both;"></div>
		<div style="search_field_wrapper" id="sf_blnEventType">
			<div class="search_field_label">Event Type:</div>
			<div class="search_field"><label><input type='radio' name='blnEventType' value='1' <?=($fields['blnEventType']==='1'?"CHECKED='CHECKED'":"");?> /> In</label>
		<label><input type='radio' name='blnEventType' value='0' <?=($fields['blnEventType']==='0'?"CHECKED='CHECKED'":"");?> /> Out</label>
		<?php /*<label><input type='checkbox' name='blnEventType' <?php if($fields['blnEventType'] == 'on' || $fields['blnEventType'] == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?></div>
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
				<input type="button" value="Reset Form" class="button btn-reload" style="width:100px;" onClick="location='?view=tblTimes&reset'"/>
			</div>
		</div>
		<div style="clear: both;"></div>
	</div>
	</div>

	<br/>
	
	<div class="filter_box">
	<table width="100%">
		<tr>
			<?php if (accessible_permission("add_tblTime","view")) { ?>
				<td style="padding-right:10px;border-right:solid 1px maroon;width:117px;">
					<input type="button" value="Add Time" disabled="disabled" onClick="location='?view=add_tblTime'" class="button btn-add" style="width:117px;"/>
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
			<?php if (accessible_permission("delete_tblTime_model","model")) { ?>
				<td width="50" align="center">Delete</td>
				<!--<td width="40" align="center" style="padding:0"><input type="checkbox" id="tblTimes_all" title="Select all items on this page"/></td>-->
			<?php } ?>
			<td>
			  Event Time
				<input type="image" onclick="sort_by.value='datEvent_a';" src='<?=COMMON_FILES_PATH;?>images/icons/arrow_up_16.gif' width="10" height="10" />
				<input type="image" onclick="sort_by.value='datEvent_d';" src='<?=COMMON_FILES_PATH;?>images/icons/arrow_down_16.gif' width="10" height="10" />
			</td>
			<td>
			  Event Type
				<input type="image" onclick="sort_by.value='blnEventType_a';" src='<?=COMMON_FILES_PATH;?>images/icons/arrow_up_16.gif' width="10" height="10" />
				<input type="image" onclick="sort_by.value='blnEventType_d';" src='<?=COMMON_FILES_PATH;?>images/icons/arrow_down_16.gif' width="10" height="10" />
			</td>
			<td>
			  Employee
				<input type="image" onclick="sort_by.value='strFullName_a';" src='<?=COMMON_FILES_PATH;?>images/icons/arrow_up_16.gif' width="10" height="10" />
				<input type="image" onclick="sort_by.value='strFullName_d';" src='<?=COMMON_FILES_PATH;?>images/icons/arrow_down_16.gif' width="10" height="10" />
			</td>
			<!--td>time->datEvent</td-->
		</tr>

		<?php
		$i=0;
		foreach($pager->results as $row)
		{
			$i++;
			$time = new Time();
			$time->setPropertyValues($row);
			$employee = new Employee();
			$employee->setPropertyValues($row);
			?>
			<tr class="grid-row<?= ($i%2) ?>">
				<?php if (accessible_permission("delete_tblTime_model","model")) { ?>
					<td align="center">
						<a href='controller.php?action=delete_tblTime&id=<?=$time->lngID;?>&popup_destination=<?=@$popup_destination;?>' onClick='return confirm("Are you sure that you want to delete this tblTime?");'><img src='<?=COMMON_FILES_PATH;?>images/icons/delete.gif' /></a>
						<!--<input type="checkbox" class="tblTimes" name="id[]" value="<?=$time->lngID;?>"/>-->
					</td>
				<?php } ?>
				<td>
					<?php if (accessible_permission("add_tblTime","view")) {
						echo "<a href='?view=add_tblTime&id=".$time->lngID."'>".date('m/d/Y | h:m a', strtotime($time->datEvent))."</a>";
					}
					else
						echo $time->datEvent;
				?>
				</td>
				<td>
					<?php if (accessible_permission("add_tblTime","view")) {
						echo "<a href='?view=add_tblTime&id=".$time->lngID."'>".($time->blnEventType == true ? 'In' : 'Out')."</a>";
					}
					else
						echo ($time->blnEventType == true ? 'In' : 'Out');
				?>
				</td>
				<td>
					<?php if (accessible_permission("add_tblEmployee","view")) {
						echo "<a href='?view=add_tblEmployee&id=".$time->lngEmployeeID."'>".$employee->strFullName."</a>";
					}
					else
						echo $employee->strFullName;
				?>
				</td>
				<!--<td><?php //echo $time->datEvent;?></td>-->
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
				<?php /*if (accessible_permission("delete_tblTime_model","model")) { ?>
				<b>Action:</b> <a href='javascript:void(0)' class="link btn-delete" id='batch_delete'>Remove selected</a>
				<?php }*/ ?> 
			</td>
			<td colspan="2" align="right"><?=$results;?></td>
		</tr>
	</table>

</form>
