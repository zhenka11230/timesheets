<?php
require_once("includes/view_included.php");
//require_once("includes/PagedResult.php");
//require_once("includes/ExportFormat.php");

$status->destination = "tblExportFormats";

$fields = array();
$fields['strName'] = $db->escapeSimple(trim(@$_REQUEST['strName']));
$fields['blnType'] = $db->escapeSimple(trim(@$_REQUEST['blnType']));
$fields['strDateFormat'] = $db->escapeSimple(trim(@$_REQUEST['strDateFormat']));
$fields['strTimeFormat'] = $db->escapeSimple(trim(@$_REQUEST['strTimeFormat']));
$fields['strNormalCode'] = $db->escapeSimple(trim(@$_REQUEST['strNormalCode']));
$fields['strOtherCode'] = $db->escapeSimple(trim(@$_REQUEST['strOtherCode']));
$fields['strSickCode'] = $db->escapeSimple(trim(@$_REQUEST['strSickCode']));
$fields['strVacationCode'] = $db->escapeSimple(trim(@$_REQUEST['strVacationCode']));
$fields['strHolidayCode'] = $db->escapeSimple(trim(@$_REQUEST['strHolidayCode']));
$fields['strOT1Code'] = $db->escapeSimple(trim(@$_REQUEST['strOT1Code']));
$fields['strOT2Code'] = $db->escapeSimple(trim(@$_REQUEST['strOT2Code']));
$fields['strFormat'] = $db->escapeSimple(trim(@$_REQUEST['strFormat']));

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
		'blnType' => array($fields['blnType'],'bool'),
		'strDateFormat' => array($fields['strDateFormat'],'like'),
		'strTimeFormat' => array($fields['strTimeFormat'],'like'),
		'strNormalCode' => array($fields['strNormalCode'],'like'),
		'strOtherCode' => array($fields['strOtherCode'],'like'),
		'strSickCode' => array($fields['strSickCode'],'like'),
		'strVacationCode' => array($fields['strVacationCode'],'like'),
		'strHolidayCode' => array($fields['strHolidayCode'],'like'),
		'strOT1Code' => array($fields['strOT1Code'],'like'),
		'strOT2Code' => array($fields['strOT2Code'],'like'),
		'strFormat' => array($fields['strFormat'],'like'),
		)
	);
$pager->table = ExportFormat::$tableName;
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
		if ($('input.tblExportFormats:checked').size() == 0)
		{
			alert('Please select at least one item to delete');
			return false;
		}
		
		if (confirm("Are you sure that you want to remove the selected items?")) 
		{
			var link='controller.php?action=delete_tblExportFormat';
			$('input.tblExportFormats:checked').each(function(){
				link += '&id[]='+$(this).val();
			});
			link += '&popup_destination=<?=@$popup_destination;?>';
			location.href=(link);
		}
	});
	$('#tblExportFormats_all').click(function(){
			$('.tblExportFormats').attr('checked', $('#tblExportFormats_all').attr('checked'));
		});
	$('.tblExportFormats').click(function(){
			if ($(this).attr('checked') == false && $('#tblExportFormats_all').attr('checked'))
				$('#tblExportFormats_all').removeAttr('checked');
		});
});
</script>

<div class="page_title">Manage TblExportFormats</div>

