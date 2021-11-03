<?php

$host = "localhost";
$user = "Raizes.Artezanato";
$pass = "";
$db = "raizes";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Connection failed" . mysqli_connect_error());
}
