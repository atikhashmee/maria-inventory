<?php include 'files/header.php'; ?>
<?php include 'files/menu.php'; ?>



<?php 
   if (isset($_GET['del-id'])) {
           if ($db->delete("sell","billchallan = '".$_GET['del-id']."'")) {?>
<script> alert('Data has been deleted'); window.location.href='order_management.php'; </script>
<?php   }
   }
   
   ?>
<div class="container-fluid">
   <div class="row">
      <div class="col">
         <div class="bg-light card card-body" style=" background: #b4c6d8 !important">
            <h1 style="text-align: center;">Order Management</h1>
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
            <th>Product</th>
            <th>Quantity</th>
            <th>Price</th>
            <th>Total</th>
            <th>Discount</th>
           
            <th>Grand Total</th>
            <th>sell Date</th>
            
            <th>Action </th>
          </tr>
        </thead>
        <tbody>
          <?php 
        
            $i=0;
            $sql = "SELECT * FROM `sell`";
            if (isset($_GET['filter'])) {
               $sql .="WHERE `selldate` BETWEEN '".$_GET['start']."' AND '".$_GET['to']."'";
            }
            $sellinfo = $db->joinQuery($sql)->fetchAll();
            foreach ($sellinfo as $sel) {  $i++; ?>
                 
        
                  <tr>
                    <td><?=$i?></td>
                    <td><?=$sel['billchallan']?></td>
                    <td><?=$fn->getUserName($sel['customerid'])?></td>
                    
                    <td><?=$fn->getProductName($sel['productid'])?></td>
                    <td><?=$sel['quantity']?></td>
                    <td><?=$sel['price']?></td>
                    <td><?=$sel['quantity'] * $sel['price'] ?></td>
                    <td><?=$sel['discount']?></td>
                    
                    <td><?=($sel['quantity'] * $sel['price']) - ($sel['discount'])?></td>
                    <td><?=$sel['selldate']?></td>
                    
                    <td>
                     <a class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false"></a>
                <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 40px, 0px); top: 0px; left: 0px; will-change: transform;">
                  <a class="dropdown-item" href="#" id="forprint" key-id="<?=$sel['billchallan']?>" onclick="saveprint()">Print</a>
                  <a class="dropdown-item" href="payment_adjustment.php?invoiceid=<?=$sel['billchallan']?>">Adjustment</a>
                  <a class="dropdown-item" href="order_management.php?del-id=<?=$sel['billchallan']?>" onclick="return confirm('Are you sure?')">Delete</a>
                </div>
              </a>
                      </td>
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
<!-- making pdf using jspdf -->
<script src="pdf/pdffile1.js"></script>
<script src="pdf/pdffile2.js"></script>



