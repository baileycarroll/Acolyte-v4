<?php

require "admin_header.php";
require "includes/dbh.inc.php";
session_start();

$_SESSION['module'] = $_POST['module_select'] ?: 'Elements_Of_Magick';
$module = $_SESSION['module'];

?>



    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar" style="height: 700px; flex:1;">
        <div class="sidebar-sticky">
              <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
              <span>Classroom Management</span>
              <a class="d-flex align-items-center text-muted" href="#"></a>
            </h6>
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link" href="admin.php">
                  Dashboard <span class="sr-only">(current)</span>
                </a>
              </li>
                <li class="nav-item">
                <a class="nav-link" href="roster.php">
                  Roster <span class="sr-only">(current)</span>
                </a>
              </li>
                <li class="nav-item">
                <a class="nav-link" href="gradebook.php">
                  Gradebook <span class="sr-only">(current)</span>
                </a>
              </li>
                <li class="nav-item">
                <a class="nav-link disabled" href="content.php">
                  Content Management <span class="sr-only">(current)</span>
                </a>
              </li>
            </ul>

            <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
              <span>Business Administrativa</span>
              <a class="d-flex align-items-center text-muted" href="#"></a>
            </h6>
            <ul class="nav flex-column mb-2">
            <li class="nav-item">
                <a class="nav-link" href="all_users.php">
                  All Users
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="new_users.php">
                  New Users
                </a>
              </li>
                <li class="nav-item">
                <a class="nav-link" href="exist_users.php">
                  Existing Users
                </a>
              </li>
                <li class="nav-item">
                <a class="nav-link" href="expired_users.php">
                  Expired Users
                </a>
              </li>
                <li class="nav-item">
                <a class="nav-link" href="admin_users.php">
                  Administrative Users
                </a>
              </li>
            </ul>
          </div>
        </nav>

        <main role="main" class="col-md-9  PageContent ml-sm-auto col-lg-10 pt-3 px-">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 text-light border-bottom">
            <h1 class="h2 text-light">GatheringWIND Gradebook <?php echo " - $module" ?></h1>
        <form class="form-inline" action="gradebook.php" method="post">
        <select class="form-control-sm" onchange="this.form.submit()" name="module_select" id="mod_id">
        <option value="">What Module to view?</option>
        <option value="Elements_Of_Magick">Elements of Magick</option>
        <option value="The_Seven_Directions_of_the_Crossroads">The Seven Directions of the Crossroads</option>
        <option value="3_Realms_of_Awen">The Three Realms of Awen</option>
        <option value="Archetypes_of_Deity">Archetypes of Deity</option>
        <option value="The_Celtic_Pantheon">The Celtic Pantheon</option>
        <option value="Self_Awareness">Self Awareness</option>
        <option value="Totems">Totems</option>
        <option value="Sabbats">Sabbats</option>
        <option value="Moons">Moons</option>
        <option value="Tools_of_Magick">Tools of Magick</option>
        <option value="Symbols_and_Sigils">Symbols and Sigils</option>
        <option value="Spell_Craft">Spell Craft</option>
        <option value="Charms_and_Incantations">Charms and Incantations</option>
        <option value="Talismans">Talismans</option>
        <option value="Divination">Divination</option>
        <option value="Spirit_Work">Spirit Work</option>
        <option value="Ancestors">Ancestors</option>
        </select><br />
        </form>
          </div>
          <div class="container-fluid">
          <div class="row">
          <div class="col">
          <?php
          $sql = "SELECT students.student_id, students.first_name, students.last_name, gradebook.$module FROM students JOIN gradebook ON students.student_id = gradebook.student_id WHERE students.student_group < 99 ";
          if ($result = mysqli_query($conn, $sql)) {
            if(mysqli_num_rows($result) > 0) {
              echo "<table class='table mt-3'>
              <thead class='bg-dark text-light'>
              <tr>
              <th scope='col'>Student ID</th>
              <th scope='col'>First Name</th>
              <th scope='col'>Last Name</th>
              <th scope='col'>Grade</th>
              </tr>
              </thead>
              <tbody class='bg-light'>";

              while($row = mysqli_fetch_array($result)) { 
                echo 
                 "<tr>" 
                . "<td>" 
                . $row['student_id'] . "</td><td>"
                . $row['first_name'] . "</td><td>"
                . $row['last_name'] . "</td><td>"
                . $row[$module] . "</td>"
                . "</tr>"
                ;
              }
              
              echo "</tbody>
              </table>
              ";
            }
          }
        ?>
          </div>
          <div class="col-3">
        <div style="background-color: #cc9900;" class="container rounded mt-3">
        <h4>Grade Update</h4>
        <form action="includes/grade_update.inc.php" method="post">
        <div class="form-group">
        <label for="std_id">What is the Student ID?</label>
        <input type="text" name="student_id" id="std_id" class="form-control">
        <label for="acc_new_status">What is the Student Grade?</label><br />
        <select class="form-control" name="std_grade" id="acc_new_status">
        <option value="Yes - Attendance Good, Homework Submitted">Yes - Attendance Good, Homework Submitted</option>
        <option value="No - Attendance Good, Homework Not Submitted">No - Attendance Good, Homework Not Submitted</option>
        <option value="No - Attendance Absent, Homework Submitted">No - Attendance Absent, Homework Submitted</option>
        <option value="No - Attendance Absent, Homework Not Submitted">No - Attendance Absent, Homework Not Submitted</option>
        </select><br />
        <button type="submit" id="update-submit" class="btn mt-2 mb-2 bg-white"> Update Student</button>
        </div>
        </form>
        </div>
        </div>
        </div>
        
          </div>
          
          
          </div>
        </main>
      </div>
