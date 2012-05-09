<?php
require_once("includes/view_included.php");
//require_once("includes/EmploymentType.php");

$status->destination = "add_tblEmploymentType";

$id = $db->escapeSimple(trim(@$_REQUEST['id']));
if ($id > 0) {
	$status->destination = "add_tblEmploymentType&id=".$id;
}

if (isset($_SESSION[APPLICATION_NAME]['form_data']))
{
	$values = $_SESSION[APPLICATION_NAME]['form_data'];
	unset($_SESSION[APPLICATION_NAME]['form_data']);
	
	$employmentType = new EmploymentType(@$id);
	$employmentType->setPropertyValues($values);
}
else {
	$employmentType = new EmploymentType($id);
	$employmentType->setPropertyValues($_REQUEST);
}
?>
<script type="text/javascript">
	$(document).ready(function() {
		<?php if (!accessible_permission("add_tblEmploymentType_model","model")) { ?>
		$('#save_btn').attr({'class':'button btn-readonly','title':'<?=ERR_READONLY;?>'});
		$('#add_frm').submit(function(){alert('<?=ERR_READONLY;?>');return false;});
		<?php } ?>
		<?php if (!$tblEmploymentType->exists) { ?>
		document.forms[0].strName.focus();
		<?php } ?>
	});
</script>
<div class="page_title"><?=$employmentType->exists ? "Update" : "Add"?> TblEmploymentType</div>

<form id="add_frm" action="controller.php?action=<?=$status->destination;?>" method="POST">

<input type="hidden" name="popup_destination" value="<?=@$popup_destination;?>"/>
<input type="hidden" name="force_postback" value=""/>

<table class="grid-def">
<tr class="grid-row_header">
	<td colspan="2">TblEmploymentType Information</td>
