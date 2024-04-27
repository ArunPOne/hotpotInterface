<?php
include('config.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['searchdata'])) {
    $search_data = $_POST['searchdata'];
}

?>
<html>

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        form {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        form div {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"] {
            width: 100%;
            padding: 10px;
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

        /* Flexbox */
        .form-flex {
            margin-right: 5%;
            margin-left: 5%;
            display: flex;
            justify-content: space-between;
        }

        /* Responsive CSS */
        @media (max-width: 768px) {
            form {
                width: 90%;
            }
        }

        .cancel-link {
            display: inline-block;
            background-color: #dc3545;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            text-decoration: none;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .cancel-link:hover {
            background-color: #c82333;
        }
    </style>
</head>

<body>

    <form method="POST">
        <?php
        include 'config.php';
        $sql_fetch_reservation = "SELECT * FROM reservations WHERE bookingNo = '$search_data' OR phone_number = '$search_data'";
        $result = mysqli_query($conn, $sql_fetch_reservation);

        if (mysqli_num_rows($result) > 0) {
            $counter = 1; // Initialize counter
            while ($row = mysqli_fetch_assoc($result)) {
        ?>
                <div>
                    <label for="bookingNo<?php echo $counter; ?>">Booking Number:</label>
                    <input type="text" id="bookingNo<?php echo $counter; ?>" name="bookingNo" value="<?php echo $row["bookingNo"]; ?>" readonly>
                </div>
                <div>
                    <label for="name<?php echo $counter; ?>">Name:</label>
                    <input type="text" id="name<?php echo $counter; ?>" name="name" value="<?php echo $row["name"]; ?>" readonly>
                </div>
                <div class="form-flex">
                    <div>
                        <label for="email<?php echo $counter; ?>">Email:</label>
                        <input type="email" id="email<?php echo $counter; ?>" name="email" value="<?php echo $row["email"]; ?>" readonly>
                    </div>
                    <div>
                        <label for="phone_number<?php echo $counter; ?>">Phone Number:</label>
                        <input type="text" id="phone_number<?php echo $counter; ?>" name="phone_number" value="<?php echo $row["phone_number"]; ?>" readonly>
                    </div>
                </div>
                <div class="form-flex">
                    <div>
                        <label for="booking_date<?php echo $counter; ?>">Booking Date:</label>
                        <input type="text" id="booking_date<?php echo $counter; ?>" name="booking_date" value="<?php echo $row["booking_date"]; ?>" readonly>
                    </div>
                    <div>
                        <label for="booking_time<?php echo $counter; ?>">Booking Time:</label>
                        <input type="text" id="booking_time<?php echo $counter; ?>" name="booking_time" value="<?php echo $row["booking_time"]; ?>" readonly>
                    </div>
                </div>
                <div class="form-flex">
                    <div>
                        <label for="no_adults<?php echo $counter; ?>">Number of Adults:</label>
                        <input type="text" id="no_adults<?php echo $counter; ?>" name="no_adults" value="<?php echo $row["no_adults"]; ?>" readonly>
                    </div>
                    <div>
                        <label for="no_childrens<?php echo $counter; ?>">Number of Children:</label>
                        <input type="text" id="no_childrens<?php echo $counter; ?>" name="no_childrens" value="<?php echo $row["no_childrens"]; ?>" readonly>
                    </div>
                </div>
                <div>
                    <label for="table_number<?php echo $counter; ?>">Table Number:</label>
                    <input type="text" id="table_number<?php echo $counter; ?>" name="table_number" value="<?php echo $row["table_number"]; ?>" readonly>
                </div>
                <div>
                    <a href="deletereservation.php?id=<?php echo $row['id']; ?>" class="cancel-link">Cancel Reservation</a>
                    <a style="margin-left: 50%; font-size:20px" href="#" class="action-link" onclick="printReservation()"><i class="fas fa-print"></i> </a>
                </div>
            
        <?php
                $counter++; // Increment counter
            }
        } else {
            echo "<h2>Reservation Booking ID Incorrect !!!</h2>";
        }

        mysqli_close($conn);
        ?>
    </form>


    <script>
        function printReservation() {
            // Print the reservation details page
            window.print();
        }
    </script>

</body>

</html>