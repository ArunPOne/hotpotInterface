<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $formName = $_POST['formName'];
    $tableNumber = $_POST['tableNumber'];
    $spicyLevel = $_POST['spicy'];
    $selectedSoup = $_POST['soup'];
    $selectedVegetables = isset($_POST['vegetable']) ? $_POST['vegetable'] : array(); // Check if vegetable checkbox was selected
    $selectedAddons = isset($_POST['addon']) ? $_POST['addon'] : array(); // Check if addon checkbox was selected

    if (is_array($selectedVegetables)) {
        $selectedVegetables_str = implode(', ', $selectedVegetables);
    } else {
        $selectedVegetables_str = $selectedVegetables;
    }

    if (is_array($selectedAddons)) {
        $selectedAddons_str = implode(', ', $selectedAddons);
    } else {
        $selectedAddons_str = $selectedAddons;
    }


    // Calculate total price
    $totalPrice = calculateTotalPrice($selectedAddons); // Pass selected addons to calculateTotalPrice function

    // Prepare SQL statement
    $sql = "INSERT INTO carts (`name`, tableNumber, spicyLevel, selectedSoup, selectedVegetables, selectedAddons, price)
            VALUES ('$formName', '$tableNumber', '$spicyLevel', '$selectedSoup','$selectedVegetables_str', '$selectedAddons_str', '$totalPrice')";

    if (mysqli_query($conn, $sql)) {
        // Redirect to a success page
        header("Location: vegetable hotpot.php");
        exit(); // Terminate the current script
    } else {
        echo '<script>alert("Error: ' . mysqli_error($conn) . '");</script>';
    }
}

$sql_cart_count = "SELECT COUNT(*) AS count FROM carts";
$result_cart_count = mysqli_query($conn, $sql_cart_count);
$row_cart_count = mysqli_fetch_assoc($result_cart_count);
$cart_count = $row_cart_count['count'];

// Function to calculate total price
function calculateTotalPrice($selectedAddons)
{
    // Sample pricing logic - you should adjust this based on your actual pricing
    $addonPrices = array(
        "Tiger Prawn" => 9,
        "Baby Octopus" => 9,
        "Fish Balls" => 8,
        "Sliced Barramundi" => 7,
        "Green Mussel" => 8,
        "Vermiceli" => 9,
        "Baby Cuttlefish" => 6,
        "Golden Mushroom" => 8,
        "Egg" => 5
    );

    $totalPrice = 35; // Base price without addons
    foreach ($selectedAddons as $addon) {
        if (array_key_exists($addon, $addonPrices)) {
            $totalPrice += $addonPrices[$addon];
        }
    }
    return $totalPrice;
}

