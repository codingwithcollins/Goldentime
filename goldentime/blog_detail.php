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

// Get the blog post ID from the URL parameter
$post_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Debugging output: Show the post ID
echo "Debug: Post ID received: " . htmlspecialchars($post_id) . "<br>";

// Check if post_id is valid
if ($post_id === 0) {
    die("Invalid post ID. Please check the URL.");
}

// Fetch the blog post details from the database
$sql = "SELECT title, author, created_at, content FROM blog_posts WHERE id = ?";
$stmt = $conn->prepare($sql);

// Check if the preparation was successful
if ($stmt === false) {
    die("Error preparing statement: " . $conn->error);
}

$stmt->bind_param("i", $post_id);
$stmt->execute();
$result = $stmt->get_result();
$post = $result->fetch_assoc();

// Check if the post was found
if ($post === null) {
    die("No post found with the given ID.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($post['title']); ?> - Golden Time Blog</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
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

    <!-- Blog Post Section -->
    <div class="container mx-auto my-8 p-6 bg-white rounded-lg shadow-lg">
        <h2 class="text-3xl font-bold mb-4"><?php echo htmlspecialchars($post['title']); ?></h2>
        <p class="text-gray-600 mb-2">By <?php echo htmlspecialchars($post['author']); ?> on <?php echo date("F j, Y", strtotime($post['created_at'])); ?></p>
        <div class="text-gray-800 mb-6">
            <?php echo nl2br(htmlspecialchars($post['content'])); ?>
        </div>

        <!-- Comments Section -->
        <div class="border-t border-gray-300 pt-4">
            <h3 class="text-xl font-semibold mb-4">Comments</h3>
            <form action="submit_comment.php" method="POST" class="mb-6">
                <input type="hidden" name="post_id" value="<?php echo $post_id; ?>">
                <textarea name="comment" rows="4" class="w-full p-4 border rounded-lg" placeholder="Leave a comment..." required></textarea>
                <button type="submit" class="mt-2 bg-gold-500 text-white px-4 py-2 rounded">Submit Comment</button>
            </form>

            <!-- Display Comments -->
            <div id="comments-list">
                <?php
                $comment_sql = "SELECT username, comment, created_at FROM comments WHERE post_id = ? ORDER BY created_at DESC";
                $comment_stmt = $conn->prepare($comment_sql);
                $comment_stmt->bind_param("i", $post_id);
                $comment_stmt->execute();
                $comment_result = $comment_stmt->get_result();

                while ($comment = $comment_result->fetch_assoc()) {
                    echo '<div class="mb-4 border-b pb-2">';
                    echo '<p class="font-semibold">' . htmlspecialchars($comment['username']) . ' <span class="text-gray-500 text-sm">' . date("F j, Y", strtotime($comment['created_at'])) . '</span></p>';
                    echo '<p>' . nl2br(htmlspecialchars($comment['comment'])) . '</p>';
                    echo '</div>';
                }
                ?>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-8">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 Golden Time. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>

<?php
$stmt->close();
$conn->close();
?>
