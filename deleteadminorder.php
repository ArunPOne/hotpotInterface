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

// Execute SQL query to fetch unique table numbers in ascending order
$sql = "SELECT DISTINCT tableNumber FROM `carts` ORDER BY tableNumber ASC";
$tableNumbersResult = mysqli_query($conn, $sql);

// Check if the query was successful
if (!$tableNumbersResult) {
    die("Error fetching table numbers: " . mysqli_error($conn));
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if an ID was submitted for deletion
    if (isset($_POST['delete_id'])) {
        // Escape the ID for security
        $id = mysqli_real_escape_string($conn, $_POST['delete_id']);
        
        // Delete the record from the database
        $delete_sql = "DELETE FROM carts WHERE id='$id'";
        if (!mysqli_query($conn, $delete_sql)) {
            echo "Error deleting record: " . mysqli_error($conn);
        }
    }
    
    // Redirect back to orderview.php
    header("Location: orderview.php");
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
            margin-bottom: 20px; /* Add margin between tables */
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
        button {
            background-color: blue;
            color: white;
            border: none;
            padding: 8px 32px;
            font-size: 20px;
            margin-left: 45%;
        }
    </style>
</head>
<body>
    <br>
    <h1 style="margin-left:15px;">Order Details</h1>
    <?php
    // Iterate over each unique table number
    while ($tableRow = mysqli_fetch_assoc($tableNumbersResult)) {
        $tableNumber = $tableRow['tableNumber'];

        // Execute SQL query to fetch orders for this table number
        $sql = "SELECT * FROM `carts` WHERE tableNumber='$tableNumber' ORDER BY id ASC";
        $result = mysqli_query($conn, $sql);

        // Check if the query was successful
        if (!$result) {
            die("Error fetching orders for table $tableNumber: " . mysqli_error($conn));
        }
    ?>
    <br>
    <br>
    <form id="adminorders_<?php echo $tableNumber; ?>" name="adminorders_<?php echo $tableNumber; ?>" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
        <table>
        <caption style="font-size:18px;"><b>Table No: <?php echo $tableNumber; ?></b></caption>

            <tr>
                <th style="width:1%;">No</th>
                <th style="width:5%;">Hotpot Type</th>
                <th style="width:5%;">Spicy Level</th>
                <th style="width:7%;">Soup Type</th>
                <th style="width:23%;">Vegetables</th>
                <th>Add Ons</th>
                <th style="width:5%;">Quantity</th>
                <th style="width:5%;">Price</th>
                <th style="width:5%;">Action</th>
            </tr>
            <?php
            $counter = 1;
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <tr>
                    <td><?php echo $counter; ?></td>
                    <td><?php echo $row["name"] ?></td>
                    <td><?php echo $row["spicyLevel"] ?></td>
                    <td><?php echo $row["selectedSoup"] ?></td>
                    <td><?php echo $row["selectedVegetables"] ?></td>
                    <td><?php echo $row["selectedAddons"] ?></td>
                    <td><?php echo $row["quantity"] ?></td>
                    <td><?php echo $row["price"] ?></td>
                    <td>
                        <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                        <input type="submit" class="button" style="background-color:red; color:white;border: none;font-size:10px; padding: 6px 20px;" value="Delete">
                    </td>
                </tr>
            <?php
                $counter++;
            }
            ?>
        </table>
        <br>
    </form>
    <?php
    }
    ?>
</body>
</html>

<?php
mysqli_close($conn);
?>
