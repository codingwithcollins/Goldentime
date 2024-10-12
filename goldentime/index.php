<?php
// Database connection settings
$servername = "localhost";
$username = "root";
$password = ""; 
$dbname = "goldentime"; 

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch only 3 watches from the watches table
$sql = "SELECT * FROM watches LIMIT 3";
$result = $conn->query($sql);

if (!$result) {
    die("Error: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="images/favicon.png">
    <title>Golden Time - Watches</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">

    <!-- Navbar -->
    <!-- Navbar -->
<nav class="bg-white shadow">
    <div class="container mx-auto p-4 flex justify-between items-center">
        <!-- Logo -->
        <h1 class="text-2xl font-bold">Golden Time</h1>
        
        <!-- Hamburger Button (Hidden on larger screens) -->
        <div class="block md:hidden">
            <button id="nav-toggle" class="text-gray-800 focus:outline-none">
                <!-- Hamburger Icon (SVG) -->
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                </svg>
            </button>
        </div>

        <!-- Links (Visible on larger screens) -->
        <ul id="nav-menu" class="hidden md:flex space-x-6">
            <li><a href="index.php" class="text-gray-800">Home</a></li>
            <li><a href="products.php" class="text-gray-800">Shop</a></li>
            <li><a href="#about" class="text-gray-800">About Us</a></li>
            <li><a href="#contact" class="text-gray-800">Contact</a></li>
            <li><a href="cart.php" class="text-gray-800">Cart</a></li>
        </ul>
    </div>

    <!-- Links for mobile (Initially hidden, toggled by the button) -->
    <ul id="mobile-menu" class="hidden flex-col md:hidden bg-white px-4 py-2 space-y-4">
        <li><a href="index.php" class="text-gray-800 block">Home</a></li>
        <li><a href="products.php" class="text-gray-800 block">Shop</a></li>
        <li><a href="#about" class="text-gray-800 block">About Us</a></li>
        <li><a href="#contact" class="text-gray-800 block">Contact</a></li>
        <li><a href="cart.php" class="text-gray-800 block">Cart</a></li>
    </ul>
</nav>

    <!-- Hero Section -->
    <section id="home" class="bg-cover bg-center h-96" style="background-image: url('images/background4.jpg');">
        <div class="bg-black bg-opacity-50 h-full flex justify-center items-center">
            <div class="text-center text-white">
                <h2 class="text-4xl font-bold">Watches and Accessories</h2>
                <p class="text-lg mt-4">For those who value time</p>
                <a href="products.php" class="mt-6 inline-block bg-gold-500 text-white px-6 py-2 rounded">View Collection</a>
            </div>
        </div>
    </section>
<!-- Latest Blog Posts Section -->
<section class="py-16 bg-white">
    <div class="container mx-auto text-center">
        <h3 class="text-3xl font-bold mb-8">Latest from Our Blog</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="bg-gray-100 p-6 rounded-lg shadow-md">
                <img src="images/blog1.jpg" alt="Blog 1" class="mx-auto mb-4">
                <h4 class="text-xl font-bold mb-2">How to Choose the Perfect Watch</h4>
                <p class="text-gray-600 mb-4">Discover how to select a watch that complements your style and personality.</p>
                <a href="blog_detail.php?blog_id=1" class="text-gold-500 underline">Read more</a>
            </div>
            <div class="bg-gray-100 p-6 rounded-lg shadow-md">
                <img src="images/blog2.jpg" alt="Blog 2" class="mx-auto mb-4">
                <h4 class="text-xl font-bold mb-2">2024 Watch Trends</h4>
                <p class="text-gray-600 mb-4">Check out the latest trends in watches that are dominating this year.</p>
                <a href="blog_detail.php?blog_id=2" class="text-gold-500 underline">Read more</a>
            </div>
            <div class="bg-gray-100 p-6 rounded-lg shadow-md">
                <img src="images/blog3.jpg" alt="Blog 3" class="mx-auto mb-4">
                <h4 class="text-xl font-bold mb-2">Caring for Your Watch</h4>
                <p class="text-gray-600 mb-4">Tips and tricks to keep your watch in top shape for years to come.</p>
                <a href="blog_detail.php?blog_id=3" class="text-gold-500 underline">Read more</a>
            </div>
        </div>
    </div>
</section>

    <!-- Bestsellers Section -->
    <section class="py-16 bg-gray-100">
        <div class="container mx-auto text-center">
            <h3 class="text-3xl font-bold mb-8">Bestsellers</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Dynamic Product Cards -->
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <div class="bg-white p-6 rounded-lg shadow-md">
                        <img src="<?php echo $row['image_url']; ?>" alt="<?php echo $row['name']; ?>" class="mx-auto mb-4" loading="lazy">
                        <h4 class="text-xl font-bold mb-2"><?php echo $row['name']; ?></h4>
                        <p class="text-gray-600 mb-4">KSH <?php echo number_format($row['price_ksh'], 2); ?></p>
                        <a href="watch_detail.php?watch_id=<?php echo $row['id']; ?>" class="bg-black text-white px-4 py-2 rounded">View</a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
<!-- Shop by Category Section -->
<section class="py-16 bg-white">
    <div class="container mx-auto text-center">
        <h3 class="text-3xl font-bold mb-8">Shop by Category</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <a href="category.php?category=men" class="block bg-gray-100 p-6 rounded-lg">
                <img src="images/men.jpg" alt="Men's Watches" class="mx-auto mb-4">
                <h4 class="text-xl font-bold">Men's Watches</h4>
            </a>
            <a href="category.php?category=women" class="block bg-gray-100 p-6 rounded-lg">
                <img src="images/women.jpg" alt="Women's Watches" class="mx-auto mb-4">
                <h4 class="text-xl font-bold">Women's Watches</h4>
            </a>
            <a href="category.php?category=accessories" class="block bg-gray-100 p-6 rounded-lg">
                <img src="images/accessories.jpg" alt="Accessories" class="mx-auto mb-4">
                <h4 class="text-xl font-bold">Accessories</h4>
            </a>
        </div>
    </div>
</section>

    <!-- Reviews Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto text-center">
            <h3 class="text-3xl font-bold mb-8">Customer Reviews</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Reviewer 1 -->
                <div class="bg-gray-100 p-6 rounded-lg shadow-md">
                    <img src="images/customer1.jpeg" alt="Reviewer 1" class="mx-auto rounded-full w-20 h-20 mb-4">
                    <h4 class="text-xl font-bold mb-2">John Doe</h4>
                    <p class="text-gray-600 mb-4">"Amazing craftsmanship and excellent customer service. Highly recommend Golden Time watches!"</p>
                    <div class="text-gold-500">
                        ★★★★☆
                    </div>
                </div>
                <!-- Reviewer 2 -->
                <div class="bg-gray-100 p-6 rounded-lg shadow-md">
                    <img src="images/customer2.jpeg" alt="Reviewer 2" class="mx-auto rounded-full w-20 h-20 mb-4">
                    <h4 class="text-xl font-bold mb-2">Jane Smith</h4>
                    <p class="text-gray-600 mb-4">"Stylish and durable watches. I’ve been using mine for a year, and it still looks new."</p>
                    <div class="text-gold-500">
                        ★★★★★
                    </div>
                </div>
                <!-- Reviewer 3 -->
                <div class="bg-gray-100 p-6 rounded-lg shadow-md">
                    <img src="images/customer3.jpeg" alt="Reviewer 3" class="mx-auto rounded-full w-20 h-20 mb-4">
                    <h4 class="text-xl font-bold mb-2">Michael Brown</h4>
                    <p class="text-gray-600 mb-4">"A watch that speaks elegance and quality. I’ve received so many compliments."</p>
                    <div class="text-gold-500">
                        ★★★★★
                    </div>
                </div>
            </div>
        </div>
    </section>
<!-- Partner Logos Section -->
<section class="py-16 bg-white">
    <div class="container mx-auto text-center">
        <h3 class="text-3xl font-bold mb-8">Trusted By</h3>
        <div class="flex justify-around items-center">
            <img src="images/logo1.png" alt="Partner 1" class="h-20">
            <img src="images/logo2.png" alt="Partner 2" class="h-20">
            <img src="images/logo5.png" alt="Partner 3" class="h-20">
            <img src="images/logo4.jpeg" alt="Partner 4" class="h-22">
        </div>
    </div>
</section>
<!-- Newsletter Section -->
<section class="bg-black text-white py-16">
    <div class="container mx-auto text-center">
        <h3 class="text-3xl font-bold mb-4">Subscribe to Our Newsletter</h3>
        <p class="text-lg mb-8">Stay updated with our latest offers, products, and articles.</p>
        <form action="subscribe.php" method="POST" class="flex justify-center">
            <input type="email" name="email" placeholder="Enter your email" class="p-2 w-1/3 rounded-l">
            <button type="submit" class="bg-gold-500 text-white px-6 py-2 rounded-r">Subscribe</button>
        </form>
    </div>
</section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-8">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 Golden Time. All rights reserved.</p>
        </div>
    </footer>
    <script>
    // Select the toggle button and mobile menu
    const navToggle = document.getElementById('nav-toggle');
    const mobileMenu = document.getElementById('mobile-menu');

    // Add click event listener to the toggle button
    navToggle.addEventListener('click', function() {
        // Toggle the hidden class on the mobile menu
        mobileMenu.classList.toggle('hidden');
    });
</script>

</body>
</html>
