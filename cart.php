<?php
session_start();
include 'shared/header.php';
?>

<body>
    <?php include 'shared/nav.php' ?>
    <h1 class="text-2xl font-bold mx-[40px]">Cart Page</h1>

    <div class="mx-[40px] mt-[40px]">
        <?php
        if (isset($_SESSION['cart']) && count($_SESSION['cart']) > 0) {
            $total = 0;
            foreach ($_SESSION['cart'] as $index => $item) {
                $subtotal = $item['price'] * $item['quantity'];
                $total += $subtotal;
        ?>
                <div class="border rounded-md p-6 bg-gray-200 mb-4">
                    <p class=""><?= $item['name'] ?> <small class="text-orange-400">(<?= $item['quantity'] ?>)</small></p>
                    <p class="">Price: <?= $item['price'] ?> BDT/KG</p>
                    <p class="">Subtotal: <?= $subtotal ?> BDT</p>
                    <form action="func/removeFromCart.php" method="POST">
                        <input type="hidden" name="product_index" value="<?= $index ?>">
                        <button type="submit" class="bg-red-400 text-white px-4 py-2 rounded mt-2">Remove</button>
                    </form>
                </div>
        <?php
            }
        ?>
            <div class="text-xl font-bold">Total: <?= $total ?> BDT</div>
            <a href="checkout.php" class="bg-blue-500 text-white px-4 py-2 rounded mt-4 inline-block">Proceed to Checkout</a>
        <?php
        } else {
            echo "<p>Your cart is empty.</p>";
        }
        ?>
    </div>
</body>

</html>
