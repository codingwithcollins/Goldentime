<?php
// Assume necessary includes and database connection here
include 'db_connection.php'; // Ensure the path is correct
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book an Appointment</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link your CSS file -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .appointment-container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin: 10px 0 5px;
        }

        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        .submit-button {
            background-color: #007bff; /* Primary color */
            color: white;
            padding: 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s;
        }

        .submit-button:hover {
            background-color: #0056b3; /* Darker blue on hover */
        }

        .cancel-button {
            display: inline-block;
            text-align: center;
            padding: 10px;
            margin-top: 10px;
            background-color: #dc3545; /* Red color for Cancel */
            color: white;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
            width: 100%;
        }

        .cancel-button:hover {
            background-color: #c82333; /* Darker red on hover */
        }
    </style>
</head>
<body>

<div class="appointment-container">
    <h2>Book an Appointment</h2>
    <form action="process_appointment.php" method="POST">
        <label for="name">Your Name:</label>
        <input type="text" id="name" name="name" required>

        <label for="email">Your Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="date">Preferred Date:</label>
        <input type="date" id="date" name="date" required>

        <label for="time">Preferred Time:</label>
        <input type="time" id="time" name="time" required>

        <label for="watch">Select Watch:</label>
        <select id="watch" name="watch" required>
            <option value="">Select a watch</option>
            <!-- Populate options dynamically from the database -->
            <?php
            // Example query to fetch watches
            $sql = "SELECT id, name FROM watches";
            $result = $conn->query($sql);
            while ($row = $result->fetch_assoc()) {
                echo "<option value='{$row['id']}'>{$row['name']}</option>";
            }
            ?>
        </select>

        <button type="submit" class="submit-button">Confirm Appointment</button>
        <a href="index.php" class="cancel-button">Cancel</a>
    </form>
</div>

</body>
</html>
