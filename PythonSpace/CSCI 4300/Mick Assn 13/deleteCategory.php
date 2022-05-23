<?php

require_once('database.php');

//$category_id = filter_input(INPUT_POST, 'category_id', FILTER_VALIDATE_INT);

$category_name = filter_input(INPUT_POST, 'category_name');

// Delete the category from the database

$query = 'DELETE FROM categories WHERE categoryName = :category_name';
$statement = $db->prepare($query);
//$statement->bindValue(':category_id', $category_id);
$statement->bindValue(':category_name', $category_name);
$statement->execute();
$statement->closeCursor();

// Display the Category List page
include('categoryList.php');
