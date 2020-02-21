<!DOCTYPE html>
<html>
  <head>
  <title>Fuck This</title>
    <body>
      <form method="post">
      <table>
      <h3>Choose Sort Method</h3>
      <tr></tr>
      <tr>
        <select id="SortBy" name='SortBy' onchange='this.submit()'>>
          <option value="name">Name</option>
          <option value="date">Date</option>
          <option value="photographer">Photographer</option>
          <option value="location">Location</option>
        </select>
      </tr>
    <tr>
      <td style="text-align: center;"><button type="submit" name="sort"/>Sort</button></td>
    </tr>
    </table>
  </form>
    </body>
  </head>

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
  $selected_key = $_POST['SortBy'];

  $file = fopen("C:\wamp64\www\PhotoGallery\uploads\list.txt", 'r');
  flock($file, LOCK_SH);

  $photoArr = [];

  #Loads array with objects of photos
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

  if($selected_key == 'name')
  {
    $photoArr = sortBy($photoArr, 1);
  }
  elseif ($selected_key == 'date') {
    $photoArr = sortBy($photoArr, 2);
  }
  elseif ($selected_key == 'photographer')
  {
    $photoArr = sortBy($photoArr, 3);
  }
  elseif ($selected_key == 'location') {
    $photoArr = sortBy($photoArr, 4);
  }

  #Displays each photo
  for($x = 0; $x < sizeof($photoArr); $x++)
  {
    $fname = $photoArr[$x]->get_fname();
    echo "File Name: $fname<br>";
    echo $photoArr[$x]->get_pname()."<br>";
    echo $photoArr[$x]->get_date()."<br>";
    echo $photoArr[$x]->get_photographer()."<br>";
    echo $photoArr[$x]->get_location()."<br>";
    #echo "$dir_path$fname"."<\t\t>";
    echo "<img src='$dir_path$fname' style='width:33%;height:33%;'>"."\t\t<br>";
  }

  flock($file, LOCK_UN);
  fclose($file);

?>
