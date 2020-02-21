<!DOCTYPE html>
<html>
	<head>
		<title>Le Photo Upload Screen</title>
	</head>
	<body>
			<form method="post" enctype="multipart/form-data">
			<table style="border: 70px;">
			<tr>
				<td style="width: 100px; text-align: left;">Photo Name:</td>
				<td><input type="text" name="photoname" required size="20" maxlength="20" /></td>
			</tr>
			<tr>
				<td style="width: 100px; text-align: left;">Date Taken:</td>
				<td><input type="date" name="datetaken" required size="20" maxlength="20" /></td>
			</tr>
			<tr>
				<td style="width: 100px; text-align: left;">Photographer:</td>
				<td><input type="text" name="photographer" required size="20" maxlength="20" /></td>
			</tr>
			<tr>
				<td style="width: 100px; text-align: left;">Location:</td>
				<td><input type="text" name="location" requiredsize="20" maxlength="20" /></td>
			</tr>
			<tr>
				<td></td>
				<td style="text-align: center;"><input type="file" style="background-color:blue; color:white; width:160px" name="SelectFile" id="SelectFile" /></td>
			</tr>
			<tr>
				<td></td>
				<td style="text-align: center;"><input type="submit" style="background-color:blue; color:white; width:160px" name="submit" value="Upload" /></td>
			</tr>
			<tr>
				<td></td>
				<td style="text-align: center;"><button type="submit" formaction="ralph_view.php" formnovalidate style="background-color:blue; color:white; width:160px" name="submit1"/>View Photos</button?</td>
			</tr>
			</table>
		</form>
	</body>
</html>

<?php
	#If Upload is pressed, it will check to see if file was properly uploaded
	if(isset($_POST["submit"]))
	{
		$target_dir = "uploads/";
		$target_file = $target_dir.basename($_FILES["SelectFile"]["name"]);
		$uploadOK = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		$check = getimagesize($_FILES["SelectFile"]["tmp_name"]);

		echo $target_file."<br>";

		#Checks if file is valid.
		if($check !== false)
		{
			echo "File is an image - ".$check["mime"].". "."<br>";
			$uploadOK = 1;
		}
		else
		{
			echo "File is not an image.";
			$uploadOK = 0;
		}

		if(move_uploaded_file($_FILES["SelectFile"]["tmp_name"],$target_file))
		{
			#$fp = fopen("uploads\list.txt", 'w') or die("Unable to open file!");
			file_put_contents("uploads/list.txt", basename($_FILES["SelectFile"]["name"]), FILE_APPEND);
			file_put_contents("uploads/list.txt", "\n", FILE_APPEND);
			file_put_contents("uploads/list.txt", $_POST['photoname'], FILE_APPEND);
			file_put_contents("uploads/list.txt", "\n", FILE_APPEND);
			file_put_contents("uploads/list.txt", $_POST['datetaken'], FILE_APPEND);
			file_put_contents("uploads/list.txt", "\n", FILE_APPEND);
			file_put_contents("uploads/list.txt", $_POST['photographer'], FILE_APPEND);
			file_put_contents("uploads/list.txt", "\n", FILE_APPEND);
			file_put_contents("uploads/list.txt", $_POST['location'], FILE_APPEND);
			file_put_contents("uploads/list.txt", "\n", FILE_APPEND);
			echo "The file ".basename($_FILES["SelectFile"]["name"])." has been uploaded.";
			#fclose($fp);
		}
		else
		{
			echo "Fucking didn't work.";
		}
	}
?>
