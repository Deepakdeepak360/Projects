<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

$categories = [
    ["id" => "1", "name" => "Electronics"],
    ["id" => "2", "name" => "Clothing"],
    ["id" => "3", "name" => "Home Appliances"]
];

echo json_encode($categories);
?>