<form method="get" action="<?=$_SERVER['PHP_SELF'];?>">
	<input type="hidden" name="view" value="tblExportFormats"/>
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
			<div class="search_field_label">StrName:</div>
			<div class="search_field"><input type='text' class='textbox' name='strName' value='<?=$fields['strName'];?>' maxlength='255'/></div>
		</div>
		
		<div style="search_field_wrapper" id="sf_blnType">
			<div class="search_field_label">BlnType:</div>
			<div class="search_field"><label><input type='radio' name='blnType' value='1' <?=($fields['blnType']==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnType' value='0' <?=($fields['blnType']==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnType' <?php if($fields['blnType'] == 'on' || $fields['blnType'] == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?></div>
		</div>
		<div style="clear: both;"></div>
		<div style="search_field_wrapper" id="sf_strDateFormat">
			<div class="search_field_label">StrDateFormat:</div>
			<div class="search_field"><input type='text' class='textbox' name='strDateFormat' value='<?=$fields['strDateFormat'];?>' maxlength='255'/></div>
		</div>
		
		<div style="search_field_wrapper" id="sf_strTimeFormat">
			<div class="search_field_label">StrTimeFormat:</div>
			<div class="search_field"><input type='text' class='textbox' name='strTimeFormat' value='<?=$fields['strTimeFormat'];?>' maxlength='255'/></div>
		</div>
		<div style="clear: both;"></div>
		<div style="search_field_wrapper" id="sf_strNormalCode">
			<div class="search_field_label">StrNormalCode:</div>
			<div class="search_field"><input type='text' class='textbox' name='strNormalCode' value='<?=$fields['strNormalCode'];?>' maxlength='255'/></div>
		</div>
		
		<div style="search_field_wrapper" id="sf_strOtherCode">
			<div class="search_field_label">StrOtherCode:</div>
			<div class="search_field"><input type='text' class='textbox' name='strOtherCode' value='<?=$fields['strOtherCode'];?>' maxlength='255'/></div>
		</div>
		<div style="clear: both;"></div>
		<div style="search_field_wrapper" id="sf_strSickCode">
			<div class="search_field_label">StrSickCode:</div>
			<div class="search_field"><input type='text' class='textbox' name='strSickCode' value='<?=$fields['strSickCode'];?>' maxlength='255'/></div>
		</div>
		
		<div style="search_field_wrapper" id="sf_strVacationCode">
			<div class="search_field_label">StrVacationCode:</div>
			<div class="search_field"><input type='text' class='textbox' name='strVacationCode' value='<?=$fields['strVacationCode'];?>' maxlength='255'/></div>
		</div>
		<div style="clear: both;"></div>
		<div style="search_field_wrapper" id="sf_strHolidayCode">
			<div class="search_field_label">StrHolidayCode:</div>
			<div class="search_field"><input type='text' class='textbox' name='strHolidayCode' value='<?=$fields['strHolidayCode'];?>' maxlength='255'/></div>
		</div>
		
		<div style="search_field_wrapper" id="sf_strOT1Code">
			<div class="search_field_label">StrOT1Code:</div>
			<div class="search_field"><input type='text' class='textbox' name='strOT1Code' value='<?=$fields['strOT1Code'];?>' maxlength='255'/></div>
		</div>
		<div style="clear: both;"></div>
		<div style="search_field_wrapper" id="sf_strOT2Code">
			<div class="search_field_label">StrOT2Code:</div>
			<div class="search_field"><input type='text' class='textbox' name='strOT2Code' value='<?=$fields['strOT2Code'];?>' maxlength='255'/></div>
		</div>
		
		<div style="search_field_wrapper" id="sf_strFormat">
			<div class="search_field_label">StrFormat:</div>
			<div class="search_field"><input type='text' class='textbox' name='strFormat' value='<?=$fields['strFormat'];?>' maxlength='1073741823'/></div>
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
				<input type="button" value="Reset Form" class="button btn-reload" style="width:100px;" onClick="location='?view=tblExportFormats&reset'"/>
			</div>
		</div>
		<div style="clear: both;"></div>
	</div>
	</div>

	<br/>
	
	<div class="filter_box">
	<table width="100%">
		<tr>
			<?php if (accessible_permission("add_tblExportFormat","view")) { ?>
				<td style="padding-right:10px;border-right:solid 1px maroon;width:173px;">
					<input type="button" value="Add TblExportFormat" onClick="location='?view=add_tblExportFormat'" class="button btn-add" style="width:173px;"/>
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
			<?php if (accessible_permission("delete_tblExportFormat_model","model")) { ?>
				<td width="50" align="center">Delete</td>
				<!--<td width="40" align="center" style="padding:0"><input type="checkbox" id="tblExportFormats_all" title="Select all items on this page"/></td>-->
			<?php } ?>
			<td>
			  StrName
				<input type="image" onclick="sort_by.value='strName_a';" src='<?=COMMON_FILES_PATH;?>images/icons/arrow_up_16.gif' width="10" height="10" />
				<input type="image" onclick="sort_by.value='strName_d';" src='<?=COMMON_FILES_PATH;?>images/icons/arrow_down_16.gif' width="10" height="10" />
			</td>
			<!--td>exportFormat->strName</td-->
		</tr>

		<?php
		$i=0;
		foreach($pager->results as $row)
		{
			$i++;
			$exportFormat = new ExportFormat();
			$exportFormat->setPropertyValues($row);
			?>
			<tr class="grid-row<?= ($i%2) ?>">
				<?php if (accessible_permission("delete_tblExportFormat_model","model")) { ?>
					<td align="center">
						<a href='controller.php?action=delete_tblExportFormat&id=<?=$exportFormat->lngID;?>&popup_destination=<?=@$popup_destination;?>' onClick='return confirm("Are you sure that you want to delete this tblExportFormat?");'><img src='<?=COMMON_FILES_PATH;?>images/icons/delete.gif' /></a>
						<!--<input type="checkbox" class="tblExportFormats" name="id[]" value="<?=$exportFormat->lngID;?>"/>-->
					</td>
				<?php } ?>
				<td>
					<?php if (accessible_permission("add_tblExportFormat","view")) {
						echo "<a href='?view=add_tblExportFormat&id=".$exportFormat->lngID."'>".$exportFormat->strName."</a>";
					}
					else
						echo $exportFormat->strName;
				?>
				</td>
				<!--<td><?php //echo $exportFormat->strName;?></td>-->
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
				<?php /*if (accessible_permission("delete_tblExportFormat_model","model")) { ?>
				<b>Action:</b> <a href='javascript:void(0)' class="link btn-delete" id='batch_delete'>Remove selected</a>
				<?php }*/ ?> 
			</td>
			<td colspan="2" align="right"><?=$results;?></td>
		</tr>
	</table>

</form>
