<?php

include "shared/header.php";
include "cfg/dbconnect.php";

$err_flag = false;
$name_err = $price_err = $description_err = $category_err = $tag_err = $brand_err = "";
$name = $price = $description = $category = $tag = $brand = "";

if (isset($_POST['submit'])) {
    $name = trim($_POST['name']);
    $price = trim($_POST['price']);
    $description = trim($_POST['description']);
    $category = trim($_POST['category']);
    $tag = trim($_POST['tag']);
    $brand = trim($_POST['brand']);

    if (empty($name)) {
        $name_err = 'Enter Name';
        $err_flag = true;
    }
    if (empty($price)) {
        $price_err = 'Enter price';
        $err_flag = true;
    }

    if (empty($description)) {
        $description_err = 'Enter description';
        $err_flag = true;
    }
    if (empty($category)) {
        $category_err = 'Enter category';
        $err_flag = true;
    }
    if (empty($tag)) {
        $tag_err = 'Enter tag';
        $err_flag = true;
    }
    if (empty($brand)) {
        $brand_err = 'Enter brand';
        $err_flag = true;
    }

    if (!$err_flag) {
        $sql = "INSERT INTO product (name, price, description, category, tag, brand) VALUES (?, ?, ?, ?, ?, ?)";
        try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$name, $price, $description, $category, $tag, $brand]);
            echo "Product Added";
            header("Location: index.php");
            exit; // Ensure script stops executing after redirect
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}
?>

<body>
    <?php include 'shared/nav.php' ?>
    <?php
    if (isset($_SESSION["user"]) && $_SESSION["user"]["role"] != "admin") {
        header("Location: index.php");
        exit;
    }
    ?>

    <div class="container mx-auto p-8 flex flex-col justify-center items-center">
        <h1 class="text-2xl font-semibold mb-6">Add Product</h1>
        <form action="" method="post" class="w-full max-w-lg bg-white shadow-md rounded-lg p-8">
            <div class="mb-4">
                <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Name</label>
                <input type="text" name="name" id="name" placeholder="Enter Name"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    value="<?= $name ?>">
                <div class="text-red-500 text-sm"><?= $name_err ?></div>
            </div>
            <div class="mb-4">
                <label for="price" class="block text-gray-700 text-sm font-bold mb-2">Price</label>
                <input type="number" name="price" id="price" placeholder="Enter Price"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    value="<?= $price ?>">
                <div class="text-red-500 text-sm"><?= $price_err ?></div>
            </div>
            <div class="mb-4">
                <label for="description" class="block text-gray-700 text-sm font-bold mb-2">Description</label>
                <textarea name="description" id="description" placeholder="Enter Description"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"><?= $description ?></textarea>
                <div class="text-red-500 text-sm"><?= $description_err ?></div>
            </div>
            <div class="mb-4">
                <label for="category" class="block text-gray-700 text-sm font-bold mb-2">Category</label>
                <textarea name="category" id="category" placeholder="Enter Category"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"><?= $category ?></textarea>
                <div class="text-red-500 text-sm"><?= $category_err ?></div>
            </div>
            <div class="mb-4">
                <label for="tag" class="block text-gray-700 text-sm font-bold mb-2">Tag</label>
                <textarea name="tag" id="tag" placeholder="Enter Tag"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"><?= $tag ?></textarea>
                <div class="text-red-500 text-sm"><?= $tag_err ?></div>
            </div>
            <div class="mb-4">
                <label for="brand" class="block text-gray-700 text-sm font-bold mb-2">Brand</label>
                <textarea name="brand" id="brand" placeholder="Enter Brand"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"><?= $brand ?></textarea>
                <div class="text-red-500 text-sm"><?= $brand_err ?></div>
            </div>
            <div class="flex items-center justify-between">
                <button type="submit" name="submit"
                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                    Submit
                </button>
                <a href="index.php"
                    class="inline-block align-baseline font-bold text-sm text-red-500 hover:text-red-800">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</body>

</html>