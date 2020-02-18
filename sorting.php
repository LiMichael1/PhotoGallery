<?php
    function compareByTimeStamp($time1, $time2) 
    {
        if (strtotime($time1) < strtotime($time2))
            return 1;
        else if (strtotime($time1) > strtotime($time2))
            return -1;
        else    
            return 0;
    }

    function sortByDate($arr)
    {
        usort($arr, "compareByTimeStamp");

        return $arr;
    }

    $array = array("2016-09-12", "2009-09-06", "2009-09-09");

    $array = sortByDate($array);

    print_r($array);
    echo "<br>";

    function sortByAlphabeticalOrder($arr)
    {
        usort($arr, "strnatcmp");

        return $arr;
    }

    $array1 = array("b", "a", "d");
    $array1 = sortByAlphabeticalOrder($array1);

    print_r($array1);
    echo "<br>";
?>