<?php
class student{
    public $id;
    public $name;
    public $age;
    public $university;

    public function __construct($id, $name, $age, $university){
        $this->id = $id;
        $this->name = $name;
        $this->age = $age;
        $this->university = $university;
    }
}

?>