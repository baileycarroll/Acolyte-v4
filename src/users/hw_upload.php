<?php 

require "header.php";
session_start();
?>


<div class="container-fluid">
  <div class="row justify-content-center">
    <div style="position: absolute; top: 15rem;" class="col-4 text-light form-group PageContent">
      <form action="includes/homework_upload.inc.php" method="post" enctype="multipart/form-data">

      <h3>Homework Submission</h3>

      <input class="form-control mt-2 mb-2" type="text" name="name" placeholder="Name:">

      <input class="form-control mb-2" type="text" name="comments" placeholder="Comments:">

      <input type="file" name="upload" placeholder="Select a File to Submit">

      <input class="btn btn-success m-2 ml-auto" type="submit" value="Submit" name="hw_submit">
 
    </form>
    </div>
  </div>
</div>