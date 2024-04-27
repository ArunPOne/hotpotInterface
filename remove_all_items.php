<?php
include 'config.php';

// Delete all items from the 'carts' table
$sql = "DELETE FROM `carts`";
if (mysqli_query($conn, $sql)) {
    // Redirect back to the cart page after successful removal
    header("Location: cart.php");
    exit();
} else {
    echo '<script>alert("Error: ' . mysqli_error($conn) . '");</script>';
}

mysqli_close($conn);
?>
