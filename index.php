<?php
include_once('mgsFunctions.php');

try
{
	$db = getConnection();

	// Get category ID
	$category_id = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT);
	if ($category_id == NULL || $category_id == FALSE) {
		$category_id = 1;
	}
		
	// Get name for selected category
	$category = getCategory($db, $category_id);
	$category_name = $category['categoryName'];

	// Get all categories
	$categories = getCategories($db);

	// Get products for selected category
	$products = getProductsByCategory($db, $category_id);
	include_once('view.php');
}
catch (Exception $e)
{
	$error_message = $e->getMessage();
	include_once('database_error.php');
}

?>
