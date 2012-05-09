<?php
require_once("includes/view_included.php");
//require_once("includes/PagedResult.php");
//require_once("includes/Connection.php");

$status->destination = "tblConnections";

$fields = array();
$fields['strMAC'] = $db->escapeSimple(trim(@$_REQUEST['strMAC']));
$fields['strComputerName'] = $db->escapeSimple(trim(@$_REQUEST['strComputerName']));
$fields['datDate'] = $db->escapeSimple(trim(@$_REQUEST['datDate']));
$fields['datAction'] = $db->escapeSimple(trim(@$_REQUEST['datAction']));
$fields['bytType'] = $db->escapeSimple(trim(@$_REQUEST['bytType']));

// pager fields
$fields['sort_by'] = (isset($_REQUEST['sort_by']) ? $db->escapeSimple(trim($_REQUEST['sort_by'])) : "strMAC_a");
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
		'strMAC' => array($fields['strMAC'],'like'),
		'strComputerName' => array($fields['strComputerName'],'like'),
		'datDate' => array($fields['datDate'],'eq'),
		'datAction' => array($fields['datAction'],'eq'),
		'bytType' => array($fields['bytType'],'eq'),
		)
	);
$pager->table = Connection::$tableName;
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
		if ($('input.tblConnections:checked').size() == 0)
		{
			alert('Please select at least one item to delete');
			return false;
		}
		
		if (confirm("Are you sure that you want to remove the selected items?")) 
		{
			var link='controller.php?action=delete_tblConnection';
			$('input.tblConnections:checked').each(function(){
				link += '&id[]='+$(this).val();
			});
			link += '&popup_destination=<?=@$popup_destination;?>';
			location.href=(link);
		}
	});
	$('#tblConnections_all').click(function(){
			$('.tblConnections').attr('checked', $('#tblConnections_all').attr('checked'));
		});
	$('.tblConnections').click(function(){
			if ($(this).attr('checked') == false && $('#tblConnections_all').attr('checked'))
				$('#tblConnections_all').removeAttr('checked');
		});
});
</script>

<div class="page_title">Manage TblConnections</div>

<form method="get" action="<?=$_SERVER['PHP_SELF'];?>">
	<input type="hidden" name="view" value="tblConnections"/>
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
		
		<div style="search_field_wrapper" id="sf_strMAC">
			<div class="search_field_label">StrMAC:</div>
			<div class="search_field"><input type='text' class='textbox' name='strMAC' value='<?=$fields['strMAC'];?>' maxlength='255'/></div>
		</div>
		
		<div style="search_field_wrapper" id="sf_strComputerName">
			<div class="search_field_label">StrComputerName:</div>
			<div class="search_field"><input type='text' class='textbox' name='strComputerName' value='<?=$fields['strComputerName'];?>' maxlength='255'/></div>
		</div>
		<div style="clear: both;"></div>
		<div style="search_field_wrapper" id="sf_datDate">
			<div class="search_field_label">DatDate:</div>
			<div class="search_field"><input type='text' class='datepicker' name='datDate' value='<?php if($fields['datDate'] != ''){echo date('Y-m-d',strtotime($fields['datDate']));}?>' /></div>
		</div>
		
		<div style="search_field_wrapper" id="sf_datAction">
			<div class="search_field_label">DatAction:</div>
			<div class="search_field"><input type='text' class='datepicker' name='datAction' value='<?php if($fields['datAction'] != ''){echo date('Y-m-d',strtotime($fields['datAction']));}?>' /></div>
		</div>
		<div style="clear: both;"></div>
		<div style="search_field_wrapper" id="sf_bytType">
			<div class="search_field_label">BytType:</div>
			<div class="search_field">short</div>
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
				<input type="button" value="Reset Form" class="button btn-reload" style="width:100px;" onClick="location='?view=tblConnections&reset'"/>
			</div>
		</div>
		<div style="clear: both;"></div>
	</div>
	</div>

	<br/>
	
	<div class="filter_box">
	<table width="100%">
		<tr>
			<?php if (accessible_permission("add_tblConnection","view")) { ?>
				<td style="padding-right:10px;border-right:solid 1px maroon;width:159px;">
					<input type="button" value="Add TblConnection" onClick="location='?view=add_tblConnection'" class="button btn-add" style="width:159px;"/>
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
			<?php if (accessible_permission("delete_tblConnection_model","model")) { ?>
				<td width="50" align="center">Delete</td>
				<!--<td width="40" align="center" style="padding:0"><input type="checkbox" id="tblConnections_all" title="Select all items on this page"/></td>-->
			<?php } ?>
			<td>
			  StrMAC
				<input type="image" onclick="sort_by.value='strMAC_a';" src='<?=COMMON_FILES_PATH;?>images/icons/arrow_up_16.gif' width="10" height="10" />
				<input type="image" onclick="sort_by.value='strMAC_d';" src='<?=COMMON_FILES_PATH;?>images/icons/arrow_down_16.gif' width="10" height="10" />
			</td>
			<!--td>connection->strMAC</td-->
		</tr>

		<?php
		$i=0;
		foreach($pager->results as $row)
		{
			$i++;
			$connection = new Connection();
			$connection->setPropertyValues($row);
			?>
			<tr class="grid-row<?= ($i%2) ?>">
				<?php if (accessible_permission("delete_tblConnection_model","model")) { ?>
					<td align="center">
						<a href='controller.php?action=delete_tblConnection&id=<?=$connection->lngID;?>&popup_destination=<?=@$popup_destination;?>' onClick='return confirm("Are you sure that you want to delete this tblConnection?");'><img src='<?=COMMON_FILES_PATH;?>images/icons/delete.gif' /></a>
						<!--<input type="checkbox" class="tblConnections" name="id[]" value="<?=$connection->lngID;?>"/>-->
					</td>
				<?php } ?>
				<td>
					<?php if (accessible_permission("add_tblConnection","view")) {
						echo "<a href='?view=add_tblConnection&id=".$connection->lngID."'>".$connection->strMAC."</a>";
					}
					else
						echo $connection->strMAC;
				?>
				</td>
				<!--<td><?php //echo $connection->strMAC;?></td>-->
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
				<?php /*if (accessible_permission("delete_tblConnection_model","model")) { ?>
				<b>Action:</b> <a href='javascript:void(0)' class="link btn-delete" id='batch_delete'>Remove selected</a>
				<?php }*/ ?> 
			</td>
			<td colspan="2" align="right"><?=$results;?></td>
		</tr>
	</table>

</form>
