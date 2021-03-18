<?php

$mysqli = new mysqli("localhost", "root", "", "sociablekit");

if ( $mysqli->connect_error ) {
    die("Connection failed: " . $mysqli->connect_error);
}

?>