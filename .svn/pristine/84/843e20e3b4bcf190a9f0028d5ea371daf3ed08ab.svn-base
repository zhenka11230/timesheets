<?php
require_once("includes/view_included.php");
//require_once("includes/Connection.php");

$status->destination = "add_tblConnection";

$id = $db->escapeSimple(trim(@$_REQUEST['id']));
if ($id > 0) {
	$status->destination = "add_tblConnection&id=".$id;
}

if (isset($_SESSION[APPLICATION_NAME]['form_data']))
{
	$values = $_SESSION[APPLICATION_NAME]['form_data'];
	unset($_SESSION[APPLICATION_NAME]['form_data']);
	
	$connection = new Connection(@$id);
	$connection->setPropertyValues($values);
}
else {
	$connection = new Connection($id);
	$connection->setPropertyValues($_REQUEST);
}
?>
<script type="text/javascript">
	$(document).ready(function() {
		<?php if (!accessible_permission("add_tblConnection_model","model")) { ?>
		$('#save_btn').attr({'class':'button btn-readonly','title':'<?=ERR_READONLY;?>'});
		$('#add_frm').submit(function(){alert('<?=ERR_READONLY;?>');return false;});
		<?php } ?>
		<?php if (!$tblConnection->exists) { ?>
		document.forms[0].strMAC.focus();
		<?php } ?>
	});
</script>
<div class="page_title"><?=$connection->exists ? "Update" : "Add"?> TblConnection</div>

<form id="add_frm" action="controller.php?action=<?=$status->destination;?>" method="POST">

<input type="hidden" name="popup_destination" value="<?=@$popup_destination;?>"/>
<input type="hidden" name="force_postback" value=""/>

<table class="grid-def">
<tr class="grid-row_header">
	<td colspan="2">TblConnection Information</td>
</tr>
<tr>
	<td class="grid-space" width="55%">
		<table class="grid-form">

		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($connection,'strMAC')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='strMAC' value='<?=$connection->strMAC;?>' maxlength='255'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($connection,'strComputerName')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='strComputerName' value='<?=$connection->strComputerName;?>' maxlength='255'/>
			</td>
		</tr>
		<tr>
			<td class="column_label" style="vertical-align:middle;"><?=AttributeReader::PropertyAttributes($connection,'datDate')->Description;?>: </td>
			<td>
				<input type='text' class='datepicker' name='datDate' value='<?php if($connection->datDate != ''){echo date('Y-m-d',strtotime($connection->datDate));}?>' />
			</td>
		</tr>
		<tr>
			<td class="column_label" style="vertical-align:middle;"><?=AttributeReader::PropertyAttributes($connection,'datAction')->Description;?>: </td>
			<td>
				<input type='text' class='datepicker' name='datAction' value='<?php if($connection->datAction != ''){echo date('Y-m-d',strtotime($connection->datAction));}?>' />
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($connection,'bytType')->Description;?>: </td>
			<td>
				short
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>
				<input type="submit" style="width: 65px;" class="button btn-save" value="Save" id="save_btn" />
				<input type="button" style="width: 80px;" class="button btn-cancel" value="Cancel" onclick="window.location.replace('?view=tblConnections');" />
			</td>
		</tr>
		</table>
	</td>
	<?php /*if (@$connection->exists) { ?>
	<td class="grid-space">
		<div class="column_label">Related-view (<a class="fancybox" href="popup_index.php?view=related-view&id=<?=$connection->lngID;?>&source=<?=urlencode($status->destination);?>">Manage</a>)</div>
		<ul class="dot">
			<?php
			foreach ($items = RelatedClass::getRelatedObjects(array('lngID'=>$connection->lngID)) as $r)
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
