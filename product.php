<?php include 'files/header.php'; ?>
<?php include 'files/menu.php'; ?>

<div class="container-fluid">
  <div class="row">
       <div class="col">
         <div class="bg-light card card-body" style=" background: #b4c6d8 !important">
          <h1 style="text-align: center;">Add new Product</h1>
         </div>
       </div>
     </div>
   <div class="row">


      <?php 
   if (isset($_GET['del-id'])) {
           if ($db->delete("units","unit_id = '".$_GET['del-id']."'")) {?>
<script> alert('Data has been deleted'); window.location.href='product.php'; </script>
<?php   }
   }

    if (isset($_GET['del-id'])) {
             if ($db->delete('product_info','p_id = '.$_GET['del-id'].'')) {
                   ?><script>alert('Data has been deleted'); 
                   window.location.href='product.php';</script><?php 
             }
        }
   
   
   ?>



      <div class="col">
         <div class="card border-primary">
            <div class="card-header">Add new Product</div>
            <div class="card-body">
               <form class="form-horizontal form-label-left" method="post" >
                  <div class="row">
                     <div class="col">
                        <div class="form-group">
                           <label for="name">Product ID <span class="required">*</span>
                           </label>
                           <input id="productid" class="form-control" name="productid"  required="required" type="text">
                        </div>
                     </div>
                    
                     <div class="col">
                        <div class="form-group">
                           <label  for="name">Select a Category
                           </label>
                           <select class="form-control" name="category">
                              <option value="">Choose option</option>
                              <?php 
                                 $cat  =  $db->joinQuery("SELECT * FROM `cateogory`")->fetchAll();
                                 foreach ($cat as $cater) { ?>
                              <option value="<?=$cater['cat_id']?>"><?=$cater['cat_name']?></option>
                              <?php   }
                                 ?>
                           </select>
                        </div>
                     </div>
                     <div class="col">
                        <div class="form-group">
                           <label for="name">Product Name
                           </label>
                           <input type="text" name="productname" class="form-control">
                           <!-- <select class="form-control" name="size">
                              <option value="">Choose option</option>
                              <?php 
                                 $siz  =  $db->joinQuery("SELECT * FROM `p_size`")->fetchAll();
                                 foreach ($siz as $size) { ?>
                              <option value="<?=$size['pro_size_id']?>"><?=$size['pro_size_name']?></option>
                              <?php   }
                                 ?>
                           </select> -->
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     
                     <div class="col">
                        <div class="form-group">
                           <label  for="name">Quantity<span class="required">*</span>
                           </label>
                           <input id="openingstock" class="form-control"  name="openingstock"  required="required" type="text">
                        </div>
                     </div>
                     <div class="col">
                        <div class="form-group">
                           <label  for="name">Unit
                           </label>
                           <select class="form-control" name="unit">
                              <option value="">Choose option</option>
                              <?php 
                                 $unit = $db->selectAll("units")->fetchAll();
                                   foreach ($unit as $u) {  ?>
                              <option value="<?=$u['unit_id']?>"><?=$u['unit_name']?></option>
                              <?php   }
                                 ?>
                           </select>
                           <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#myModal">Add new unit</button>
                        </div>
                     </div>
                     <div class="col">
                        <div class="form-group">
                           <label  for="name">Purchasing Price <span class="required">*</span>
                           </label>
                           <input id="purchasingprice" class="form-control" name="purchasingprice"  required="required" type="text">
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col">
                        <div class="form-group">
                           <label  for="name">Selling Price <span class="required">*</span>
                           </label>
                           <input id="sellingprice" class="form-control"  name="sellingprice"  required="required" type="text">
                        </div>
                     </div>
                     <div class="col">
                        <div class="form-group">
                           <label  for="name">Re-order warning <span class="required">*</span>
                           </label>
                           <input type="number" class="form-control" name="re-order-warning" id="re-order-warning">
                        </div>
                     </div>
                     <div class="col">
                        <div class=" form-group">
                           <label  for="textarea">Description
                           </label>
                           <textarea id="description"  name="description" class="form-control col-md-7 col-xs-12"></textarea>
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="col-md-6 col-md-offset-3">
                        <button type="submit" class="btn btn-primary">Cancel</button>
                        <button id="saveusers" name="saveproduct" type="submit" class="btn btn-success">Submit</button>
                     </div>
                  </div>
               </form>
            </div>
         </div>
         <?php 
            if (isset($_POST['saveproduct'])) {



                  $alredythere = $db->joinQuery("SELECT COUNT(*) as existalready FROM `product_info` WHERE `pro_id`='".$_POST['productid']."'")->fetch(PDO::FETCH_ASSOC);
                if ($alredythere['existalready']>0) {
                   echo "<h3 style='color:red'>This name is already there, try different name</h3>";
                   exit();
                }
            
                 $data = array(
                  'pro_id' => $_POST['productid'], 
                  'product_cat' => $_POST['category'],  
                  'pro_name' => $_POST['productname'], 
                  'unit' => $_POST['unit'],
                  'opening_stock' => $_POST['openingstock'],
                  'purchase_price' => $_POST['purchasingprice'],
                  'selling_price' => $_POST['sellingprice'],
                  're_order_warning' => $_POST['re-order-warning'],
                  'description' => $_POST['description'],
                  'created_at' => date("Y-m-d") 
                );
                if (!empty($_POST['productid'])) {
                    if ($db->insert("product_info",$data)) { ?>
                      <script>alert('Data has been saved')</script>
                        
                  <?php   } else {
                      echo "<h1 style='color:red'>Data has not been saved</h1>";
                    }
                }else{
                    echo "<h1 style='color:red'>Fields are empty</h1>";
                }
            }
            ?>
      </div>
   </div>
   <!-- users view section starts here -->
   <div class="row">
      <div class="col">
         <?php 
            $sql =  "SELECT * FROM `product_info`";
            $i =0;
            
            $data = $db->joinQuery($sql)->fetchAll();
            
            ?>
         <table class="table table-condensed table-bordered table-hover table-striped" id="myTable" >
            <thead>
               <tr>
                  <th>#</th>
                  <th>ProductID</th>
                  <th>Product Name</th>
                  <th>Purchase Price</th>
                  
                  <th>Sale Price</th>
                 
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
               <?php 
                  foreach ($data as $val) {  $i++; 
                     ?>
               <tr>
                  <th scope="row"><?=$i?></th>
                  <td><?=$val['pro_id']?></td>
                  <td><?=$val['pro_name']?></td>
                  
                  <td><?=$val['purchase_price']?></td>
                  <td><?=$val['selling_price']?></td>
                  <td><a class="btn btn-dark" href="edit-product.php?edit-id=<?=$val['p_id']?>">Edit</a>|
                    <a href="product.php?del-id=<?=$val['p_id']?>" onclick="return confirm('Are you sure?')" class="btn btn-sm btn-danger">Delete</a></td>
               </tr>
               <?php   }
                  ?>
            </tbody>
         </table>
      </div>
   </div>
