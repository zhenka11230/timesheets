<?php

$xfdf_value_pairs = array(
	"appointed_hours" => 200,
    	"dept_num" => "pizdets"
); 

$pdf_location = "http://localhost/pdf_php/1234.pdf";




function createXFDF($pdfurl, $fielddata) {
	// Encoding must be UTF-8!
	// Define XML namespace
	$xfdf =
		'<?xml version="1.0" encoding="UTF-8"?>' . "\n" .
		'<xfdf xmlns="http://ns.adobe.com/xfdf/" xml:space="preserve">' . "\n";

	// Permanent identifier based on the contents of the source PDf file (MD5 signature value)
	// Unique identifier for the modified version of the PDF.
	// See specification for more information
	$xfdf .=
		'   <ids original="' . md5($pdfurl) . '" modified="' . md5($pdfurl . time()) . '" />' . "\n";

	$xfdf .=
		'   <f href="' . $pdfurl . '" />' . "\n" .
		'   <fields>' . "\n";

	if (!empty($fielddata)) {
		foreach ($fielddata as $field => $value) {
			$xfdf .= '     <field name="' . $field . '">' . "\n";
			$xfdf .= '         <value>' . htmlspecialchars($value) . '</value>' . "\n";
			$xfdf .= '     </field>' . "\n";
		}
	}

	$xfdf .=
		'   </fields>' . "\n" .
		'</xfdf>';
	return $xfdf;
}

$xfdf = createXFDF($pdf_location, $xfdf_value_pairs);
echo $xfdf;

?>

