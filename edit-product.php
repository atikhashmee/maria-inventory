<?php include 'files/header.php'; ?>
<?php include 'files/menu.php'; 
  

  if (isset($_GET['edit-id'])) {
            $editdata =  $db->selectAll('product_info','p_id = '.$_GET['edit-id'].'')->fetch(PDO::FETCH_ASSOC);
        }

?>

<div class="container-fluid">
  <div class="row">
       <div class="col">
         <div class="bg-light card card-body" style=" background: #b4c6d8 !important">
          <h1 style="text-align: center;">Edit Product</h1>
         </div>
       </div>
     </div>
   <div class="row">


     



      <div class="col">
         <div class="card border-primary">
            <div class="card-header">Add new Product</div>
            <div class="card-body">
               <form class="form-horizontal form-label-left" method="post" >
                  <div class="row">
                     <div class="col">
                        <div class="form-group">
                           <label for="name">Product ID  </label>
                           <input id="productid" class="form-control" name="productid"   type="text" value="<?=$editdata['pro_id']?>">
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
                           <label  for="name">Select a Brand
                           </label>
                           <select class="form-control" name="brand">
                              <option value="">Choose option</option>
                              <?php 
                                 $brand  =  $db->joinQuery("SELECT * FROM `p_brand`")->fetchAll();
                                 foreach ($brand as $bran) { ?>
                              <option value="<?=$bran['brand_id']?>"><?=$bran['brand_name']?></option>
                              <?php   }
                                 ?>
                           </select>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col">
                        <div class="form-group">
                           <label for="name">Product Name
                           </label>
                           <input type="text" name="productname" class="form-control" value="<?=$editdata['pro_name']?>" >
                           
                        </div>
                     </div>
                     <div class="col">
                        <div class="form-group">
                           <label  for="name">Quantity       </label>
                           <input id="openingstock" class="form-control"  name="openingstock"   type="text" value="<?=$editdata['opening_stock']?>">
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
                           <input id="purchasingprice" class="form-control" name="purchasingprice"  type="text" value="<?=$editdata['purchase_price']?>">
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col">
                        <div class="form-group">
                           <label  for="name">Selling Price <span class="required">*</span>
                           </label>
                           <input id="sellingprice" class="form-control"  name="sellingprice"  type="text" value="<?=$editdata['selling_price']?>">
                        </div>
                     </div>
                     <div class="col">
                        <div class="form-group">
                           <label  for="name">Re-order warning 
                           </label>
                           <input type="number" class="form-control" name="re-order-warning" id="re-order-warning" value="<?=$editdata['re_order_warning']?>">
                        </div>
                     </div>
                     <div class="col">
                        <div class=" form-group">
                           <label  for="textarea">Description
                           </label>
                           <textarea id="description"  name="description" class="form-control col-md-7 col-xs-12"><?=$editdata['description']?></textarea>
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="col-md-6 col-md-offset-3">
                        
                        <button name="updatebtn" type="submit" class="btn btn-warning">Update</button>
                     </div>
                  </div>
               </form>
            </div>
         </div>
         <?php 
            if (isset($_POST['updatebtn'])) {



                  /*$alredythere = $db->joinQuery("SELECT COUNT(*) as existalready FROM `product_info` WHERE `pro_id`='".$_POST['productid']."'")->fetch(PDO::FETCH_ASSOC);
                if ($alredythere['existalready']>0) {
                   echo "<h3 style='color:red'>This name is already there, try different name</h3>";
                   exit();
                }*/

    $cate = empty($_POST['category'])?$editdata['product_cat']:$_POST['category'];
    $bra = empty($_POST['brand'])?$editdata['brand_id']:$_POST['brand'];
    $unit = empty($_POST['unit'])?$editdata['unit']:$_POST['unit'];
          $data = array(
           'pro_id' => $_POST['productid'], 
           'product_cat' => $cate, 
           'brand_id' => $bra, 
           'pro_name' => $_POST['productname'], 
           'unit' => $unit,
           'opening_stock' => $_POST['openingstock'],
           'purchase_price' => $_POST['purchasingprice'],
           'selling_price' => $_POST['sellingprice'],
           're_order_warning' => $_POST['re-order-warning'],
           'description' => $_POST['description'],
           'created_at' => date("Y-m-d") 
          );
                if (!empty($_POST['productid'])) {
                    if ($db->update("product_info",$data,'p_id ='.$_GET['edit-id'].'')) { ?>
                        <script>alert('Data has been Updated'); 
                   window.location.href='product.php';</script>
                 <?php    } else {
                      echo "<h1 style='color:red'>Data has not been saved</h1>";
                    }
                }else{
                    echo "<h1 style='color:red'>Fields are empty</h1>";
                }
            }
            ?>
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
               <button type="submit" name="unitssave"  class="btn btn-warning">Save</button>
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
                  <td>

                    <a href="product.php?del-id=<?=$d['unit_id']?>" onclick="return confirm('Are you sure?')">Delete</a></td>
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