<?php
/**
 * Created by PhpStorm.
 * User: Pukolino
 * Date: 05/02/2018
 * Time: 12:53
 */

// Set the database access information as constants:
/*
define('DB_USER', 'mytodouser');
define('DB_PASSWORD', 'mytodouser');
define('DB_HOST', 'localhost');
define('DB_NAME', 'sitename');

// Make the connection
$dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
# OR die('Could not connect MySQL: ' . mysqli_connect_error());

*/


DEFINE('DB_USER', 'bcaca891473502');
DEFINE('DB_PASSWORD', '0e657a18');
DEFINE('DB_HOST', 'us-cdbr-iron-east-05.cleardb.net');
DEFINE('DB_NAME', 'forum2');


$dbc = @mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME)
OR die('Could not connect ot mysql: ' . mysqli_connect_error());

mysqli_set_charset($dbc, 'utf8');
