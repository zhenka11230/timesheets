<?php
require_once("includes/view_included.php");
//require_once("includes/EmployeeMapping.php");

$status->destination = "add_employee_mapping";

$id = $db->escapeSimple(trim(@$_REQUEST['id']));
if ($id > 0) {
	$status->destination = "add_employee_mapping&id=".$id;
}

if (isset($_SESSION[APPLICATION_NAME]['form_data']))
{
	$values = $_SESSION[APPLICATION_NAME]['form_data'];
	unset($_SESSION[APPLICATION_NAME]['form_data']);
	
	$employeeMapping = new EmployeeMapping(@$id);
	$employeeMapping->setPropertyValues($values);
}
else {
	$employeeMapping = new EmployeeMapping($id);
	$employeeMapping->setPropertyValues($_REQUEST);
}
?>
<script type="text/javascript">
	$(document).ready(function() {
		<?php if (!accessible_permission("add_employee_mapping_model","model")) { ?>
		$('#save_btn').attr({'class':'button btn-readonly','title':'<?=ERR_READONLY;?>'});
		$('#add_frm').submit(function(){alert('<?=ERR_READONLY;?>');return false;});
		<?php } ?>
		<?php if (!$employee_mapping->exists) { ?>
		document.forms[0].employee_id.focus();
		<?php } ?>
	});
</script>
<div class="page_title"><?=$employeeMapping->exists ? "Update" : "Add"?> Employee Mapping</div>

<form id="add_frm" action="controller.php?action=<?=$status->destination;?>" method="POST">

<input type="hidden" name="popup_destination" value="<?=@$popup_destination;?>"/>
<input type="hidden" name="force_postback" value=""/>

<table class="grid-def">
<tr class="grid-row_header">
	<td colspan="2">Employee Mapping Information</td>
</tr>
<tr>
	<td class="grid-space" width="55%">
		<table class="grid-form">

		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($employeeMapping,'employee_id')->Description;?>: <span class="hint" onmouseover="return overlib('Required Field');" onmouseout="return nd();">&nbsp;</span></td>
			<td>
				<select name='employee_id' class='textbox'><option value=''></option><?php foreach(Employee::getEmployees() as $r) { ?><option value='<?=$r->lngID;?>' <?= ($r->lngID == $employeeMapping->employee_id ? "SELECTED='SELECTED'":"") ?>><?=$r->strFullName;?></option><?php } ?></select>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($employeeMapping,'user_id')->Description;?>: <span class="hint" onmouseover="return overlib('Required Field');" onmouseout="return nd();">&nbsp;</span></td>
			<td>
				<select name='user_id' class='textbox'><option value=''></option><?php foreach(Authentication_User::getUsers() as $r) { ?><option value='<?=$r->user_id;?>' <?= ($r->user_id == $employeeMapping->user_id ? "SELECTED='SELECTED'":"") ?>><?=$r->getName();?></option><?php } ?></select>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>
				<input type="submit" style="width: 65px;" class="button btn-save" value="Save" id="save_btn" />
				<input type="button" style="width: 80px;" class="button btn-cancel" value="Cancel" onclick="window.location.replace('?view=employee_mappings');" />
			</td>
		</tr>
		</table>
	</td>
	<?php /*if (@$employeeMapping->exists) { ?>
	<td class="grid-space">
		<div class="column_label">Related-view (<a class="fancybox" href="popup_index.php?view=related-view&id=<?=$employeeMapping->employee_mapping_id;?>&source=<?=urlencode($status->destination);?>">Manage</a>)</div>
		<ul class="dot">
			<?php
			foreach ($items = RelatedClass::getRelatedObjects(array('employee_mapping_id'=>$employeeMapping->employee_mapping_id)) as $r)
			{
				?><li><b><a class="fancybox" href="popup_index.php?view=add_related_view&id=<?=$r->employee_mapping_id;?>&source=<?=urlencode($status->destination);?>"><?=$r->related_name;?></a></li><?php
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
