<?php
require_once("includes/view_included.php");
//require_once("includes/TimeNote.php");

$status->destination = "add_tblTimeNote";

$id = $db->escapeSimple(trim(@$_REQUEST['id']));
if ($id > 0) {
	$status->destination = "add_tblTimeNote&id=".$id;
}

if (isset($_SESSION[APPLICATION_NAME]['form_data']))
{
	$values = $_SESSION[APPLICATION_NAME]['form_data'];
	unset($_SESSION[APPLICATION_NAME]['form_data']);
	
	$timeNote = new TimeNote(@$id);
	$timeNote->setPropertyValues($values);
}
else {
	$timeNote = new TimeNote($id);
	$timeNote->setPropertyValues($_REQUEST);
}
?>
<script type="text/javascript">
	$(document).ready(function() {
		<?php if (!accessible_permission("add_tblTimeNote_model","model")) { ?>
		$('#save_btn').attr({'class':'button btn-readonly','title':'<?=ERR_READONLY;?>'});
		$('#add_frm').submit(function(){alert('<?=ERR_READONLY;?>');return false;});
		<?php } ?>
		<?php if (!$tblTimeNote->exists) { ?>
		document.forms[0].strNote.focus();
		<?php } ?>
	});
</script>
<div class="page_title"><?=$timeNote->exists ? "Update" : "Add"?> TblTimeNote</div>

<form id="add_frm" action="controller.php?action=<?=$status->destination;?>" method="POST">

<input type="hidden" name="popup_destination" value="<?=@$popup_destination;?>"/>
<input type="hidden" name="force_postback" value=""/>

<table class="grid-def">
<tr class="grid-row_header">
	<td colspan="2">TblTimeNote Information</td>
</tr>
<tr>
	<td class="grid-space" width="55%">
		<table class="grid-form">

		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($timeNote,'lngTimeID')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='lngTimeID' value='<?=$timeNote->lngTimeID;?>'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($timeNote,'strNote')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='strNote' value='<?=$timeNote->strNote;?>' maxlength='255'/>
			</td>
		</tr>
		<tr>
			<td class="column_label" style="vertical-align:middle;"><?=AttributeReader::PropertyAttributes($timeNote,'datDate')->Description;?>: </td>
			<td>
				<input type='text' class='datepicker' name='datDate' value='<?php if($timeNote->datDate != ''){echo date('Y-m-d',strtotime($timeNote->datDate));}?>' />
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>
				<input type="submit" style="width: 65px;" class="button btn-save" value="Save" id="save_btn" />
				<input type="button" style="width: 80px;" class="button btn-cancel" value="Cancel" onclick="window.location.replace('?view=tblTimeNotes');" />
			</td>
		</tr>
		</table>
	</td>
	<?php /*if (@$timeNote->exists) { ?>
	<td class="grid-space">
		<div class="column_label">Related-view (<a class="fancybox" href="popup_index.php?view=related-view&id=<?=$timeNote->lngID;?>&source=<?=urlencode($status->destination);?>">Manage</a>)</div>
		<ul class="dot">
			<?php
			foreach ($items = RelatedClass::getRelatedObjects(array('lngID'=>$timeNote->lngID)) as $r)
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
