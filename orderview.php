<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.0/css/line.css">

    <title>Admin Dashboard Panel</title>
</head>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600&display=swap');

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Poppins', sans-serif;
    }

    :root {
        --primary-color: #0E4BF1;
        --panel-color: #FFF;
        --text-color: #000;
        --black-light-color: #707070;
        --border-color: #e6e5e5;
        --toggle-color: #DDD;
        --box1-color: #4DA3FF;
        --box2-color: #FFE6AC;
        --box3-color: #E7D1FC;
        --title-icon-color: #fff;
    }

    body {
        min-height: 100vh;
        background-color: orange;
    }

    body.dark {
        --primary-color: #3A3B3C;
        --panel-color: #242526;
        --text-color: #CCC;
        --black-light-color: #CCC;
        --border-color: #4D4C4C;
        --toggle-color: #FFF;
        --box1-color: #3A3B3C;
        --box2-color: #3A3B3C;
        --box3-color: #3A3B3C;
        --title-icon-color: #CCC;
    }

    nav {
        position: fixed;
        top: 0;
        left: 0;
        height: 100%;
        width: 250px;
        padding: 10px 14px;
        background-color: var(--panel-color);
        border-right: 1px solid var(--border-color);
        transition: all 0.5s ease;
    }

    nav.close {
        width: 73px;
    }

    nav .logo-name {
        display: flex;
        align-items: center;
    }

    nav .logo-name .logo_name {
        font-size: 22px;
        font-weight: 600;
        color: var(--text-color);
        margin-left: 14px;
        transition: all 0.5s ease;
    }

    nav.close .logo_name {
        opacity: 0;
        pointer-events: none;
    }

    nav .menu-items {
        margin-top: 40px;
        height: calc(100% - 90px);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .menu-items li {
        list-style: none;
    }

    .menu-items li a {
        display: flex;
        align-items: center;
        height: 50px;
        text-decoration: none;
        position: relative;
    }

    .menu-items li a i {
        font-size: 24px;
        min-width: 45px;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--black-light-color);
    }

    .menu-items li a .link-name {
        font-size: 18px;
        font-weight: 400;
        color: var(--black-light-color);
        transition: all 0.5s ease;
    }

    nav.close li a .link-name {
        opacity: 0;
        pointer-events: none;
    }

    .nav-links li a:hover i,
    .nav-links li a:hover .link-name {
        color: var(--primary-color);
    }

    body.dark .nav-links li a:hover i,
    body.dark .nav-links li a:hover .link-name {
        color: var(--text-color);
    }

    .menu-items .logout-mode {
        padding-top: 10px;
        border-top: 1px solid var(--border-color);
    }

    .menu-items .mode {
        display: flex;
        align-items: center;
        white-space: nowrap;
    }

    .menu-items .mode-toggle {
        position: absolute;
        right: 14px;
        height: 50px;
        min-width: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
    }

    .mode-toggle .switch {
        position: relative;
        display: inline-block;
        height: 22px;
        width: 40px;
        border-radius: 25px;
        background-color: var(--toggle-color);
    }

    .switch:before {
        content: "";
        position: absolute;
        left: 5px;
        top: 50%;
        transform: translateY(-50%);
        height: 15px;
        width: 15px;
        background-color: var(--panel-color);
        border-radius: 50%;
        transition: all 0.3s ease;
    }

    body.dark .switch:before {
        left: 20px;
    }

    .dashboard {
        position: relative;
        left: 250px;
        background-color: var(--panel-color);
        min-height: 100vh;
        width: calc(100% - 250px);
        padding: 10px 14px;
        transition: all 0.5s ease;
    }

    nav.close~.dashboard {
        left: 73px;
        width: calc(100% - 73px);
    }

    .dashboard .top {
        position: fixed;
        top: 0;
        left: 250px;
        display: flex;
        width: calc(100% - 250px);
        justify-content: space-between;
        align-items: center;
        padding: 10px 14px;
        background-color: var(--panel-color);
        transition: all 0.5s ease;
        z-index: 10;
    }

    nav.close~.dashboard .top {
        left: 73px;
        width: calc(100% - 73px);
    }

    .dashboard .top .sidebar-toggle {
        font-size: 26px;
        color: var(--text-color);
        cursor: pointer;
    }

    .dashboard .top .search-box {
        position: relative;
        height: 45px;
        max-width: 600px;
        width: 100%;
        margin: 0 30px;
    }

    .top .search-box input {
        position: absolute;
        border: 1px solid var(--border-color);
        background-color: var(--panel-color);
        padding: 0 25px 0 50px;
        border-radius: 5px;
        height: 100%;
        width: 100%;
        color: var(--text-color);
        font-size: 15px;
        font-weight: 400;
        outline: none;
    }

    .top .search-box i {
        position: absolute;
        left: 15px;
        font-size: 22px;
        z-index: 10;
        top: 50%;
        transform: translateY(-50%);
        color: var(--black-light-color);
    }

    .top img {
        width: 40px;
        border-radius: 50%;
    }

    .dashboard .dash-content {
        padding-top: 50px;
    }

    .dash-content .title {
        display: flex;
        align-items: center;
        margin: 60px 0 30px 0;
    }

    .dash-content .title i {
        position: relative;
        height: 35px;
        width: 35px;
        background-color: var(--primary-color);
        border-radius: 6px;
        color: var(--title-icon-color);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 24px;
    }

    .dash-content .title .text {
        font-size: 24px;
        font-weight: 500;
        color: var(--text-color);
        margin-left: 10px;
    }

    .dash-content .boxes {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
    }

    .dash-content .boxes .box {
        display: flex;
        flex-direction: column;
        align-items: center;
        border-radius: 12px;
        width: calc(100% / 3 - 15px);
        padding: 15px 20px;
        background-color: var(--box1-color);
        transition: all 0.5s ease;
    }

    .boxes .box i {
        font-size: 35px;
        color: var(--text-color);
    }

    .boxes .box .text {
        white-space: nowrap;
        font-size: 18px;
        font-weight: 500;
        color: var(--text-color);
    }

    .boxes .box .number {
        font-size: 40px;
        font-weight: 500;
        color: var(--text-color);
    }

    .boxes .box.box2 {
        background-color: green;
    }

    .boxes .box.box3 {
        background-color: red;
    }

    .dash-content .activity .activity-data {
        display: flex;
        justify-content: space-between;
        align-items: center;
        width: 100%;
    }

    .activity .activity-data {
        display: flex;
    }

    .activity-data .data {
        display: flex;
        flex-direction: column;
        margin: 0 15px;
    }

    .activity-data .data-title {
        font-size: 20px;
        font-weight: 500;
        color: var(--text-color);
    }

    .activity-data .data .data-list {
        font-size: 18px;
        font-weight: 400;
        margin-top: 20px;
        white-space: nowrap;
        color: var(--text-color);
    }

    table {
        border-collapse: collapse;
        width: 100%;
        margin: 2% auto;
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
</style>

<body>
    <nav>
        <div class="logo-name">
            <span class="logo_name">Admin</span>
        </div>

        <div class="menu-items">
            <ul class="nav-links">

                <li><a href="adminmenu.php">
                        <i class="uil uil-files-landscapes"></i>
                        <span class="link-name">Menu</span>
                    </a></li>
                <li><a href="adminbooking.php">
                        <i class="uil uil-users-alt"></i>
                        <span class="link-name">Booking</span>
                    </a></li>
                <li><a href="orderview.php">
                        <i class="uil uil-invoice"></i>
                        <span class="link-name">Orders</span>
                    </a></li>

            </ul>

            <ul class="logout-mode">
                <li>
                    <a href="index.php">
                        <i class="uil uil-signout"></i>
                        <span class="link-name">Logout</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <section class="dashboard">
        <div class="top">
            <!--<img src="images/profile.jpg" alt="">-->
        </div>
        </div>
        <br>
        <p style="font-size:25px; font-family: 'Poppins', sans-serif; "><b>Order Details </b></h1>

            <?php
            include 'config.php';

            $sql = "SELECT DISTINCT tableNumber FROM `carts` ORDER BY tableNumber ASC"; // Get distinct table numbers in ascending order
            $result = mysqli_query($conn, $sql);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $tableNumber = $row["tableNumber"]; // Get the table number
                    $totalPrice = 0; // Initialize totalPrice here
                    // Query to fetch orders for a specific table number
                    $orders_sql = "SELECT * FROM `carts` WHERE tableNumber = '$tableNumber' ORDER BY id ASC"; // Assuming there's an id column for ordering the orders
                    $orders_result = mysqli_query($conn, $orders_sql);

                    if (mysqli_num_rows($orders_result) > 0) {
            ?>
        <table>
            <caption style="font-size:18px;"><b>Table No: <?php echo $tableNumber; ?></b></caption>
            <tr>
                <th style="width:3%">No</th>
                <th style="width:10%">Hotpot Type</th>
                <th style="width:8%">Spicy Level</th>
                <th style="width:6%">Soup Type</th>
                <th style="width:17%">Vegetables</th>
                <th style="width:20%">Add Ons</th>
                <th style="width:10%">Quantity</th>
                <th style="width:5%">Price</th>
            </tr>
            <?php
                        $counter = 1;
                        while ($order_row = mysqli_fetch_assoc($orders_result)) {
            ?>
                <tr>
                    <td><?php echo $counter; ?></td>
                    <td><?php echo $order_row["name"] ?></td>
                    <td><?php echo $order_row["spicyLevel"] ?></td>
                    <td><?php echo $order_row["selectedSoup"] ?></td>
                    <td><?php echo $order_row["selectedVegetables"] ?></td>
                    <td><?php echo $order_row["selectedAddons"] ?></td>
                    <td><?php echo $order_row["quantity"] ?></td>
                    <td><?php echo $order_row["price"] ?></td>
                </tr>
            <?php
                            $counter++;
                            $totalPrice += $order_row["price"];
                        }
            ?>
            <tr>
                <td colspan="7" style="text-align: right; font-weight: bold;">Total Price:</td>
                <td><?php echo $totalPrice; ?></td>
            </tr>
        </table>
<?php
                    } else {
                        echo "<p>No orders for table number: $tableNumber</p>";
                    }
                }
            } else {
                echo "<p>No orders found</p>";
            }

            mysqli_close($conn);
?>


<button onclick="window.location.href='editadminorder.php'" style=" background-color:blue; color:white;border: none;padding: 6px 34px;font-size:15px;" type="button">Edit</button>
<button onclick="window.location.href='deleteadminorder.php'" style=" background-color:red; color:white;border: none;padding: 6px 28px;font-size:15px;" type="button">Delete</button>



</body>

</html>