<?php
	// Include PEAR's database library	
	require_once 'DB.php';
	require_once $_SERVER['DOCUMENT_ROOT'].'/../db_info.php';

	// Connect to the database
	$db = DB::connect(DSN('timeclockSQL'));
	if (PEAR::isError($db)) {
		die($db->getMessage());
	}
	// Just die on db errors
	//$db->setErrorHandling (PEAR_ERROR_DIE);

	// Return associative arrays
	$db->setFetchMode (DB_FETCHMODE_ASSOC);
?>