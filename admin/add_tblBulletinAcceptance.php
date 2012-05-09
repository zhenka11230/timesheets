<?php
require_once("includes/view_included.php");
//require_once("includes/BulletinAcceptance.php");

$status->destination = "add_tblBulletinAcceptance";

$id = $db->escapeSimple(trim(@$_REQUEST['id']));
if ($id > 0) {
	$status->destination = "add_tblBulletinAcceptance&id=".$id;
}

if (isset($_SESSION[APPLICATION_NAME]['form_data']))
{
	$values = $_SESSION[APPLICATION_NAME]['form_data'];
	unset($_SESSION[APPLICATION_NAME]['form_data']);
	
	$bulletinAcceptance = new BulletinAcceptance(@$id);
	$bulletinAcceptance->setPropertyValues($values);
}
else {
	$bulletinAcceptance = new BulletinAcceptance($id);
	$bulletinAcceptance->setPropertyValues($_REQUEST);
}
?>
<script type="text/javascript">
	$(document).ready(function() {
		<?php if (!accessible_permission("add_tblBulletinAcceptance_model","model")) { ?>
		$('#save_btn').attr({'class':'button btn-readonly','title':'<?=ERR_READONLY;?>'});
		$('#add_frm').submit(function(){alert('<?=ERR_READONLY;?>');return false;});
		<?php } ?>
		<?php if (!$tblBulletinAcceptance->exists) { ?>
		document.forms[0].lngEmployeeID.focus();
		<?php } ?>
	});
</script>
<div class="page_title"><?=$bulletinAcceptance->exists ? "Update" : "Add"?> TblBulletinAcceptance</div>

<form id="add_frm" action="controller.php?action=<?=$status->destination;?>" method="POST">

<input type="hidden" name="popup_destination" value="<?=@$popup_destination;?>"/>
<input type="hidden" name="force_postback" value=""/>

<table class="grid-def">
<tr class="grid-row_header">
	<td colspan="2">TblBulletinAcceptance Information</td>
</tr>
<tr>
	<td class="grid-space" width="55%">
		<table class="grid-form">

		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($bulletinAcceptance,'lngEmployeeID')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='lngEmployeeID' value='<?=$bulletinAcceptance->lngEmployeeID;?>'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($bulletinAcceptance,'lngBulletinID')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='lngBulletinID' value='<?=$bulletinAcceptance->lngBulletinID;?>'/>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>
				<input type="submit" style="width: 65px;" class="button btn-save" value="Save" id="save_btn" />
				<input type="button" style="width: 80px;" class="button btn-cancel" value="Cancel" onclick="window.location.replace('?view=tblBulletinAcceptances');" />
			</td>
		</tr>
		</table>
	</td>
	<?php /*if (@$bulletinAcceptance->exists) { ?>
	<td class="grid-space">
		<div class="column_label">Related-view (<a class="fancybox" href="popup_index.php?view=related-view&id=<?=$bulletinAcceptance->lngID;?>&source=<?=urlencode($status->destination);?>">Manage</a>)</div>
		<ul class="dot">
			<?php
			foreach ($items = RelatedClass::getRelatedObjects(array('lngID'=>$bulletinAcceptance->lngID)) as $r)
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
