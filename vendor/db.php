<?php

function getConn(){
        $dbHos = "localhost";
        $dbUser = "root";
        $dbPass = "";
        $dbData = "datahotel";
        
        $conn = new PDO('mysql:host=localhost; dbname=datahotel',$dbUser,$dbPass);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
}
