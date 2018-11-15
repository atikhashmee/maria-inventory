<?php include 'files/header.php'; ?>
<?php include 'files/menu.php'; ?>

<?php 
   if (isset($_GET['del-id'])) {
           if ($db->delete("purchase","billchallan = '".$_GET['del-id']."'")) {?>
<script> alert('Data has been deleted'); window.location.href='purchase.php'; </script>
<?php   }
   }

   ?>
<div class="container-fluid">
   <div class="row" style="margin-bottom: 22px;">
      <div class="col">
         <div class="bg-light card card-body" style=" background: #b4c6d8 !important">
            <h1 style="text-align: center;">Product Purchase</h1>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col">
         <form class="form-horizontal form-label-left" method="post"  name="allotherinfo" id="allotherinfo">
            <div class="row">
               <div class="col">
                  <div class="form-group">
                    <input type="hidden" name="atik">
                     <label  for="name">Date of Purchase <span class="required">*</span></label>
                     <input type="date"  name="datepurchase" id="datepurchase"  class="form-control">
                  </div>
               </div>
               <div class="col">
                  <div class=" form-group">
                     <label for="name">supplierName<span class="required">*</span></label>
                     <select class="form-control" name="suppliername" id="suppliername">
                        <option>Choose option</option>
                        <?php 
                           $cat  =  $db->joinQuery("SELECT * FROM `users` WHERE `user_role`='2'")->fetchAll();
                           foreach ($cat as $cater) { ?>
                        <option value="<?=$cater['u_id']?>"><?=$cater['name']?></option>
                        <?php } ?>
                     </select>
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col">
                  <div class="form-group">
                     <label  for="name">Product Category<span class="required">*</span></label>
                     <select class="form-control" name="productcat" id="productcat" onchange="getProduct()">
                        <option>Choose option</option>
                        <?php 
                           $cat  =  $db->joinQuery("SELECT * FROM `cateogory`")->fetchAll();
                           foreach ($cat as $cater) { ?>
                        <option value="<?=$cater['cat_id']?>"><?=$cater['cat_name']?></option>
                        <?php } ?>
                     </select>
                  </div>
               </div>
               <div class="col">
                  <div class="form-group">
                     <label  for="name">Product<span class="required">*</span></label>
                     <select class="form-control" name="product" id="product">
                     </select>
                  </div>
               </div>
            </div>
            <div class="row">
              
               <div class="col">
                  <div class="form-group">
                     <label  for="name">Quantity<span class="required">*</span>
                     </label>
                     <input id="quntity" class="form-control"  name="quntity" id="quntity"  type="text">
                  </div>
               </div>
            </div>
            <div class="row">
               <div class="col">
                  <div class="form-group">
                     <label  for="name">Price <span class="required">*</span>
                     </label>
                     <input id="price" class="form-control"  name="price" onblur="gettotalpric()" id="price"  type="text">
                  </div>
               </div>
               <div class="col">
                  <div class=" form-group">
                     <label  for="name">Total <span class="required">*</span>
                     </label>
                     <input id="totallprice" class="form-control"  name="totallprice" type="text">
                  </div>
               </div>
            </div>
            <div class="form-group">
               <div class="col-md-6 col-md-offset-3">
                  <button type="submit" class="btn btn-primary">Cancel</button>
                  <button id="saveusers" type="button" onclick="addtocart()" class="btn btn-success">Add to list</button>
               </div>
            </div>
      </div>
      <div class="col">
      <table class="table">
      <thead>
      <tr>
      <th>Item name</th>
      <th>Quantity</th>
      <th>price</th>
      <th>Total Price</th>
      </tr>
      </thead>
      <tbody id="mycartlists">
      </tbody>
      </table>
      </div>
   </div>
   <!-- <ul class="list-group" id="listgroup">
      </ul> -->
   <!--         <input type="hidden" name="productnameid[]" id="productnameid">
      <input type="hidden" name="productqunatityhidden[]" id="productqunatityhidden">
      <input type="hidden" name="productpricehideen[]" id="productpricehideen"> -->
   <!-- Use accounts sections  -->
   <div class="row">
   <div class="col">
   <div class="form-group">
<label for="">Bill/challan No</label>
<input type="text" class="form-control" name="billchallan" id="billchallan" placeholder="click on the button" required>
 <button type="button" onclick="gBCN()" class="btn btn-danger">Generate No</button>
</div>

</div>

<div class="col">
<div class="form-group" style="position: relative; top:20px; text-align: center;">
    <div class="custom-control custom-radio">
      <input type="radio" id="customRadio1" name="cashcheque" value="no"  class="custom-control-input" checked="">
      <label class="custom-control-label" for="customRadio1">Cash</label>
    </div>

    
   
  </div>
   <div id="cashoption">
   <div class="form-group">
   <label for="">Paid</label>
   <input type="text" class="form-control" id="nowpayment" name="nowpayment" onblur="nowwpayment()">
   </div>
   <div class="form-group">
   <label for="">Due Balance</label>
   <input type="text" class="form-control" name="billbalance" id="billbalance">
   </div>
   </div>
   
   </div>
   <div class="col">
   
   <div class="form-group">
   <label for="">Total</label>
   <input type="text" class="form-control" id="subtotalbeforecommsion" name="subtotalbeforecommsion" value="0">
   </div>
   <div class="row">
     <div class="col">
       
   <div class="form-group">
   <label for="">Discount</label>
   <input type="text" class="form-control" id="discount" name="discount" onblur="getpricediscounted()">
   </div>
     </div>
      
   </div>
   
  
   <div class="form-group">
   <label for="">Grand Total</label>
   <input type="text" class="form-control" id="grandtotalaftercommision">
   </div>
   </div>
 </div>
 <div class="row">

