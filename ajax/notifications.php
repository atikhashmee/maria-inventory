			


		   <?php 
		   		include '../php/dboperation.php';
		   		include("../php/functions.php");
			      $db = new Db();
			       $fn = new Functions();
		   		//echo "response from notification";
		   		$products = $db->selectAll('product_info')->fetchAll();
		   		$productids = array();
		   		$productquantity = array();
		   		$proname = array();
		   		$proquanity = array();

		   		class ModelObj
		   			{
		   				public $productsid;
		   				public $proquantity;
		   				function __construct($proid,$proquan)
		   				{
		   					$this->productsid = $proid;
		   					$this->proquantity = $proquan;
		   				}
		   			}


		   		foreach ($products as $pr) {
		   			$productids[$pr['pro_id']] = $pr['re_order_warning'];
		   			$productquantity[$pr['pro_id']] = $pr['opening_stock'];
		   			$proname[$pr['pro_id']] = $pr['pro_name'];


		   			//stock the calculation in my cest
		   			if ($pr['re_order_warning']>$fn->myQuantity($pr['pro_id'])) {
		   				array_push($proquanity, new ModelObj($pr['pro_name'],$pr['re_order_warning']));
		   			}
		   		}

		   		
		   		echo json_encode($proquanity);

		   ?>