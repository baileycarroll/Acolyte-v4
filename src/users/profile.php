<?php
    require "header.php";
    require "includes/dbh.inc.php";
    ?>

<main>

<div class="PageContent container-fluid">

  <div class="row">

    <div class="col-4 text-light">
      <h4 class="text-center mb-2">My Profile</h4>
      <ul>
       <li class="mb-2 col-12 btn btn-light" onclick="showDash()">Dashboard</li>
       <li></li>
       <li class="mb-2 col-12 btn btn-light " onclick="showInfo()">Update My Contact Information</li>
        <li></li>
        <li class="mb-2 col-12 btn btn-light" onclick="showResPass()">Reset Password</li>
        <li></li>
       <!-- <li class="mb-2  btn btn-secondary " onclick="showMembership()">Membership</li> -->
        <li></li>
        
      </ul>
    </div>

     <div id="dashboard" class="col PageContent px-2 text-center text-light" >
     <h1 align=center class="h3 mt-3 mb-3 font-weight-normal">
          My Information
        </h1>
      
        <?php
          $student_id = $_SESSION['student_id'];
          $sql = "SELECT first_name, last_name, phone, email, account_status  FROM students WHERE student_id = '$student_id' ";
          if ($result = mysqli_query($conn, $sql)) {
            if(mysqli_num_rows($result) > 0) {
              echo "<table class='table mt-3'>
              <thead class='bg-dark text-light'>
              <tr>
              <th scope='col'>First Name</th>
              <th scope='col'>Last Name</th>
              <th scope='col'>Phone Number</th>
              <th scope='col'>Email</th>
              <th scope='col'>Account Status</th>
              </tr>
              </thead>
              <tbody class='bg-light'>";

              while($row = mysqli_fetch_array($result)) {
                echo "<tr>
                <td>" . $row['first_name'] . "</td><td>"
                . $row['last_name'] . "</td><td>" . 
                $row['phone'] . "</td><td>" . $row['email'] . "</td><td>" . 
                $row['account_status'] . "</td></tr>"
                
                ;
              }
              
              echo "</tbody>
              </table>
              ";
            }
          }
        ?>
      
    </div>
    <div id="pass_reset" class="col p-2 text-center text-light" style="display: none;">
    <div class="row d-flex justify-content-center">
    <form class="form-signin" _lpchecked="1" action="includes/resetPass.inc.php" autocomplete="off" a method="POST">
      <h1 class="h3 mb-3 font-weight-normal">
          Reset My Password
        </h1>
        <label for="inputPassword" class="sr-only">
        Password
        </label>
        <input type="password" id="inputPassRep" class="form-control mb-2" placeholder="Password" name="pass" required="" autocomplete="new-password">
        <label for="inputPassRep" class="sr-only">
        Repeat Password
        </label>
        <input type="password" id="inputPassword" class="form-control mb-2" placeholder="Repeat Password" name="passRep" required="" autocomplete="new-password">
        <button class="btn mb-1 btn-lg btn-light btn-block" name="signup-submit" type="submit">
          Reset Password
        </button>
    </form>
    </div>
    </div>
     <div id="membership" class="col bg-secondary text-center text-light" style="display: none;">
      TESTTING HIDING ITEMS Lorem ipsum dolor, sit amet consectetur adipisicing elit. Eaque, molestiae voluptates! Dignissimos voluptatum est commodi vero voluptatibus praesentium. Assumenda aspernatur minima rerum quisquam officia esse repudiandae reprehenderit ut corporis. Eos!
    </div>
    <div id="my_info" class="col p-2 text-center text-light" style="display: none;">
    <form method="post" action="functions/info_updates.php">
    <div class="container m-2">
    <h4>My Information</h4>
  <div class="form-row">
    <div class="form-group col-6">
      <input type="text" class="form-control" name="first" placeholder="First Name">
    </div>
    <div class="form-group col-6">
      <input type="text" class="form-control" name="last" placeholder="Last Name">
    </div>
  
  <div class="form-group col-6">
    <input type="text" class="form-control" name="phone" placeholder="Phone Number">
  </div>
  <div class="form-group col-6">
    <input type="email" class="form-control" name="email" placeholder="E-mail">
  </div>
  </div>
  
  <button type="submit" name="info_update-submit" class="btn btn-lg btn-light">Update</button>
</form>
    </div>
</div>

  </div>

</div>


<script>
      function contactUpdate() {
    $.ajax({
        url:"functions/info_updates.php",
        type:"POST",
        success:function(result){
            console.log(result);
        }
    });

}
</script>
    
</main>

<?php 
    require "footer.php";
    ?>