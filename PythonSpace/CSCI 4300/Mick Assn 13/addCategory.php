<?php

// Get the category data
//$category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);
$category_name = filter_input(INPUT_POST, 'category_name');

require_once('database.php');

// Add Category into the database

$query = 'INSERT INTO categories (categoryName) VALUES (:category_name)';

$statement = $db->prepare($query);
//$statement->bindValue(':category_id', $category_id);
$statement->bindValue(':category_name', $category_name);
$statement->execute();
$statement->closeCursor();

// Display the Product List page
include('categoryList.php');
