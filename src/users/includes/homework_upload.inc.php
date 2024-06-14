<?php
  require 'dbh.inc.php';
  session_start();
$name_of_file = basename($_FILES['upload']['name']);

$type_of_file = substr($name_of_file, strrpos($name_of_file, '.') + 1);

$siz_of_file = $_FILES['upload']['size']/1024;

$max_allowed_size = 200;
$allowed_file_types = array("pdf", "txt", "doc", "rtf", "docx", "gdoc", "odf");

if($siz_of_file > $max_allowed_size){
  $errors .= "\n Size of file should be less than $max_allowed_size";
}

$allowed_ext = false;
for($i=0; $i<sizeof($allowed_file_types); $i++)
{
  if(strcasecmp($allowed_file_types[i], $type_of_file) == 0){
    $allowed_ext = true;
  }
}

if(!$allowed_ext) {
  $errors .="\n The uploaded file is not a supported file type. ". " Only the following file types are supported: ".implode(',',$allowed_file_types);
}

  ?>