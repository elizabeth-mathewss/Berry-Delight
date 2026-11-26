<?php
include("../Connection/Connection.php");

$sql = "SELECT 
            p.*, 
            q.*,
            y.*,
            s.subcategory_name, 
            c.category_name,
            COALESCE(stock_data.total_stock, 0) as total_stock,
            COALESCE(cart_data.total_sold, 0) as total_sold,
            COALESCE(review_rating.avg_rating, 0) as avg_rating,
            COALESCE(review_rating.review_count, 0) as review_count
        FROM 
            tbl_productqty q 
                    INNER JOIN 
                     tbl_product p ON p.product_id = q.product_id
        INNER JOIN 
            tbl_subcategory s ON p.subcategory_id = s.subcategory_id
        INNER JOIN 
            tbl_category c ON s.category_id = c.category_id
        INNER JOIN 
            tbl_quantity y ON q.quantity_id = y.quantity_id

        LEFT JOIN 
            (SELECT product_id, SUM(stock_qty) as total_stock FROM tbl_stock GROUP BY product_id) as stock_data
            ON p.product_id = stock_data.product_id
        LEFT JOIN 
            (SELECT product_id, SUM(cart_qty) as total_sold FROM tbl_cart WHERE cart_status > 0 GROUP BY product_id) as cart_data
            ON p.product_id = cart_data.product_id
        LEFT JOIN
            (SELECT product_id, AVG(review_rating) as avg_rating, COUNT(review_id) as review_count FROM tbl_review GROUP BY product_id) as review_rating
            ON p.product_id = review_rating.product_id
        WHERE p.seller_id= '".$_GET['sid']."' AND true ";

// ----- APPLY FILTERS (Sanitized to prevent SQL injection) -----
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = $Con->real_escape_string($_GET['search']);
    $sql .= " AND p.product_name LIKE '$search%'";
}
if (isset($_GET['categories']) && !empty($_GET['categories'])) {
    $categories = array_map('intval', $_GET['categories']);
    $catList = implode(',', $categories);
    $sql .= " AND c.category_id IN ($catList)";
}
if (isset($_GET['subcategories']) && !empty($_GET['subcategories'])) {
    $subcategories = array_map('intval', $_GET['subcategories']);
    $subcatList = implode(',', $subcategories);
    $sql .= " AND s.subcategory_id IN ($subcatList)";
}
if (isset($_GET['price']) && !empty($_GET['price'])) {
    $price = intval($_GET['price']);
    $sql .= " AND q.productqty_price <= $price";
}

// ----- APPLY SORTING -----
$sortKey = $_GET['sort'] ?? 'az';
$sortOptions = [
    'az'         => 'p.product_name ASC',
    'za'         => 'p.product_name DESC',
    'price_asc'  => 'p.product_price ASC',
    'price_desc' => 'p.product_price DESC',
    'most_sold'  => 'total_sold DESC'
];
$orderBy = $sortOptions[$sortKey] ?? $sortOptions['az'];
$sql .= " ORDER BY " . $orderBy;

// ----- EXECUTE QUERY AND GENERATE OUTPUT -----
$result = $Con->query($sql);

// Fetch all rows into an array and shuffle them
$products = [];
if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $remainingStock = $row['total_stock'] - $row['total_sold'];
        $products[] = $row;
    }
    // Shuffle the products array to mix them randomly
    shuffle($products);

    // Output shuffled products
    foreach ($products as $row) {
        $remainingStock = $row['total_stock'] - $row['total_sold'];
        ?>
        <div class="product-card">
            <a href="ViewMore.php?pid=<?php echo $row['product_id']; ?>" class="product-card-link">
                <div class="product-card-image">
                    <img src="../Assets/Files/SellerDocs/<?php echo htmlspecialchars($row['product_photo']); ?>" alt="<?php echo htmlspecialchars($row['product_name']); ?>">
                </div>
                <div class="product-card-body">
                    <h4 class="product-card-title"><?php echo htmlspecialchars($row['product_name']); ?></h4>
                    <!-- <div><?php echo $row['quantity_name'] ?> g</div> -->
                    <div class="product-card-rating">
                        <?php
                        $full_stars = floor($row['avg_rating']);
                        $decimal_part = $row['avg_rating'] - $full_stars;
                        for ($s = 1; $s <= 5; $s++) {
                            if ($s <= $full_stars) { echo '<i class="fas fa-star"></i>'; }
                            else if ($s == ($full_stars + 1) && $decimal_part >= 0.25) { echo '<i class="fas fa-star-half-alt"></i>'; }
                            else { echo '<i class="far fa-star"></i>'; }
                        }
                        ?>
                        <span class="review-count">(<?php echo $row['review_count']; ?>)</span>
                    </div>
                    <p class="product-card-price"><?php echo number_format($row['product_price']); ?> ₹</p>
                </div>
            </a>
            <div class="product-card-footer">
                <?php if ($remainingStock > 0) { ?>
                    <button class="product-card-button" onclick="addToCart(<?php echo $row['product_id']; ?>)">
                        <i class="fas fa-shopping-cart"></i> Add to Cart
                    </button>
                <?php } else { ?>
                    <button class="product-card-button-disabled" disabled>
                        <i class="fas fa-ban"></i> Out of Stock
                    </button>
                <?php } ?>
            </div>
        </div>
        <?php
    }
} else {
    echo "<p class='error-message'>No products found matching your criteria.</p>";
}
?>