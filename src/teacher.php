<?php
class teacher{
    var $School;
    var $TeacherID;
    var $Name;
    var $Password;
    /*
    for $row:
    0 -> id
    1 -> school
    2 -> teacherid
    3 -> teachername
    4 -> password
    */
    function __construct($row){
        $this->School =     $row[1];
        $this->TeacherID =  $row[2];
        $this->Name =       $row[3];
        $this->Password =   $row[4];
    }  
}