</div>
</div>
<?php include 'files/footer.php'; ?>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
   <div class="modal-dialog">
      <!-- Modal content-->
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Add all the units</h4>
         </div>
         <div class="modal-body">
            <form action="" class="form" method="post">
               <div class="form-group"><label for="">Unit Name</label>
                  <input type="text" class="form-control" name="unitname">
               </div>
               <div class="form-group"><label for="">Unit Description</label>
                  <textarea class="form-control" name="description"></textarea>
               </div>
               <button type="submit" name="unitssave"  class="btn btn-primary">Save</button>
            </form>
            <?php 
               if (isset($_POST['unitssave'])) {
                       
                   $data = array(
                     'unit_name' => $_POST['unitname'], 
                     'unit_description' => $_POST['description']
                   );
               
                   if (!empty($_POST['unitname'])) {
                      if ($db->insert("units",$data)) {
                          echo "<h2 style='color:blue'> Unit Saved <h2>";
                     }else {
                           echo "<h2 style='color:red'> Unit is not saved <h2>";
                     }
                   }else {
                     echo "<h2 style='color:red'> Fields are empty <h2>";
                   }
               
                    
               
               }
               ?>
            <table class="table">
               <tr>
                  <th>SL</th>
                  <th>Name</th>
                  <th>Description</th>
                  <th>Actions</th>
               </tr>
               <?php 
                  $i=0;
                  $data = $db->selectAll("units")->fetchAll();
                  foreach ($data as $d) { $i++; ?> 
               <tr>
                  <td><?=$i?></td>
                  <td><?=$d['unit_name']?></td>
                  <td><?=$d['unit_description']?></td>
                  <td><a href="product.php?del-id=<?=$d['unit_id']?>" onclick="return confirm('Are you sure?')">Delete</a></td>
               </tr>
               <?php  }
                  ?>
            </table>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>