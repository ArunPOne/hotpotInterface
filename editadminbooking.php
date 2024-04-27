<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sizzlepot";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Execute SQL query to fetch reservations
$sql = "SELECT * FROM `reservations`";
$result = mysqli_query($conn, $sql);

// Check if the query was successful
if (!$result) {
    die("Error fetching reservations: " . mysqli_error($conn));
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Loop through each submitted booking
    foreach ($_POST['no_adults'] as $key => $no_adults) {
        // Escape variables for security
        $no_adults = mysqli_real_escape_string($conn, $no_adults);
        $no_childrens = mysqli_real_escape_string($conn, $_POST['no_childrens'][$key]);
        $table_number = mysqli_real_escape_string($conn, $_POST['table_number'][$key]);
        
        // Get the booking number
        $bookingNo = mysqli_real_escape_string($conn, $_POST['bookingNo'][$key]);
        
        // Update the booking in the database
        $update_sql = "UPDATE reservations SET no_adults='$no_adults', no_childrens='$no_childrens', table_number='$table_number' WHERE bookingNo='$bookingNo'";
        if (!mysqli_query($conn, $update_sql)) {
            echo "Error updating record: " . mysqli_error($conn);
        }
    }
    
    // Redirect back to adminbooking.php
    header("Location: adminbooking.php");
    exit();
}
?>

<html>
<head>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }
      
        table {
            border-collapse: collapse;
            width: 95%;
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
        button{
            background-color:blue;
            color:white;
            border: none;
            padding: 8px 32px;
            font-size:20px;
            margin-left:45%;

        }
    </style>
</head>
<body>
    <br>
    <h1 style="margin-left:20px;">Edit Booking</h1>
    <br>
    <form id="adminbooking" name="adminbooking" action="editadminbooking.php" method="POST">
        <table>
            <tr>
                <th>Booking No.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th style="width:10%;">Adult</th>
                    <th style="width:10%;">Children</th>
                    <th style="width:10%;">Table No.</th>
            </tr>
            <?php 
                while ($row = mysqli_fetch_assoc($result)) { ?>
                 
                        <tr>
                         <td><?php echo $row['bookingNo']; ?></td>
                         <td><?php echo $row['name']; ?></td>
                         <td><?php echo $row['email']; ?></td>
                         <td><?php echo $row['phone_number']; ?></td>
                         <td><?php echo $row['booking_date']; ?></td>
                         <td><?php echo $row['booking_time']; ?></td>
                         <td><input style="width:100%; height:100%; font-size:20px;" type="text" id="no_adults" name="no_adults[]" value="<?php echo $row['no_adults']; ?>"></td>
                          <td><input style="width:100%; height:100%; font-size:20px;" type="text" id="no_childrens" name="no_childrens[]" value="<?php echo $row['no_childrens']; ?>"></td>
                          <td><input style="width:100%; height:100%; font-size:20px;" type="text" id="table_number" name="table_number[]" value="<?php echo $row['table_number']; ?>"></td>
                          <input type="hidden" name="bookingNo[]" value="<?php echo $row['bookingNo']; ?>">
                        </tr>


                    <?php
                }
             
            ?>
        </table>
        <br>
        <button id="button" type="submit">Update Booking</button>
    </form>
</body>
</html>

<?php
mysqli_close($conn);
?>
