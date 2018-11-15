

		<?php 

			include '../php/dboperation.php';
			$db = new Db();
			session_start();
			  
			  $datass = json_decode($_GET['item']);
			   for ($i=0; $i <count($datass); $i++) { 
			    	 $data = array(
			    	 	'purchasedate' => $_GET['datepurchase'],
			    	 	'billchallan' => $_GET['billchallan'],
			    	 	'discount' => $_GET['discount'],
			    	 	'payment_taka' => $_GET['nowpayment'],
			    	 	'purchaseentryby' => $_SESSION['u_id'],
			    	 	'supplier' => $datass[$i]->name,
			    	 	'productid' => $datass[$i]->pname,
			    	 	'quantity' => $datass[$i]->quntity,
			    	 	'price' => $datass[$i]->price
			    	 	 );

			    	 /*echo "<pre>";
			    	 print_r($data);
			    	 echo "</pre>";*/
			    	$db->insert("purchase",$data);
			    	  
			    }
			  /*echo "<pre>";
			   print_r($_GET['allotherinfo']);
			  print_r($_GET);
			  echo "</pre>";*/
			  
		?>