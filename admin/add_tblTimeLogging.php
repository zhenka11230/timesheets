<?php
require_once("includes/view_included.php");
//require_once("includes/TimeLogging.php");

$status->destination = "add_tblTimeLogging";

$id = $db->escapeSimple(trim(@$_REQUEST['id']));
if ($id > 0) {
	$status->destination = "add_tblTimeLogging&id=".$id;
}

if (isset($_SESSION[APPLICATION_NAME]['form_data']))
{
	$values = $_SESSION[APPLICATION_NAME]['form_data'];
	unset($_SESSION[APPLICATION_NAME]['form_data']);
	
	$timeLogging = new TimeLogging(@$id);
	$timeLogging->setPropertyValues($values);
}
else {
	$timeLogging = new TimeLogging($id);
	$timeLogging->setPropertyValues($_REQUEST);
}
?>
<script type="text/javascript">
	$(document).ready(function() {
		<?php if (!accessible_permission("add_tblTimeLogging_model","model")) { ?>
		$('#save_btn').attr({'class':'button btn-readonly','title':'<?=ERR_READONLY;?>'});
		$('#add_frm').submit(function(){alert('<?=ERR_READONLY;?>');return false;});
		<?php } ?>
		<?php if (!$tblTimeLogging->exists) { ?>
		document.forms[0].strDate.focus();
		<?php } ?>
	});
</script>
<div class="page_title"><?=$timeLogging->exists ? "Update" : "Add"?> TblTimeLogging</div>

<form id="add_frm" action="controller.php?action=<?=$status->destination;?>" method="POST">

<input type="hidden" name="popup_destination" value="<?=@$popup_destination;?>"/>
<input type="hidden" name="force_postback" value=""/>

<table class="grid-def">
<tr class="grid-row_header">
	<td colspan="2">TblTimeLogging Information</td>
</tr>
<tr>
	<td class="grid-space" width="55%">
		<table class="grid-form">

		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($timeLogging,'strDate')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='strDate' value='<?=$timeLogging->strDate;?>' maxlength='255'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($timeLogging,'strLogType')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='strLogType' value='<?=$timeLogging->strLogType;?>' maxlength='255'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($timeLogging,'strTimeID')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='strTimeID' value='<?=$timeLogging->strTimeID;?>' maxlength='255'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($timeLogging,'strEvent')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='strEvent' value='<?=$timeLogging->strEvent;?>' maxlength='255'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($timeLogging,'strEventType')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='strEventType' value='<?=$timeLogging->strEventType;?>' maxlength='255'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($timeLogging,'strClassificationID')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='strClassificationID' value='<?=$timeLogging->strClassificationID;?>' maxlength='255'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($timeLogging,'strDelegateID')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='strDelegateID' value='<?=$timeLogging->strDelegateID;?>' maxlength='255'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($timeLogging,'strDepartmentID')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='strDepartmentID' value='<?=$timeLogging->strDepartmentID;?>' maxlength='255'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($timeLogging,'strOvertimeCalculationMethod')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='strOvertimeCalculationMethod' value='<?=$timeLogging->strOvertimeCalculationMethod;?>' maxlength='255'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($timeLogging,'strComputerID')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='strComputerID' value='<?=$timeLogging->strComputerID;?>' maxlength='255'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($timeLogging,'strJobID')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='strJobID' value='<?=$timeLogging->strJobID;?>' maxlength='255'/>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>
				<input type="submit" style="width: 65px;" class="button btn-save" value="Save" id="save_btn" />
				<input type="button" style="width: 80px;" class="button btn-cancel" value="Cancel" onclick="window.location.replace('?view=tblTimeLogging');" />
			</td>
		</tr>
		</table>
	</td>
	<?php /*if (@$timeLogging->exists) { ?>
	<td class="grid-space">
		<div class="column_label">Related-view (<a class="fancybox" href="popup_index.php?view=related-view&id=<?=$timeLogging->lngID;?>&source=<?=urlencode($status->destination);?>">Manage</a>)</div>
		<ul class="dot">
			<?php
			foreach ($items = RelatedClass::getRelatedObjects(array('lngID'=>$timeLogging->lngID)) as $r)
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
