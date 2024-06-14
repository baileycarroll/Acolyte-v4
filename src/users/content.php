<?php

require "admin_header.php";
require "includes/dbh.inc.php";
session_start();

$new_module = $_POST['new_module'];

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
                <a class="nav-link active" href="admin.php">
                  Dashboard <span class="sr-only">(current)</span>
                </a>
              </li>
                <li class="nav-item">
                <a class="nav-link active" href="roster.php">
                  Roster <span class="sr-only">(current)</span>
                </a>
              </li>
                <li class="nav-item">
                <a class="nav-link active" href="gradebook.php">
                  Gradebook <span class="sr-only">(current)</span>
                </a>
              </li>
                <li class="nav-item">
                <a class="nav-link active" href="content.php">
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

        <main role="main" class="col-md-9 ml-sm-auto bg-secondary col-lg-10 pt-3 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">Content Management</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group mr-2">
                <button class="btn btn-sm btn-outline-light">Share</button>
                <button class="btn btn-sm btn-outline-light">Export</button>
              </div>
              <button class="btn btn-sm btn-outline-light dropdown-toggle">
                This week
              </button>
            </div>
          </div>
          <div class="container-fluid">
            <div class="row d-flex">
              <div class="col-4 bg-light text-dark rounded">
                <form action="content.php" method="post">
                <div class="form-group">
                  <h3 align=center>Add New Module</h3>
                  <label for="mod_new"> What is the name of the new module? </label>
                  <input class="form-control" id="mod_new" type="text" name="new_module">
                  <button type="submit" class="btn m-2 btn-outline-secondary">Create New Module</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </main>
      </div>
<?php

require "footer.php";

?>