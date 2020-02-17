<?php
  $dir_path = "uploads/";
  $extensions_ary = array('jpg','jpeg','png');
  echo "$dir_path"."<br>";
  if(is_dir($dir_path))
  {
    $files = scandir($dir_path);

    for($i = 0; $i < count($files); $i++)
    {
      if($files[$i] != '.' && $files[$i] != '..')
      {
        echo "File Name -> $files[$i]<br>";

        $file = pathinfo($files[$i]);
        $extension = strtolower($file['extension']);
        echo "File Extension->$extension<br>";

        //echo in_array($extension,$extensions_ary)
        if(in_array($extension,$extensions_ary))
        {
          echo "<img src='$dir_path$files[$i]' style='width:100px;height:100px;'><br>";
        }
        else{
          echo "not working.<br><br>";
        }
      }
    }
  }

?>
