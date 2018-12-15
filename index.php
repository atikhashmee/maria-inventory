


<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Standard Meta -->
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">

    <!-- Site Properties -->
    <title>Login :: Panel</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" crossorigin="anonymous">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css">
    <style>
        .container-center{
            margin: 0 auto;
            margin-top: 134px;
        }
    </style>
</head>
<body>
	<?php 
      
          if (isset($_GET['msg'])) {  ?>
            <script>
              alert(<?=$_GET['msg']?>);
              window.location.href='index.php';
          </script>
       <?php    }

    ?>
        <div class="container-fluid">
    <aside class="col-sm-4 container-center">
<div class="card">
<article class="card-body">
<a href="" class="float-right btn btn-outline-primary">Sign up</a>
<h4 class="card-title mb-4 mt-1">Sign in</h4>
	 <form method="post" action="php/login.php"> 
    <div class="form-group">
    	<label>UserName</label>
        <input name="name" class="form-control" placeholder="Email" type="text">
    </div> <!-- form-group// -->
    <div class="form-group">
    	<a class="float-right" href="#">Forgot?</a>
    	<label>Your password</label>
        <input class="form-control" name="pass" placeholder="******" type="password">
    </div> <!-- form-group// --> 
    <div class="form-group"> 
    <div class="checkbox">
      <label> <input type="checkbox"> Save password </label>
    </div> <!-- checkbox .// -->
    </div> <!-- form-group// -->  
    <div class="form-group">
        <button type="submit" name="btn" class="btn btn-primary btn-block"> Login  </button>
    </div> <!-- form-group// -->                                                           
</form>
</article>
</div> <!-- card.// -->

	</aside> <!-- col.// -->
    </div>
    <script type="text/javascript" src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"  crossorigin="anonymous"></script>
</body>
</html>