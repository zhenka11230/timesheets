<?php
//require_once(dirname(__FILE__)."/DbObject.php");

class ExportFormat extends DbObject
{
	public static $tableName = "tblExportFormats";
	public $exists = false;

	/** [[Column=lngID, DataType=int, Description=LngID, ReadOnly=true]]*/
	public $lngID;

	/** [[Column=strName, DataType=varchar, Description=StrName, MaxLength=255]]*/
	public $strName;

	/** [[Column=blnType, DataType=bit, Description=BlnType, Required=true]]*/
	public $blnType;

	/** [[Column=strDateFormat, DataType=varchar, Description=StrDateFormat, MaxLength=255]]*/
	public $strDateFormat;

	/** [[Column=strTimeFormat, DataType=varchar, Description=StrTimeFormat, MaxLength=255]]*/
	public $strTimeFormat;

	/** [[Column=strNormalCode, DataType=varchar, Description=StrNormalCode, MaxLength=255]]*/
	public $strNormalCode;

	/** [[Column=strOtherCode, DataType=varchar, Description=StrOtherCode, MaxLength=255]]*/
	public $strOtherCode;

	/** [[Column=strSickCode, DataType=varchar, Description=StrSickCode, MaxLength=255]]*/
	public $strSickCode;

	/** [[Column=strVacationCode, DataType=varchar, Description=StrVacationCode, MaxLength=255]]*/
	public $strVacationCode;

	/** [[Column=strHolidayCode, DataType=varchar, Description=StrHolidayCode, MaxLength=255]]*/
	public $strHolidayCode;

	/** [[Column=strOT1Code, DataType=varchar, Description=StrOT1Code, MaxLength=255]]*/
	public $strOT1Code;

	/** [[Column=strOT2Code, DataType=varchar, Description=StrOT2Code, MaxLength=255]]*/
	public $strOT2Code;

	/** [[Column=strFormat, DataType=varchar, Description=StrFormat, MaxLength=1073741823]]*/
	public $strFormat;

	// foreign key fields (will be populated upon request)
	
	
	public function fetchData($id)
	{
		//list($arg1, $arg2) = $args;
		$query="SELECT * FROM ".self::$tableName." WHERE lngID=".$id;

		$row = $this->db->getRow($query);
		
		if (count($row) > 0)
			$this->setPropertyValues($row);

		if ($this->lngID > 0)
			$this->exists = true;
	}
	
	
	public function getExportFormats($args=array())
	{
		global $db;
		
		$query = "SELECT * 
			FROM ".self::$tableName." t 
			WHERE 1=1 
				".(@$args['lngID'] != '' ? " AND lngID={$args['lngID']} " : "")."
				".(@$args['strName'] != '' ? " AND strName='{$args['strName']}' " : "")."
				".(@$args['blnType'] != '' ? " AND blnType={$args['blnType']} " : "")."
				".(@$args['strDateFormat'] != '' ? " AND strDateFormat='{$args['strDateFormat']}' " : "")."
				".(@$args['strTimeFormat'] != '' ? " AND strTimeFormat='{$args['strTimeFormat']}' " : "")."
				".(@$args['strNormalCode'] != '' ? " AND strNormalCode='{$args['strNormalCode']}' " : "")."
				".(@$args['strOtherCode'] != '' ? " AND strOtherCode='{$args['strOtherCode']}' " : "")."
				".(@$args['strSickCode'] != '' ? " AND strSickCode='{$args['strSickCode']}' " : "")."
				".(@$args['strVacationCode'] != '' ? " AND strVacationCode='{$args['strVacationCode']}' " : "")."
				".(@$args['strHolidayCode'] != '' ? " AND strHolidayCode='{$args['strHolidayCode']}' " : "")."
				".(@$args['strOT1Code'] != '' ? " AND strOT1Code='{$args['strOT1Code']}' " : "")."
				".(@$args['strOT2Code'] != '' ? " AND strOT2Code='{$args['strOT2Code']}' " : "")."
				".(@$args['strFormat'] != '' ? " AND strFormat='{$args['strFormat']}' " : "")."
			ORDER BY strName";
		$results = $db->getAll($query);
		
		$items = array();
		foreach ($results as $r) {
			$obj = new ExportFormat();
			$obj->setPropertyValues($r);
			$obj->exists = true;
			
			array_push($items, $obj);
		}
		
		return $items;
	}
	
	public function getCount()
	{
		global $db;
		
		$query = "SELECT count(*) FROM ".self::$tableName;
		return $db->getOne($query);
	}
	
	public function save($delete=0)
	{	
		/*
		global $login_info;

		$user = $login_info->get_user_info();
		
		$this->modified_by = (isset($user['first_name']) ? $user['first_name'].' '.$user['last_name'] : $user['username']);
		*/
		//$this->last_modified = date("Y-m-d G:i:s");
		//$this->deleted = ($delete == 1 || $delete === true ? '1' : '0');
		
		// create query
		$query = ($this->exists ? $this->updateString(self::$tableName, 'lngID') : $this->insertString(self::$tableName));

		// prepare query
		$stmt = $this->db->prepare($query);

		// execute statement
		$result =& $this->db->execute($stmt);
		
		/*if (PEAR::isError($result)) {
			throw new Exception($result->getMessage());
		}*/
		
		return $result;
	}
	
	public function delete($method='hard')
	{
		if ($method == 'soft')
			return $this->save(1);
			
		// create query
		$query="DELETE FROM ".self::$tableName." WHERE lngID=".$this->lngID;

		// prepare query
		$stmt = $this->db->prepare($query);

		// execute statement
		$result =& $this->db->execute($stmt);
		
		/*if (PEAR::isError($result)) {
			throw new Exception($result->getMessage());
		}*/
		
		return $result;
	}
}
