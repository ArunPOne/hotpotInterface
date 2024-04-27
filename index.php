<?php
include('config.php');

$sql_cart_count = "SELECT COUNT(*) AS count FROM carts";
$result_cart_count = mysqli_query($conn, $sql_cart_count);
$row_cart_count = mysqli_fetch_assoc($result_cart_count);
$cart_count = $row_cart_count['count'];
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
    <style>
        :root {
            --main-color: #21e892;
            --black: #222;
            --white: rgb(163, 162, 162);
            --red: #ff6b81;
            --light-black: #777;
            --light-white: #fff9;
            --dark-bg: rgba(0, 0, 0, .7);
            --light-bg: #eee;
            --border: .1rem solid var(--red);
            --box-shadow: 1rem 1rem rgba(0, 0, 0, .1);
            --text-shadow: 0 1.5rem 3rem rgba(0, 0, 0, .3);
            --bg: #010103;
            --tran-05: all 0.5s ease;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            outline: none;
            border: none;
            text-decoration: none;
            text-transform: capitalize;
        }

        .categories h2 {
            color: blue;
        }

        .footer {
            font-size: 62.5%;
        }

        .footer {
            background: var(--black);
            text-align: center;
        }

        .footer .share {
            padding: 1rem 0;
            padding-top: 2rem;
        }

        .footer .share a {
            height: 3rem;
            width: 3rem;
            line-height: 3rem;
            font-size: 1.2rem;
            color: var(--red);
            border: var(--border);
            margin: .3rem;
            border-radius: 50%;
            margin-bottom: 0%;
        }

        .footer .share a:hover {
            background-color: var(--white);
        }

        .footer .links {
            margin-top: 0%;
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            padding: 1rem 0;
            gap: 1rem;
        }

        .footer .links a {
            padding: .5rem 2rem;
            color: var(--red);
            border: var(--border);
            font-size: 1.2rem;
        }

        .footer .links a:hover {
            background-color: var(--white);
        }

        .footer .credit {
            font-size: 1.2rem;
            color: var(--red);
            font-weight: lighter;
            padding: 1.5rem;
        }

        .footer .credit span {
            color: var(--white);
        }
    </style>
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
    <!-- Navbar Section Ends Here -->

    <!-- fOOD sEARCH Section Starts Here -->
    <section class="food-search text-right" style="margin-top: -180px;">
        <div class="container">

            <form action="food-search.php" method="POST">
                <input type="search" name="search" placeholder="Search for Hotpot.." required>
                <input type="submit" name="submit" value="Search" class="btn btn-primary">
            </form>

        </div>
    </section>
    <!-- fOOD sEARCH Section Ends Here -->

    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center" style="margin-right: 120px;">Hotpot Category</h2>

            <a href="chicken hotpot.php">
                <div class="box-3 float-container">
                    <img src="Chicken Based.png" alt="Chicken Based" style="width: 100%; border-style: solid; border-color: black; border-radius: 2%; border-width: 5px;">
                    <h3 class=" float-text text-black">Chicken Hotpot</h3>
                </div>
            </a>

            <a href="seafood hotpot.php">
                <div class="box-3 float-container">
                    <img src="Seafood Based.png" alt="Seafood Based" style="width: 100%; border-style: solid; border-color: black; border-radius: 2%; border-width: 5px;">

                    <h3 class="float-text text-black">Seafood Hotpot</h3>
                </div>
            </a>

            <a href="vegetable hotpot.php">
                <div class="box-3 float-container">
                    <img src="Vegetable Based.png" alt="Vegetable Based" style="width: 100%; border-style: solid; border-color: black; border-radius: 2%; border-width: 5px;">

                    <h3 class=" float-text text-black">Vegetable Hotpot</h3>
                </div>
            </a>


            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


    <div style="background-color:antiquewhite;"><br>
        <h1 style="text-align: center; margin-top: 6%; color: red;">Dining Concept</h1><br>
        <h3 style="text-align: center; margin:55px ;font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;">
            SIZZLEPOT is popping a fresh eating trend! The flexibility of selecting your favourite ingredients and level of
            spiciness has become one of the iconic trendy menus for the youngsters today!
        </h3>

        <div style="position:relative; display: inline;">
            <img src="plate.png" alt="Background Image" style="margin-left: 25%; width: 50%;">
            <img src="dining concept.png" alt="Dining Concept" class="imtip" style="width: 40%;">
        </div>
    </div>

    <section class="footer">

        <div class="share">
            <a href="https://www.facebook.com/" class="fab fa-facebook-f"></a>
            <a href="https://twitter.com/i/flow/login" class="fab fa-twitter"></a>
            <a href="https://www.instagram.com/accounts/login/" class="fab fa-instagram"></a>
        </div>

        <div class="links">
            <a href="index.php">Home</a>
            <a href="reservation.php">Reservation</a>
            <a href="adminlogin.php">Admin</a>
        </div>

        <div class="credit"></span> All Rights Reserved</div>

    </section>

</body>

</html>