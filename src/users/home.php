<?php 


   if(isset($_POST['text'])) {
    strip_tags(header('Content-disposition: attachment; filename=my_notes.txt'));
    header('Content-type: application/txt');
    echo strip_tags($_POST['text']);
    exit;

    
}
?>
<?php
require "header.php";
$membership = $_SESSION['membership'];
   $week = $_POST["module"] ?: "Introduction";
   if($membership!='Active'){
    session_unset();
    session_destroy();
    echo ('Your membership has expired. Please renew it to contine to use this site. <a href="../membership.php">Renew Now</a>');
    exit(); 
}

    ?>





<main>
<div class=" mt-4 container-fluid">
<div id="homePage"  class="container-fluid">
    <div class="row">
        <div class="col-8 rounded container-fluid text-light m-1" style="padding-top:1rem; padding-left:6rem; padding-bottom:3rem; left: -60px;">
            <div style="min-width: 1000px;" class="row d-flex">
                <div style="min-width: 275px;" class="col-3 PageContent p-3 m-1">
                    <h4 align=center class="mb-3" id="module_list" style="color:white;">Module List</h4>
                        
                        <form action="home.php" method="post">
                            <input type="hidden" name="module" value="Introduction">
                            <button class="btn col-12 btn-light mb-1" type="submit" name="signup-submit">Introduction Page</button>
                        </form>
                    
                        <form action="home.php" method="post">
                                <input type="hidden" name="module" value="this_week">
                                <button class="btn col-12 mb-1" style="background-color: #ffd480;" type="submit">Current Module</button>
                        </form>
                        
                        <form action="home.php" method="post">
                                <input type="hidden" name="module" value="last_week">
                                <button class="btn col-12 mb-1 btn-light" type="submit">Previous Module</button>
                        </form>
                        
                        <form action="home.php" method="post">
                                <input type="hidden" name="module" value="next_week">
                                <button class="btn col-12 mb-1 btn-light" type="submit">Next Module</button>
                        </form>
                        
                    

                </div>
                <div class="col PageContent m-1" oncontextmenu="return false;">
                <h4 align=center><u><?php echo"$week"; ?></u></h4>
                <?php
                  echo file_get_contents("Class_Resources/slides/$week.html");
                  ?>
                </div>
            </div>
            <div style="min-width: 1000px;" class="row">
                <div class="col p-2 PageContent m-1">
                    <h3 align=center>Student Notes</h3>
                    <p>
                    <form method="post" action="">
                    <textarea name="text">
                        Please use this area to take your notes if you wish. 
                    </textarea><br />
                    <button class="btn col-3" style="background-color: #ffd480;" type="submit">Save</button>
                    </form>
                    </p>
                </div>
            </div>
            <div style="min-width: 1000px;" class="row">
                <div class="col p-2 mb-5 PageContent m-1">
                    <h3 align=center>External Resources & Links </h3>
                <?php
                  echo file_get_contents("Class_Resources/Links/$week.html");
                ?>
                </div>
            </div>
        </div>
        <div class="col-3  text-light m-1" style="padding-top:1rem; min-height: 300px; min-width: 350px; right: -75px;">
            <div class="row">
                <div align=center class="col p-2 PageContent m-1">
                    <h3>Announcements </h3> 
                <?php
                  echo file_get_contents("Class_Resources/Annc/$week.html");
                ?> 
                    
                </div>
            </div>
            <div class="row">
                <div align=center id="live_info" class="col p-2 PageContent m-1">
                <p>
                    <h3>Live Class Info</h3>
                    <p>
                        <h6>Lady Gwenyfur Draigtanllwyth is inviting you to a scheduled Zoom meeting.</h6>
                        Topic: Old World Witchcraft
                        <br />
                        Time: 9:00AM PST on Saturdays
                        <br />
                        <a href="#" target="blank">Join Zoom Meeting</a>
                        <br />
                        Meeting ID: 778 781 602
                        <br />
                        Listen on your phone: <br />
                        +1 929 205 6099 US (East Coast) <br />
                        +1 669 900 6833 US (West Coast) <br />
                        *** Central US can use either Number ***
                    </p>
                </p>
                </div>
            </div>
            <div class="row">
                <div align=center class="col p-2 PageContent m-1" style="min-height: 338px;">
                    <h3>Notes </h3>
                <?php
                  echo file_get_contents("Class_Resources/Notes/$week.html");
                ?>
                    
                </div>
            </div>
        </div>
        
    </div>
</div>
</div>
</div>
</div>

</main>

</body>