// Close database connection
mysqli_close($conn);
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>
    <!-- Navbar Section Starts Here -->
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="#" title="Logo">
                    <img src="sizzlepot.png" alt="Restaurant Logo" class="img-responsive">
                </a>
            </div>

            <div style="margin-left: 510px; margin-top: 20px;">
                <ul>
                    <li>
                        <a href="index.php">Home</a>
                    </li>
                    <li>
                        <a style="cursor: pointer;">Categories</a>
                        <ul>
                            <li><a href="chicken hotpot.php">Chicken Hotpot</a></li>
                            <li><a href="seafood hotpot.php">Seafood Hotpot</a></li>
                            <li><a href="vegetable hotpot.php">Vegetable Hotpot</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="reservation.php">Reservation</a>
                    </li>
                    <li>
                    <a href="status.php">Check Status</a>
                    </li>


                    <ul id="checkoutList">
                        <li>
                            <button style="background-color:white; border-color:white" onclick="window.location.href = 'cart.php';">
                                <i style="margin: 7px; cursor: pointer;" class="fa fa-shopping-cart"> Cart (<?php echo $cart_count; ?>)</i>
                            </button>
                        </li>
                    </ul>
                </ul>
            </div>

            <div class="clearfix"></div>
        </div>
    </section>

    <section class="food-search text-right" style="margin-top: -180px;">
        <div class="container">

            <form action="food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Hotpot.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>

    <section class="categories">
        <div class="container">
            <h2 class="text-center" style="margin-right: 70px;">Choose Your Feast</h2>
            <h3 class="text-center">Vegetable Hotpot (4 Persons)</h3>

            <div class="box-3 float-container">
                <img src="vegetable category.png" alt="vegetable Based" style="width: 200%; border-style: solid; border-color: black; border-radius: 2%; border-width: 5px;">
            </div>
        </div>
    </section>

    <table style="width: 50%;">
        <tr>
            <td style="width: 40%; ">
                <form id="vegetableHotpotForm" style="background-color:white; width: 80%; margin-left: 350px; border-radius: 20px;" action="vegetable hotpot.php" method="POST">
                    <input type="hidden" name="formName" value="Vegetable Hotpot">

                    <div class="container" style="text-align: center;">
                        <p style="font-size: 20px;font-weight:bold; display: inline-block; vertical-align: middle;">
                            Table Number: </p>
                        <input style="width: 23%; height: 30px; font-size: 15px; padding: 0px 10px; display: inline-block; " type="number" id="tableNumber" name="tableNumber" placeholder="Table Number" min="1" required>
                    </div>

                    <div class="container" style="text-align: center;">
                        <p style="font-size: 20px;font-weight:bold; display: inline-block; vertical-align: middle;">
                            Spicy Level: </p>
                        <div class="spicy-level">
                            <input type="radio" id="spicy1" name="spicy" value="Very Spicy" required>
                            <label for="spicy1">&#127798;</label>

                            <input type="radio" id="spicy2" name="spicy" value="Medium Spicy" required>
                            <label for="spicy2">&#127798;</label>

                            <input type="radio" id="spicy3" name="spicy" value="Spicy" required>
                            <label for="spicy3">&#127798;</label>

                            <input type="radio" id="spicy4" name="spicy" value="Low Spicy" required>
                            <label for="spicy4">&#127798;</label>

                        </div>
                    </div>

                    <div class="container" style="text-align: center;">
                        <p style="font-size: 20px;font-weight:bold; display: inline-block; vertical-align: middle;">
                            Select a soup: </p>
                    </div>

                    <div class="container" style="margin-left: 40%;">
                        <input type="radio" id="soup1" name="soup" value="Tomyam" required>
                        <label for="soup1">Tomyam Soup</label><br>

                        <input type="radio" id="soup2" name="soup" value="Laksa" required>
                        <label for="soup2">Laksa Soup</label><br>

                        <input type="radio" id="soup3" name="soup" value="Herbal" required>
                        <label for="soup3">Herbal Soup</label>
                    </div>

                    <div class="container" style="text-align: center;">
                        <p style="font-size: 20px;font-weight:bold; display: inline-block; vertical-align: middle;">
                            Select Vegetables (3 only): </p>
                    </div>

                    <div class="container" style="margin-left: 40%;">
                        <input type="checkbox" name="vegetable[]" value="Spinach">
                        <label for="vegetable1">Spinach</label><br>

                        <input type="checkbox" name="vegetable[]" value="Lettuce">
                        <label for="vegetable2">Lettuce</label><br>

                        <input type="checkbox" name="vegetable[]" value="Lotus Root">
                        <label for="vegetable3"> Lotus Root</label><br>

                        <input type="checkbox" name="vegetable[]" value="Sweetcorns">
                        <label for="vegetable4">Sweet Corns</label><br>

                        <input type="checkbox" name="vegetable[]" value="Potato Slices">
                        <label for="vegetable5">Potato Slices</label><br>

                        <input type="checkbox" name="vegetable[]" value="Yaumak">
                        <label for="vegetable6"> Yau Mak</label><br>
                    </div>

                    <div class="container" style="text-align: center;">
                        <p style="font-size: 20px;font-weight:bold; display: inline-block; vertical-align: middle;">
                            Add On: </p>
                    </div>

                    <div class="container" style="margin-left: 10%;">
                        <input type="checkbox" name="addon[]" value="Tiger Prawn">
                        <label for="addon1">Tiger Prawn (RM9)</label><br><br>

                        <input type="checkbox" name="addon[]" value="Baby Octopus">
                        <label for="addon2">Baby Octopus (RM9)</label><br><br>

                        <input type="checkbox" name="addon[]" value="Fish Balls">
                        <label for="addon3"> Fish Balls (RM8)</label><br><br>

                        <input type="checkbox" name="addon[]" value="Sliced Barramundi">
                        <label for="addon4">Sliced Barramundi (RM7)</label><br><br>

                    </div>

                    <div class="container" style="margin-left: 60%; margin-top: -160px;">

                        <input type="checkbox" name="addon[]" value="Green Mussel">
                        <label for="addon6"> Green Mussel (RM9)</label><br><br>

                        <input type="checkbox" name="addon[]" value="Baby Cuttlefish">
                        <label for="addon7">Baby Cuttlefish (RM6)</label><br><br>

                        <input type="checkbox" name="addon[]" value="Golden Mushroom">
                        <label for="addon8">Golden Mushroom (RM8)</label><br><br>

                        <input type="checkbox" name="addon[]" value="Egg">
                        <label for="addon9">Egg (RM5)</label>
                    </div>


                    <button style=" margin-left: 35%; margin-top: 9%; font-size: 20px; background-color: #4CAF50; color: white; padding: 5px 15px; border: none; border-radius: 5px; cursor: pointer;">
                        Add to Cart <i class="fa fa-shopping-cart" style="margin-left: 3px;"></i>
                    </button><br><br>
                </form>
            </td>
        </tr>
    </table>


</body>

<script>
    const vegetableCheckboxes = document.querySelectorAll('input[name^="vegetable"]');
    const addonCheckboxes = document.querySelectorAll('input[name^="addon"]');

    vegetableCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            let checkedCount = document.querySelectorAll('input[name^="vegetable"]:checked').length;
            if (checkedCount > 3) {
                this.checked = false;
            }
        });
    });

    addonCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            // Add your logic for addon checkboxes here
        });
    });
</script>

</html>