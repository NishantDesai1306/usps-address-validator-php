<?php
require $_SERVER['DOCUMENT_ROOT'] . '/helper/exception-handler.php';
require $_SERVER['DOCUMENT_ROOT'] . '/helper/database.php';
require $_SERVER['DOCUMENT_ROOT'] . '/helper/index.php';

$addressLine1 = sanitize($_POST['addressLine1']);
$addressLine2 = sanitize($_POST['addressLine2']);
$city = sanitize($_POST['city']);
$state = sanitize($_POST['state']);
$zip = sanitize($_POST['zip']);

// insert row into table address
$insert_address_sql = file_get_contents('../helper/queries/insert-address.sql');

$stmt = $conn->prepare($insert_address_sql);

$stmt->bind_param("sssss", $addressLine1, $addressLine2, $state, $city, $zip);
$stmt->execute();

mysqli_stmt_close($stmt);
mysqli_close($conn);
?>