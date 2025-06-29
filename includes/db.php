<?php

// For security, required PHP files should "die" if SAFE_TO_RUN is not defined
if (!defined('SAFE_TO_RUN')) {
    // Prevent direct execution - show a warning instead
    die(basename(__FILE__)  . ' cannot be executed directly!');
}

# 1. Defining constant
#1st way
# local database
$db = ['host'=>'localhost',
        'user'=>'root',
        'pass'=>'',
        'name'=>'thegreencompany'];

$tables = [];

#2nd way
// $db['host'] = 'localhost';
// $db['user'] = 'root';
// $db['pass'] = '';
// $db['name'] = 'cms';

foreach($db as $key =>$value){
    define(strtoupper($key),$value);
}

#2. Opening Database
$connection = mysqli_connect(HOST,USER,PASS,NAME);

if(!$connection){
    die("Database connection failed");
} 

#3. Save table names
$sql = "SHOW TABLES";
$result = $connection->query($sql);

if (!$result) {
    die("Could not execute SQL \"$sql\"");
}

// Read each row as an array indexed by numbers
while ($row = $result->fetch_row()) {
    // Put the first item in each row into the tables array
    $tables[] = $row[0];
}

#4. Save field names
# Add field names in an associate array for each table name
foreach($tables as $tableName){
    $sql = "SHOW COLUMNS FROM $tableName";
    $result = $connection->query($sql);

    if (!$result) {
        die("Could not execute SQL \"$sql\"");
    }

    while ($row = $result->fetch_row()) {
        $fields[$row[0]] = "";
    }
}
?>