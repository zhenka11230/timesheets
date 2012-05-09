<?php
require_once("includes/view_included.php");
//require_once("includes/ExportFormat.php");

$status->destination = "add_tblExportFormat";

$id = $db->escapeSimple(trim(@$_REQUEST['id']));
if ($id > 0) {
	$status->destination = "add_tblExportFormat&id=".$id;
}

if (isset($_SESSION[APPLICATION_NAME]['form_data']))
{
	$values = $_SESSION[APPLICATION_NAME]['form_data'];
	unset($_SESSION[APPLICATION_NAME]['form_data']);
	
	$exportFormat = new ExportFormat(@$id);
	$exportFormat->setPropertyValues($values);
}
else {
	$exportFormat = new ExportFormat($id);
	$exportFormat->setPropertyValues($_REQUEST);
}
?>
<script type="text/javascript">
	$(document).ready(function() {
		<?php if (!accessible_permission("add_tblExportFormat_model","model")) { ?>
		$('#save_btn').attr({'class':'button btn-readonly','title':'<?=ERR_READONLY;?>'});
		$('#add_frm').submit(function(){alert('<?=ERR_READONLY;?>');return false;});
		<?php } ?>
		<?php if (!$tblExportFormat->exists) { ?>
		document.forms[0].strName.focus();
		<?php } ?>
	});
</script>
<div class="page_title"><?=$exportFormat->exists ? "Update" : "Add"?> TblExportFormat</div>

<form id="add_frm" action="controller.php?action=<?=$status->destination;?>" method="POST">

<input type="hidden" name="popup_destination" value="<?=@$popup_destination;?>"/>
<input type="hidden" name="force_postback" value=""/>

<table class="grid-def">
<tr class="grid-row_header">
	<td colspan="2">TblExportFormat Information</td>
</tr>
<tr>
	<td class="grid-space" width="55%">
		<table class="grid-form">

		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($exportFormat,'strName')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='strName' value='<?=$exportFormat->strName;?>' maxlength='255'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($exportFormat,'blnType')->Description;?>: <span class="hint" onmouseover="return overlib('Required Field');" onmouseout="return nd();">&nbsp;</span></td>
			<td>
				<label><input type='radio' name='blnType' value='1' <?=($exportFormat->blnType==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnType' value='0' <?=($exportFormat->blnType==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnType' <?php if($exportFormat->blnType == 'on' || $exportFormat->blnType == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($exportFormat,'strDateFormat')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='strDateFormat' value='<?=$exportFormat->strDateFormat;?>' maxlength='255'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($exportFormat,'strTimeFormat')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='strTimeFormat' value='<?=$exportFormat->strTimeFormat;?>' maxlength='255'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($exportFormat,'strNormalCode')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='strNormalCode' value='<?=$exportFormat->strNormalCode;?>' maxlength='255'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($exportFormat,'strOtherCode')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='strOtherCode' value='<?=$exportFormat->strOtherCode;?>' maxlength='255'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($exportFormat,'strSickCode')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='strSickCode' value='<?=$exportFormat->strSickCode;?>' maxlength='255'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($exportFormat,'strVacationCode')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='strVacationCode' value='<?=$exportFormat->strVacationCode;?>' maxlength='255'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($exportFormat,'strHolidayCode')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='strHolidayCode' value='<?=$exportFormat->strHolidayCode;?>' maxlength='255'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($exportFormat,'strOT1Code')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='strOT1Code' value='<?=$exportFormat->strOT1Code;?>' maxlength='255'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($exportFormat,'strOT2Code')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='strOT2Code' value='<?=$exportFormat->strOT2Code;?>' maxlength='255'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($exportFormat,'strFormat')->Description;?>: </td>
			<td>
				<textarea rows='3' class='textbox' name='strFormat'><?=$exportFormat->strFormat;?></textarea>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>
				<input type="submit" style="width: 65px;" class="button btn-save" value="Save" id="save_btn" />
				<input type="button" style="width: 80px;" class="button btn-cancel" value="Cancel" onclick="window.location.replace('?view=tblExportFormats');" />
			</td>
		</tr>
		</table>
	</td>
	<?php /*if (@$exportFormat->exists) { ?>
	<td class="grid-space">
		<div class="column_label">Related-view (<a class="fancybox" href="popup_index.php?view=related-view&id=<?=$exportFormat->lngID;?>&source=<?=urlencode($status->destination);?>">Manage</a>)</div>
		<ul class="dot">
			<?php
			foreach ($items = RelatedClass::getRelatedObjects(array('lngID'=>$exportFormat->lngID)) as $r)
			{
				?><li><b><a class="fancybox" href="popup_index.php?view=add_related_view&id=<?=$r->lngID;?>&source=<?=urlencode($status->destination);?>"><?=$r->related_name;?></a></li><?php
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
