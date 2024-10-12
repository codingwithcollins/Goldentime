<?php
// Start session
session_start();

// Connect to the database
$conn = new mysqli("localhost", "root", "", "goldentime");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $product_id = $_POST['product_id'];
    $user_id = $_SESSION['user_id']; // Assuming user is logged in and session holds user_id

    // Insert wishlist item into the database
    $sql = "INSERT INTO wishlist (user_id, product_id) VALUES ('$user_id', '$product_id')";

    if ($conn->query($sql) === TRUE) {
        echo "<p class='success-msg'>Item added to your wishlist!</p>";
    } else {
        echo "<p class='error-msg'>Error: " . $sql . "<br>" . $conn->error . "</p>";
    }
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add to Wishlist</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .wishlist-container {
            background-color: #fff;
            border-radius: 8px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 300px;
        }

        .wishlist-container h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .wishlist-btn {
            background-color: #4CAF50;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .wishlist-btn:hover {
            background-color: #45a049;
        }

        .success-msg {
            color: green;
            margin-top: 20px;
        }

        .error-msg {
            color: red;
            margin-top: 20px;
        }
    </style>
</head>
<body>

<div class="wishlist-container">
    <h2>Add to Wishlist</h2>
    <form method="POST" action="wishlist.php">
        <input type="hidden" name="product_id" value="123"> <!-- Replace with dynamic product ID -->
        <button type="submit" class="wishlist-btn">Add to Wishlist</button>
    </form>
</div>

</body>
</html>
