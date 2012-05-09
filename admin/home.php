<div class="page_title">Welcome <?php
if ($logged_in == 1 && $login_info != null) {
	$visitor = $login_info->get_user_info();
	echo (!isset($visitor['first_name']) ? $visitor['username'] : $visitor['first_name']);
}
else {
	echo "Guest";
}
?></div>

<table width="100%" style="table-layout:fixed;">
<tr>
	<td width="48%" valign="top">

		<div class="text_tabs">
			<ul class="dot">
				<li class="left spacer">&nbsp;</li>
				<li><b><span>App-related section</span></b></li>
			</ul>
		</div>
		<div class="tabbed_section_body">
			<div class="scrolling_pane" style="height:240px;">
				
			</div>
		</div>

	</td>
	<td width="2%"></td>
	<td width="48%" valign="top">

		<div class="text_tabs">
			<ul class="dot">
				<li class="left spacer">&nbsp;</li>
				<li><b><span>Related Links</span></b></li>
			</ul>
		</div>
		<div class="tabbed_section_body">
			<ul class="dot">
				<li><a href="../" target="_blank">Public Site</a></li>
				<li><a href="http://library.brooklyn.cuny.edu/" target="_blank">Library Homepage</a></li>
			</ul>
		</div>

	</td>
</tr>
</table>