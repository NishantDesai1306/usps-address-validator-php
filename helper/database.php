<?php
$server = "localhost";
$username = "root";
$password = "rootroot";
$database = "test";
 
// Create connection
$conn = new mysqli($server, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (empty (mysqli_fetch_array(mysqli_query($conn,"SHOW DATABASES LIKE '$database'")))) {
    if($conn->query("CREATE DATABASE $database") === TRUE) {
        $conn->select_db($database);

        // create table if it does not exist
        $create_table_sql = file_get_contents(__DIR__ . '/queries/create-table.sql');

        if ($conn->query($create_table_sql) === TRUE) {
            // table created successfully
        } else {
            error_log(print_r("Error creating table: " . $conn->error, true));
        }
    }
}
else {
    $conn->select_db($database);
}
?>