<?php
require_once("includes/view_included.php");
//require_once("includes/PagedResult.php");
//require_once("includes/Bulletin.php");

$status->destination = "tblBulletins";

$fields = array();
$fields['blnActive'] = $db->escapeSimple(trim(@$_REQUEST['blnActive']));
$fields['strTitle'] = $db->escapeSimple(trim(@$_REQUEST['strTitle']));
$fields['strBulletin'] = $db->escapeSimple(trim(@$_REQUEST['strBulletin']));
$fields['datDate'] = $db->escapeSimple(trim(@$_REQUEST['datDate']));
$fields['bytTarget'] = $db->escapeSimple(trim(@$_REQUEST['bytTarget']));
$fields['lngDepartmentID'] = $db->escapeSimple(trim(@$_REQUEST['lngDepartmentID']));
$fields['lngShiftID'] = $db->escapeSimple(trim(@$_REQUEST['lngShiftID']));
$fields['blnRequireAcceptance'] = $db->escapeSimple(trim(@$_REQUEST['blnRequireAcceptance']));
$fields['blnHighPriority'] = $db->escapeSimple(trim(@$_REQUEST['blnHighPriority']));

// pager fields
$fields['sort_by'] = (isset($_REQUEST['sort_by']) ? $db->escapeSimple(trim($_REQUEST['sort_by'])) : "blnActive_a");
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
		'blnActive' => array($fields['blnActive'],'bool'),
		'strTitle' => array($fields['strTitle'],'like'),
		'strBulletin' => array($fields['strBulletin'],'like'),
		'datDate' => array($fields['datDate'],'eq'),
		'bytTarget' => array($fields['bytTarget'],'eq'),
		'lngDepartmentID' => array($fields['lngDepartmentID'],'like'),
		'lngShiftID' => array($fields['lngShiftID'],'like'),
		'blnRequireAcceptance' => array($fields['blnRequireAcceptance'],'bool'),
		'blnHighPriority' => array($fields['blnHighPriority'],'bool'),
		)
	);
$pager->table = Bulletin::$tableName;
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
		if ($('input.tblBulletins:checked').size() == 0)
		{
			alert('Please select at least one item to delete');
			return false;
		}
		
		if (confirm("Are you sure that you want to remove the selected items?")) 
		{
			var link='controller.php?action=delete_tblBulletin';
			$('input.tblBulletins:checked').each(function(){
				link += '&id[]='+$(this).val();
			});
			link += '&popup_destination=<?=@$popup_destination;?>';
			location.href=(link);
		}
	});
	$('#tblBulletins_all').click(function(){
			$('.tblBulletins').attr('checked', $('#tblBulletins_all').attr('checked'));
		});
	$('.tblBulletins').click(function(){
			if ($(this).attr('checked') == false && $('#tblBulletins_all').attr('checked'))
				$('#tblBulletins_all').removeAttr('checked');
		});
});
</script>

<div class="page_title">Manage TblBulletins</div>

