<?php
require_once("includes/view_included.php");
//require_once("includes/Job.php");

$status->destination = "add_tblJob";

$id = $db->escapeSimple(trim(@$_REQUEST['id']));
if ($id > 0) {
	$status->destination = "add_tblJob&id=".$id;
}

if (isset($_SESSION[APPLICATION_NAME]['form_data']))
{
	$values = $_SESSION[APPLICATION_NAME]['form_data'];
	unset($_SESSION[APPLICATION_NAME]['form_data']);
	
	$job = new Job(@$id);
	$job->setPropertyValues($values);
}
else {
	$job = new Job($id);
	$job->setPropertyValues($_REQUEST);
}
?>
<script type="text/javascript">
	$(document).ready(function() {
		<?php if (!accessible_permission("add_tblJob_model","model")) { ?>
		$('#save_btn').attr({'class':'button btn-readonly','title':'<?=ERR_READONLY;?>'});
		$('#add_frm').submit(function(){alert('<?=ERR_READONLY;?>');return false;});
		<?php } ?>
		<?php if (!$tblJob->exists) { ?>
		document.forms[0].lngCode.focus();
		<?php } ?>
	});
</script>
<div class="page_title"><?=$job->exists ? "Update" : "Add"?> TblJob</div>

<form id="add_frm" action="controller.php?action=<?=$status->destination;?>" method="POST">

<input type="hidden" name="popup_destination" value="<?=@$popup_destination;?>"/>
<input type="hidden" name="force_postback" value=""/>

<table class="grid-def">
<tr class="grid-row_header">
	<td colspan="2">TblJob Information</td>
</tr>
<tr>
	<td class="grid-space" width="55%">
		<table class="grid-form">

		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($job,'lngCode')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='lngCode' value='<?=$job->lngCode;?>'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($job,'strName')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='strName' value='<?=$job->strName;?>' maxlength='255'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($job,'strDescription')->Description;?>: </td>
			<td>
				<textarea rows='3' class='textbox' name='strDescription'><?=$job->strDescription;?></textarea>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($job,'blnDisabled')->Description;?>: <span class="hint" onmouseover="return overlib('Required Field');" onmouseout="return nd();">&nbsp;</span></td>
			<td>
				<label><input type='radio' name='blnDisabled' value='1' <?=($job->blnDisabled==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnDisabled' value='0' <?=($job->blnDisabled==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnDisabled' <?php if($job->blnDisabled == 'on' || $job->blnDisabled == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($job,'blnDeleted')->Description;?>: <span class="hint" onmouseover="return overlib('Required Field');" onmouseout="return nd();">&nbsp;</span></td>
			<td>
				<label><input type='radio' name='blnDeleted' value='1' <?=($job->blnDeleted==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnDeleted' value='0' <?=($job->blnDeleted==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnDeleted' <?php if($job->blnDeleted == 'on' || $job->blnDeleted == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>
				<input type="submit" style="width: 65px;" class="button btn-save" value="Save" id="save_btn" />
				<input type="button" style="width: 80px;" class="button btn-cancel" value="Cancel" onclick="window.location.replace('?view=tblJobs');" />
			</td>
		</tr>
		</table>
	</td>
	<?php /*if (@$job->exists) { ?>
	<td class="grid-space">
		<div class="column_label">Related-view (<a class="fancybox" href="popup_index.php?view=related-view&id=<?=$job->lngID;?>&source=<?=urlencode($status->destination);?>">Manage</a>)</div>
		<ul class="dot">
			<?php
			foreach ($items = RelatedClass::getRelatedObjects(array('lngID'=>$job->lngID)) as $r)
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
