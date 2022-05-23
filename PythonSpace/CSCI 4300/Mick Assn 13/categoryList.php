<?php

include('database.php');

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

?>
<title>My Guitar Shop</title>
<link rel="stylesheet" type="text/css" href="test.css">

<style>
    table {
        border: 1px solid black;
        border-collapse: collapse;
    }

    th,td {
        border: 1px solid black;
        border-style: dashed;
    }
    a {
        text-decoration: none;
        font-size: 130%;
    }
</style>

<body>
    <header>
        <h1 style="position:relative;right:-30px;">Product Manager</h1>
        <h1 style="border-bottom: 2px solid black;margin-top:20px;margin-left:-12px;margin-right:-12px;"></h1>
    </header>
    <main>
        <h2 style="color: rgb(255, 181, 0); position:relative;bottom:-30px; right:80px;">Category List</h2>
        <section>
            <div class ="tableCL">
            <table>
                <tr>
                    <th>Name</th>
                    <th></th>
                <tr>
                    <?php foreach ($categories as $category) : ?>
                        <td><?php echo $category['categoryName']; ?></td>
                        <td>
                            <form action="deleteCategory.php" method="post">
                                <input type="hidden" name="category_name" value="<?php echo $category['categoryName'] ?>">
                                <input type="submit" value="Delete">
                            </form>
                        </td>
                </tr>
                </tr>
            <?php endforeach; ?>
            </table>
        </section>
        </div>
        <h2 style="color: rgb(255, 181, 0); position:relative;bottom:-10px; right:80px;">Add Category</h2>
        
        <form action="addCategory.php" method="post" id="add_category_form">
            
        <label style="position:relative;right:50px;">Name:</label>
            <input style="position:relative;right:50;" type="text" name="category_name">
            <input style="margin-left:-40;" type="submit" value="Add"><br>
        </form>
        <p id="viewList"><a href="index.php">List Products</a></p>
    </main>
    <h1 style="border-bottom: 2px solid black;margin-top:36px;margin-left:-12px;margin-right:-12px;"></h1>
    <footer>
        <p style="margin-left: 75%; margin-top:-100px;">&copy; <?php echo date(2010); ?> My Guitar Shop, Inc.</p>
    </footer>
</body>
</html>