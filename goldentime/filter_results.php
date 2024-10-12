<?php
// Sample PHP code to handle the filters and display the filtered watches

// Connect to the database
include('db_connection.php');

// Retrieve filter values (add more filters if needed)
$availability = $_GET['availability'] ?? '';
$condition = $_GET['condition'] ?? '';
$price_range = $_GET['price_range'] ?? '';
$gender = $_GET['gender'] ?? '';
$case_size = $_GET['case_size'] ?? '';
$bracelet_material = $_GET['bracelet_material'] ?? '';
$bracelet_type = $_GET['bracelet_type'] ?? '';
$bezel_type = $_GET['bezel_type'] ?? '';
$dial_color = $_GET['dial_color'] ?? '';
$box_and_papers = $_GET['box_and_papers'] ?? '';
$year = $_GET['year'] ?? '';

// Initialize the query
$query = "SELECT * FROM watches WHERE 1=1"; // 1=1 is a trick to simplify appending WHERE clauses

// Add conditions based on filters
if ($availability) {
    $query .= " AND availability = '" . mysqli_real_escape_string($conn, $availability) . "'";
}
if ($condition) {
    // Use backticks around the column name 'condition'
    $query .= " AND `condition` = '" . mysqli_real_escape_string($conn, $condition) . "'";
}
if ($price_range) {
    // Assuming price_range is something like "10000-50000"
    list($min_price, $max_price) = explode('-', $price_range);
    $query .= " AND price_ksh BETWEEN " . intval($min_price) . " AND " . intval($max_price);
}
if ($gender) {
    $query .= " AND gender = '" . mysqli_real_escape_string($conn, $gender) . "'";
}
if ($case_size) {
    $query .= " AND case_size = '" . mysqli_real_escape_string($conn, $case_size) . "'";
}
if ($bracelet_material) {
    $query .= " AND bracelet_material = '" . mysqli_real_escape_string($conn, $bracelet_material) . "'";
}
if ($bracelet_type) {
    $query .= " AND bracelet_type = '" . mysqli_real_escape_string($conn, $bracelet_type) . "'";
}
if (isset($_POST['buckle_type'])) {
    $buckle_type = $_POST['buckle_type'];
} else {
    $buckle_type = 'default_value'; // Set a default value if it's not set
}

if ($dial_color) {
    $query .= " AND dial_color = '" . mysqli_real_escape_string($conn, $dial_color) . "'";
}
if ($box_and_papers) {
    $query .= " AND box_and_papers = '" . mysqli_real_escape_string($conn, $box_and_papers) . "'";
}
if ($year) {
    $query .= " AND year = '" . mysqli_real_escape_string($conn, $year) . "'";
}

// Execute the query
$result = mysqli_query($conn, $query);

if (!$result) {
    // If there's an error, output the error message
    die("Query failed: " . mysqli_error($conn));
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="images/favicon.png">
    <title>Goldentime - Watches</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background-color: #f4f4f4;
        }
        .product-container {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .product-card {
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            width: 300px;
            text-align: center;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s;
        }
        .product-card:hover {
            transform: scale(1.05);
        }
        .product-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .product-details {
            padding: 15px;
        }
        .product-name {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .product-price {
            color: #27ae60;
            font-size: 16px;
            margin-bottom: 15px;
        }
        .checkout-btn {
            background-color: #3498db;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.2s;
        }
        .checkout-btn:hover {
            background-color: #2980b9;
        }
    </style>
</head>
<body>

<h1>Available Watches</h1>

<div class="product-container">
    <?php
    // Fetch and display the results
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="product-card">';
        echo '<img src="' . htmlspecialchars($row['image_url']) . '" alt="' . htmlspecialchars($row['name']) . '" class="product-image">';
        echo '<div class="product-details">';
        echo '<div class="product-name">' . htmlspecialchars($row['name']) . '</div>';
        echo '<div class="product-price">KSH ' . number_format($row['price_ksh'], 2) . '</div>';
        echo '<a href="watch_detail.php?watch_id=' . $row['id'] . '" class="checkout-btn">Checkout the Product</a>';
        echo '</div>';  // Close product-details
        echo '</div>';  // Close product-card
    }
    ?>
</div>

</body>
</html>
