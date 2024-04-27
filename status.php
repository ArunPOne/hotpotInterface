<?php
include('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['searchdata'])) {
    $search_data = $_POST['searchdata'];

    // Query to fetch details based on booking number or contact number
    $sql_fetch_reservation = "SELECT * FROM reservations WHERE bookingNo = '$search_data' OR phone_number = '$search_data'";

    $result = mysqli_query($conn, $sql_fetch_reservation);

    if (mysqli_num_rows($result) > 0) {
        // Display reservation details
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<h2>Booking Details</h2>";
            echo "<p><strong>Booking Number:</strong> " . $row['bookingNo'] . "</p>";
            echo "<p><strong>Name:</strong> " . $row['name'] . "</p>";
            echo "<p><strong>Email:</strong> " . $row['email'] . "</p>";
            echo "<p><strong>Phone Number:</strong> " . $row['phone_number'] . "</p>";
            echo "<p><strong>Booking Date:</strong> " . $row['booking_date'] . "</p>";
            echo "<p><strong>Booking Time:</strong> " . $row['booking_time'] . "</p>";
            echo "<p><strong>Number of Adults:</strong> " . $row['no_adults'] . "</p>";
            echo "<p><strong>Number of Children:</strong> " . $row['no_childrens'] . "</p>";
            // You can handle table numbers if it's stored in an appropriate format in the database
            // echo "<p><strong>Table Number:</strong> " . $row['table_number'] . "</p>";
        }
    } else {
        echo '<p>No booking found for the provided information.</p>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Check Status</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 30px;
        }

        form {
            text-align: center;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        p {
            text-align: center;
            margin-top: 20px;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>Check Reservation</h1>
        <form action="checkStatus.php" method="POST">
            <input type="text" name="searchdata" placeholder="Enter Booking Number or Contact Number" required="">
            <input type="submit" value="Search">
        </form>
        <p>Want to make a new reservation? <a href="reservation.php">Click here</a></p>
    </div>
</body>

</html>