<?php
	$file_name = $_GET['filename'];
	header("Cache-Control: public");
	header("Content-Description: File Transfer");
	header("Content-Disposition: attachment; filename=$file_name");
	header("Content-Type: text/html");
	header("Content-Transfer-Encoding: binary");
	// Read the file from disk
	readfile($file_name);
?>