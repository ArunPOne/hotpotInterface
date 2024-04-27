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

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['quantity'])) {
    foreach ($_POST['quantity'] as $id => $quantity) {
        // Escape variables for security
        $id = (int)$id; // Convert to integer to ensure it's safe for SQL
        $quantity = mysqli_real_escape_string($conn, $quantity);
        
        // Update the quantity in the database
        $sql = "UPDATE carts SET quantity='$quantity' WHERE id=$id";
        if (!mysqli_query($conn, $sql)) {
            echo "Error updating record: " . mysqli_error($conn);
        }
    }
    
    // Redirect back to orderview.php after updating
    header("Location: orderview.php");
    exit();
}

// Fetch unique table numbers from the database
$tableNumbersQuery = "SELECT DISTINCT tableNumber FROM carts";
$tableNumbersResult = mysqli_query($conn, $tableNumbersQuery);

// Check if $tableNumbersResult is valid
if (!$tableNumbersResult) {
    die("Error fetching table numbers: " . mysqli_error($conn));
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
            width: 90%;
            margin: 1% auto;
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
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <br>
<h1 style="margin-left:20px;">Edit Order</h1>

<form id="adminorder" name="adminorder" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
<?php
    // Display a separate table for each table number
    while ($tableRow = mysqli_fetch_assoc($tableNumbersResult)) {
        $tableNumber = $tableRow['tableNumber'];

        // Fetch menu items for this table number
        $sql = "SELECT * FROM carts WHERE tableNumber = '$tableNumber'";
        $result = mysqli_query($conn, $sql);

        // Check if $result is valid
        if (!$result) {
            die("Error fetching menu items for table $tableNumber: " . mysqli_error($conn));
        }
    ?>
    <br>
    <table>
    <caption style="font-size:18px;"><b>Table No: <?php echo $tableNumber; ?></b></caption>

        <tr>
            <th style="width:3%" >No</th>
            <th style="width:10%">Hotpot Type</th>
            <th style="width:8%">Spicy Level</th>
            <th style="width:6%">Soup Type</th>
            <th style="width:17%">Vegetables</th>
            <th style="width:20%">Add Ons</th>
            <th style="width:10%">Quantity</th>
            <th style="width:5%">Price</th>
        </tr>
        <?php
        // Initialize counter variable
        $counter = 1;
        // Check if $result is valid
        while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <tr>
            <td><?php echo $counter; ?></td>
            <td><?php echo $row["name"] ?></td>
            <td><?php echo $row["spicyLevel"] ?></td>
            <td><?php echo $row["selectedSoup"] ?></td>
            <td><?php echo $row["selectedVegetables"] ?></td>
            <td><?php echo $row["selectedAddons"] ?></td>
            <td><input style="width:100%; height:100%; font-size:20px;" type="text" name="quantity[<?php echo $row['id']; ?>]" value="<?php echo $row['quantity']; ?>"></td>
            <td><?php echo $row["price"] ?></td>
        </tr>
        <?php
            // Increment counter
            $counter++;
        }
        ?>
    </table>
<?php
    }
    mysqli_close($conn);
?>
<br>
<button id="button" type="submit">Update Order</button>
</form>
</body>
</html>
