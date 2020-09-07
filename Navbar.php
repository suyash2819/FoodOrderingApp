<?php 
if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
?>
<nav class="navbar navbar-expand-lg navbar-trans">
    <a class="navbar-brand" href="#">Foodshala</a>
    <button class="navbar-toggler custom-toggler" type="button" data-toggle="collapse"
        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
        aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="Index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <?php if(!isset($_SESSION['username'])&&!isset($_SESSION['restaurantname'])){?>

            <li class="nav-item">
                <a class="nav-link" href="UserSignUp.php">User SignUp</a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="RestaurantSignUp.php">Restaurant SignUp</a>
            </li>
            <?php } ?>
        </ul>
        <ul class="navbar-nav my-2 my-lg-0">
            <?php if(isset($_SESSION['username'])||isset($_SESSION['restaurantname'])){?>
            <li class="nav-item">
                <a class="nav-link" href="#">Welcome <?php if(isset($_SESSION['username'])){ echo $_SESSION['username'];} else {echo $_SESSION['restaurantname']; }
                        ?>
                </a>
            </li>
            <?php if(isset($_SESSION['restaurantname'])){ ?>
            <li class="nav-item">
                <a class="nav-link" href="AddToMenu.php">Add To Menu</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Orders.php">View Orders</a>
            </li>
            <?php } ?>
            <li class="nav-item">
                <a class="nav-link" href="./Logout.php">Logout</a>
            </li>
            <?php } else { ?>
            <li class="nav-item">
                <a class="nav-link" href="Login.php">Login</a>
            </li>
            <?php } ?>
        </ul>
    </div>
</nav>