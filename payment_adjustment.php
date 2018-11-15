<?php include 'files/header.php'; ?>
<?php include 'files/menu.php'; ?>




<div class="container-fluid">
   <div class="row">
      <div class="col">
         <div class="bg-light card card-body" style=" background: #b4c6d8 !important">
            <h1 style="text-align: center;">Payment  Adjustment</h1>
         </div>
      </div>
   </div>
</div>
   
    <?php
    $getinvoice = $db->selectAll('sell','billchallan='.$_GET['invoiceid'].'')->fetchAll();
    $paidamount = $getinvoice[0]['payment_taka'];
    //update total pay amount
    function updatepayment()
    {
      $onordertimepay =  $GLOBALS['db']->joinQuery('SELECT  SUM(`payamount`) as tt FROM `c_payment` WHERE `invoiceno`="'.$_GET['invoiceid'].'"')->fetch(PDO::FETCH_ASSOC);
       
      $GLOBALS['paidamount']  += $onordertimepay['tt'];

    }
    updatepayment();

     ?>





<div class="container">
  <div class="row">
    <div class="col">
      
       <div class="bg-light card card-body">

            <div class="card card-header">
               <h5>Invoice no = <?=$getinvoice[0]['billchallan']?> </h5>
           <h5>Customer = <?=$fn->getUserName($getinvoice[0]['customerid'])?> </h5>
           <h5>Order Date = <?=$getinvoice[0]['selldate']?> </h5>
            </div>
            
           <table class="table table-bordered">
             <tr>
               <th>SL</th>
               <th>Product</th>
               <th>Price</th>
               <th>Quantity</th>
               <th>Total</th>
             </tr>
             <?php 
             $i =0;
             $sum = 0;
              foreach ($getinvoice as $val) { $i++; $sum += $val['price']*$val['quantity'];  ?>
                <tr>
                  <td><?=$i?></td>
                  <td><?=$fn->getProductName($val['productid'])?></td>
                  <td><?=$val['price']?></td>
                  <td><?=$val['quantity']?></td>
                  <td><?=$val['price']*$val['quantity']?></td>
                </tr>
              <?php }
             ?>
             <tr>
                 <td></td>
                 <td></td>
                 <td></td>
                 <td>SubTotal</td>
                 <td><?=$sum?></td>
               </tr><tr>
                 <td></td>
                 <td></td>
                 <td></td>
                 <td>Discount</td>
                 <td><?=$getinvoice[0]['discount']?></td>
               </tr>
             <tr>
                 <td></td>
                 <td></td>
                 <td></td>
                 <td>Grand Total</td>
                 <td><?=$sum-=$getinvoice[0]['discount']?></td>
               </tr>
               <tr>
                 <td></td>
                 <td></td>
                 <td></td>
                 <td>Paid</td>
                 <td><?=$paidamount?></td>
               </tr>
               <tr>
                 <td></td>
                 <td></td>
                 <td></td>
                 <td>Due</td>
                 <td><?=$sum-$paidamount?></td>
               </tr>
               
           </table>
               

          <form action="" method="POST">
            <div class="row">
               
              <div class="col">
                <label>Date</label>
                <input type="date" class="form-control" name="paydate" required>
              </div>
              <div class="col">
                <label>PayAmount</label>
                <input type="text" class="form-control" name="payamount">
              </div>
              <div class="col">
                <input type="submit" name="btnpayment" class="btn btn-primary" value="payment" style="position: absolute; top: 32px;">
              </div>
            </div>
          </form>
          <?php

              if (isset($_POST['btnpayment'])) {
                  $data = array(
                    'invoiceno' => $_GET['invoiceid'], 
                    'customerid' => $getinvoice[0]['customerid'], 
                    'payamount' => $_POST['payamount'], 
                    'paymentdate' => $_POST['paydate']
                  );
                  if (!empty($_POST['paydate'])) {
                        if ($db->insert('c_payment',$data)) {
                          updatepayment();
                           ?>
                            <script>
                              alert("Payment is done");
window.location.href='payment_adjustment.php?invoiceid='+<?=$_GET['invoiceid']?>+'';</script>
                           <?php 
                           
                        }else {
                          echo "<h3 style='color:red'>Payment could not be done</h3>";
                        }
                  }
              }
           ?>
         </div>
    </div>
  </div>
  

</div>

<div class="container">
  <div class="row">
    <div class="col">
       <div class="bg-light card card-body" style=" background: #060202 !important;">
          <form action="" method="GET">
            <div class="row">
               
              <div class="col"><input type="date" class="form-control" name="start"></div>
              <div class="col"><input type="date" class="form-control" name="to"></div>
              <div class="col"><input type="submit" name="filter" class="btn btn-default"></div>
            </div>
          </form>
         </div>
    </div>
  </div>
  <div class="row">
    <div class="col">
      <table class="table table-bordered table-condensed  table-striped" id="myTable">
        <thead>
          <tr>
            <th>Sl</th>
            <th>Invoice No</th>
            <th>Customer</th>
            <th>Amount</th>
            <th>Date</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php 
        
            $i=0;
     $sql = "SELECT * FROM `c_payment` where  invoiceno ='".$_GET['invoiceid']."'";
            /*if (isset($_GET['filter'])) {
                
               $sql .=" AND `paymentdate` BETWEEN '".$_GET['start']."' AND '".$_GET['to']."'";

            }
            echo $sql;*/
            $paymeinfo = $db->joinQuery($sql)->fetchAll();
            foreach ($paymeinfo as $pi) {  $i++; ?>
                 
        <tr>
          <td><?=$i?></td>
          <td><?=$pi['invoiceno']?></td>
          <td><?=$pi['customerid']?></td>
          <td><?=$pi['payamount']?></td>
          <td><?=$pi['paymentdate']?></td>
          <td><a href="" class="btn btn-danger">Delete</a></td>
          
        </tr>

                  

           <?php  }

          ?>
        </tbody>
      </table>
    </div>
  </div>
</div>



<?php include 'files/footer.php'; ?>



