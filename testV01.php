<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php
        echo $_POST["photo_name"] . "<br>";
        echo $_POST["date_taken"] . "<br>";
        echo $_POST["photographer"] . "<br>";
        echo $_POST["location"] . "<br>";
        echo $_FILES["image"] . "<br>";
    ?>
</body>
</html>