<?php
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

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $review = $_POST['review'];
    $review_image = "";

    // Handle image upload if provided
    if (isset($_FILES['review_image']) && $_FILES['review_image']['error'] === UPLOAD_ERR_OK) {
        $imageName = $_FILES['review_image']['name'];
        $imageTmpName = $_FILES['review_image']['tmp_name'];
        $imageFolder = 'uploads/reviews/' . basename($imageName);
        
        // Move the uploaded file to a directory
        if (move_uploaded_file($imageTmpName, $imageFolder)) {
            $review_image = $imageFolder; // Save the image path
        }
    }

    // Insert review and image URL into the database
    $sql = "INSERT INTO reviews (name, review, image_url) VALUES ('$name', '$review', '$review_image')";
    if ($conn->query($sql) === TRUE) {
        echo "Review submitted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
