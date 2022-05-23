<?php
include('database.php');

// Get category ID
if (!isset($category_id)) {
    $category_id = filter_input(INPUT_GET, 'category_id', FILTER_VALIDATE_INT);
    if ($category_id == NULL || $category_id == FALSE) {
        $category_id = 1;
    }
}

// Get name for selected category
$queryCategory = 'SELECT * FROM categories WHERE categoryID = :category_id';

$statement1 = $db->prepare($queryCategory);
$statement1->bindValue(':category_id', $category_id);
$statement1->execute();
$category = $statement1->fetch();
$category_name = $category['categoryName'];
$statement1->closeCursor();

// Get all categories
$queryAllCategories = 'SELECT * FROM categories ORDER BY categoryID';
$statement2 = $db->prepare($queryAllCategories);
$statement2->execute();
$categories = $statement2->fetchAll();
$statement2->closeCursor();

// Get products for selected categories 
$queryProducts = 'SELECT * FROM products WHERE categoryID = :category_id ORDER BY productID';
$statement3 = $db->prepare($queryProducts);
$statement3->bindValue(':category_id', $category_id);
$statement3->execute();
$products = $statement3->fetchAll();
$statement3->closeCursor();
?>

<title>My Guitar Shop</title>
<link rel="stylesheet" type="text/css" href="test.css" />

<style>
    table {
        border: 1px solid black;
        border-collapse: collapse;
    }

    th,
    td {
        border: 1px solid black;
        border-style: dashed;
    }

    ul {
        list-style: none;
    }

    a {
        text-decoration: none;
    }

    .pList {
        margin-left: -50px;
        margin-top: 110px;
    }
</style>

<body>

    <header>
        <h1 style="position:relative;right:-30px;">Product Manager</h1>
        <h1 style="border-bottom: 2px solid black;margin-top:20px;margin-left:-12px;margin-right:-12px;"></h1>
    </header>
    <main>
        <h1 id="productList">Product List</h1>
        <h2 id="categories"><a href="categoryList.php" style="color: rgb(255, 181, 0);">Categories</a></h2>
        <aside>
            <nav>
                <ul>
                    <div class="pList">
                        <?php foreach ($categories as $category) : ?>

                            <li style="margin: 15px 0;"><a style="text-decoration:underline; position:relative; right:30px; top:-95px; color:#000080;" href="?category_id=<?php echo $category['categoryID']; ?>">
                                    <?php echo $category['categoryName'];?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </div>
                </ul>
            </nav>

        </aside>

        <section>
            <div class="tableIndex">
                <!-- Display a table of products -->
                <h2><?php echo $category_name; ?></h2>
                <table>
                    <tr>
                        <th>Code</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th></th>
                    </tr>

                    <?php foreach ($products as $product) : ?>

                        <tr>
                            <td><?php echo $product['productCode']; ?></td>
                            <td><?php echo $product['productName']; ?></td>
                            <td class="right"><?php echo $product['listPrice']; ?></td>

                            <td>
                                <form action="delete.php" method="post">
                                    <input type="hidden" name="product_id" value="<?php echo $product['productID']; ?>">
                                    <input type="hidden" name="category_id" value="<?php echo $product['categoryID'] ?>">
                                    <input id="delete" type="submit" value="Delete">
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            </div>
            <p style="text-decoration:underline; margin-left: 100px; margin-top:6px;"><a href="form.php">Add Product</a></p>
        </section>
    </main>

    <footer style="border-top: 2px solid black;position: absolute; top:353; width: 824px;margin-left:-12px">
                <p style="margin-left: 74.3%; margin-top:2;">&copy; <?php echo date(2010); ?> My Guitar Shop, Inc.</p>
    </footer>
</body>

</html>