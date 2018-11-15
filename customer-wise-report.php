<?php include 'files/header.php'; ?>
<?php include 'files/menu.php';

 ?>
<div class="container-fluid">

   <div class="row">
       <div class="col">
         <div class="bg-light card card-body" style=" background: #b4c6d8 !important">
          <h1 style="text-align: center;">Customerwise Report</h1>
         </div>
       </div>
     </div>

     <div class="row">
       <div class="col">
         <div class="bg-light card card-body" style=" background: #060202 !important;">
          <form action="" method="POST">
            <div class="row">
              <!-- <div class="col">
                <select class="form-control" name="filtertype" id="filtertype">
                     <option>Select a type</option>
                      <option value="Payment">Payment Statement</option>
                      <option value="Stock">Stock</option>
                  </select>
                </div> -->
               <div class="col">
                <select class="form-control" name="cutomername" id="cutomername">
                     <option>Select a Customer</option>
                     <?php 
                        $cat  =  $db->joinQuery("SELECT * FROM `users` WHERE `user_role`='1'")->fetchAll();
                        foreach ($cat as $cater) { ?>
                     <option value="<?=$cater['u_id']?>"><?=$cater['name']?></option>
                     <?php   }
                        ?>
                  </select>
                </div>
               <div class="col">
                 
                     
                     <select class="form-control" name="productcat" id="productcat" onchange="getProduct()">
                        <option>product category</option>
                        <?php 
                           $cat  =  $db->joinQuery("SELECT * FROM `cateogory`")->fetchAll();
                           foreach ($cat as $cater) { ?>
                        <option value="<?=$cater['cat_id']?>"><?=$cater['cat_name']?></option>
                        <?php
                           }
                           
                           ?>
                     </select>
                  
               </div>
               <div class="col">
                  
                     <select class="form-control" name="product" id="product">

                     </select>
                  
               </div>
                 
              <div class="col"><input type="date" class="form-control" name="start"></div>
              <div class="col"><input type="date" class="form-control" name="to"></div>
              <div class="col"><input type="submit" value="Search" name="filter" class="btn btn-default"></div>
            </div>
          </form>
         </div>
       </div>

     </div>



