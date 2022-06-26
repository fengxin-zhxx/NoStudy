<?php
class student{
    var $Method;
    var $School;
    var $StudentID;
    var $Name;
    var $Contact;
    var $Password;
    /*
    for $row:
    0 -> id
    1 -> method
    2 -> school
    3 -> studentid
    4 -> studentname
    5 -> contact
    6 -> password
    */
    function __construct($row){
        $this->Method =     $row[1];
        $this->School =     $row[2];
        $this->StudentID =  $row[3];
        $this->Name =       $row[4];
        $this->Contact =    $row[5];
        $this->Password =   $row[6];
    }  
}
