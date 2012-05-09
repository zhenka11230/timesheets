<?php
require_once("includes/view_included.php");
//require_once("includes/Bulletin.php");

$status->destination = "add_tblBulletin";

$id = $db->escapeSimple(trim(@$_REQUEST['id']));
if ($id > 0) {
	$status->destination = "add_tblBulletin&id=".$id;
}

if (isset($_SESSION[APPLICATION_NAME]['form_data']))
{
	$values = $_SESSION[APPLICATION_NAME]['form_data'];
	unset($_SESSION[APPLICATION_NAME]['form_data']);
	
	$bulletin = new Bulletin(@$id);
	$bulletin->setPropertyValues($values);
}
else {
	$bulletin = new Bulletin($id);
	$bulletin->setPropertyValues($_REQUEST);
}
?>
<script type="text/javascript">
	$(document).ready(function() {
		<?php if (!accessible_permission("add_tblBulletin_model","model")) { ?>
		$('#save_btn').attr({'class':'button btn-readonly','title':'<?=ERR_READONLY;?>'});
		$('#add_frm').submit(function(){alert('<?=ERR_READONLY;?>');return false;});
		<?php } ?>
		<?php if (!$tblBulletin->exists) { ?>
		document.forms[0].blnActive.focus();
		<?php } ?>
	});
</script>
<div class="page_title"><?=$bulletin->exists ? "Update" : "Add"?> TblBulletin</div>

<form id="add_frm" action="controller.php?action=<?=$status->destination;?>" method="POST">

<input type="hidden" name="popup_destination" value="<?=@$popup_destination;?>"/>
<input type="hidden" name="force_postback" value=""/>

<table class="grid-def">
<tr class="grid-row_header">
	<td colspan="2">TblBulletin Information</td>
</tr>
<tr>
	<td class="grid-space" width="55%">
		<table class="grid-form">

		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($bulletin,'blnActive')->Description;?>: <span class="hint" onmouseover="return overlib('Required Field');" onmouseout="return nd();">&nbsp;</span></td>
			<td>
				<label><input type='radio' name='blnActive' value='1' <?=($bulletin->blnActive==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnActive' value='0' <?=($bulletin->blnActive==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnActive' <?php if($bulletin->blnActive == 'on' || $bulletin->blnActive == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($bulletin,'strTitle')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='strTitle' value='<?=$bulletin->strTitle;?>' maxlength='255'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($bulletin,'strBulletin')->Description;?>: </td>
			<td>
				<textarea rows='3' class='textbox' name='strBulletin'><?=$bulletin->strBulletin;?></textarea>
			</td>
		</tr>
		<tr>
			<td class="column_label" style="vertical-align:middle;"><?=AttributeReader::PropertyAttributes($bulletin,'datDate')->Description;?>: </td>
			<td>
				<input type='text' class='datepicker' name='datDate' value='<?php if($bulletin->datDate != ''){echo date('Y-m-d',strtotime($bulletin->datDate));}?>' />
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($bulletin,'bytTarget')->Description;?>: </td>
			<td>
				short
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($bulletin,'lngDepartmentID')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='lngDepartmentID' value='<?=$bulletin->lngDepartmentID;?>'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($bulletin,'lngShiftID')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='lngShiftID' value='<?=$bulletin->lngShiftID;?>'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($bulletin,'blnRequireAcceptance')->Description;?>: <span class="hint" onmouseover="return overlib('Required Field');" onmouseout="return nd();">&nbsp;</span></td>
			<td>
				<label><input type='radio' name='blnRequireAcceptance' value='1' <?=($bulletin->blnRequireAcceptance==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnRequireAcceptance' value='0' <?=($bulletin->blnRequireAcceptance==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnRequireAcceptance' <?php if($bulletin->blnRequireAcceptance == 'on' || $bulletin->blnRequireAcceptance == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($bulletin,'blnHighPriority')->Description;?>: <span class="hint" onmouseover="return overlib('Required Field');" onmouseout="return nd();">&nbsp;</span></td>
			<td>
				<label><input type='radio' name='blnHighPriority' value='1' <?=($bulletin->blnHighPriority==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnHighPriority' value='0' <?=($bulletin->blnHighPriority==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnHighPriority' <?php if($bulletin->blnHighPriority == 'on' || $bulletin->blnHighPriority == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>
				<input type="submit" style="width: 65px;" class="button btn-save" value="Save" id="save_btn" />
				<input type="button" style="width: 80px;" class="button btn-cancel" value="Cancel" onclick="window.location.replace('?view=tblBulletins');" />
			</td>
		</tr>
		</table>
	</td>
	<?php /*if (@$bulletin->exists) { ?>
	<td class="grid-space">
		<div class="column_label">Related-view (<a class="fancybox" href="popup_index.php?view=related-view&id=<?=$bulletin->lngID;?>&source=<?=urlencode($status->destination);?>">Manage</a>)</div>
		<ul class="dot">
			<?php
			foreach ($items = RelatedClass::getRelatedObjects(array('lngID'=>$bulletin->lngID)) as $r)
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
