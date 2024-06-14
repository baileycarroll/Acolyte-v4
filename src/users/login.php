<?php
    require "login_header.php";
    ?>


<main>
    <?php 

        if (isset($_SESSION['username'])) {
            header("Location home.php");
        }
        else {
            echo '<div class="row d-flex justify-content-center">
            <div id="regForm" class="col-4 PageContent rounded text-center text-light form-group m-3">
            <h1 class="mt-5">Student Login</h1>
            <form class="mt-5" action="includes/login.inc.php" method="post">
            <div class="form-group m-1">
            <input class="form-control" type="text" name="username" placeholder="Username">
            </div>
            <div class="form-group m-1">
            <input class="form-control" type="password" name="pass" placeholder="Password">
            </div>
            <button id="logBtn" class="m-1 btn text-dark" type="submit" name="login-submit">Login</button> 
            </form>
            <a href="register.php">
                <button id="logBtn" class="m-1 btn text-dark">Register</button>
            </a>
            </div>
            </div>';
            
        }
    ?>
    
</main>

<?php 
    require "footer.php";
    ?>