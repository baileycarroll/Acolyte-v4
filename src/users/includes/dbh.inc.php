<?php


//Actual Web Server
$servername ="host.docker.internal:8002";
$dBUsrname = "bailey";
$dBPassword = "Hp@51007058";
$dBName = "gatheringWind";


$conn = mysqli_connect($servername, $dBUsrname, $dBPassword, $dBName);

if (!$conn) {
    die("Connection Failed: ".mysqli_connect_error());
}

?>