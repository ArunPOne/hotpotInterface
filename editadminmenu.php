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

// Fetch menu items from the database
$sql = "SELECT * FROM `menu`";
$result = mysqli_query($conn, $sql);

// Check if $result is valid
if ($result && mysqli_num_rows($result) > 0) {
    // Process form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        foreach ($_POST['price'] as $key => $price) {
            // Escape variables for security
            $price = mysqli_real_escape_string($conn, $price);
            $id = $key + 1; // Assuming the ID starts from 1 and increments by 1
            
            // Update the price in the database
            $sql = "UPDATE menu SET price='$price' WHERE id='$id'";
            if (!mysqli_query($conn, $sql)) {
                echo "Error updating record: " . mysqli_error($conn);
            }
        }
        
        // Redirect back to adminmenu.php after updating
        header("Location: adminmenu.php");
        exit();
    }
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
    <h1 style="margin-left:20px;">Edit Menu</h1>
    <br>
    <form id="adminmenu" name="adminmenu" action="editadminmenu.php" method="POST">
        <table>
            <tr>
                <th style="width:20%;"><b>Food</b></th>
                <th style="width:10%;"><b>Price</b></th>
            </tr>
            <?php
            // Check if $result is valid
                while ($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td><?php echo $row['name']; ?></td>
                        <td><input style="width:100%; height:100%; font-size:20px;" type="text" id="price" name="price[]" value="<?php echo $row['price']; ?>"></td>
                    </tr>
                    <?php
                }
             
            ?>
        </table>
        <br>
        <button id="button" type="submit">Update Menu</button>
    </form>
</body>
</html>

<?php
mysqli_close($conn);
?>
