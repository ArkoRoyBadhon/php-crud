<?php
include 'shared/header.php';
include 'cfg/dbconnect.php';

$sql = "select * from product order by id";
$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->get_result();
?>


<body>
    <?php include 'shared/nav.php' ?>
    <h1 class="text-2xl font-bold mx-[40px]">All products</h1>
    <div class="grid grid-cols-2 md:grid-cols-3 mx-[40px] gap-[20px] mt-[40px]">

        <?php
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            foreach ($result as $row) { ?>
                <div class="border rounded-md p-6 bg-gray-200">
                    <p class=""><?= $row['name'] ?> <small class="text-orange-400"><?= $row['tag'] ?></small></p>
                    <p class="">Price: <?= $row['price'] ?>BDT/KG</p>
                    <p class="text-[12px] text-slate-400">Category <?= $row['category'] ?></p>
                    <p class="text-[12px] text-slate-400">brand <?= $row['brand'] ?></p>
                    <p class="">Description <?= $row['decription'] ?></p>
                    <form action="func/addToCart.php" method="POST">
                        <input type="hidden" name="product_id" value="<?= $row['id'] ?>">
                        <input type="hidden" name="product_name" value="<?= $row['name'] ?>">
                        <input type="hidden" name="product_price" value="<?= $row['price'] ?>">
                        <button type="submit" class="bg-green-400 text-white px-4 py-2 rounded mt-4">Add to Cart</button>
                    </form>
                </div>
            <?php }
        }
        ?>
    </div>

</body>

</html>