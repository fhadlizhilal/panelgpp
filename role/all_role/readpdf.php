<!DOCTYPE html>
<html>
<title>Page Title</title>
<body>
	<?php  
		// The location of the PDF file
		// on the server
		$filename = "../e_approval/file_approval/".$_GET['file'];
		  
		// Header content type
		header("Content-type: application/pdf");
		header("Content-Length: " . filesize($filename));
		  
		// Send the file to the browser.
		ob_clean();
		flush();
		readfile($filename);
		exit();
	?>
</body>
</html>