		<?php 
				require_once("dboperation.php");
				 
				class Functions extends Db
				{


				    function __construct(){
				    	parent::__construct();
				    }

				 public function getBrandName($brandid)
				   {
				       
				       $productname =  $this->selectAll("p_brand","brand_id='".$brandid."'")->fetch(PDO::FETCH_ASSOC);
				       return $productname['brand_name'];

				   }
				   public function getSizeName($sizeid)
				   {
				       
				      $productname =  $this->selectAll("p_size","pro_size_id='".$sizeid."'")->fetch(PDO::FETCH_ASSOC);
				       return $productname['pro_size_name'];

				   }

				   public function getUserName($userid)
				   {
				   	 $productname =  $this->selectAll("users","u_id='".$userid."'")->fetch(PDO::FETCH_ASSOC);
				       return $productname['name'];
				   }

				   public function Chartsaccounta($chartid)
				   {
				   	 $productname =  $this->selectAll("charts_accounts","charts_id='".$chartid."'")->fetch(PDO::FETCH_ASSOC);
				       return $productname['chart_name'];
				   }
				   public function expenseCategory($expcat)
				   {
				   	 $productname =  $this->selectAll("expensecategory","excate_id='".$expcat."'")->fetch(PDO::FETCH_ASSOC);
				       return $productname['name'];
				   } 

				   public function getProductName($Productid)
				   {
				   	 $val =  $this->joinQuery("SELECT  `pro_name` FROM `product_info` WHERE `pro_id`='{$Productid}'")->fetch(PDO::FETCH_ASSOC);
				   	  
				       return $val['pro_name'];
				   }

				
				function imageupload($str,$targetfile)
			                   {
			                   	   $filename = $_FILES[$str]['name'];
			                   	   $filesize = $_FILES[$str]['size'];
			                   	   $filetype = $_FILES[$str]['type'];
			                   	   $tempname = $_FILES[$str]['tmp_name'];

			                                $allowed = array(
			                                'jpg' =>"image/jpg",
			                                'jpeg' =>"image/jpeg",  
			                                'png' =>"image/png",
			                                'gif' =>"image/gif"
			                               );

			                                $ext  =  pathinfo($filename,PATHINFO_EXTENSION);
			                                
					                      if (!array_key_exists($ext, $allowed)) {
					                     die("Select a valid file,. valid extentions are JPG,JPEG,PNG,GIF");
					                      }

					                      $maxsize = 5*1024*1024;
					                      if ($filesize>$maxsize) {
					                        die("Maximum file size is 5 MB, your file size exceeding the limit");
					                      }


						                       if (in_array($filetype, $allowed)) {
						                  if (file_exists($targetfile)) {
						                die("this file is already exist ");
						              }else {
						                move_uploaded_file($tempname, $targetfile);
						               // echo "your file is successfully uploaded ";
						              }
						                }else{
						                  echo "there is problem uploading your files";
						                }
			                   }


				public function getCustomerPurchasedAmount($customerid)
				{
					$customers_opening = $this->joinQuery("SELECT `opening_balance` FROM `users` WHERE `u_id`='".$_POST['cutomername']."'")->fetch(PDO::FETCH_ASSOC);
              $opening = $customers_opening['opening_balance'];
              $sum = $opening;
					 $sql ="SELECT `selldate`, `billchallan`, `productid`, `quantity`, `price`,`discount`,`token` FROM `sell` WHERE `customerid`='{$customerid}'
             UNION
              SELECT `return_date`, `memono`, `productid`, `quntity`, `price`, `discount`, `token` FROM `sell_return` WHERE `customerid`='{$customerid}'";
               $ss =  $this->joinQuery($sql)->fetchAll();
				  foreach ($ss as $val) {
				  	$tot = (((int)$val['price'] * (int)$val['quantity']) );
				  	if ($val['token']=="sr") {
                        $sum -= $tot;
                    }else if($val['token']=="s"){
                       $sum += $tot;
                    }
				  }
				  return $sum;
				
				}


				public function getSupllierdueby($supplier)
				{
					$customers_opening = $this->joinQuery("SELECT `opening_balance` FROM `users` WHERE `u_id`='{$supplier}'")->fetch(PDO::FETCH_ASSOC);
              $opening = $customers_opening['opening_balance'];
              $sum = $opening;
					  $sql ="SELECT `purchasedate`,`billchallan`, `productid`, `quantity`, `price`, `weight`, `transport`, `vat`, `discount`, `token` FROM `purchase` WHERE `supplier`='{$supplier}'
             UNION
              SELECT `return_date`, `memono`, `productid`, `quntity`, `price`, `weight`, `transport`, `vat`, `discount`, `token` FROM `purchase_return` WHERE `supplierId`='{$supplier}' ORDER by purchasedate";


               $ss =  $this->joinQuery($sql)->fetchAll();
				  foreach ($ss as $val) {
				  	$tot = (((int)$val['price'] * (int)$val['quantity']) + (int)$val['weight'] + (int)$val['transport']);
				  	if ($val['token']=="pr") {
                        $sum -= $tot;
                    }else if($val['token']=="p"){
                       $sum += $tot;
                    }
				  }
				  return $sum;
				
				}
				 function myQuantity($proid){
              $openini = $GLOBALS['db']->joinQuery("SELECT `opening_stock` FROM `product_info` WHERE `pro_id`='{$proid}'")->fetch(PDO::FETCH_ASSOC);
              $total = $openini['opening_stock'];

              $sql = "SELECT `billchallan`,`selldate`, `token`, `productid`, `quantity` 
                    FROM `sell` WHERE `productid`='{$proid}'
                    UNION
                    SELECT `billchallan`, `purchasedate`,`token`,`productid`, `quantity` 
                    FROM `purchase` WHERE `productid`='{$proid}'
                    UNION
                    SELECT `memono`, `return_date`, `token`,`productid`,`quntity` 
                    FROM `sell_return` WHERE `productid`='{$proid}'
                    UNION
                    SELECT `memono`, `return_date`,`token`,`productid`,`quntity`  
                    FROM `purchase_return` WHERE `productid`='{$proid}'";
                    $query =  $GLOBALS['db']->joinQuery($sql)->fetchAll();
                          foreach ($query as $qu) {  
                    if ($qu['token']=="p") {
                              $total+= $qu['quantity'];
                          }else if ($qu['token']=="s") {
                               $total-= $qu['quantity'];
                          } else if ($qu['token']=="sr") {
                            $total+= $qu['quantity'];
                          }else if ($qu['token']=="pr") {
                            $total-= $qu['quantity'];
                          }
                        }
           return $total;

         }

			}
				
		?>