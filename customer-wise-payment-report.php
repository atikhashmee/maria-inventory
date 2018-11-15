<?php include 'files/header.php'; ?>
<?php include 'files/menu.php';

 ?>
<div class="container-fluid">

   <div class="row">
       <div class="col">
         <div class="bg-light card card-body" style=" background: #b4c6d8 !important">
          <h1 style="text-align: center;">Customerwise Payment Report</h1>
         </div>
       </div>
     </div>

     <div class="row">
       <div class="col">
         <div class="bg-light card card-body" style=" background: #060202 !important;">
          <form action="" method="POST">
            <div class="row">
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
   
         $sql =  "SELECT `billchallan`,`selldate`, `customerid`,`payment_taka`, `token` FROM `sell` 
           UNION
           SELECT `invoiceno`,`paymentdate`, `customerid`, `payamount`, `token` FROM `c_payment`";

           $duebalance = 0;
         if (isset($_POST['filter'])) {

              //search by only name
              if (!empty($_POST['cutomername'])) {
      $sql ="SELECT `billchallan`,`selldate`, `customerid`,`payment_taka`, `token` FROM `sell` where `customerid`='".$_POST['cutomername']."'
             UNION
        SELECT `invoiceno`,`paymentdate`, `customerid`, `payamount`, `token` FROM `c_payment` WHERE `customerid`='".$_POST['cutomername']."'";
              } 


     if (!empty($_POST['cutomername']) && !empty($_POST['start']) && !empty($_POST['to'])) {
      $sql ="SELECT `billchallan`,`selldate`, `customerid`,`payment_taka`, `token` FROM `sell` where `customerid`='".$_POST['cutomername']."' AND  `selldate` BETWEEN '".$_POST['start']."' AND '".$_POST['to']."'
             UNION
        SELECT `invoiceno`,`paymentdate`, `customerid`, `payamount`, `token` FROM `c_payment` WHERE `customerid`='".$_POST['cutomername']."' and `paymentdate` BETWEEN '".$_POST['start']."' AND '".$_POST['to']."'";
              }


              if (!empty($_POST['start']) && !empty($_POST['to'])) {
                $sql =  "SELECT `billchallan`,`selldate`, `customerid`,`payment_taka`, `token` FROM `sell` where  `selldate` between '".$_POST['start']."' AND '".$_POST['to']."'
           UNION
           SELECT `invoiceno`,`paymentdate`, `customerid`, `payamount`, `token` FROM `c_payment` where `paymentdate` between '".$_POST['start']."' AND '".$_POST['to']."'";
              }


             
              // fetching customer opening balnce to add up the total transaction
              $customers_opening = $db->joinQuery("SELECT `opening_balance` FROM `users` WHERE `u_id`='".$_POST['cutomername']."'")->fetch(PDO::FETCH_ASSOC);
              $opening = $customers_opening['opening_balance'];
              $duebalance = $fn->getCustomerPurchasedAmount($_POST['cutomername']);
              
              ?>
              <div class="bg-light card card-body" style=" background: #060202 !important;">
     <h4 style="color: white">Customer Name : <?php  echo $fn->getUserName($_POST['cutomername']); ?></h4>
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
               <th>Invoice</th>
               <th>Date</th>
               <th>Customer Name</th>
               <th>Amount</th>
               <th>Total</th>
               <th>Status</th>
               
            </tr>
         </thead>
         <tbody>
         
            <?php 
               $i=0;
               $sum = 0;
                  foreach ($data as $val) {  $i++;
                    $sum+= (int)$val['payment_taka'];  
                   ?>
            <tr>
               <th scope="row"><?=$i?></th>
               <td><?=$val['billchallan']?></td>
               <td><?=$val['selldate']?></td>
               <td><?=$fn->getUserName($val['customerid'])?></td>
               <td><?=$val['payment_taka']?></td>
               <td><?=number_format($sum)?></td>
                
                <td><?php 
                 if ($val['token']=="s") {
                     echo "On sale payment";
                  } else if ($val['token']=="cp") {
                    echo "customer payment";
                  } 
                ?></td>
   
               </tr>
            <?php   }
               ?>

               <tr>
                 <td></td>
                 <td></td>
                 <td>Total due</td>
                 <td><?=$duebalance?></td>
                 <td></td>
                 <td></td>
               </tr> 
               <tr>
                 <td></td>
                 <td></td>
                 <td> Total Paid </td>
                 <td><?=$sum?></td>
                 <td></td>
                 <td></td>
               </tr> 
               <tr>
                 <td></td>
                 <td></td>
                 <td> Balance </td>
                 <td><?=$duebalance-$sum?></td>
                 <td></td>
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
      $brand = $db->selectAll("p_brand");
      $sizes = $db->selectAll("p_size");
      $pro = $db->selectAll("product_info");
       $branddd = [];
       $sizsesss =  [];
       $products =  [];
      
      while ($br = $brand->fetch(PDO::FETCH_ASSOC)) {
       $branddd[$br['brand_id']] = $br['brand_name'];
      }
      
      
      while ($si = $sizes->fetch(PDO::FETCH_ASSOC)) {
       $sizsesss[$si['pro_size_id']] = $si['pro_size_name'];
      }
      while ($prlist = $pro->fetch(PDO::FETCH_ASSOC)) {
                           $productname = '';
                              if (!empty($prlist['size_id'])) {
                                 $productname .= $fn->getBrandName($prlist['brand_id'])."-". $fn->getSizeName($prlist['size_id']);
                              }else {
                                 $productname .=$fn->getBrandName($prlist['brand_id']);
                              }
       $products[$prlist['pro_id']] = $productname;
      }
      
      
      ?>
   
   var brnds = <?php echo json_encode($branddd);?>;
   var sizzz = <?php echo json_encode($sizsesss);?>;
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
   var dll = "";
   for(var j = 0; j < data.length; j++){
    dll = "";
    if (data[j].size_id.length !== 0) {
       dll =  sizzz[data[j].size_id];
    }
   text +="<option value='"+data[j].pro_id+"'>"+brnds[data[j].brand_id]+"-"+ dll +"</option>";
   }
   $("#product").html(text);
   // console.log(data[0].p_id);
   $("#cuquntity").val("6");
   })
   .fail(function() {
   console.log("error");
   })
   .always(function() {
   console.log("complete");
   });
   
   
   }
</script>