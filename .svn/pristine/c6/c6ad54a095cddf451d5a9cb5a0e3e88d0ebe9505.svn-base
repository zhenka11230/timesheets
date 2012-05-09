<div class="page_title">Welcome - Please Login</div>

<form name="frmLogin" action="http://<?=$_SERVER['SERVER_NAME']?>/mylibrary/controller.php?action=login&app=<?=APPLICATION_NAME;?>" method="post">
	<input type="hidden" name="redir" value="<?=@$redir;?>"/>

	<table class="grid-def" style="width:260px;" align="center">
		<tr class="grid-row_header">
			<td align="center">Administrative Login</td>
		</tr>
		<tr class="grid-space">
			<td>
				<table>
					<tr>
						<td valign="top" rowspan="2" align="center" width="80">
							<img src="<?=COMMON_FILES_PATH;?>images/loginUsers.gif" alt="Login Graphic"/>
						</td>
						<td width="160">
							<b><label for="username">Username:</label></b><br/>
							<input type="text" name="username" class="textbox" style="width:150px" id="username"/>
						</td>
					</tr>
					<tr>
						<td>
							<b><label for="password">Password:</label></b><br/>
							<input type="password" name="password" class="textbox" style="width:150px" id="password"/>
							<div class="input_hint">Case Sensitive</div>
						</td>
					</tr>
					<tr>
						<td></td>
						<td><input type="submit" value="Login" class="button btn-identity" style="width:70px;"/></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	
</form>

<script type="text/javascript">document.frmLogin.username.focus()</script>
