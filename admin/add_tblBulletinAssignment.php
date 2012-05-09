<?php
require_once("includes/view_included.php");
//require_once("includes/BulletinAssignment.php");

$status->destination = "add_tblBulletinAssignment";

$id = $db->escapeSimple(trim(@$_REQUEST['id']));
if ($id > 0) {
	$status->destination = "add_tblBulletinAssignment&id=".$id;
}

if (isset($_SESSION[APPLICATION_NAME]['form_data']))
{
	$values = $_SESSION[APPLICATION_NAME]['form_data'];
	unset($_SESSION[APPLICATION_NAME]['form_data']);
	
	$bulletinAssignment = new BulletinAssignment(@$id);
	$bulletinAssignment->setPropertyValues($values);
}
else {
	$bulletinAssignment = new BulletinAssignment($id);
	$bulletinAssignment->setPropertyValues($_REQUEST);
}
?>
<script type="text/javascript">
	$(document).ready(function() {
		<?php if (!accessible_permission("add_tblBulletinAssignment_model","model")) { ?>
		$('#save_btn').attr({'class':'button btn-readonly','title':'<?=ERR_READONLY;?>'});
		$('#add_frm').submit(function(){alert('<?=ERR_READONLY;?>');return false;});
		<?php } ?>
		<?php if (!$tblBulletinAssignment->exists) { ?>
		document.forms[0].lngBulletinID.focus();
		<?php } ?>
	});
</script>
<div class="page_title"><?=$bulletinAssignment->exists ? "Update" : "Add"?> TblBulletinAssignment</div>

<form id="add_frm" action="controller.php?action=<?=$status->destination;?>" method="POST">

<input type="hidden" name="popup_destination" value="<?=@$popup_destination;?>"/>
<input type="hidden" name="force_postback" value=""/>

<table class="grid-def">
<tr class="grid-row_header">
	<td colspan="2">TblBulletinAssignment Information</td>
</tr>
<tr>
	<td class="grid-space" width="55%">
		<table class="grid-form">

		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($bulletinAssignment,'lngBulletinID')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='lngBulletinID' value='<?=$bulletinAssignment->lngBulletinID;?>'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($bulletinAssignment,'lngEmployeeID')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='lngEmployeeID' value='<?=$bulletinAssignment->lngEmployeeID;?>'/>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>
				<input type="submit" style="width: 65px;" class="button btn-save" value="Save" id="save_btn" />
				<input type="button" style="width: 80px;" class="button btn-cancel" value="Cancel" onclick="window.location.replace('?view=tblBulletinAssignments');" />
			</td>
		</tr>
		</table>
	</td>
	<?php /*if (@$bulletinAssignment->exists) { ?>
	<td class="grid-space">
		<div class="column_label">Related-view (<a class="fancybox" href="popup_index.php?view=related-view&id=<?=$bulletinAssignment->lngID;?>&source=<?=urlencode($status->destination);?>">Manage</a>)</div>
		<ul class="dot">
			<?php
			foreach ($items = RelatedClass::getRelatedObjects(array('lngID'=>$bulletinAssignment->lngID)) as $r)
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
