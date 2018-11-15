

		<?php 

				require_once 'dboperation.php';
			    
               $db = new Db();
				if (isset($_POST['btn'])) {

					$name = $_POST['name'];
					$pass = md5($_POST['pass']);
					$qry = $db->selectAll("administrative","username = '$name' AND password = '$pass'");
					$data = $qry->fetch(PDO::FETCH_ASSOC);
					if (!empty($name) && !empty($pass)) {
						
							if ($name == $data['username'] && $pass == $data['password']) {

								session_start();
								$_SESSION['username'] = $name;
								
								$_SESSION['u_id']      = $data['aid'];
								
								header("location:../home.php");
							}else{
								header("location:../index.php?msg=username and password don't match");

								//echo " <a href='../index.php'>Go back</a>";
							}
					}else {
						header("location:../index.php?msg=fields are empty , fill them first ..... ");
						
					}


				}	


		?>