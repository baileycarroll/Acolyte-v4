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
            <h1 class="h2 text-light">Classroom Roster</h1>
          </div>
          <div class="container">
          <div class="row">
          <div class="col">
          <?php
          $sql = "SELECT * FROM students WHERE account_status = 'Active' && student_group < 99 ";
          if ($result = mysqli_query($conn, $sql)) {
            if(mysqli_num_rows($result) > 0) {
              echo "<table class='table mt-3'>
              <thead class='bg-dark text-light'>
              <tr>
              <th scope='col'>Student Id</th>
              <th scope='col'>First Name</th>
              <th scope='col'>Last Name</th>
              <th scope='col'>Email</th>
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
                . $row['email'] . "</td>"
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
          </div>
        </main>
      </div>
