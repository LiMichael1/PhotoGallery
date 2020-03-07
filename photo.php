<?php

    class Photo {
        //Properties
        public $file_name = '';
        public $photo_name = '';
        public $Date = '';
        public $Photographer = '';
        public $Location = '';
        public $photo_location = '';

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

?>