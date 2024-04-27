<?php
include 'config.php';

// Check if ID is set in the URL
if(isset($_GET['id']) && !empty($_GET['id'])) {
    // Get the ID from the URL
    $id = $_GET['id'];

    // SQL to delete a record
    $sql = "DELETE FROM carts WHERE id=$id";

    if (mysqli_query($conn, $sql)) {
        header("Location:cart.php");
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
} else {
    // If ID is not set in the URL, show an error message
    echo "Invalid request";
}

mysqli_close($conn);
?>
