<?php
  class Photo {
      //Properties
      public $file_name = '';
      public $photo_name = '';
      public $Date = '';
      public $Photographer = '';
      public $Location = '';
      public $photo_location = '';

      public function __construct($file_name, $photo_name, $Date, $Photographer, $Location, $photo_location)
      {
          $this->file_name = $file_name;
          $this->photo_name = $photo_name;
          $this->Date = $Date;
          $this->Photographer = $Photographer;
          $this->Location = $Location;
          $this->photo_location = $photo_location;
      }

      public function get_fname(){ return $this->file_name; }

      public function get_pname(){ return $this->photo_name; }

      public function get_date(){ return $this->Date; }

      public function get_photographer(){ return $this->Photographer; }

      public function get_location(){ return $this->Location; }

  }

  function compareByTimeStamp($time1, $time2)
  {
      if (strtotime($time1) < strtotime($time2))
          return 1;
      else if (strtotime($time1) > strtotime($time2))
          return -1;
      else
          return 0;
  }

  function sortBy($arr, $opt)
  {
      switch($opt) {
          case 0:
              usort($arr, function($a, $b)
              {
                  return strnatcmp(strtolower($a->get_fname()), strtolower($b->get_fname()));
              });
              break;

          case 1:
              usort($arr, function($a, $b)
              {
                  return strnatcmp(strtolower($a->get_pname()), strtolower($b->get_pname()));
              });
              break;

          case 2:
              usort($arr, function($a, $b)
              {
                  return compareByTimeStamp($a->get_date(), $b->get_date());
              });
              break;

          case 3:
              usort($arr, function($a, $b)
              {
                  return strnatcmp( strtolower($a->get_photographer()) , strtolower($b->get_photographer()));
              });
              break;

          case 4:
              usort($arr, function($a, $b)
              {
                  return strnatcmp(strtolower($a->get_location()), strtolower($b->get_location()));
              });
              break;

      }

      return $arr;
  }



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
        #echo "File Name -> $files[$i]<br>";

        $file = pathinfo($files[$i]);
        $extension = strtolower($file['extension']);
        #echo "File Extension->$extension<br>";

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

  $file = fopen("C:\wamp64\www\PhotoGallery\uploads\list.txt", 'r');
  flock($file, LOCK_SH);

  $photoArr = [];

  while (!feof($file))
  {
    $fname = fgets($file);
    $pname = fgets($file);
    $Date = fgets($file);
    $Photographer = fgets($file);
    $Location = fgets($file);
    $photo_location = $dir_path.$fname;

    $p1 = new Photo($fname, $pname, $Date, $Photographer, $Location, $photo_location);
    array_push($photoArr, $p1);
  }

  for($x = 0; $x < 4; $x++)
  {
    echo $photoArr[$x]->get_location()."<br>";
  }

?>
