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


?>