<script type="text/javascript">

        
        function saveprint () {
          
            var keyid =  document.getElementById('forprint');
              var invoiceno = keyid.getAttribute("key-id");
              alert(invoiceno);
              $.ajax({
                url: 'ajax/getsellinfobymemo.php?memo='+invoiceno
              })
              .done(function(res) {
                 elements = JSON.parse(res);
                printPdf(elements,invoiceno)
              })
              .fail(function() {
                console.log("error");
              })
              .always(function() {
                console.log("complete");
              });
              
            
          
           
        }






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
   
   var  purchaseitem  = [];
   var totalsum = 0;
   
   function addtocart(){
   
   var cutomername = $("#cutomername").val();
   var pcategory = $("#productcat").val();
   var pname = $("#product").val();
   var quantity =  $("#quntity").val();
   var price =  $("#price").val();
   
     if (ifExist(pname)===0) {
       $("#productnameid").val(pname);
       $("#productqunatityhidden").val(quantity);
       $("#productpricehideen").val(price);
       purchaseitem.push(new productobj(cutomername,pcategory,pname,quantity,price)); //pushing every item to the cart so that i can retrive and modified in the cart 
     $("#mycartlists").append('<tr> <td>'+$("#product").text()+'</td>  <td>'+quantity+'</td>   <td>'+price+'</td> <td class="totatlbalnceshow">'+price*quantity+'</td> </tr>');
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
            url: 'ajax/addnewsellinfo.php?item='+JSON.stringify(purchaseitem)+"&allinfo="+$("#allotherinfo").serialize(),
            type: 'GET',
          
          })
          .done(function(res) {
            console.log(res);
          //  alert('res');
            alert("Product has been sold out ");
            window.location.href="sellproduct.php";
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
   
   
   
   
     // check the ccustomer due 
   
     function checkTheCurrenDue(){
       var cusid  =  document.getElementById('cutomername').value;
   
           $.ajax({
             url: 'ajax/checkcurrentdue.php?custom_id='+cusid,
             type: 'POST',
            
           })
           .done(function(res) {
             document.getElementById('cuduemoney').value = res;
             console.log("success");
           })
           .fail(function() {
             console.log("error");
           })
           .always(function() {
             console.log("complete");
           });
           
     }

        
     // check the radio button to show the cheque payment method
      function chequeoptioncheck(){
        var divid  = document.getElementById('chequeoption');
       var radio  =  document.getElementById('customRadio2');
       var cashoption = document.getElementById('cashoption');
        if (radio.checked === true){
          divid.style.display = 'inline-block';

          cashoption.style.display  = 'none';
          
        }else {
          divid.style.display = 'none';
           cashoption.style.display  = 'inline-block';
        }

      }

   
   function gBCN() {
     var d =  new Date();
 $("#billchallan").val(d.getFullYear()+""+ parseInt(d.getMonth()+1)+""+d.getDate()+""+d.getHours() +""+d.getMinutes()+""+d.getSeconds());
   }
      


   //pdf genereator
        function printPdf (elements,invoice) {
          
                  var columns = [
            {title: "SL", dataKey: "sl"},
            {title: "Product", dataKey:"pro"},
            {title: "Price", dataKey:"price"}, 
            {title: "Quantity", dataKey: "quantity"},
        ];

        var rows=[];
        var sum = 0;
        for (var i = 0,j=1; i < elements.length; i++,j++) {
         rows.push({"sl":j,"pro":prod[elements[i].productid],"price":elements[i].price,"quantity":elements[i].quantity});
          sum += parseInt(elements[i].quantity);
        }
        rows.push({"sl":" ","desc":" ","category":"Total amount = ","amount":sum});
        
        // Only pt supported (not mm or in)
        var doc = new jsPDF('p', 'pt');
        
        doc.autoTable(columns, rows, {
            theme: 'grid',
            styles: {
            
              columnWidth: 'auto'
            },
            columnStyles: {
              id: {fillColor: 0}
            },
            alternateRowStyles: {
              fillColor: 255
            },
            margin: {top: 150},
            addPageContent: function(data) {
             

            }
        });
       // doc.setDrawColor(100);
        //doc.setFillColor(false);
        doc.rect(350, 30, 200, 20, 'S'); //Fill and Border
        doc.rect(350, 50, 200, 20, 'S'); //Fill and Border
        doc.setFontSize(16);
        doc.setFontType('Times');
        doc.text("Invoice : "+invoice,350, 45);
        doc.text("Date : "+elements[0].selldate, 350, 65);

        doc.setFontSize(26);
        doc.text("Apsara Apparels design", 40, 30);
        doc.setFontSize(12);
        doc.text("House # 04, Road # 05, Sector # 06, Uttara, Dhaka", 40, 50);
        doc.text("Tel: 0088-02-7912748", 40, 70);
        




        //---------downbelow
        doc.setFontSize(16);
        doc.setTextColor(0,0,0);
        doc.rect(50, 750, 100, 45, 'S');
        doc.text("Prepared By",55,790);
        doc.rect(150, 750, 100, 45, 'S');
         doc.text("Paid By",155,790);
        doc.rect(250, 750, 100, 45, 'S');
        doc.text("Recipent",255,790);
        doc.rect(350, 750, 100, 45, 'S');
        doc.text("Checked By",355,790);
        doc.rect(450, 750, 100, 45, 'S');
         doc.text("Approved By",455,790);
          doc.save("Voucher.pdf");
        }

   
   
</script>