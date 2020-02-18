<?php 

class Photo {
    //Properties
    public $file_name = '';
    public $photo_name = '';
    public $Date = '';
    public $Photographer = '';
    public $Location = '';

    public function __construct($file_name, $photo_name, $Date, $Photographer, $Location)
    {
        $this->file_name = $file_name;
        $this->photo_name = $photo_name;
        $this->Date = $Date;
        $this->Photographer = $Photographer;
        $this->Location = $Location;
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

$p1 = new Photo("fw.jpg", "d", "2000-02-12", "b", "Chinatown");
$p2 = new Photo("erw.png", "c", "2016-02-12", "a", "b");

$array = array($p1, $p2);

$array = sortBy($array, 4);

echo $array[0]->get_location();

?>