<?php
require_once("includes/view_included.php");
//require_once("includes/PagedResult.php");
//require_once("includes/EmploymentType.php");

$status->destination = "tblEmploymentTypes";

$fields = array();
$fields['strName'] = $db->escapeSimple(trim(@$_REQUEST['strName']));
$fields['blnAccrueVacations'] = $db->escapeSimple(trim(@$_REQUEST['blnAccrueVacations']));
$fields['lngVacationStartAfter'] = $db->escapeSimple(trim(@$_REQUEST['lngVacationStartAfter']));
$fields['bytVacationStartAferUnits'] = $db->escapeSimple(trim(@$_REQUEST['bytVacationStartAferUnits']));
$fields['sngVacationStartAt'] = $db->escapeSimple(trim(@$_REQUEST['sngVacationStartAt']));
$fields['sngVacationAccrue'] = $db->escapeSimple(trim(@$_REQUEST['sngVacationAccrue']));
$fields['sngVacationAccrueEvery'] = $db->escapeSimple(trim(@$_REQUEST['sngVacationAccrueEvery']));
$fields['bytVacationAccrueUnit'] = $db->escapeSimple(trim(@$_REQUEST['bytVacationAccrueUnit']));
$fields['blnVacationAccrueLimit'] = $db->escapeSimple(trim(@$_REQUEST['blnVacationAccrueLimit']));
$fields['sngVacationAccrueLimit'] = $db->escapeSimple(trim(@$_REQUEST['sngVacationAccrueLimit']));
$fields['bytVacationResetAccrual'] = $db->escapeSimple(trim(@$_REQUEST['bytVacationResetAccrual']));
$fields['blnVacationCarryOverBalance'] = $db->escapeSimple(trim(@$_REQUEST['blnVacationCarryOverBalance']));
$fields['blnAccrueSickLeave'] = $db->escapeSimple(trim(@$_REQUEST['blnAccrueSickLeave']));
$fields['lngSickLeaveStartAfter'] = $db->escapeSimple(trim(@$_REQUEST['lngSickLeaveStartAfter']));
$fields['bytSickLeaveStartAferUnits'] = $db->escapeSimple(trim(@$_REQUEST['bytSickLeaveStartAferUnits']));
$fields['sngSickLeaveStartAt'] = $db->escapeSimple(trim(@$_REQUEST['sngSickLeaveStartAt']));
$fields['sngSickLeaveAccrue'] = $db->escapeSimple(trim(@$_REQUEST['sngSickLeaveAccrue']));
$fields['sngSickLeaveAccrueEvery'] = $db->escapeSimple(trim(@$_REQUEST['sngSickLeaveAccrueEvery']));
$fields['bytSickLeaveAccrueUnit'] = $db->escapeSimple(trim(@$_REQUEST['bytSickLeaveAccrueUnit']));
$fields['blnSickLeaveAccrueLimit'] = $db->escapeSimple(trim(@$_REQUEST['blnSickLeaveAccrueLimit']));
$fields['sngSickLeaveAccrueLimit'] = $db->escapeSimple(trim(@$_REQUEST['sngSickLeaveAccrueLimit']));
$fields['bytSickLeaveResetAccrual'] = $db->escapeSimple(trim(@$_REQUEST['bytSickLeaveResetAccrual']));
$fields['blnSickLeaveCarryOverBalance'] = $db->escapeSimple(trim(@$_REQUEST['blnSickLeaveCarryOverBalance']));
$fields['blnVacationUseHireDate'] = $db->escapeSimple(trim(@$_REQUEST['blnVacationUseHireDate']));
$fields['blnSickTimeUseHireDate'] = $db->escapeSimple(trim(@$_REQUEST['blnSickTimeUseHireDate']));

// pager fields
$fields['sort_by'] = (isset($_REQUEST['sort_by']) ? $db->escapeSimple(trim($_REQUEST['sort_by'])) : "strName_a");
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
		'strName' => array($fields['strName'],'like'),
		'blnAccrueVacations' => array($fields['blnAccrueVacations'],'bool'),
		'lngVacationStartAfter' => array($fields['lngVacationStartAfter'],'like'),
		'bytVacationStartAferUnits' => array($fields['bytVacationStartAferUnits'],'eq'),
		'sngVacationStartAt' => array($fields['sngVacationStartAt'],'eq'),
		'sngVacationAccrue' => array($fields['sngVacationAccrue'],'eq'),
		'sngVacationAccrueEvery' => array($fields['sngVacationAccrueEvery'],'eq'),
		'bytVacationAccrueUnit' => array($fields['bytVacationAccrueUnit'],'eq'),
		'blnVacationAccrueLimit' => array($fields['blnVacationAccrueLimit'],'bool'),
		'sngVacationAccrueLimit' => array($fields['sngVacationAccrueLimit'],'eq'),
		'bytVacationResetAccrual' => array($fields['bytVacationResetAccrual'],'eq'),
		'blnVacationCarryOverBalance' => array($fields['blnVacationCarryOverBalance'],'bool'),
		'blnAccrueSickLeave' => array($fields['blnAccrueSickLeave'],'bool'),
		'lngSickLeaveStartAfter' => array($fields['lngSickLeaveStartAfter'],'like'),
		'bytSickLeaveStartAferUnits' => array($fields['bytSickLeaveStartAferUnits'],'eq'),
		'sngSickLeaveStartAt' => array($fields['sngSickLeaveStartAt'],'eq'),
		'sngSickLeaveAccrue' => array($fields['sngSickLeaveAccrue'],'eq'),
		'sngSickLeaveAccrueEvery' => array($fields['sngSickLeaveAccrueEvery'],'eq'),
		'bytSickLeaveAccrueUnit' => array($fields['bytSickLeaveAccrueUnit'],'eq'),
		'blnSickLeaveAccrueLimit' => array($fields['blnSickLeaveAccrueLimit'],'bool'),
		'sngSickLeaveAccrueLimit' => array($fields['sngSickLeaveAccrueLimit'],'eq'),
		'bytSickLeaveResetAccrual' => array($fields['bytSickLeaveResetAccrual'],'eq'),
		'blnSickLeaveCarryOverBalance' => array($fields['blnSickLeaveCarryOverBalance'],'bool'),
		'blnVacationUseHireDate' => array($fields['blnVacationUseHireDate'],'bool'),
		'blnSickTimeUseHireDate' => array($fields['blnSickTimeUseHireDate'],'bool'),
		)
	);
