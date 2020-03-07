<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Bree+Serif|Indie+Flower|Roboto+Mono&display=swap" rel="stylesheet">
    <title>View Photos</title>
    <style>
      .photo-container-size {
        width: 33%;
      }

      body {
        background: linear-gradient(-45deg, #ee7752, #e73c7e, #23a6d5, #23d5ab);
        background-size: 400% 400%;
        animation: gradient 15s ease infinite;
      }

      @keyframes gradient {
          0% {
              background-position: 0% 50%;
          }
          50% {
              background-position: 100% 50%;
          }
          100% {
              background-position: 0% 50%;
          }
      }

      h1 {
        font-family: 'Indie Flower';
        text-align: center;
        font-size: 5rem;
        text-shadow: 2px 2px 4px red;
        color: white;
      }

      p{
        font-family: 'Roboto Mono';
      }

      span {
        font-family: 'Bree Serif';
      }

      .desc-size {
        font-size: 1.4rem;
      }

      img {
        transition: transform 1s;
        border-radius: 30px;
      }

      img:hover {

        transform: scale(1.5);
      }

      .card-color { background-color: #FFE5B4; }

      .card-border { border-radius: 30px;}

      .space-above {
        margin-top : 5rem;
      }

    </style>
</head>

<body class="container">
  <header>
    <h1 class="">Photo Gallery</h1>
  </header>

    <input class="btn btn-danger my-3 float-right" type="button" onclick="window.location.href = 'index.html';" value="Upload More"/>

    <form method="post">
      <div class="form-group">
        <select class="form-control" id="SortBy" name='SortBy' onchange='this.submit()'>>
          <option value="name">Name</option>
          <option value="date">Date</option>
          <option value="photographer">Photographer</option>
          <option value="location">Location</option>
        </select>
        <button class="btn btn-primary my-3" type="submit" name="sort">Sort</button>
      </div>
    </form>

<?php

include "connect.php";
include "photo.php";
include "sorting.php";

// -----------------------------------------------------------------------------//

$dir_path = "uploads/";
$extensions_ary = array('jpg','jpeg','png');
$photoArr = [];

//Checks if a sort has been chosen else auto sort by name.
if(isset($_POST['SortBy'])){
  $selected_key = $_POST['SortBy'];
}
else {
  $selected_key = 'name';
}

#Loads array with objects of photos.
$photoArr = Load_Photos_Table($photoArr);

#Gets information from dropdown to sort.
if($selected_key == 'name')
{
  $photoArr = sortBy($photoArr, 1);
}
elseif ($selected_key == 'date')
{
  $photoArr = sortBy($photoArr, 2);
}
elseif ($selected_key == 'photographer')
{
  $photoArr = sortBy($photoArr, 3);
}
elseif ($selected_key == 'location')
{
  $photoArr = sortBy($photoArr, 4);
}

// ----------------------------------------------------------------------

echo "<div class='card text-center card-color card-border container '> ";
echo "<div class='row justify-content-around my-5'>";

#Displays each photo
for($x = 0; $x < sizeof($photoArr); $x++)
{
  $fname = $photoArr[$x]->get_fname();
  
  echo "<div class='desc-size col-4'>";
  echo "<img class='' style='width:80%;height:60%;' src='$dir_path$fname'> <br>
  <p class='' >Photo Name: <span>" . $photoArr[$x]->get_pname() . "</span></p>
  <p class='' >Date Taken: <span>" . $photoArr[$x]->get_date() . "</span></p>
  <p class='' >Photographer: <span>" . $photoArr[$x]->get_photographer() . "</span></p>
  <p class='' >Location: <span>" . $photoArr[$x]->get_location() . "</span></p>";
  echo "</div>";

  if (($x+1)%3 == 0)
  {
    echo "</div>";
    echo "<div class='row justify-content-around my-5'>";
  }
  
}
echo "</div>";
echo "</div>";
?>

</body>
</html>
