<?php
// Include the database connection
include 'db_connection.php'; // Ensure the path is correct

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate input
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $date = htmlspecialchars(trim($_POST['date']));
    $time = htmlspecialchars(trim($_POST['time']));
    $watch_id = intval($_POST['watch']);

    // Check if all fields are filled
    if (empty($name) || empty($email) || empty($date) || empty($time) || empty($watch_id)) {
        die("All fields are required. Please go back and fill in the details.");
    }

    // Prepare an SQL statement to insert the appointment
    $sql = "INSERT INTO appointments (name, email, appointment_date, appointment_time, watch_id) VALUES (?, ?, ?, ?, ?
)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssi", $name, $email, $date, $time, $watch_id);

    // Execute the statement and check for success
    if ($stmt->execute()) {
        echo "<h3>Appointment booked successfully!</h3>";
        echo "<p>Thank you, {$name}. Your appointment for the watch has been scheduled.</p>";
        echo "<p><a href='index.php'>Go back to the homepage</a></p>";
    } else {
        echo "<h3>There was an error booking your appointment.</h3>";
        echo "<p>Please try again later.</p>";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    // Redirect if the form was not submitted correctly
    header("Location: book_appointment.php");
    exit;
}
?>
