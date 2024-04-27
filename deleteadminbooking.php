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
    // Check if a booking number was submitted
    if (isset($_POST['delete_bookingNo'])) {
        // Escape the booking number for security
        $bookingNo = mysqli_real_escape_string($conn, $_POST['delete_bookingNo']);
        
        // Delete the booking from the database
        $delete_sql = "DELETE FROM reservations WHERE bookingNo='$bookingNo'";
        if (!mysqli_query($conn, $delete_sql)) {
            echo "Error deleting record: " . mysqli_error($conn);
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
    <h1 style="margin-left:20px;">Delete Booking</h1>
    <br>
    <form id="adminbooking" name="adminbooking" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
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
                <th>Action</th>
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
                        <td><?php echo $row['no_adults']; ?></td>
                        <td><?php echo $row['no_childrens']; ?></td>
                        <td><?php echo $row['table_number']; ?></td>
                        <td>
                        <input type="submit" class="button" style="background-color:red; color:white;border: none;font-size:10px; padding: 6px 20px;" value="Delete">
                            <input type="hidden" name="delete_bookingNo" value="<?php echo $row['bookingNo']; ?>">
                           
                        </td>
                    </tr>
            <?php } ?>
        </table>
        <br>
    </form>
</body>
</html>

<?php
mysqli_close($conn);
?>