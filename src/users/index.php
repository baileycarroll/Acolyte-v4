<?php
    require "header.php";
    ?>


<main>
    <?php 
        if (isset($_SESSION['userID'])) {
            echo '<p>You are logged in!</p>';
        }
        else {
            echo '<p>Please Log-In or Register</p>';
        }
    ?>
    
</main>

<?php 
    require "footer.php";
    ?>