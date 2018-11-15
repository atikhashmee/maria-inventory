<?php include 'files/header.php'; ?>
<?php include 'files/menu.php';
   
    $logindata =  $db->selectAll('administrative','aid='.$_SESSION['u_id'].'')->fetch(PDO::FETCH_ASSOC);

 ?>
 
	  <style>
            .myhr{
                height: auto;
                width: 718px;
                text-align: center;
                font-size: 16px;
                text-transform: uppercase;
                margin: 0 auto;
            
            }
            .myhr h1 h2 h3 h4 h5 h6 p{
                 
            }
        </style>        
        
        <div class="container-fluid">
        <div class="row card border-primary mb-3 card-header myhr" >
           <h3>Update Login access</h3>
        </div>
        </div>
        <div class="row">
           <div class="col-md-4"></div>
           <div class="col">
              <form role="form"  action=""  method="POST" enctype="multipart/form-data" >
                 
                 <div class="form-group">
                    <label> UserName </label>
  <input name="username" class="form-control" value="<?=$logindata['username']?>" />
                 </div>
                 <div class="form-group">
                    <label>Enter new Password </label>
 <input name="password" class="form-control"  />
                 </div>
                 <div class="form-group">
                    <label> E-mail </label>
   <input name="email" class="form-control" value="<?=$logindata['email']?>" />
                 </div>
                 
                 
                 
                 <button type="submit" name="btn" class="btn btn-warning" style="margin-right: 88px; margin-left: 92px; width: 98px;">Update</button>
                 <button type="reset" class="btn btn-primary" style="width: 98px;"> Reset </button>
              </form>
              <?php

              	if (isset($_POST['btn'])) {
              		$data = array(
              			'username' =>$_POST['username'] ,
              			'password' => md5($_POST['password']),
              			'email' =>$_POST['email'] 
              			 );
              		if ($db->update('administrative',$data,'aid='.$_SESSION['u_id'].'')) {
              			echo "<h3 style='color:blue'>Data has been updated</h3>";
              		}else {
              			echo "<h3 style='color:red'>Data has not been updated</h3>";
              		}
              	}

              ?>
              
           </div>
           <div class="col-md-4"></div>
        </div>
 
 <?php include 'files/footer.php'; ?>