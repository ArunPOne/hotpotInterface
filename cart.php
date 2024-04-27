<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart UI</title>
    <link rel="stylesheet" type="text/css" href="./style.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,900" rel="stylesheet">

    <style>
        body {
            margin: 0;
            padding: 0;
            background: linear-gradient(to bottom right, #E3F0FF, #FAFCFF);
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .CartContainer {
            width: 90%;
            height: 90%;
            background-color: #ffffff;
            border-radius: 20px;
            box-shadow: 0px 10px 20px #1687d933;
        }

        .Header {
            margin: auto;
            width: 90%;
            height: 15%;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .Heading {
            font-size: 20px;
            font-family: 'Open Sans', sans-serif;
            font-weight: 700;
            color: #2F3841;
        }

        .Action {
            font-size: 14px;
            font-family: 'Open Sans', sans-serif;
            font-weight: 600;
            color: #E44C4C;
            cursor: pointer;
            border-bottom: 1px solid #E44C4C;
        }

        table {
            border-collapse: collapse;
            width: 80%;
            margin: 0 auto;
            border: 1px solid #ddd;
        }

        th,
        td {
            border: 2px solid black;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: lightgrey;
        }

        .back-button {
            margin-top: 20px;
            margin-left: 5%;
            text-align: left;
        }

        .quantity-buttons {
            display: flex;
            align-items: center;
        }

        .quantity-button {
            background-color: #f0f0f0;
            border: none;
            color: black;
            padding: 5px 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 4px;
        }

        .pay-link {
            font-size: 20px;
            background-color: #4CAF50;
            color: white;
            padding: 5px 15px;
            border-radius: 5px;
            text-decoration: none;
            margin-top: 2%;
            margin-bottom: 2%;
            display: inline-block;
        }

        .pay-link:hover {
            color: red;
        }

        .pay-link-left {
            margin-left: 70%;
        }
    </style>
</head>

<body>

    <div class="CartContainer">
        <div class="back-button">
            <a href="index.php">Back</a>
        </div>
        <div class="Header">
            <h3 class="Heading">Shopping Cart</h3>
            <h5 class="Action">
                <a href="remove_all_items.php">Remove All</a>
            </h5>
        </div>
        <form method="POST">
            <div class="tr td">
                <table>
                    <tr>
                        <th>No</th>
                        <th>Hotpot Type</th>
                        <th>Spicy Level</th>
                        <th>Soup Type</th>
                        <th>Vegetables</th>
                        <th>Add Ons</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Remove</th>
                    </tr>
                    <?php
                    include 'config.php';
                    $sql = "SELECT * FROM `carts`";
                    $result = mysqli_query($conn, $sql);
                    $totalPrice = 0; // Initialize total price variable

                    if (mysqli_num_rows($result) > 0) {
                        $counter = 1; // Initialize counter
                        while ($row = mysqli_fetch_assoc($result)) {
                            // Calculate item price
                            $itemPrice = $row["price"] * $row["quantity"];
                            $totalPrice += $itemPrice; // Add item price to total price
                    ?>
                            <tr>
                                <td><?php echo $counter; ?></td>
                                <td><?php echo $row["name"] ?></td>
                                <td><?php echo $row["spicyLevel"] ?></td>
                                <td><?php echo $row["selectedSoup"] ?></td>
                                <td><?php echo $row["selectedVegetables"] ?></td>
                                <td><?php echo $row["selectedAddons"] ?></td>
                                <td class="quantity-buttons">
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                    <button type="button" onclick="decreaseQuantity(<?php echo $row['id']; ?>)" class="quantity-button">-</button>
                                    <span id="quantity_<?php echo $row['id']; ?>"><?php echo $row["quantity"] ?></span>
                                    <button type="button" onclick="increaseQuantity(<?php echo $row['id']; ?>)" class="quantity-button">+</button>
                                </td>
                                <td><?php echo $itemPrice; ?></td> <!-- Display item price -->
                                <td><a href="deleteitems.php?id=<?php echo $row['id']; ?>">Remove</a></td>
                            </tr>
                    <?php
                            $counter++; // Increment counter
                        }
                    } else {
                        echo "<tr><td colspan='8';>Items haven't Select</tr>";
                    }

                    mysqli_close($conn);
                    ?>
                    <tr>
                        <td colspan="7" style="text-align: right; font-weight: bold;">Total Price:</td>
                        <td colspan="2" id="totalPrice"><?php echo $totalPrice; ?></td>
                    </tr>
                </table>

                <a href="https://www.maybank2u.com.my/home/m2u/common/login.do" class="pay-link pay-link-left">Pay Now</a>
                <a href="index.php" class="pay-link pay-link-right">Pay At Counter</a>
            </div>
        </form>
    </div>

    <script>
        function increaseQuantity(id) {
            var quantityElement = document.getElementById('quantity_' + id);
            var currentQuantity = parseInt(quantityElement.innerText);
            quantityElement.innerText = currentQuantity + 1;
            updatePrice();
        }

        function decreaseQuantity(id) {
            var quantityElement = document.getElementById('quantity_' + id);
            var currentQuantity = parseInt(quantityElement.innerText);
            if (currentQuantity > 1) {
                quantityElement.innerText = currentQuantity - 1;
                updatePrice();
            }
        }

        function updatePrice() {
            var totalPrice = 0;
            var quantities = document.querySelectorAll('.quantity-buttons span');
            var prices = document.querySelectorAll('td:nth-child(8)');
            for (var i = 0; i < quantities.length; i++) {
                totalPrice += parseInt(quantities[i].innerText) * parseFloat(prices[i].innerText);
            }
            document.getElementById('totalPrice').innerText = totalPrice.toFixed(2);
        }
    </script>
</body>

</html>