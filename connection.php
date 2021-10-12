<?php

$dbhost = "localhost";
$dbuser = "";
$dbpass = '';
$dbname = "login_sample_db";

$con = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);
if(mysqli_connect_errno()){

    die("failed to connect!");
}