$pager->table = EmploymentType::$tableName;
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
		if ($('input.tblEmploymentTypes:checked').size() == 0)
		{
			alert('Please select at least one item to delete');
			return false;
		}
		
		if (confirm("Are you sure that you want to remove the selected items?")) 
		{
			var link='controller.php?action=delete_tblEmploymentType';
			$('input.tblEmploymentTypes:checked').each(function(){
				link += '&id[]='+$(this).val();
			});
			link += '&popup_destination=<?=@$popup_destination;?>';
			location.href=(link);
		}
	});
	$('#tblEmploymentTypes_all').click(function(){
			$('.tblEmploymentTypes').attr('checked', $('#tblEmploymentTypes_all').attr('checked'));
		});
	$('.tblEmploymentTypes').click(function(){
			if ($(this).attr('checked') == false && $('#tblEmploymentTypes_all').attr('checked'))
				$('#tblEmploymentTypes_all').removeAttr('checked');
		});
});
</script>

<div class="page_title">Manage Employment Types</div>

<form method="get" action="<?=$_SERVER['PHP_SELF'];?>">
	<input type="hidden" name="view" value="tblEmploymentTypes"/>
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
		
		<div style="search_field_wrapper" id="sf_strName">
			<div class="search_field_label">Name:</div>
			<div class="search_field"><input type='text' class='textbox' name='strName' value='<?=$fields['strName'];?>' maxlength='255'/></div>
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
				<input type="button" value="Reset Form" class="button btn-reload" style="width:100px;" onClick="location='?view=tblEmploymentTypes&reset'"/>
			</div>
		</div>
		<div style="clear: both;"></div>
	</div>
	</div>

	<br/>
	
	<div class="filter_box">
	<table width="100%">
		<tr>
			<?php if (accessible_permission("add_tblEmploymentType","view")) { ?>
				<td style="padding-right:10px;border-right:solid 1px maroon;width:187px;">
					<input type="button" value="Add Employment Type" disabled="disabled" onClick="location='?view=add_tblEmploymentType'" class="button btn-add" style="width:187px;"/>
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
			<?php if (accessible_permission("delete_tblEmploymentType_model","model")) { ?>
				<td width="50" align="center">Delete</td>
				<!--<td width="40" align="center" style="padding:0"><input type="checkbox" id="tblEmploymentTypes_all" title="Select all items on this page"/></td>-->
			<?php } ?>
			<td>
			  Name
				<input type="image" onclick="sort_by.value='strName_a';" src='<?=COMMON_FILES_PATH;?>images/icons/arrow_up_16.gif' width="10" height="10" />
				<input type="image" onclick="sort_by.value='strName_d';" src='<?=COMMON_FILES_PATH;?>images/icons/arrow_down_16.gif' width="10" height="10" />
			</td>
			<!--td>employmentType->strName</td-->
		</tr>

		<?php
		$i=0;
		foreach($pager->results as $row)
		{
			$i++;
			$employmentType = new EmploymentType();
			$employmentType->setPropertyValues($row);
			?>
			<tr class="grid-row<?= ($i%2) ?>">
				<?php if (accessible_permission("delete_tblEmploymentType_model","model")) { ?>
					<td align="center">
						<a href='controller.php?action=delete_tblEmploymentType&id=<?=$employmentType->lngID;?>&popup_destination=<?=@$popup_destination;?>' onClick='return confirm("Are you sure that you want to delete this tblEmploymentType?");'><img src='<?=COMMON_FILES_PATH;?>images/icons/delete.gif' /></a>
						<!--<input type="checkbox" class="tblEmploymentTypes" name="id[]" value="<?=$employmentType->lngID;?>"/>-->
					</td>
				<?php } ?>
				<td>
					<?php if (accessible_permission("add_tblEmploymentType","view")) {
						echo "<a href='?view=add_tblEmploymentType&id=".$employmentType->lngID."'>".$employmentType->strName."</a>";
					}
					else
						echo $employmentType->strName;
				?>
				</td>
				<!--<td><?php //echo $employmentType->strName;?></td>-->
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
				<?php /*if (accessible_permission("delete_tblEmploymentType_model","model")) { ?>
				<b>Action:</b> <a href='javascript:void(0)' class="link btn-delete" id='batch_delete'>Remove selected</a>
				<?php }*/ ?> 
			</td>
			<td colspan="2" align="right"><?=$results;?></td>
		</tr>
	</table>

</form>
