<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Implement payment processing (Mpesa, PayPal, Bank Card)
    $payment_method = $_POST['payment_method'];
    // Process the payment based on the method selected
    echo "<div class='success-message'>Payment successfully processed with $payment_method.</div>";
    // Clear the cart
    unset($_SESSION['cart']);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="images/favicon.png">
    <title>Checkout - Golden Time</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
        }
        .header h1 {
            color: #333;
        }
        .checkout-form {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 400px;
            margin: 0 auto;
        }
        .checkout-form label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
            color: #333;
        }
        .checkout-form input[type="radio"] {
            margin-right: 10px;
        }
        .checkout-form input[type="submit"] {
            background-color: #e67e22;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .checkout-form input[type="submit"]:hover {
            background-color: #d95f1e;
        }
        .success-message {
            text-align: center;
            margin-top: 20px;
            font-size: 18px;
            color: green;
        }
    </style>
</head>
<body>

<div class="header">
    <h1>Checkout</h1>
</div>

<div class="checkout-form">
    <form method="post" action="checkout.php">
        <label for="payment_method">Select Payment Method:</label>
        <input type="radio" name="payment_method" value="mpesa" id="mpesa">
        <label for="mpesa">Mpesa</label><br>
        <input type="radio" name="payment_method" value="paypal" id="paypal">
        <label for="paypal">PayPal</label><br>
        <input type="radio" name="payment_method" value="bank_card" id="bank_card">
        <label for="bank_card">Bank Card</label><br>
        <input type="submit" value="Place Order">
    </form>
</div>

</body>
</html>
