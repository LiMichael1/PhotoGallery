<?php
	$target_dir = "uploads/";
	$target_file = $target_dir.basename($_FILES["SelectFile"]["name"]);
	$uploadOK = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

	if(isset($_POST["submit"]))
	{
		$check = getimagesize($_FILES["SelectFile"]["tmp_name"]);
		if($check !== false)
		{
			echo "File is an image - ".$check["mime"].".";
			$uploadOK = 1;
		}
		else
		{
			echo "File is not an image.";
			$uploadOK = 0;
		}
	}
	
	if(move_uploaded_file($_FILES["SelectFile"]["tmp_name"],$target_file))
	{
		echo "The file ".basename($_FILES["SelectFile"]["name"])." has been uploaded.";
	}
	else
	{
		echo "Fucking didn't work.";
	}
?>