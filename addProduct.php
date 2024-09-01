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

    if (empty(($name))) {
        $name_err = 'Enter Name';
        $err_flag = true;
    }
    if (empty(($price))) {
        $price_err = 'Enter price';
        $err_flag = true;
    }

    if (empty(($description))) {
        $description_err = 'Enter description';
        $err_flag = true;
    }
    if (empty(($category))) {
        $category_err = 'Enter category';
        $err_flag = true;
    }
    if (empty(($tag))) {
        $tag_err = 'Enter tag';
        $err_flag = true;
    }
    if (empty(($brand))) {
        $brand_err = 'Enter brand';
        $err_flag = true;
    }

    if (!$err_flag) {
        $sql = "insert into product(name, price, decription, category, tag, brand) values (?, ?, ?, ?, ?, ?)";
        try {
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sissss", $name, $price, $description, $category, $tag, $brand);
            $stmt->execute();
            echo "Product Added";
            header("location:index.php");
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}

?>

<body>
    <?php include 'shared/nav.php' ?>

    <div class="container flex flex-col justify-center items-center">
        <h1 class="text-center text-2xl font-semibold">ADD Product</h1>
        <form action="" method="post" class="w-[400px] border p-6 mt-[40px]">
            <div class="mb-3 w-full">
                <label for="name" class="">Name</label>
                <br>
                <input type="text" name="name" id="name" placeholder="Enter Name" class="border outline outline-1" value="<?= $name ?>">
                <div class="text-red-400"><?= $name_err ?></div>
            </div>
            <div class="mb-3">
                <label for="price" class="">Price</label>
                <br>
                <input type="number" name="price" id="price" placeholder="Enter Price" class="outline outline-1" value="<?= $price ?>">
                <div class="text-red-400"><?= $price_err ?></div>
            </div>
            <div class="mb-3">
                <label for="description" class="">Description</label>
                <br>
                <textarea type="text" name="description" id="description" placeholder="Enter Description"
                    class="outline outline-1"><?= $description ?></textarea>
                <div class="text-red-400"><?= $description_err ?></div>
            </div>
            <div class="mb-3">
                <label for="category" class="">category</label>
                <br>
                <textarea type="text" name="category" id="category" placeholder="Enter category"
                    class="outline outline-1"><?= $category ?></textarea>
                <div class="text-red-400"><?= $category_err ?></div>
            </div>
            <div class="mb-3">
                <label for="tag" class="">tag</label>
                <br>
                <textarea type="text" name="tag" id="tag" placeholder="Enter tag"
                    class="outline outline-1"><?= $tag ?></textarea>
                <div class="text-red-400"><?= $tag_err ?></div>
            </div>
            <div class="mb-3">
                <label for="brand" class="">brand</label>
                <br>
                <textarea type="text" name="brand" id="brand" placeholder="Enter brand"
                    class="outline outline-1"><?= $brand ?></textarea>
                <div class="text-red-400"><?= $brand_err ?></div>
            </div>

            <button type="submit" class="px-6 py-2 border rounded-md bg-green-400" name="submit">
                Submit
            </button>
            <a href="index.php" class="px-6 py-2 border rounded-md bg-red-400">Cancel</a>
        </form>
    </div>
</body>

</html>