<?php
require "admin_header.php";
require "includes/dbh.inc.php";
session_start();

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

        <main role="main" class="col-md-9  PageContent ml-sm-auto col-lg-10 pt-3 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2 text-light">Business Administrativa - New Users</h1>
            
          </div>
          <div class="container">
          <div class="row">
          <div class="col">
          <?php
          $sql = "SELECT * FROM students WHERE account_status = 'Pending'";
          if ($result = mysqli_query($conn, $sql)) {
            if(mysqli_num_rows($result) > 0) {
              echo "<table class='table mt-3'>
              <thead class='bg-dark text-light'>
              <tr>
              <th scope='col'>Student Id</th>
              <th scope='col'>First Name</th>
              <th scope='col'>Last Name</th>
              <th scope='col'>Email</th>
              <th scope='col'>Account Status</th>
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
                . $row['email'] . "</td><td>"
                . $row['account_status'] . "</td>"
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
        <div class="col-4">
        <div style="background-color: #cc9900;" class="container rounded mt-3">
        <h4>Student Status Update</h4>
        <form action="includes/new_update.inc.php" method="post">
        <div class="form-group">
        <label for="std_id">What is the Student ID?</label>
        <input type="text" name="student_id" id="std_id" class="form-control">
        <label for="acc_new_status">What is the new account status?</label><br />
        <select class="form-control" name="acc_status" id="acc_new_status">
        <option value="Active">Active</option>
        <option value="Pending">Pending</option>
        <option value="Suspended">Suspended</option>
        <option value="Deactivated">Deactivated</option>
        </select><br />
        <button type="submit" id="update-submit" class="btn mt-2 mb-2 bg-white"> Update Student</button>
        </div>
        </form>
        </div>
        <div style="background-color: #cc9900;" class="container rounded mt-3">
        <h4>Create New Student</h4>
        <form action="includes/new_student.inc.php" method="post">
        <div class="form-group">
        <label for='first_nm'>What is the First Name?</label>
        <input type="text" name="first_name" id="first_nm" class="form-control">
        <label for="last_nm">What is the Last Name?</label>
        <input type="text" name="last_name" id="last_nm" class="form-control">
        <button type="submit" id="create-submit" class="btn mt-2 mb-2 bg-white"> Create Student</button>
        </div>
        </form>
        </div>
        </div>
        </div>
          </div>
        </main>
      </div>
