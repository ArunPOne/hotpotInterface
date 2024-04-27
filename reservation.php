<?php
include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phonenumber'];
    $booking_date = $_POST['bookingdate'];
    $booking_time = $_POST['bookingtime'];
    $no_adults = $_POST['noadults'];
    $no_childrens = $_POST['nochildrens'];
    $table_number = isset($_POST['tableNumber']) ? $_POST['tableNumber'] : array();
    $bno = mt_rand(100000000, 9999999999);


    // Convert the array to a comma-separated string for storage in the database
    if (is_array($table_number)) {
        $table_number_str = implode(',', $table_number);
    } else {
        $table_number_str = $table_number;
    }

    // Insert data into the reservations table
    $sql_insert_reservation = "INSERT INTO reservations (bookingNo, name, email, phone_number, booking_date, booking_time, no_adults, no_childrens, table_number) 
    VALUES ('$bno', '$name', '$email', '$phone_number', '$booking_date', '$booking_time', '$no_adults', '$no_childrens', '$table_number_str')";

    if (mysqli_query($conn, $sql_insert_reservation)) {
        // Update the message to reflect the correct variable
        echo '<script>alert("Reservation successful. Booking number is "+"' . $bno . '");</script>';
    } else {
        echo '<script>alert("Error: ' . mysqli_error($conn) . '");</script>';
    }
    
}

$sql_cart_count = "SELECT COUNT(*) AS count FROM carts";
$result_cart_count = mysqli_query($conn, $sql_cart_count);
$row_cart_count = mysqli_fetch_assoc($result_cart_count);
$cart_count = $row_cart_count['count'];



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        .booking-form-container {
            max-width: 55%;
            margin: 0 auto;
            padding: 20px;
            border: 5px solid black;
            border-radius: 5px;
            text-align: center;
            margin-bottom: 2%;
        }

        .booking-form {
            display: flex;
            flex-direction: column;
        }

        input[type="text"],
        input[type="email"],
        input[type="number"],
        input[type="date"],
        input[type="time"],
        select {
            margin: auto;
            margin-top: 15px;
            width: 50%;
            margin-bottom: 10px;
            padding: 10px;
            border: 2px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .submit-button {
            margin: auto;
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
        }

        .submit-button:hover {
            background-color: #0056b3;
        }

        p {
            margin-top: 10px;
            text-align: center;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .table {
            display: inline-block;
            width: 100px;
            height: 100px;
            border: 5px solid black;
            text-align: center;
            line-height: 100px;
            cursor: pointer;
            margin: 5%;
            margin-top: 2%;
            margin-bottom: 5%;
            transition: background-color 0.3s;
            /* Smooth transition for background color */
        }

        .table:hover {
            background-color: lightgray;
            /* Change background color on hover */
        }

        .table.booked {
            background-color: gray;
            cursor: not-allowed;
        }

        .table.selected {
            background-color: lightblue;
        }
    </style>
</head>

<body>
    <!-- Navbar Section Starts Here -->
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="#" title="Logo">
                    <img src="sizzlepot.png" alt="Restaurant Logo" class="img-responsive">
                </a>
            </div>

            <div style="margin-left: 510px; margin-top: 20px;">
                <ul>
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a style="cursor: pointer;">Categories</a>
                        <ul>
                            <li><a href="chicken hotpot.php">Chicken Hotpot</a></li>
                            <li><a href="seafood hotpot.php">Seafood Hotpot</a></li>
                            <li><a href="vegetable hotpot.php">Vegetable Hotpot</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="reservation.php">Reservation</a>
                    </li>
                    <li>
                    <a href="status.php">Check Status</a>
                    </li>


                    <ul id="checkoutList">
                        <li>
                            <button style="background-color:white; border-color:white" onclick="window.location.href = 'cart.php';">
                                <i style="margin: 7px; cursor: pointer;" class="fa fa-shopping-cart"> Cart (<?php echo $cart_count; ?>)</i>
                            </button>
                        </li>
                    </ul>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>

    <section class="food-search text-right" style="margin-top: -180px;">
        <div class="container">

            <form action="food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Hotpot.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>


    <div class="booking-form-container">
        <h1>Table Booking Form</h1><br>
        <form action="reservation.php" method="post" class="booking-form" id="booking-form">
            <input type="text" name="name" placeholder="Name" required="">
            <input type="email" name="email" placeholder="Email" required="">
            <input type="number" name="phonenumber" placeholder="Phone Number" min="1" required="">
            <input type="date" name="bookingdate" min="<?php echo date('Y-m-d'); ?>" required="">
            <input type="time" id="timepicker" name="bookingtime" min="00:00" max="23:59" step="1" required="" onkeypress="return false;">

            <select class="form-control" name="noadults" required>
                <option value="" disabled selected>Number of Adults</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
            </select>

            <select class="form-control" name="nochildrens" required>
                <option value="" disabled selected>Number of Children</option>
                <option value="0">0</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
            </select>

            <input type="hidden" name="tableNumber[]" id="selected_tables">

            <h3 style="text-align: left; margin-top:5%">Select a Table:</h3><br><br>
            <div>
                <!-- Add onclick event to each table -->
                <div class="table" id="1"  name="tableNumber[]" onclick="toggleTable('1')">Table 1</div>
                <div class="table" id="2"  name="tableNumber[]" onclick="toggleTable('2')">Table 2</div>
                <div class="table" id="3"  name="tableNumber[]" onclick="toggleTable('3')">Table 3</div>
                <div class="table" id="4"  name="tableNumber[]" onclick="toggleTable('4')">Table 4</div>
                <div class="table" id="5"  name="tableNumber[]" onclick="toggleTable('5')">Table 5</div>
                <div class="table" id="6"  name="tableNumber[]" onclick="toggleTable('6')">Table 6</div>
                <div class="table" id="7"  name="tableNumber[]" onclick="toggleTable('7')">Table 7</div>
                <div class="table" id="8"  name="tableNumber[]" onclick="toggleTable('8')">Table 8</div>
            </div>

            <input type="submit" value="Reserve a Table" name="submit" class="submit-button" onclick="onSubmitClicked()">
        </form>

        <p>Check Booking <a href="status.php" target="_blank">Status</a></p>

        <script>
            // Array to store selected table numbers
            var selectedTables = [];

            // Function to toggle table selection
            function toggleTable(tableId) {
                var tableElement = document.getElementById(tableId);
                if (tableElement.classList.contains('selected')) {
                    // If the table is already selected, remove it from the list
                    tableElement.classList.remove('selected');
                    selectedTables.splice(selectedTables.indexOf(tableId), 1);
                } else {
                    // If the table is not selected, add it to the list
                    tableElement.classList.add('selected');
                    selectedTables.push(tableId);
                }

                // Update the hidden input field with the selected table numbers array
                document.getElementById('selected_tables').value = selectedTables.join(',');
            }
        </script>

</body>

</html>