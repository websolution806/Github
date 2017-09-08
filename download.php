<?php
$file_name = 'contacts.csv';
$file_url = 'http://localhost:8080/instagram/' . $file_name;
header('Content-type: text/csv');
//header("Content-Transfer-Encoding: Binary"); 
header("Content-disposition: attachment; filename=\"".$file_name."\""); 
readfile($file_url);
exit;
?>