</tr>
<tr>
	<td class="grid-space" width="55%">
		<table class="grid-form">

		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($employmentType,'strName')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='strName' value='<?=$employmentType->strName;?>' maxlength='255'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($employmentType,'blnAccrueVacations')->Description;?>: <span class="hint" onmouseover="return overlib('Required Field');" onmouseout="return nd();">&nbsp;</span></td>
			<td>
				<label><input type='radio' name='blnAccrueVacations' value='1' <?=($employmentType->blnAccrueVacations==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnAccrueVacations' value='0' <?=($employmentType->blnAccrueVacations==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnAccrueVacations' <?php if($employmentType->blnAccrueVacations == 'on' || $employmentType->blnAccrueVacations == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($employmentType,'lngVacationStartAfter')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='lngVacationStartAfter' value='<?=$employmentType->lngVacationStartAfter;?>'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($employmentType,'bytVacationStartAferUnits')->Description;?>: </td>
			<td>
				short
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($employmentType,'sngVacationStartAt')->Description;?>: </td>
			<td>
				float
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($employmentType,'sngVacationAccrue')->Description;?>: </td>
			<td>
				float
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($employmentType,'sngVacationAccrueEvery')->Description;?>: </td>
			<td>
				float
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($employmentType,'bytVacationAccrueUnit')->Description;?>: </td>
			<td>
				short
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($employmentType,'blnVacationAccrueLimit')->Description;?>: <span class="hint" onmouseover="return overlib('Required Field');" onmouseout="return nd();">&nbsp;</span></td>
			<td>
				<label><input type='radio' name='blnVacationAccrueLimit' value='1' <?=($employmentType->blnVacationAccrueLimit==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnVacationAccrueLimit' value='0' <?=($employmentType->blnVacationAccrueLimit==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnVacationAccrueLimit' <?php if($employmentType->blnVacationAccrueLimit == 'on' || $employmentType->blnVacationAccrueLimit == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($employmentType,'sngVacationAccrueLimit')->Description;?>: </td>
			<td>
				float
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($employmentType,'bytVacationResetAccrual')->Description;?>: </td>
			<td>
				short
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($employmentType,'blnVacationCarryOverBalance')->Description;?>: <span class="hint" onmouseover="return overlib('Required Field');" onmouseout="return nd();">&nbsp;</span></td>
			<td>
				<label><input type='radio' name='blnVacationCarryOverBalance' value='1' <?=($employmentType->blnVacationCarryOverBalance==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnVacationCarryOverBalance' value='0' <?=($employmentType->blnVacationCarryOverBalance==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnVacationCarryOverBalance' <?php if($employmentType->blnVacationCarryOverBalance == 'on' || $employmentType->blnVacationCarryOverBalance == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($employmentType,'blnAccrueSickLeave')->Description;?>: <span class="hint" onmouseover="return overlib('Required Field');" onmouseout="return nd();">&nbsp;</span></td>
			<td>
				<label><input type='radio' name='blnAccrueSickLeave' value='1' <?=($employmentType->blnAccrueSickLeave==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnAccrueSickLeave' value='0' <?=($employmentType->blnAccrueSickLeave==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnAccrueSickLeave' <?php if($employmentType->blnAccrueSickLeave == 'on' || $employmentType->blnAccrueSickLeave == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($employmentType,'lngSickLeaveStartAfter')->Description;?>: </td>
			<td>
				<input type='text' class='textbox' name='lngSickLeaveStartAfter' value='<?=$employmentType->lngSickLeaveStartAfter;?>'/>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($employmentType,'bytSickLeaveStartAferUnits')->Description;?>: </td>
			<td>
				short
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($employmentType,'sngSickLeaveStartAt')->Description;?>: </td>
			<td>
				float
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($employmentType,'sngSickLeaveAccrue')->Description;?>: </td>
			<td>
				float
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($employmentType,'sngSickLeaveAccrueEvery')->Description;?>: </td>
			<td>
				float
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($employmentType,'bytSickLeaveAccrueUnit')->Description;?>: </td>
			<td>
				short
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($employmentType,'blnSickLeaveAccrueLimit')->Description;?>: <span class="hint" onmouseover="return overlib('Required Field');" onmouseout="return nd();">&nbsp;</span></td>
			<td>
				<label><input type='radio' name='blnSickLeaveAccrueLimit' value='1' <?=($employmentType->blnSickLeaveAccrueLimit==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnSickLeaveAccrueLimit' value='0' <?=($employmentType->blnSickLeaveAccrueLimit==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnSickLeaveAccrueLimit' <?php if($employmentType->blnSickLeaveAccrueLimit == 'on' || $employmentType->blnSickLeaveAccrueLimit == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($employmentType,'sngSickLeaveAccrueLimit')->Description;?>: </td>
			<td>
				float
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($employmentType,'bytSickLeaveResetAccrual')->Description;?>: </td>
			<td>
				short
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($employmentType,'blnSickLeaveCarryOverBalance')->Description;?>: <span class="hint" onmouseover="return overlib('Required Field');" onmouseout="return nd();">&nbsp;</span></td>
			<td>
				<label><input type='radio' name='blnSickLeaveCarryOverBalance' value='1' <?=($employmentType->blnSickLeaveCarryOverBalance==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnSickLeaveCarryOverBalance' value='0' <?=($employmentType->blnSickLeaveCarryOverBalance==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnSickLeaveCarryOverBalance' <?php if($employmentType->blnSickLeaveCarryOverBalance == 'on' || $employmentType->blnSickLeaveCarryOverBalance == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($employmentType,'blnVacationUseHireDate')->Description;?>: <span class="hint" onmouseover="return overlib('Required Field');" onmouseout="return nd();">&nbsp;</span></td>
			<td>
				<label><input type='radio' name='blnVacationUseHireDate' value='1' <?=($employmentType->blnVacationUseHireDate==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnVacationUseHireDate' value='0' <?=($employmentType->blnVacationUseHireDate==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnVacationUseHireDate' <?php if($employmentType->blnVacationUseHireDate == 'on' || $employmentType->blnVacationUseHireDate == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?>
			</td>
		</tr>
		<tr>
			<td class="column_label"><?=AttributeReader::PropertyAttributes($employmentType,'blnSickTimeUseHireDate')->Description;?>: <span class="hint" onmouseover="return overlib('Required Field');" onmouseout="return nd();">&nbsp;</span></td>
			<td>
				<label><input type='radio' name='blnSickTimeUseHireDate' value='1' <?=($employmentType->blnSickTimeUseHireDate==='1'?"CHECKED='CHECKED'":"");?> /> Yes</label>
		<label><input type='radio' name='blnSickTimeUseHireDate' value='0' <?=($employmentType->blnSickTimeUseHireDate==='0'?"CHECKED='CHECKED'":"");?> /> No</label>
		<?php /*<label><input type='checkbox' name='blnSickTimeUseHireDate' <?php if($employmentType->blnSickTimeUseHireDate == 'on' || $employmentType->blnSickTimeUseHireDate == 1){echo "CHECKED='CHECKED'";}?>/> Yes</label>*/ ?>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>
				<input type="submit" style="width: 65px;" class="button btn-save" value="Save" id="save_btn" />
				<input type="button" style="width: 80px;" class="button btn-cancel" value="Cancel" onclick="window.location.replace('?view=tblEmploymentTypes');" />
			</td>
		</tr>
		</table>
	</td>
	<?php /*if (@$employmentType->exists) { ?>
	<td class="grid-space">
		<div class="column_label">Related-view (<a class="fancybox" href="popup_index.php?view=related-view&id=<?=$employmentType->lngID;?>&source=<?=urlencode($status->destination);?>">Manage</a>)</div>
		<ul class="dot">
			<?php
			foreach ($items = RelatedClass::getRelatedObjects(array('lngID'=>$employmentType->lngID)) as $r)
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
