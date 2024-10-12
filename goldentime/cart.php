<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="images/favicon.png">
    <title>Shopping Cart - Golden Time</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link to external CSS -->
    <style>
        /* Inline CSS for quick styling (can be moved to styles.css) */
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f8f8;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 40px;
            font-size: 28px;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        table th, table td {
            padding: 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table th {
            background-color: #f4f4f4;
        }

        table img {
            width: 80px;
            height: auto;
        }

        .total {
            text-align: right;
            font-size: 18px;
            margin-bottom: 20px;
        }

        .btn {
            background-color: #ff9933;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 5px;
            cursor: pointer;
            border: none;
            border-radius: 5px;
        }

        .btn:hover {
            background-color: #ff6600;
        }

        .checkout {
            float: right;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Shopping Cart</h1>

        <table>
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- PHP Loop to list items in the cart -->
                <?php
                // Sample data for watches (replace with actual data from your database)
                $cartItems = [
                    ['image' => 'images/patek_grandmaster_chime.jpeg', 'name' => 'Patek Philippe Grandmaster Chime', 'price' => 320000000, 'quantity' => 1],
                    ['image' => 'images/rolex_daytona_newman.jpeg', 'name' => 'Rolex Daytona Paul Newman', 'price' => 150000000, 'quantity' => 1]
                ];
                $total = 0;

                foreach ($cartItems as $item) {
                    $itemTotal = $item['price'] * $item['quantity'];
                    $total += $itemTotal;
                    echo "
                    <tr>
                        <td><img src='{$item['image']}' alt='{$item['name']}'> {$item['name']}</td>
                        <td>KSH " . number_format($item['price'], 2) . "</td>
                        <td>
                            <form action='update_cart.php' method='POST'>
                                <input type='number' name='quantity' value='{$item['quantity']}' min='1'>
                                <input type='hidden' name='name' value='{$item['name']}'>
                                <button type='submit' class='btn'>Update</button>
                            </form>
                        </td>
                        <td>KSH " . number_format($itemTotal, 2) . "</td>
                        <td><a href='remove_from_cart.php?name={$item['name']}' class='btn'>Remove</a></td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>

        <div class="total">
            <strong>Total: KSH <?php echo number_format($total, 2); ?></strong>
        </div>

        <div class="checkout">
            <a href="checkout.php" class="btn">Proceed to Checkout</a>
        </div>
    </div>
</body>
</html>
