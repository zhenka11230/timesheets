<?php
require_once("includes/view_included.php");
//require_once("includes/PagedResult.php");
//require_once("includes/Job.php");

$status->destination = "tblJobs";

$fields = array();
$fields['lngCode'] = $db->escapeSimple(trim(@$_REQUEST['lngCode']));
$fields['strName'] = $db->escapeSimple(trim(@$_REQUEST['strName']));
$fields['strDescription'] = $db->escapeSimple(trim(@$_REQUEST['strDescription']));
$fields['blnDisabled'] = $db->escapeSimple(trim(@$_REQUEST['blnDisabled']));
$fields['blnDeleted'] = $db->escapeSimple(trim(@$_REQUEST['blnDeleted']));

// pager fields
$fields['sort_by'] = (isset($_REQUEST['sort_by']) ? $db->escapeSimple(trim($_REQUEST['sort_by'])) : "lngCode_a");
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
		'lngCode' => array($fields['lngCode'],'like'),
		'strName' => array($fields['strName'],'like'),
		'strDescription' => array($fields['strDescription'],'like'),
		'blnDisabled' => array($fields['blnDisabled'],'bool'),
		'blnDeleted' => array($fields['blnDeleted'],'bool'),
		)
	);
$pager->table = Job::$tableName;
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
		if ($('input.tblJobs:checked').size() == 0)
		{
			alert('Please select at least one item to delete');
			return false;
		}
		
		if (confirm("Are you sure that you want to remove the selected items?")) 
		{
			var link='controller.php?action=delete_tblJob';
			$('input.tblJobs:checked').each(function(){
				link += '&id[]='+$(this).val();
			});
			link += '&popup_destination=<?=@$popup_destination;?>';
			location.href=(link);
		}
	});
	$('#tblJobs_all').click(function(){
			$('.tblJobs').attr('checked', $('#tblJobs_all').attr('checked'));
		});
	$('.tblJobs').click(function(){
			if ($(this).attr('checked') == false && $('#tblJobs_all').attr('checked'))
				$('#tblJobs_all').removeAttr('checked');
		});
});
</script>

<div class="page_title">Manage TblJobs</div>

<form method="get" action="<?=$_SERVER['PHP_SELF'];?>">
	<input type="hidden" name="view" value="tblJobs"/>
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
		
		<div style="search_field_wrapper" id="sf_lngCode">
			<div class="search_field_label">LngCode:</div>
			<div class="search_field"><input type='text' class='textbox' name='lngCode' value='<?=$fields['lngCode'];?>'/></div>
		</div>
		
		<div style="search_field_wrapper" id="sf_strName">
			<div class="search_field_label">StrName:</div>
			<div class="search_field"><input type='text' class='textbox' name='strName' value='<?=$fields['strName'];?>' maxlength='255'/></div>
		</div>
		<div style="clear: both;"></div>
		<div style="search_field_wrapper" id="sf_strDescription">
			<div class="search_field_label">StrDescription:</div>
			<div class="search_field"><input type='text' class='textbox' name='strDescription' value='<?=$fields['strDescription'];?>' maxlength='1073741823'/></div>
		</div>
		
		<div style="search_field_wrapper" id="sf_blnDisabled">
			<div class="search_field_label">BlnDisabled:</div>
			<div class="search_field"><label><input type='radio' name='blnDisabled' value='1' <?=($fields['blnDisabled']==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnDisabled' value='0' <?=($fields['blnDisabled']==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnDisabled' <?php if($fields['blnDisabled'] == 'on' || $fields['blnDisabled'] == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?></div>
		</div>
		<div style="clear: both;"></div>
		<div style="search_field_wrapper" id="sf_blnDeleted">
			<div class="search_field_label">BlnDeleted:</div>
			<div class="search_field"><label><input type='radio' name='blnDeleted' value='1' <?=($fields['blnDeleted']==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnDeleted' value='0' <?=($fields['blnDeleted']==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnDeleted' <?php if($fields['blnDeleted'] == 'on' || $fields['blnDeleted'] == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?></div>
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
				<input type="button" value="Reset Form" class="button btn-reload" style="width:100px;" onClick="location='?view=tblJobs&reset'"/>
			</div>
		</div>
		<div style="clear: both;"></div>
	</div>
	</div>

	<br/>
	
	<div class="filter_box">
	<table width="100%">
		<tr>
			<?php if (accessible_permission("add_tblJob","view")) { ?>
				<td style="padding-right:10px;border-right:solid 1px maroon;width:110px;">
					<input type="button" value="Add TblJob" onClick="location='?view=add_tblJob'" class="button btn-add" style="width:110px;"/>
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
			<?php if (accessible_permission("delete_tblJob_model","model")) { ?>
				<td width="50" align="center">Delete</td>
				<!--<td width="40" align="center" style="padding:0"><input type="checkbox" id="tblJobs_all" title="Select all items on this page"/></td>-->
			<?php } ?>
			<td>
			  LngCode
				<input type="image" onclick="sort_by.value='lngCode_a';" src='<?=COMMON_FILES_PATH;?>images/icons/arrow_up_16.gif' width="10" height="10" />
				<input type="image" onclick="sort_by.value='lngCode_d';" src='<?=COMMON_FILES_PATH;?>images/icons/arrow_down_16.gif' width="10" height="10" />
			</td>
			<!--td>job->lngCode</td-->
		</tr>

		<?php
		$i=0;
		foreach($pager->results as $row)
		{
			$i++;
			$job = new Job();
			$job->setPropertyValues($row);
			?>
			<tr class="grid-row<?= ($i%2) ?>">
				<?php if (accessible_permission("delete_tblJob_model","model")) { ?>
					<td align="center">
						<a href='controller.php?action=delete_tblJob&id=<?=$job->lngID;?>&popup_destination=<?=@$popup_destination;?>' onClick='return confirm("Are you sure that you want to delete this tblJob?");'><img src='<?=COMMON_FILES_PATH;?>images/icons/delete.gif' /></a>
						<!--<input type="checkbox" class="tblJobs" name="id[]" value="<?=$job->lngID;?>"/>-->
					</td>
				<?php } ?>
				<td>
					<?php if (accessible_permission("add_tblJob","view")) {
						echo "<a href='?view=add_tblJob&id=".$job->lngID."'>".$job->lngCode."</a>";
					}
					else
						echo $job->lngCode;
				?>
				</td>
				<!--<td><?php //echo $job->lngCode;?></td>-->
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
				<?php /*if (accessible_permission("delete_tblJob_model","model")) { ?>
				<b>Action:</b> <a href='javascript:void(0)' class="link btn-delete" id='batch_delete'>Remove selected</a>
				<?php }*/ ?> 
			</td>
			<td colspan="2" align="right"><?=$results;?></td>
		</tr>
	</table>

</form>
