<?php 
// Database connection settings
$servername = "localhost";
$username = "root"; // Default username for XAMPP
$password = ""; // Default no password for XAMPP
$dbname = "goldentime"; // Replace with your actual database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch all watches
$sql = "SELECT id, name, image_url, details, price_ksh FROM watches"; // Adjust this SQL query based on your actual table structure
$result = $conn->query($sql); // Execute the query

// Check if the query was successful
if (!$result) {
    die("Query failed: " . $conn->error); // Display error message if query fails
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Golden Time - Products</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .product-card img {
            width: 200px; /* Fixed width */
            height: 200px; /* Fixed height */
            object-fit: cover; /* Ensures the aspect ratio is maintained and the image covers the area */
            border-radius: 10px; /* Optional: Adds rounded corners to the images */
        }
    </style>
</head>
<body class="bg-gray-100">

    <!-- Navbar -->
    <nav class="bg-white shadow">
        <div class="container mx-auto p-4 flex justify-between items-center">
            <h1 class="text-2xl font-bold">Golden Time</h1>
            <ul class="flex space-x-6">
                <li><a href="index.php" class="text-gray-800">Home</a></li>
                <li><a href="products.php" class="text-gray-800">Shop</a></li>
                <li><a href="#about" class="text-gray-800">About Us</a></li>
                <li><a href="#contact" class="text-gray-800">Contact</a></li>
                <li><a href="cart.php" class="text-gray-800">Cart</a></li>
            </ul>
        </div>
    </nav>

    <!-- Products Section -->
    <section class="py-16 bg-gray-100">
        <div class="container mx-auto text-center">
            <h3 class="text-3xl font-bold mb-8">Shop Our Collection</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <?php while ($row = $result->fetch_assoc()) { ?>
                <div class="bg-white p-6 rounded-lg shadow-md flex flex-col items-center"> <!-- Center images and text -->
                    <img src="<?php echo $row['image_url']; ?>" alt="<?php echo $row['name']; ?>" loading="lazy">
                    <h4 class="text-xl font-bold mb-2"><?php echo $row['name']; ?></h4>
                    <p class="text-gray-600 mb-2"><?php echo $row['details']; ?></p>
                    <p class="text-gray-600 mb-4">KSH <?php echo number_format($row['price_ksh'], 2); ?></p>
                    <a href="watch_detail.php?watch_id=<?php echo $row['id']; ?>" class="bg-black text-white px-4 py-2 rounded">View</a>
                </div>
                <?php } ?>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-8">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 Golden Time. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>
