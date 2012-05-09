<?php
require_once("includes/view_included.php");
//require_once("includes/PagedResult.php");
//require_once("includes/TimeNote.php");

$status->destination = "tblTimeNotes";

$fields = array();
//$fields['lngTimeID'] = (isset($_REQUEST['lngTimeID']) && !empty($_REQUEST['lngTimeID'][0]) ? $_REQUEST['lngTimeID']:array());
$fields['lngTimeID'] = (trim(@$_REQUEST['lngTimeID']) != "" ? (int)$_REQUEST['lngTimeID']:"");
$fields['strNote'] = $db->escapeSimple(trim(@$_REQUEST['strNote']));
$fields['datDate'] = $db->escapeSimple(trim(@$_REQUEST['datDate']));

// pager fields
$fields['sort_by'] = (isset($_REQUEST['sort_by']) ? $db->escapeSimple(trim($_REQUEST['sort_by'])) : "strNote_a");
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
		'lngTimeID' => array($fields['lngTimeID'],'='),
		'strNote' => array($fields['strNote'],'like'),
		'datDate' => array($fields['datDate'],'eq'),
		)
	);
$pager->table = TimeNote::$tableName;
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
		if ($('input.tblTimeNotes:checked').size() == 0)
		{
			alert('Please select at least one item to delete');
			return false;
		}
		
		if (confirm("Are you sure that you want to remove the selected items?")) 
		{
			var link='controller.php?action=delete_tblTimeNote';
			$('input.tblTimeNotes:checked').each(function(){
				link += '&id[]='+$(this).val();
			});
			link += '&popup_destination=<?=@$popup_destination;?>';
			location.href=(link);
		}
	});
	$('#tblTimeNotes_all').click(function(){
			$('.tblTimeNotes').attr('checked', $('#tblTimeNotes_all').attr('checked'));
		});
	$('.tblTimeNotes').click(function(){
			if ($(this).attr('checked') == false && $('#tblTimeNotes_all').attr('checked'))
				$('#tblTimeNotes_all').removeAttr('checked');
		});
});
</script>

<div class="page_title">Manage TblTimeNotes</div>

<form method="get" action="<?=$_SERVER['PHP_SELF'];?>">
	<input type="hidden" name="view" value="tblTimeNotes"/>
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
		
		<div style="search_field_wrapper" id="sf_lngTimeID">
			<div class="search_field_label">LngTimeID:</div>
			<div class="search_field"><input type='text' class='textbox' name='lngTimeID' value='<?=$fields['lngTimeID'];?>'/></div>
		</div>
		
		<div style="search_field_wrapper" id="sf_strNote">
			<div class="search_field_label">StrNote:</div>
			<div class="search_field"><input type='text' class='textbox' name='strNote' value='<?=$fields['strNote'];?>' maxlength='255'/></div>
		</div>
		<div style="clear: both;"></div>
		<div style="search_field_wrapper" id="sf_datDate">
			<div class="search_field_label">DatDate:</div>
			<div class="search_field"><input type='text' class='datepicker' name='datDate' value='<?php if($fields['datDate'] != ''){echo date('Y-m-d',strtotime($fields['datDate']));}?>' /></div>
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
				<input type="button" value="Reset Form" class="button btn-reload" style="width:100px;" onClick="location='?view=tblTimeNotes&reset'"/>
			</div>
		</div>
		<div style="clear: both;"></div>
	</div>
	</div>

	<br/>
	
	<div class="filter_box">
	<table width="100%">
		<tr>
			<?php if (accessible_permission("add_tblTimeNote","view")) { ?>
				<td style="padding-right:10px;border-right:solid 1px maroon;width:145px;">
					<input type="button" value="Add TblTimeNote" onClick="location='?view=add_tblTimeNote'" class="button btn-add" style="width:145px;"/>
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
			<?php if (accessible_permission("delete_tblTimeNote_model","model")) { ?>
				<td width="50" align="center">Delete</td>
				<!--<td width="40" align="center" style="padding:0"><input type="checkbox" id="tblTimeNotes_all" title="Select all items on this page"/></td>-->
			<?php } ?>
			<td>
			  StrNote
				<input type="image" onclick="sort_by.value='strNote_a';" src='<?=COMMON_FILES_PATH;?>images/icons/arrow_up_16.gif' width="10" height="10" />
				<input type="image" onclick="sort_by.value='strNote_d';" src='<?=COMMON_FILES_PATH;?>images/icons/arrow_down_16.gif' width="10" height="10" />
			</td>
			<!--td>timeNote->strNote</td-->
		</tr>

		<?php
		$i=0;
		foreach($pager->results as $row)
		{
			$i++;
			$timeNote = new TimeNote();
			$timeNote->setPropertyValues($row);
			?>
			<tr class="grid-row<?= ($i%2) ?>">
				<?php if (accessible_permission("delete_tblTimeNote_model","model")) { ?>
					<td align="center">
						<a href='controller.php?action=delete_tblTimeNote&id=<?=$timeNote->lngID;?>&popup_destination=<?=@$popup_destination;?>' onClick='return confirm("Are you sure that you want to delete this tblTimeNote?");'><img src='<?=COMMON_FILES_PATH;?>images/icons/delete.gif' /></a>
						<!--<input type="checkbox" class="tblTimeNotes" name="id[]" value="<?=$timeNote->lngID;?>"/>-->
					</td>
				<?php } ?>
				<td>
					<?php if (accessible_permission("add_tblTimeNote","view")) {
						echo "<a href='?view=add_tblTimeNote&id=".$timeNote->lngID."'>".$timeNote->strNote."</a>";
					}
					else
						echo $timeNote->strNote;
				?>
				</td>
				<!--<td><?php //echo $timeNote->strNote;?></td>-->
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
				<?php /*if (accessible_permission("delete_tblTimeNote_model","model")) { ?>
				<b>Action:</b> <a href='javascript:void(0)' class="link btn-delete" id='batch_delete'>Remove selected</a>
				<?php }*/ ?> 
			</td>
			<td colspan="2" align="right"><?=$results;?></td>
		</tr>
	</table>

</form>
