<?php    
// Database connection
include('db_connection.php');

// Check if 'watch_id' is set in the URL
if (isset($_GET['watch_id'])) {
    $watch_id = $_GET['watch_id'];

    // Fetch watch details from 'watches' table
    $query = "SELECT * FROM watches WHERE id = ?";
    $stmt = $conn->prepare($query);

    if ($stmt) {
        $stmt->bind_param('i', $watch_id);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if the watch exists
        if ($result->num_rows > 0) {
            $watch = $result->fetch_assoc();

            // Fetch additional images
            $query_images = "SELECT image_url FROM watch_images WHERE watch_id = ?";
            $stmt_images = $conn->prepare($query_images);

            if ($stmt_images) {
                $stmt_images->bind_param('i', $watch_id);
                $stmt_images->execute();
                $images_result = $stmt_images->get_result();

                // Collect additional images
                $additional_images = [];
                if ($images_result->num_rows > 0) {
                    while ($row = $images_result->fetch_assoc()) {
                        $additional_images[] = $row['image_url'];
                    }
                }

                // Close the second statement
                $stmt_images->close();
            } else {
                echo 'Error preparing images query: ' . $conn->error;
            }

        } else {
            echo "No watch found with the given ID.";
        }

        // Close the first statement
        $stmt->close();

    } else {
        echo 'Error preparing query: ' . $conn->error;
    }

} else {
    echo "Watch ID not set.";
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="images/favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title><?php echo htmlspecialchars($watch['name']); ?> - Golden Time</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f4; /* Light gray for a soft background */
            margin: 0;
            padding: 0;
        }

        .header {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 40px 20px;
            background-color: #1a1a1a; /* Darker shade for the header */
            color: #fff; /* White text for contrast */
            text-align: center;
        }

        .site-logo {
            width: 180px;
            height: auto;
            margin-bottom: 20px;
        }

        .main-container {
            display: flex;
            justify-content: space-between;
            padding: 20px;
            flex-wrap: wrap;
            background-color: #fff; /* Keep the content area white for clarity */
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.2); /* Softer shadow for a luxurious touch */
            border-radius: 8px;
            margin: 20px;
        }

        .watch-images-container {
            flex: 1 1 40%;
            max-width: 400px;
            margin-right: 20px;
        }

        .main-watch-image img {
            width: 100%;
            max-width: 100%;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .general-info-container {
            flex: 1 1 55%;
            padding-left: 20px;
            display: flex;
            flex-direction: column;
        }

        .watch-name {
            font-size: 28px;
            font-weight: bold;
            color: #b5a76d; /* Luxurious gold color */
        }

        .watch-price {
            font-size: 24px;
            color: #d4af37; /* Elegant gold color */
            margin-bottom: 15px;
        }

        .button-container {
            display: flex;
            gap: 15px;
            margin-top: 10px;
        }

        .buy-now-button, .appointment-button {
            padding: 12px 25px;
            border: none;
            border-radius: 5px;
            color: white;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s, transform 0.2s;
        }

        .buy-now-button {
            background-color: #4caf50; /* Rich green */
        }

        .appointment-button {
            background-color: #007bff; /* Royal blue */
        }

        .buy-now-button:hover, .appointment-button:hover {
            transform: scale(1.05);
        }

        .detailed-specs-container {
            margin-top: 30px;
            padding: 20px;
            background-color: #f9f9f9; /* Light gray for the specs area */
            border-radius: 8px;
            box-shadow: 0 2px 15px rgba(0, 0, 0, 0.2);
        }

        .footer-container {
            background-color: #1a1a1a; /* Match footer with header */
            color: white;
            padding: 30px 0;
            text-align: center;
        }

        .footer-section {
            margin: 10px 0;
            flex: 1;
            min-width: 250px;
        }

        .footer-section.social .social-icons {
            display: flex;
            justify-content: center; /* Center the icons */
        }

        .footer-section.social .social-icons a {
            margin: 0 10px;
            color: white; /* Icon color */
            font-size: 24px; /* Icon size */
            transition: color 0.3s;
        }

        .footer-section.social .social-icons a:hover {
            color: #ccc; /* Change color on hover */
        }
    </style>
</head>
<body>

<!-- Header -->
<div class="header">
    <img src="images/logo.png" alt="Golden Time Logo" class="site-logo">
    <h1>Golden Time</h1>
    <h2>Discover luxury watches with elegance and craftsmanship</h2>
</div>

<!-- Main Content Container -->
<div class="main-container">
    <!-- Watch images on the left -->
    <div class="watch-images-container">
        <div class="main-watch-image">
            <?php if (!empty($watch['image_url'])): ?>
                <img src="<?php echo htmlspecialchars($watch['image_url']); ?>" alt="<?php echo htmlspecialchars($watch['name']); ?>" class="watch-image">
            <?php else: ?>
                <p>No main image available.</p>
            <?php endif; ?>
        </div>

        <!-- Display additional images dynamically -->
        <?php if (!empty($additional_images)) { ?>
        <div class="additional-images">
            <h4>More Images</h4>
            
            <?php foreach ($additional_images as $image_url) { ?>
                <img src="<?php echo htmlspecialchars($image_url); ?>" alt="Additional Image" class="additional-image" style="width: 80px; height: auto; border-radius: 8px; margin: 5px;">
            <?php } ?>
        </div>
        <?php } else { ?>
            <p>No additional images available for this watch.</p>
        <?php } ?>
    </div>

    <!-- General specifications and buttons on the right -->
    <div class="general-info-container">
        <h2 class="watch-name"><?php echo htmlspecialchars($watch['name']); ?></h2>
        <p class="watch-price">KSH <?php echo number_format($watch['price_ksh'], 2); ?></p>
        <p class="watch-description"><?php echo htmlspecialchars($watch['details']); ?></p>

        <div class="general-specs">
            <h3>General Specifications</h3>
            <p><strong>Brand:</strong> <?php echo htmlspecialchars($watch['brand']); ?></p>
            <p><strong>Model:</strong> <?php echo htmlspecialchars($watch['model']); ?></p>
            <p><strong>SKU:</strong> <?php echo htmlspecialchars($watch['sku']); ?></p>
            <p><strong>Gender:</strong> <?php echo htmlspecialchars($watch['gender']); ?></p>
        </div>

        <div class="button-container">
            <button class="buy-now-button">Buy Now</button>
            <button class="appointment-button">Schedule an Appointment</button>
        </div>

        <!-- Detailed specifications -->
        <div class="detailed-specs-container">
            <h3>Detailed Specifications</h3>
            <div class="specifications-flex-container">
                <div class="specifications-section">
                    <p><strong>Case Material:</strong> <?php echo htmlspecialchars($watch['case_material']); ?></p>
                    <p><strong>Case Diameter:</strong> <?php echo htmlspecialchars($watch['case_diameter']); ?> mm</p>
                    <p><strong>Water Resistance:</strong> <?php echo htmlspecialchars($watch['water_resistance']); ?> meters</p>
                </div>
                <div class="specifications-section">
                    <p><strong>Movement Type:</strong> <?php echo htmlspecialchars($watch['movement_type']); ?></p>
                    <p><strong>Dial Color:</strong> <?php echo htmlspecialchars($watch['dial_color']); ?></p>
                    <p><strong>Strap Material:</strong> <?php echo htmlspecialchars($watch['strap_material']); ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="footer-container">
    <div class="footer-section social">
        <h3>Connect with Us</h3>
        <div class="social-icons">
            <a href="#"><i class="fab fa-facebook"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-linkedin"></i></a>
        </div>
    </div>
    <div class="footer-section contact">
        <h3>Contact Us</h3>
        <p>Email: support@goldentime.com</p>
        <p>Phone: +254 700 123 456</p>
    </div>
    <div class="footer-section about">
        <h3>About Us</h3>
        <p>At Golden Time, we offer the finest selection of luxury watches.</p>
    </div>
</footer>

</body>
</html>
