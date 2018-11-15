
<?php
  include("php/dboperation.php");
  include("php/functions.php");
  $db = new Db();
  $fn = new Functions();
  session_start();
  /* echo "<pre>";
   echo $fn->getBrandName(1);
   echo $fn->getSizeName(1);
   echo "</pre>";*/

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
   
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/bootstrap.css" crossorigin="anonymous">
    <link rel="stylesheet" href="assets/css/bootstrap-tagsinput.css" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">

     <link rel="stylesheet" href="assets/css/style.css" crossorigin="anonymous">

    <title>Inventory Management System</title>

  </head>
  <body>
    

   