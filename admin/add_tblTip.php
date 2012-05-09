<?php
require_once("includes/view_included.php");
//require_once("includes/Tip.php");

$status->destination = "add_tblTip";

$id = $db->escapeSimple(trim(@$_REQUEST['id']));
if ($id > 0) {
	$status->destination = "add_tblTip&id=".$id;
}

if (isset($_SESSION[APPLICATION_NAME]['form_data']))
{
	$values = $_SESSION[APPLICATION_NAME]['form_data'];
	unset($_SESSION[APPLICATION_NAME]['form_data']);
	
	$tip = new Tip(@$id);
	$tip->setPropertyValues($values);
}
else {
	$tip = new Tip($id);
	$tip->setPropertyValues($_REQUEST);
}
?>
<script type="text/javascript">
	$(document).ready(function() {
		<?php if (!accessible_permission("add_tblTip_model","model")) { ?>
		$('#save_btn').attr({'class':'button btn-readonly','title':'<?=ERR_READONLY;?>'});
		$('#add_frm').submit(function(){alert('<?=ERR_READONLY;?>');return false;});
		<?php } ?>
		<?php if (!$tblTip->exists) { ?>
		document.forms[0].lngEmployeeID.focus();
		<?php } ?>
	});
</script>
<div class="page_title"><?=$tip->exists ? "Update" : "Add"?> TblTip</div>

<form id="add_frm" action="controller.php?action=<?=$status->destination;?>" method="POST">

<input type="hidden" name="popup_destination" value="<?=@$popup_destination;?>"/>
<input type="hidden" name="force_postback" value=""/>

<table class="grid-def">
<tr class="grid-row_header">
	<td colspan="2">TblTip Information</td>
</tr>
<tr>
	<td class="grid-space" width="55%">
		<table class="grid-form">

		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($tip,'lngEmployeeID')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='lngEmployeeID' value='<?=$tip->lngEmployeeID;?>'/>
			</td>
		</tr>
		<tr>
			<td class="column_label" style="vertical-align:middle;"><?=AttributeReader::PropertyAttributes($tip,'datReceived')->Description;?>: </td>
			<td>
				<input type='text' class='datepicker' name='datReceived' value='<?php if($tip->datReceived != ''){echo date('Y-m-d',strtotime($tip->datReceived));}?>' />
			</td>
		</tr>
		<tr>
			<td class="column_label" style="vertical-align:middle;"><?=AttributeReader::PropertyAttributes($tip,'datRecorded')->Description;?>: </td>
			<td>
				<input type='text' class='datepicker' name='datRecorded' value='<?php if($tip->datRecorded != ''){echo date('Y-m-d',strtotime($tip->datRecorded));}?>' />
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($tip,'sngDirect')->Description;?>: </td>
			<td>
				float
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($tip,'sngDebitCredit')->Description;?>: </td>
			<td>
				float
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($tip,'sngPaidOut')->Description;?>: </td>
			<td>
				float
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($tip,'blnEdited')->Description;?>: <span class="hint" onmouseover="return overlib('Required Field');" onmouseout="return nd();">&nbsp;</span></td>
			<td>
				<label><input type='radio' name='blnEdited' value='1' <?=($tip->blnEdited==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnEdited' value='0' <?=($tip->blnEdited==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnEdited' <?php if($tip->blnEdited == 'on' || $tip->blnEdited == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>
				<input type="submit" style="width: 65px;" class="button btn-save" value="Save" id="save_btn" />
				<input type="button" style="width: 80px;" class="button btn-cancel" value="Cancel" onclick="window.location.replace('?view=tblTips');" />
			</td>
		</tr>
		</table>
	</td>
	<?php /*if (@$tip->exists) { ?>
	<td class="grid-space">
		<div class="column_label">Related-view (<a class="fancybox" href="popup_index.php?view=related-view&id=<?=$tip->lngID;?>&source=<?=urlencode($status->destination);?>">Manage</a>)</div>
		<ul class="dot">
			<?php
			foreach ($items = RelatedClass::getRelatedObjects(array('lngID'=>$tip->lngID)) as $r)
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
