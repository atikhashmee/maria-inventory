<?php include 'files/header.php'; ?>
<?php include 'files/menu.php'; 
      
        if (isset($_GET['edit-id'])) {
            $editdata =  $db->selectAll('cateogory','cat_id = '.$_GET['edit-id'].'')->fetch(PDO::FETCH_ASSOC);
        }

        if (isset($_GET['del-id'])) {
             if ($db->delete('cateogory','cat_id = '.$_GET['del-id'].'')) {
                   ?><script>alert('Data has been deleted'); 
                   window.location.href='category.php';</script><?php 
             }
        }
  
 ?>
<div class="container-fluid">
   <div class="row ">
      <div class="col">
         <div class="bg-light card card-body header-wrapper" style=" background: #b4c6d8 !important">
            <h1 style="text-align: center;">Prodcut Category</h1>
         </div>
      </div>
   </div>
   <div class="row" style="margin-top: 20px">
      <div class="col">
         <div class="card border-primary">
            <div class="card-header">Add new Category</div>
            <div class="card-body">
              <?php 
                if (isset($_GET['edit-id'])) { ?>
                  <form class="form-horizontal form-label-left" method="post" >
                  <div class="form-group">
                     <label for="name"> Name </label>
                     <input id="cat_name" class="form-control"  name="cat_name"  type="text" value="<?=$editdata['cat_name']?>">
                  </div>
                  <div class="form-group">
                     <label  for="textarea">Description 
                     </label>
                     <textarea id="description"  name="description" class="form-control"><?=$editdata['cat_description']?></textarea>
                  </div>
                  <div class="form-group">
                     <div class="col-md-6 col-md-offset-3">
                        
                        <button name="updatebtn" type="submit" class="btn btn-warning">Update</button>
                     </div>
                  </div>
               </form>
                <?php  } else { ?>
                  <form class="form-horizontal form-label-left" method="post" >
                  <div class="form-group">
                     <label for="name"> Name <span class="required">*</span>
                     </label>
                     <input id="cat_name" class="form-control"  name="cat_name"  required="required" type="text">
                  </div>
                  <div class="form-group">
                     <label  for="textarea">Description 
                     </label>
                     <textarea id="description"  name="description" class="form-control"></textarea>
                  </div>
                  <div class="form-group">
                     <div class="col-md-6 col-md-offset-3">
                        <button type="submit" class="btn btn-primary">Cancel</button>
                        <button id="saveusers" name="savecat" type="submit" class="btn btn-success">Submit</button>
                     </div>
                  </div>
               </form>

               <?php  }

              ?>
               
            </div>
         </div>
         <?php 
            if (isset($_POST['savecat'])) {
            
                 $data = array(
                  'cat_name' => $_POST['cat_name'], 
                  'cat_description' => $_POST['description'],
                  'cat_created_at' => date("Y-m-d") 
                );
                if (!empty($_POST['cat_name'])) {
                    if ($db->insert("cateogory",$data)) {
                        echo "<h1 style='color:blue'>Data has been saved</h1>";
                    } else {
                      echo "<h1 style='color:red'>Data has not been saved</h1>";
                    }
                }else{
                    echo "<h1 style='color:red'>Fields are empty</h1>";
                }
            }


            if (isset($_POST['updatebtn'])) {

                $data = array(
                  'cat_name' => $_POST['cat_name'], 
                  'cat_description' => $_POST['description'],
                  'cat_created_at' => date("Y-m-d") 
                );
                if (!empty($_POST['cat_name'])) {
                    if ($db->update("cateogory",$data,'cat_id = '.$_GET['edit-id'].'')) {
                        echo "<h1 style='color:blue'>Data has been Updated</h1>";
                    } else {
                      echo "<h1 style='color:red'>Data has not been Updated</h1>";
                    }
                }else{
                    echo "<h1 style='color:red'>Fields are empty</h1>";
                }
            }
            
            
            ?>
      </div>
      <!-- users view section starts here -->
      <div class="col">
         <?php 
            $sql =  "SELECT * FROM `cateogory`";
            $i =0;
            
            $data = $db->joinQuery($sql)->fetchAll();
            
            ?>
         <table class="table table-striped table-condensed table-bordered" id="myTable">
            <thead>
               <tr>
                  <th>#</th>
                  <th>Name</th>
                  <th>Description</th>
                  <th>Action</th>
               </tr>
            </thead>
            <tbody>
               <?php 
                  foreach ($data as $val) {  $i++; ?>
               <tr>
                  <th scope="row"><?=$i?></th>
                  <td><?=$val['cat_name']?></td>
                  <td><?=$val['cat_description']?></td>
                  <td> <a class="btn btn-dark" href="category.php?edit-id=<?=$val['cat_id']?>">Edit</a>
      <a class="btn btn-danger" href="category.php?del-id=<?=$val['cat_id']?>" onclick="return confirm('Are you sure?')">Delete</a></td>
               </tr>
               <?php   }
                  ?>
            </tbody>
         </table>
      </div>
   </div>
</div>
<?php include 'files/footer.php'; ?>