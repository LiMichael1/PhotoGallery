<?php 

class Photo {
    //Properties
    public $file_name;
    public $photo_name;
    public $Date;
    public $Photographer;
    public $Location;

    public function Photo($file_name, $photo_name, $Date, $Photographer, $Location)
    {
        $this->file_name = $file_name;
        $this->photo_name = $photoname;
        $this->Date = $Date;
        $this->Photographer = $Photographer;
        $this->Location = $Location;
    }

}

?>