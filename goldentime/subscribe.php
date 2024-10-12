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
    $email = $_POST['email'];

    // Insert subscription into the database
    $sql = "INSERT INTO subscribers (email) VALUES ('$email')";

    if ($conn->query($sql) === TRUE) {
        echo "<p class='success-msg'>You've been successfully subscribed!</p>";
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
    <title>Subscribe to Newsletter</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f1f1;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .subscribe-container {
            background-color: #fff;
            border-radius: 8px;
            padding: 30px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 350px;
        }

        .subscribe-container h2 {
            margin-bottom: 20px;
            color: #444;
        }

        .email-input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 20px;
            font-size: 16px;
        }

        .subscribe-btn {
            background-color: #008CBA;
            color: white;
            border: none;
            padding: 12px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
            width: 100%;
        }

        .subscribe-btn:hover {
            background-color: #007B9A;
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

<div class="subscribe-container">
    <h2>Subscribe to Our Newsletter</h2>
    <form method="POST" action="subscribe.php">
        <input type="email" name="email" class="email-input" placeholder="Enter your email" required>
        <button type="submit" class="subscribe-btn">Subscribe</button>
    </form>
</div>

</body>
</html>