<form method="get" action="<?=$_SERVER['PHP_SELF'];?>">
	<input type="hidden" name="view" value="tblBulletins"/>
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
		
		<div style="search_field_wrapper" id="sf_blnActive">
			<div class="search_field_label">BlnActive:</div>
			<div class="search_field"><label><input type='radio' name='blnActive' value='1' <?=($fields['blnActive']==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnActive' value='0' <?=($fields['blnActive']==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnActive' <?php if($fields['blnActive'] == 'on' || $fields['blnActive'] == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?></div>
		</div>
		
		<div style="search_field_wrapper" id="sf_strTitle">
			<div class="search_field_label">StrTitle:</div>
			<div class="search_field"><input type='text' class='textbox' name='strTitle' value='<?=$fields['strTitle'];?>' maxlength='255'/></div>
		</div>
		<div style="clear: both;"></div>
		<div style="search_field_wrapper" id="sf_strBulletin">
			<div class="search_field_label">StrBulletin:</div>
			<div class="search_field"><input type='text' class='textbox' name='strBulletin' value='<?=$fields['strBulletin'];?>' maxlength='1073741823'/></div>
		</div>
		
		<div style="search_field_wrapper" id="sf_datDate">
			<div class="search_field_label">DatDate:</div>
			<div class="search_field"><input type='text' class='datepicker' name='datDate' value='<?php if($fields['datDate'] != ''){echo date('Y-m-d',strtotime($fields['datDate']));}?>' /></div>
		</div>
		<div style="clear: both;"></div>
		<div style="search_field_wrapper" id="sf_bytTarget">
			<div class="search_field_label">BytTarget:</div>
			<div class="search_field">short</div>
		</div>
		
		<div style="search_field_wrapper" id="sf_lngDepartmentID">
			<div class="search_field_label">LngDepartmentID:</div>
			<div class="search_field"><input type='text' class='textbox' name='lngDepartmentID' value='<?=$fields['lngDepartmentID'];?>'/></div>
		</div>
		<div style="clear: both;"></div>
		<div style="search_field_wrapper" id="sf_lngShiftID">
			<div class="search_field_label">LngShiftID:</div>
			<div class="search_field"><input type='text' class='textbox' name='lngShiftID' value='<?=$fields['lngShiftID'];?>'/></div>
		</div>
		
		<div style="search_field_wrapper" id="sf_blnRequireAcceptance">
			<div class="search_field_label">BlnRequireAcceptance:</div>
			<div class="search_field"><label><input type='radio' name='blnRequireAcceptance' value='1' <?=($fields['blnRequireAcceptance']==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnRequireAcceptance' value='0' <?=($fields['blnRequireAcceptance']==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnRequireAcceptance' <?php if($fields['blnRequireAcceptance'] == 'on' || $fields['blnRequireAcceptance'] == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?></div>
		</div>
		<div style="clear: both;"></div>
		<div style="search_field_wrapper" id="sf_blnHighPriority">
			<div class="search_field_label">BlnHighPriority:</div>
			<div class="search_field"><label><input type='radio' name='blnHighPriority' value='1' <?=($fields['blnHighPriority']==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnHighPriority' value='0' <?=($fields['blnHighPriority']==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnHighPriority' <?php if($fields['blnHighPriority'] == 'on' || $fields['blnHighPriority'] == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?></div>
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
				<input type="button" value="Reset Form" class="button btn-reload" style="width:100px;" onClick="location='?view=tblBulletins&reset'"/>
			</div>
		</div>
		<div style="clear: both;"></div>
	</div>
	</div>

	<br/>
	
	<div class="filter_box">
	<table width="100%">
		<tr>
			<?php if (accessible_permission("add_tblBulletin","view")) { ?>
				<td style="padding-right:10px;border-right:solid 1px maroon;width:145px;">
					<input type="button" value="Add TblBulletin" onClick="location='?view=add_tblBulletin'" class="button btn-add" style="width:145px;"/>
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
			<?php if (accessible_permission("delete_tblBulletin_model","model")) { ?>
				<td width="50" align="center">Delete</td>
				<!--<td width="40" align="center" style="padding:0"><input type="checkbox" id="tblBulletins_all" title="Select all items on this page"/></td>-->
			<?php } ?>
			<td>
			  BlnActive
				<input type="image" onclick="sort_by.value='blnActive_a';" src='<?=COMMON_FILES_PATH;?>images/icons/arrow_up_16.gif' width="10" height="10" />
				<input type="image" onclick="sort_by.value='blnActive_d';" src='<?=COMMON_FILES_PATH;?>images/icons/arrow_down_16.gif' width="10" height="10" />
			</td>
			<!--td>bulletin->blnActive</td-->
		</tr>

		<?php
		$i=0;
		foreach($pager->results as $row)
		{
			$i++;
			$bulletin = new Bulletin();
			$bulletin->setPropertyValues($row);
			?>
			<tr class="grid-row<?= ($i%2) ?>">
				<?php if (accessible_permission("delete_tblBulletin_model","model")) { ?>
					<td align="center">
						<a href='controller.php?action=delete_tblBulletin&id=<?=$bulletin->lngID;?>&popup_destination=<?=@$popup_destination;?>' onClick='return confirm("Are you sure that you want to delete this tblBulletin?");'><img src='<?=COMMON_FILES_PATH;?>images/icons/delete.gif' /></a>
						<!--<input type="checkbox" class="tblBulletins" name="id[]" value="<?=$bulletin->lngID;?>"/>-->
					</td>
				<?php } ?>
				<td>
					<?php if (accessible_permission("add_tblBulletin","view")) {
						echo "<a href='?view=add_tblBulletin&id=".$bulletin->lngID."'>".$bulletin->blnActive."</a>";
					}
					else
						echo $bulletin->blnActive;
				?>
				</td>
				<!--<td><?php //echo $bulletin->blnActive;?></td>-->
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
				<?php /*if (accessible_permission("delete_tblBulletin_model","model")) { ?>
				<b>Action:</b> <a href='javascript:void(0)' class="link btn-delete" id='batch_delete'>Remove selected</a>
				<?php }*/ ?> 
			</td>
			<td colspan="2" align="right"><?=$results;?></td>
		</tr>
	</table>

</form>
