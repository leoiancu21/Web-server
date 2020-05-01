<?php

$query_string = $_SERVER["QUERY_STRING"];
parse_str($query_string,$query);
$barcode_value = $query["barcode"]; 

// Creazione PHP obj
$productObj = new stdClass();
$productObj->productList = array();

// Connessione al database
$db_connection = new mysqli(

        "ec2-52-44-41-99.compute-1.amazonaws.com",
        "user",
        "password",
        "db");

// Error detection         
if ( $db_connection->connect_error ) { 

        die("connection failed : " . $db_connection->connect_error);

}

$result = $db_connection->query( " SELECT * FROM `Item` WHERE `barcode`='L-DIN-AR01' " );
if  ($result) { 

        foreach($result as $row) {

                $item = new stdClass();
                $item->name = $row["name"];
                $item->barcode = $row["barcode"];
                $productObj->productList[] = $item;

        }

}

// obj to JSON parsing 
$productJSON = json_encode($productObj);

// return JSON
echo $productJSON;



?>
