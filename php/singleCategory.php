<?php
require_once('connect.php');

$categoryID = $_POST['id'];

$categories_query = "SELECT * FROM categories WHERE cat_id = '$categoryID'";
$categories_result = mysqli_query($conn, $categories_query);
$category = $categories_result->fetch_All(MYSQLI_ASSOC);
echo json_encode($category);
?>