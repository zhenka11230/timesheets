<?php
require_once("includes/view_included.php");
//require_once("includes/Time.php");

$status->destination = "add_tblTime";

$id = $db->escapeSimple(trim(@$_REQUEST['id']));
if ($id > 0) {
	$status->destination = "add_tblTime&id=".$id;
}

if (isset($_SESSION[APPLICATION_NAME]['form_data']))
{
	$values = $_SESSION[APPLICATION_NAME]['form_data'];
	unset($_SESSION[APPLICATION_NAME]['form_data']);
	
	$time = new Time(@$id);
	$time->setPropertyValues($values);
}
else {
	$time = new Time($id);
	$time->setPropertyValues($_REQUEST);
}
?>
<script type="text/javascript">
	$(document).ready(function() {
		<?php if (!accessible_permission("add_tblTime_model","model")) { ?>
		$('#save_btn').attr({'class':'button btn-readonly','title':'<?=ERR_READONLY;?>'});
		$('#add_frm').submit(function(){alert('<?=ERR_READONLY;?>');return false;});
		<?php } ?>
		<?php if (!$tblTime->exists) { ?>
		document.forms[0].datEvent.focus();
		<?php } ?>
	});
</script>
<div class="page_title"><?=$time->exists ? "Update" : "Add"?> TblTime</div>

<form id="add_frm" action="controller.php?action=<?=$status->destination;?>" method="POST">

<input type="hidden" name="popup_destination" value="<?=@$popup_destination;?>"/>
<input type="hidden" name="force_postback" value=""/>

<table class="grid-def">
<tr class="grid-row_header">
	<td colspan="2">TblTime Information</td>
</tr>
<tr>
	<td class="grid-space" width="55%">
		<table class="grid-form">

		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($time,'lngEmployeeID')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='lngEmployeeID' value='<?=$time->lngEmployeeID;?>'/>
			</td>
		</tr>
		<tr>
			<td class="column_label" style="vertical-align:middle;"><?=AttributeReader::PropertyAttributes($time,'datEvent')->Description;?>: </td>
			<td>
				<input type='text' class='datepicker' name='datEvent' value='<?php if($time->datEvent != ''){echo date('Y-m-d',strtotime($time->datEvent));}?>' />
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($time,'blnEventType')->Description;?>: <span class="hint" onmouseover="return overlib('Required Field');" onmouseout="return nd();">&nbsp;</span></td>
			<td>
				<label><input type='radio' name='blnEventType' value='1' <?=($time->blnEventType==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnEventType' value='0' <?=($time->blnEventType==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnEventType' <?php if($time->blnEventType == 'on' || $time->blnEventType == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($time,'blnEdited')->Description;?>: <span class="hint" onmouseover="return overlib('Required Field');" onmouseout="return nd();">&nbsp;</span></td>
			<td>
				<label><input type='radio' name='blnEdited' value='1' <?=($time->blnEdited==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnEdited' value='0' <?=($time->blnEdited==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnEdited' <?php if($time->blnEdited == 'on' || $time->blnEdited == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($time,'lngClassificationID')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='lngClassificationID' value='<?=$time->lngClassificationID;?>'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($time,'lngDelegateID')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='lngDelegateID' value='<?=$time->lngDelegateID;?>'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($time,'strHash')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='strHash' value='<?=$time->strHash;?>' maxlength='10'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($time,'lngDepartmentID')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='lngDepartmentID' value='<?=$time->lngDepartmentID;?>'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($time,'bytOvertimeCalculationMethod')->Description;?>: </td>
			<td>
				short
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($time,'lngComputerID')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='lngComputerID' value='<?=$time->lngComputerID;?>'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($time,'lngJobID')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='lngJobID' value='<?=$time->lngJobID;?>'/>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>
				<input type="submit" style="width: 65px;" class="button btn-save" value="Save" id="save_btn" />
				<input type="button" style="width: 80px;" class="button btn-cancel" value="Cancel" onclick="window.location.replace('?view=tblTimes');" />
			</td>
		</tr>
		</table>
	</td>
	<?php /*if (@$time->exists) { ?>
	<td class="grid-space">
		<div class="column_label">Related-view (<a class="fancybox" href="popup_index.php?view=related-view&id=<?=$time->lngID;?>&source=<?=urlencode($status->destination);?>">Manage</a>)</div>
		<ul class="dot">
			<?php
			foreach ($items = RelatedClass::getRelatedObjects(array('lngID'=>$time->lngID)) as $r)
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
