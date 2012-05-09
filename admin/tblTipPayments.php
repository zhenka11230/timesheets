<?php
require_once("includes/view_included.php");
//require_once("includes/PagedResult.php");
//require_once("includes/TipPayment.php");

$status->destination = "tblTipPayments";

$fields = array();
$fields['lngEmployeeID'] = $db->escapeSimple(trim(@$_REQUEST['lngEmployeeID']));
$fields['lngTipID'] = $db->escapeSimple(trim(@$_REQUEST['lngTipID']));

// pager fields
$fields['sort_by'] = (isset($_REQUEST['sort_by']) ? $db->escapeSimple(trim($_REQUEST['sort_by'])) : "lngEmployeeID_a");
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
		'lngEmployeeID' => array($fields['lngEmployeeID'],'like'),
		'lngTipID' => array($fields['lngTipID'],'like'),
		)
	);
$pager->table = TipPayment::$tableName;
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
		if ($('input.tblTipPayments:checked').size() == 0)
		{
			alert('Please select at least one item to delete');
			return false;
		}
		
		if (confirm("Are you sure that you want to remove the selected items?")) 
		{
			var link='controller.php?action=delete_tblTipPayment';
			$('input.tblTipPayments:checked').each(function(){
				link += '&id[]='+$(this).val();
			});
			link += '&popup_destination=<?=@$popup_destination;?>';
			location.href=(link);
		}
	});
	$('#tblTipPayments_all').click(function(){
			$('.tblTipPayments').attr('checked', $('#tblTipPayments_all').attr('checked'));
		});
	$('.tblTipPayments').click(function(){
			if ($(this).attr('checked') == false && $('#tblTipPayments_all').attr('checked'))
				$('#tblTipPayments_all').removeAttr('checked');
		});
});
</script>

<div class="page_title">Manage TblTipPayments</div>

<form method="get" action="<?=$_SERVER['PHP_SELF'];?>">
	<input type="hidden" name="view" value="tblTipPayments"/>
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
		
		<div style="search_field_wrapper" id="sf_lngEmployeeID">
			<div class="search_field_label">LngEmployeeID:</div>
			<div class="search_field"><input type='text' class='textbox' name='lngEmployeeID' value='<?=$fields['lngEmployeeID'];?>'/></div>
		</div>
		
		<div style="search_field_wrapper" id="sf_lngTipID">
			<div class="search_field_label">LngTipID:</div>
			<div class="search_field"><input type='text' class='textbox' name='lngTipID' value='<?=$fields['lngTipID'];?>'/></div>
		</div>
		<div style="clear: both;"></div>
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
				<input type="button" value="Reset Form" class="button btn-reload" style="width:100px;" onClick="location='?view=tblTipPayments&reset'"/>
			</div>
		</div>
		<div style="clear: both;"></div>
	</div>
	</div>

	<br/>
	
	<div class="filter_box">
	<table width="100%">
		<tr>
			<?php if (accessible_permission("add_tblTipPayment","view")) { ?>
				<td style="padding-right:10px;border-right:solid 1px maroon;width:159px;">
					<input type="button" value="Add TblTipPayment" onClick="location='?view=add_tblTipPayment'" class="button btn-add" style="width:159px;"/>
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
			<?php if (accessible_permission("delete_tblTipPayment_model","model")) { ?>
				<td width="50" align="center">Delete</td>
				<!--<td width="40" align="center" style="padding:0"><input type="checkbox" id="tblTipPayments_all" title="Select all items on this page"/></td>-->
			<?php } ?>
			<td>
			  LngEmployeeID
				<input type="image" onclick="sort_by.value='lngEmployeeID_a';" src='<?=COMMON_FILES_PATH;?>images/icons/arrow_up_16.gif' width="10" height="10" />
				<input type="image" onclick="sort_by.value='lngEmployeeID_d';" src='<?=COMMON_FILES_PATH;?>images/icons/arrow_down_16.gif' width="10" height="10" />
			</td>
			<!--td>tipPayment->lngEmployeeID</td-->
		</tr>

		<?php
		$i=0;
		foreach($pager->results as $row)
		{
			$i++;
			$tipPayment = new TipPayment();
			$tipPayment->setPropertyValues($row);
			?>
			<tr class="grid-row<?= ($i%2) ?>">
				<?php if (accessible_permission("delete_tblTipPayment_model","model")) { ?>
					<td align="center">
						<a href='controller.php?action=delete_tblTipPayment&id=<?=$tipPayment->lngID;?>&popup_destination=<?=@$popup_destination;?>' onClick='return confirm("Are you sure that you want to delete this tblTipPayment?");'><img src='<?=COMMON_FILES_PATH;?>images/icons/delete.gif' /></a>
						<!--<input type="checkbox" class="tblTipPayments" name="id[]" value="<?=$tipPayment->lngID;?>"/>-->
					</td>
				<?php } ?>
				<td>
					<?php if (accessible_permission("add_tblTipPayment","view")) {
						echo "<a href='?view=add_tblTipPayment&id=".$tipPayment->lngID."'>".$tipPayment->lngEmployeeID."</a>";
					}
					else
						echo $tipPayment->lngEmployeeID;
				?>
				</td>
				<!--<td><?php //echo $tipPayment->lngEmployeeID;?></td>-->
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
				<?php /*if (accessible_permission("delete_tblTipPayment_model","model")) { ?>
				<b>Action:</b> <a href='javascript:void(0)' class="link btn-delete" id='batch_delete'>Remove selected</a>
				<?php }*/ ?> 
			</td>
			<td colspan="2" align="right"><?=$results;?></td>
		</tr>
	</table>

</form>