<div class="col">

  </div>

   <div class="col">
  
   </div>
 </div>
   <button type="button" style="margin: 0 auto;" class="btn btn-lg btn-primary" name="savepurchaseinfo" onclick="savePurchaseinfo()">Save Purchase Information </button>
   
   </form>
   </div>

   <div class="container">
     <div class="row">
       <div class="col">
  <table class="table table-bordered table-striped  table-condensed" id="myTable">
           <thead>
             <tr>
               <th>SL</th>
               <th>Bill/challan No</th>
               <th>Supplier</th>
               <th>Product</th>
               <th>Quantity</th>
               <th>Price</th>
               
              
               <th>Grand Total </th>
               
               <th>Purchase Date</th>
               <th>Action</th>
             </tr>
           </thead>
           <tbody>
            <?php 
        error_reporting(0);
            $i=0;
            $purchase = $db->selectAll("purchase")->fetchAll();
            foreach ($purchase as $pur) {  $i++; ?>
                  
                  <tr>
                    <td><?=$i?></td>
                    <td><?=$pur['billchallan']?></td>
                    <td><?=$fn->getUserName($pur['supplier'])?></td>
                    <td><?=$fn->getProductName($pur['productid'])?></td>
                    <td><?=$pur['quantity']?></td>
                    <td><?=$pur['price']?></td>
                  
                    
                    <td><?=($pur['quantity'] * $pur['price']) - ($pur['comdiscount']/100 * ($pur['quantity'] * $pur['price']))?></td>
                    
                    <td><?=$pur['purchasedate']?></td>
                    <td><a class="btn btn-danger btn-sm" href="purchase.php?del-id=<?=$pur['billchallan']?>" onclick="return confirm('Are you sure?')">Delete</a></td>
                  
                  </tr>


           <?php  }

          ?>
           </tbody>
         </table>
       </div>
     </div>
   </div>

<?php include 'files/footer.php'; ?>
<script src="assets/js/jquery.js"></script>
<script type="text/javascript">
   <?php 
      $pro = $db->selectAll("product_info");
       $products =  [];
      while ($prlist = $pro->fetch(PDO::FETCH_ASSOC)) {                 
       $products[$prlist['pro_id']] = $prlist['pro_name'];
      }
      ?>
   
   var prod = <?php echo json_encode($products);?>;
    /*alert(brnds[1]);
    alert(sizzz[1]);*/
   
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
   // console.log(data[0].p_id);
   
   })
   .fail(function() {
   console.log("error");
   })
   .always(function() {
   console.log("complete");
   });
   
   
   }
   
   var  purchaseitem  = [];
   var totalsum = 0;
   
   function addtocart(){
   
   var suppliername = $("#suppliername").val();
   var pcategory = $("#productcat").val();
   var pname = $("#product").val();
   var quantity =  $("#quntity").val();
   var price =  $("#price").val();
   
     if (ifExist(pname)===0) {
       
       purchaseitem.push(new productobj(suppliername,pcategory,pname,quantity,price)); //pushing every item to the cart so that i can retrive and modified in the cart 
     $("#mycartlists").append('<tr> <td>'+prod[$("#product").val()]+'</td>  <td>'+quantity+'</td>   <td>'+price+'</td> <td class="totatlbalnceshow">'+price*quantity+'</td> </tr>');
       totalsum += parseInt((price*quantity));
     $("#subtotalbeforecommsion").val(totalsum); // value gets updated everytime a new item get added to the cart
   }else {
     alert("This product is already in the cart");
   }
     
   }
   
   var productobj = function(sname,pcat,pname,quntity,price){ //declaring the object to design all the item in the cart 
   this.name = sname;
   this.pcat = pcat;
   this.pname = pname;
   this.quntity = quntity;
   this.price  =  price;
   }
   
   function ifExist(pid){  //to check the cart , whether a product is exist in the cart or not
   for(var j =0; j<purchaseitem.length; j++){
   if( purchaseitem[j].pname === pid)
     return 1;
   }
   return 0;
   }
   
   
   
   
   function gettotalpric(){  // get the product price tlst after putting the quntoty and producdt price
       $("#totallprice").val(parseInt($("#quntity").val()) * parseInt($("#price").val()))
   }
   
   
  
   
   
    function getpricediscounted(){ // when user is using direct money to be deducted
        var com =  $("#discount").val();
     var totalprice =  $("#subtotalbeforecommsion").val();
     $("#grandtotalaftercommision").val(  totalprice - com );
    }
   
   
   
     function nowwpayment(){   //billl payment after calculating the total
         $("#billbalance").val( $("#grandtotalaftercommision").val() - $("#nowpayment").val() )
     }
   
   
   
   
   
   
     function savePurchaseinfo(){

      if ($("#billchallan").val().length === 0) {
            alert('Bill/challan no is empty');
       }else {
   
     var tex = confirm("Are you sure ? ");
       if (tex ===  true) {
            $.ajax({
            url:'ajax/add_new_purchase_info.php?item='+JSON.stringify(purchaseitem)+"&allotherinfo="+$("#allotherinfo").serialize(),
            type: 'GET',
          
          })
          .done(function(res) {
            console.log(res);
            window.location.href="purchase.php";
   
          })
          .fail(function() {
            console.log("error");
          })
          .always(function() {
            console.log("complete");
          });
       }else{
         alert("You discard the purchase ");
       }

     }
   
         
           //console.log(purchaseitem+"= "+$("#allinfo").serialize())
   
     }
   

   
   


   
   
   
   
   
   
    function gBCN() {
     var d =  new Date();
    $("#billchallan").val(d.getFullYear()+""+ parseInt(d.getMonth()+1)+""+d.getDate()+""+d.getHours() +""+d.getMinutes()+""+d.getSeconds());
   }
   
   
   
   
   
   
</script>