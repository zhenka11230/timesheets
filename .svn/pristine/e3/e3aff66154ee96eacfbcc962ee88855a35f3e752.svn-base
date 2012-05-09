<?php
define("APPLICATION_ID", 44); // 44 - Sysdev, y - Dewey, z - WIMS CD
define("APPLICATION_NAME", "timeclockSQL");
define("VIEW_ROOT", dirname(__FILE__));
define("MODEL_ROOT", dirname(__FILE__)."/model");
define("AUTHENTICATION_ROOT", $_SERVER['DOCUMENT_ROOT']."mylibrary/");

require_once(dirname(__FILE__)."/includes/database.php");
require_once(AUTHENTICATION_ROOT."includes/global.php");
require_once(AUTHENTICATION_ROOT."includes/include_validated.php");
require_once(AUTHENTICATION_ROOT."includes/log_entry.php");
require_once(AUTHENTICATION_ROOT."includes/handle_error.php");
require_once(AUTHENTICATION_ROOT."includes/enforce_login.php");

// As of PHP 5, __autoload() is AUTOMATICALLY called when an object, of a class that has not been declared, is created.
function __autoload($class_name) 
{
	if (in_array($class_name, array('Authentication', 'Status')))
		$class_name .= '_class';

	else if (preg_match('/^Directory_/', $class_name))
		$class_name = 'directory/'. $class_name;

	else if (preg_match('/^Hours_/', $class_name))
		$class_name = 'hours/'. $class_name;

	else if (preg_match('/^Authentication_/', $class_name))
		$class_name = 'authentication/'. $class_name;

	// includes paths
	$paths = array(	AUTHENTICATION_ROOT.'includes/'.$class_name.'.php', // MyLibrary
					dirname(__FILE__).'/includes/'.$class_name.'.php'	// local
					);

	// loop through all paths and escape after first match
	foreach ($paths as $path) 
	{
		if (is_file($path)) {
			require_once $path;
			break;
		}
	}
}

// application parameters/restrictions
$myDepartments = array();
if (isset($_parameters['department_id']) && count($_parameters['department_id'])) {
	$myDepartments = $_parameters['department_id'];
}
//if employeeid is not 0
$myEmployeeID = 0;
if (isset($_parameters['employee_id']) && count($_parameters['employee_id'])) {
	$myEmployeeID = $_parameters['employee_id'][0];
}
?>
