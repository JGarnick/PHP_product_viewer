<?php 

	function getConnection()
	{
		$dsn = 'mysql:host=localhost;dbname=my_guitar_shop1';
		$username = 'mgs_user';
		$password = 'pa55word';
		
		$db = new PDO($dsn, $username, $password);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		return $db;
	}
	
	function getCategory($db, $category_id)
	{
		$queryCategory = 'SELECT * FROM categories
                      WHERE categoryID = :category_id';
		$statement1 = $db->prepare($queryCategory);
		$statement1->bindValue(':category_id', $category_id);
		$statement1->execute();
		$category = $statement1->fetch();
		$statement1->closeCursor();
		return $category;
	}
	
	function getCategories($db)
	{
		$queryAllCategories = 'SELECT * FROM categories
                           ORDER BY categoryID';
		$statement2 = $db->prepare($queryAllCategories);
		$statement2->execute();
		$categories = $statement2->fetchAll();
		$statement2->closeCursor();
		return $categories;
	}
	
	function getProductsByCategory($db, $category_id)
	{
		$queryProducts = 'SELECT * FROM products
              WHERE categoryID = :category_id
              ORDER BY productID';
		$statement3 = $db->prepare($queryProducts);
		$statement3->bindValue(':category_id', $category_id);
		$statement3->execute();
		$products = $statement3->fetchAll();
		$statement3->closeCursor();
		return $products;
	}
	
	function displayCategoryList($categories)
	{
		echo "<ul>";
		foreach ($categories as $category)
		{
			echo "<li>";
			echo "<a href='?category_id=" . $category['categoryID'] ."'>";
			echo $category['categoryName'];
			echo "</a>";
			echo "</li>";
		}
		echo "</ul>";
	}
	
	function displayProductTable($products)
	{
		echo "<table>";
		echo "<tr>";
		echo "<th>Code</th>";
		echo "<th>Name</th>";
		echo "<th class='right'>Price</th>";
		echo "</tr>";
		
		foreach ($products as $product)
		{
			echo "<tr>";
			echo "<td>".$product['productCode']."</td>";
			echo "<td>".$product['productName']."</td>";
			echo "<td class='right'>".$product['listPrice']."</td>";
			echo "</tr>";
		}
		echo "</table>";
	}

	/*try
	{
		$db = getConnection();
		echo "Connection Successful"."<br />";
		print_r(getCategory($db, 1));
		echo "<br />";
		print_r(getCategories($db));
		print_r(getProductsByCategory($db, 1));
		echo "<br />";
		displayCategoryList(getCategories($db));
		displayProductTable(getproductsByCategory($db, 1));
		$db = null;
	}
	catch (Exception $e)
	{
		echo $e->getMessage();
	}*/
	


?>