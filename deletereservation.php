<?php
include('config.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare a DELETE statement
    $sql_delete_reservation = "DELETE FROM reservations WHERE id = ?";

    if ($stmt = $conn->prepare($sql_delete_reservation)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("i", $param_id);

        // Set parameters
        $param_id = $id;

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            // Records deleted successfully. Redirect to landing page
            header("location: reservation.php");
            exit();
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

    // Close statement
    $stmt->close();

    // Close connection
    $conn->close();
} else {
    // URL doesn't contain ID parameter. Redirect to error page
    header("location: error.php");
    exit();
}
