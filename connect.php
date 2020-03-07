<?php
    
    function Connect_to_Database() {
        // Get Access to the Database
        $serverName = 'localhost';
        $userName = 'root';
        $password = '';
        $databaseName = 'mydb';

        $db = new mysqli($serverName, $userName, $password, $databaseName );
        if (mysqli_connect_errno()) {
            echo '<p>Error: Could not connect to database.<br>
            Please try again later </p>';
            exit;
        }
        //echo "Connected to Database";
        return $db;
    }

    function is_Photo_in_table($Photo_URL) {
        $db = Connect_to_Database();
        
        $sql = "SELECT Photo_URL FROM photos";
        $results = mysqli_query($db, $sql);

        if(mysqli_num_rows($results) > 0 ) {
            while ($row = mysqli_fetch_assoc($results)) {
                if ($Photo_URL === $row['Photo_URL'])
                    return true;
            }
        }

        $db->close();
        return false;
    }

    function Photo_table_insert($Photo_Name, $Photo_URL, $Date, $Location, $Photographer) {
        
        $db = Connect_to_Database();

        $sql = "INSERT INTO `photos` (`Photo_Name`, `Photo_URL`, `Date`, `Location`, `Photographer`) 
        VALUES ('$Photo_Name', '$Photo_URL', '$Date', '$Location', '$Photographer')";

        if($db->query($sql) === TRUE) {
            echo 'New Photo Data entered successfully<br>';
        }
        else {
            echo 'Error: Unable to enter SQL Query<br>';
        }

        

        $db->close();
    }

    function Load_Photos_Table($PhotoArray)
    {
        $db = Connect_to_Database();

        //CHECK -- REMOVE WHEN FINISHED TESTING 
        $sql = "SELECT * FROM photos";
        $results = mysqli_query($db, $sql);

        if(mysqli_num_rows($results)> 0) {
            while ($row = mysqli_fetch_assoc($results)) {
                $photo_info = new Photo($row['Photo_URL'], $row['Photo_Name'], $row['Date'], 
                                        $row['Photographer'], $row['Location']);
                array_push($PhotoArray, $photo_info);
            }
        }
        else {
            echo 'The Photos Table is empty.';
        }

        $db->close();

        return $PhotoArray;
    }


?>