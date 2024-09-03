<?php
include 'shared/header.php';
include 'cfg/dbconnect.php';

$searchTerm = $_GET['search'] ?? '';
$categoryFilter = $_GET['category'] ?? '';
$tagFilter = $_GET['tag'] ?? '';

$queryCategory = "SELECT DISTINCT category FROM product ORDER BY category";
$stcat = $pdo->prepare($queryCategory);
$stcat->execute();
$allcat = $stcat->fetchAll(PDO::FETCH_ASSOC);

$queryTag = "SELECT DISTINCT tag FROM product ORDER BY tag";
$sttag = $pdo->prepare($queryTag);
$sttag->execute();
$alltag = $sttag->fetchAll(PDO::FETCH_ASSOC);


// Fetch products based on filters
$query = "SELECT * FROM product WHERE 1=1";

if ($searchTerm) {
    $query .= " AND name LIKE :searchTerm";
}
if ($categoryFilter) {
    $query .= " AND category = :categoryFilter";
}
if ($tagFilter) {
    $query .= " AND tag = :tagFilter";
}

$query .= " ORDER BY id LIMIT :offset, :limit";

$statement = $pdo->prepare($query);

if ($searchTerm) {
    $statement->bindValue(':searchTerm', "%$searchTerm%");
}
if ($categoryFilter) {
    $statement->bindValue(':categoryFilter', $categoryFilter);
}
if ($tagFilter) {
    $statement->bindValue(':tagFilter', $tagFilter);
}

$limit = 5;
$page = $_GET['page'] ?? 1;
$offset = ($page - 1) * $limit;

$statement->bindValue(':offset', (int) $offset, PDO::PARAM_INT);
$statement->bindValue(':limit', (int) $limit, PDO::PARAM_INT);

$statement->execute();
$results = $statement->fetchAll(PDO::FETCH_ASSOC);

// Debugging: Check fetched products
// print_r($results); // Uncomment this line to debug

// Fetch the total number of products for pagination
$totalQuery = "SELECT COUNT(*) FROM product WHERE 1=1";
if ($searchTerm) {
    $totalQuery .= " AND name LIKE :searchTerm";
}
if ($categoryFilter) {
    $totalQuery .= " AND category = :categoryFilter";
}
if ($tagFilter) {
    $totalQuery .= " AND tag = :tagFilter";
}
$totalStatement = $pdo->prepare($totalQuery);

if ($searchTerm) {
    $totalStatement->bindValue(':searchTerm', "%$searchTerm%");
}
if ($categoryFilter) {
    $totalStatement->bindValue(':categoryFilter', $categoryFilter);
}
if ($tagFilter) {
    $totalStatement->bindValue(':tagFilter', $tagFilter);
}

$totalStatement->execute();
$totalProducts = $totalStatement->fetchColumn();
$totalPages = ceil($totalProducts / $limit);
?>

<body>
    <?php include 'shared/nav.php' ?>
    <h1 class="text-2xl font-bold mx-[40px]">All products</h1>

    <form method="GET" action="" class="mx-[40px] my-[20px]">
        <input class="outline outline-1 rounded-md p-1" type="text" name="search" placeholder="Search..." value="<?= htmlspecialchars($searchTerm) ?>">
        <select name="category" class="outline outline-1 rounded-md p-1">
            <option value="">All Categories</option>
            <?php foreach ($allcat as $category): ?>
                <option value="<?= htmlspecialchars($category['category']) ?>" <?= $category['category'] === $categoryFilter ? 'selected' : '' ?>>
                    <?= htmlspecialchars($category['category']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <select name="tag" class="outline outline-1 rounded-md p-1">
            <option value="">All Tags</option>
            <?php foreach ($alltag as $tag): ?>
                <option value="<?= htmlspecialchars($tag['tag']) ?>" <?= $tag['tag'] === $tagFilter ? 'selected' : '' ?>>
                    <?= htmlspecialchars($tag['tag']) ?>
                </option>
            <?php endforeach; ?>
        </select>
        <button type="submit" class="rounded-md px-6 py-1 border hover:bg-slate-400 hover:text-white font-semibold">Apply</button>
    </form>

    <div class="grid grid-cols-2 md:grid-cols-3 mx-[40px] gap-[20px] mt-[40px]">
        <?php if (count($results) > 0): ?>
            <?php foreach ($results as $row): ?>
                <div class="border rounded-md p-6 bg-gray-200">
                    <p class=""><?= htmlspecialchars($row['name']) ?> <small
                            class="text-orange-400"><?= htmlspecialchars($row['tag']) ?></small></p>
                    <p class="">Price: <?= htmlspecialchars($row['price']) ?> BDT/KG</p>
                    <p class="text-[12px] text-slate-400">Category <?= htmlspecialchars($row['category']) ?></p>
                    <p class="text-[12px] text-slate-400">Brand <?= htmlspecialchars($row['brand']) ?></p>
                    <p class="">Description <?= htmlspecialchars($row['description']) ?></p>
                    <form action="func/addToCart.php" method="POST">
                        <input type="hidden" name="product_id" value="<?= htmlspecialchars($row['id']) ?>">
                        <input type="hidden" name="product_name" value="<?= htmlspecialchars($row['name']) ?>">
                        <input type="hidden" name="product_price" value="<?= htmlspecialchars($row['price']) ?>">
                        <button type="submit" class="bg-green-400 text-white px-4 py-2 rounded mt-4">Add to Cart</button>
                    </form>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center">No products found.</p>
        <?php endif; ?>
    </div>

    <div class="w-full flex justify-center my-[40px] gap-[20px]">
        <?php if ($page > 1): ?>
            <a
                href="?page=<?= $page - 1 ?>&search=<?= htmlspecialchars($searchTerm) ?>&category=<?= htmlspecialchars($categoryFilter) ?>&tag=<?= htmlspecialchars($tagFilter) ?>">Previous</a>
        <?php endif; ?>

        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
            <a
                href="?page=<?= $i ?>&search=<?= htmlspecialchars($searchTerm) ?>&category=<?= htmlspecialchars($categoryFilter) ?>&tag=<?= htmlspecialchars($tagFilter) ?>"><?= $i ?></a>
        <?php endfor; ?>

        <?php if ($page < $totalPages): ?>
            <a class=""
                href="?page=<?= $page + 1 ?>&search=<?= htmlspecialchars($searchTerm) ?>&category=<?= htmlspecialchars($categoryFilter) ?>&tag=<?= htmlspecialchars($tagFilter) ?>">Next</a>
        <?php endif; ?>
    </div>
</body>

</html>
