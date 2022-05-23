<?php

require('database.php');

$query = 'SELECT * FROM categories ORDER BY categoryID';
$statement = $db->prepare($query);
$statement->execute();
$categories = $statement->fetchAll();
$statement->closeCursor();
?>

<title>My Guitar Shop</title>
<link rel="stylesheet" type="text/css" href="test.css">

<body>
    <header>
        <h1 style="position:relative;right:-30px;">Product Manager</h1>
        <h1 style="border-bottom: 2px solid black;margin-top:20px;margin-left:-12px;margin-right:-12px;"></h1>
    </header>
    <main>
        <h1 style="position:relative;bottom:-50px; right:50px; color: rgb(255, 181, 0);">Add Product</h1>
        <form action="addProduct.php" method="post" id="add_product_form">
            <label style="position:relative;bottom:-50px; right:50px;">Category:</label>
            <select style="position:relative;bottom:-50px; right:25px; border: 1px solid #000080;" name="category_id">
                <?php foreach ($categories as $category) : ?>
                    <option value="<?php echo $category['categoryID']; ?>">
                        <?php echo $category['categoryName']; ?>
                    </option>
                <?php endforeach; ?>
            </select><br>

            <label style="position:relative;bottom:-50px; right:50px;">Code:</label>
            <input style="position:relative;bottom:-50px; right:4px;" type="text" name="code"><br>
            <label style="position:relative;bottom:-45px; right:50px;">Name:</label>
            <input style="position:relative;bottom:-45px; right:8px;" type="text" name="name"><br>
            <label style="position:relative;bottom:-40px; right:50px;">List Price:</label>
            <input style="position:relative;bottom:-40px; right:31px;" type="text" name="price"><br>

            <label>&nbsp;</label>

            <input style="position:relative;bottom:-50px; right:10px;" id="sub" type="submit" value="Add Product">
        </form>
        <p id="viewProdList"><a href="index.php">View Product List</a></p>
    </main>
    <h1 style="border-bottom: 2px solid black;margin-top:150px;margin-left:-12px;margin-right:-12px;"></h1>
    <footer>
        <p style="margin-left: 75%; margin-top:-100px;">&copy; <?php echo date(2010); ?> My Guitar Shop, Inc.</p>
    </footer>
</body>
</html>