<div class="row" style="margin-top: 22px;">
   <!-- users view section starts here -->
   <div class="col">
   <?php 
         $sql =  "SELECT `selldate`, `billchallan`, `productid`, `quantity`, `price`,`discount`,`token` FROM `sell` UNION SELECT `return_date`, `memono`, `productid`, `quntity`, `price`,  `discount`, `token` FROM `sell_return` ORDER by selldate";

                  $opening = 0;

         if (isset($_POST['filter'])) {



              //search by only name


              if (!empty($_POST['cutomername'])) {

                $sql ="SELECT `selldate`, `billchallan`, `productid`, `quantity`, `price`,`discount`,`token` FROM `sell` WHERE `customerid`='".$_POST['cutomername']."'
             UNION
              SELECT `return_date`, `memono`, `productid`, `quntity`, `price`,  `discount`, `token` FROM `sell_return` WHERE `customerid`='".$_POST['cutomername']."' ORDER by selldate";

              }

                //search by name and product name
              if (!empty($_POST['cutomername']) && !empty($_POST['product'])) {
                $sql ="SELECT `selldate`, `billchallan`, `productid`, `quantity`, `price`,`discount`,`token` FROM `sell` WHERE sell.customerid='".$_POST['cutomername']."' AND sell.productid='".$_POST['product']."'
                 UNION 
                 SELECT `return_date`, `memono`, `productid`, `quntity`, `price`,  `discount`, `token` FROM `sell_return` WHERE sell_return.customerid='".$_POST['cutomername']."' AND sell_return.productid='".$_POST['product']."' ORDER by selldate";
              }

              //search by customer name ,  and date

               if (!empty($_POST['cutomername']) &&  !empty($_POST['start']) && !empty($_POST['to']) ) {
                $sql ="SELECT `selldate`, `billchallan`, `productid`, `quantity`, `price`,`discount`,`token` FROM `sell` WHERE sell.customerid='".$_POST['cutomername']."'  AND sell.selldate BETWEEN '".$_POST['start']."' AND '".$_POST['to']."'
                 UNION 
                 SELECT `return_date`, `memono`, `productid`, `quntity`, `price`,  `discount`, `token` FROM `sell_return` WHERE sell_return.customerid='".$_POST['cutomername']."' AND sell_return.return_date BETWEEN '".$_POST['start']."' AND '".$_POST['to']."' ORDER by selldate";
              }

                //search by customer name , product name , and date

                if (!empty($_POST['cutomername']) && !empty($_POST['product']) && !empty($_POST['start']) && !empty($_POST['to']) ) {
                $sql ="SELECT `selldate`, `billchallan`, `productid`, `quantity`, `price`,`discount`,`token` FROM `sell` WHERE sell.customerid='".$_POST['cutomername']."' AND sell.productid='".$_POST['product']."' AND sell.selldate BETWEEN '".$_POST['start']."' AND '".$_POST['to']."'
                 UNION 
                 SELECT `return_date`, `memono`, `productid`, `quntity`, `price`,  `discount`, `token` FROM `sell_return` WHERE sell_return.customerid='".$_POST['cutomername']."' AND sell_return.productid='".$_POST['product']."' AND sell_return.return_date BETWEEN '".$_POST['start']."' AND '".$_POST['to']."' ORDER by selldate";
              }  

              


             
              // fetching customer opening balnce to add up the total transaction
              $customers_opening = $db->joinQuery("SELECT `opening_balance` FROM `users` WHERE `u_id`='".$_POST['cutomername']."'")->fetch(PDO::FETCH_ASSOC);
              $opening = $customers_opening['opening_balance'];
              ?>
              <div class="bg-light card card-body" style=" background: #060202 !important;">
                <h4 style="color: white">Customer Name : <?php  echo $fn->getUserName($_POST['cutomername']); ?></h4>
                <!-- <h5 style="color: white">Opening Balance : <?php echo $customers_opening['opening_balance']; ?> </h5> -->
              </div>
              <?php 
         }
        // echo $sql;
         
         $data = $db->joinQuery($sql)->fetchAll();
         
         ?>
     
      <table class="table table-hover table-striped table-bordered" id="myTable" >
         <thead>
            <tr>
               <th>#</th>
               <th>Date</th>
               <th>Bill/Challan</th>
               
               <th>Description</th>
               
               <th>Total</th>
               <th>Balance</th>
            </tr>
         </thead>
         <tbody>
          <tr>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td>Opnening Balance</td>
            <td><?=$opening?></td>
          </tr>
            <?php 
               $i=0;
               $sum = $opening;
                  foreach ($data as $val) {  $i++;
                      $tot = (((int)$val['price'] * (int)$val['quantity']));
                      
                      
                   ?>
            <tr>
               <th scope="row"><?=$i?></th>
               <td><?=$val['selldate']?></td>
               <td><?=$val['billchallan']?></td>
               
               
               <td>
                <p style="margin: 0px; padding: 0px" ><?=$fn->getProductName($val['productid'])?></p> 
                 <p>Quantity :  <?=$val['quantity']?></p>
                
                 <p style="margin: 0px; padding: 0px">Status = <?php 
                    if ($val['token']=="sr") {
                        echo "Product returned";
                    }else if($val['token']=="s"){
                       echo "Product Purchesed";
                    }
               ?></p> </td>
               
               <td><?php 

                      if ($val['token']=="sr") {
                        echo "-".$tot;
                    }else if($val['token']=="s"){
                       echo "+".$tot;
                    }

               ?></td>
               <td><?php 

                      if ($val['token']=="sr") {
                        echo $sum -= $tot;
                    }else if($val['token']=="s"){
                       echo $sum += $tot;
                    }

               ?></td>
               
               </tr>
            <?php   }
               ?>
               <tr>
                 <td></td>
                 <td></td>
                 <td></td>
                 <td> <h3 style="color: blue">Total Money</h3></td>
                 <td><?=$sum?></td>
                 <td></td>
               </tr>
         </tbody>
      </table>
      
   </div>
</div>
</div>
<?php include 'files/footer.php'; ?>
<script src="assets/js/jquery.js"></script>
<script>
  <?php 
      $pro = $db->selectAll("product_info");
       $products =  [];
      while ($prlist = $pro->fetch(PDO::FETCH_ASSOC)) {           
       $products[$prlist['pro_id']] = $prlist['pro_name'];
      }
      ?>
   var prod = <?php echo json_encode($products);?>;

     
   function  getProduct() {
   var id = document.getElementById("productcat").value;
   $.ajax({
   url: 'ajax/getProductByCategory.php',
   type: 'POST',
   data: {
     id: id },
   })
   .done(function(res) {
   var text = "";
   var data = JSON.parse(res);
   for(var j = 0; j < data.length; j++){
   text +="<option value='"+data[j].pro_id+"'>"+data[j].pro_name+"</option>";
   }
   $("#product").html(text);
   
   })
   .fail(function() {
   console.log("error");
   })
   .always(function() {
   console.log("complete");
   });
   
   
   }
</script>