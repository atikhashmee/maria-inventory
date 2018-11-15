
<style type="text/css">
  @import url("//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css");

.navbar-icon-top .navbar-nav .nav-link > .fa {
  position: relative;
  width: 36px;
  font-size: 24px;
}

.navbar-icon-top .navbar-nav .nav-link > .fa > .badge {
  font-size: 0.75rem;
  position: absolute;
  right: 0;
  font-family: sans-serif;
}

.navbar-icon-top .navbar-nav .nav-link > .fa {
  top: 3px;
  line-height: 12px;
}

.navbar-icon-top .navbar-nav .nav-link > .fa > .badge {
  top: -10px;
}

@media (min-width: 576px) {
  .navbar-icon-top.navbar-expand-sm .navbar-nav .nav-link {
    text-align: center;
    display: table-cell;
    height: 70px;
    vertical-align: middle;
    padding-top: 0;
    padding-bottom: 0;
  }

  .navbar-icon-top.navbar-expand-sm .navbar-nav .nav-link > .fa {
    display: block;
    width: 48px;
    margin: 2px auto 4px auto;
    top: 0;
    line-height: 24px;
  }

  .navbar-icon-top.navbar-expand-sm .navbar-nav .nav-link > .fa > .badge {
    top: -7px;
  }
}

@media (min-width: 768px) {
  .navbar-icon-top.navbar-expand-md .navbar-nav .nav-link {
    text-align: center;
    display: table-cell;
    height: 70px;
    vertical-align: middle;
    padding-top: 0;
    padding-bottom: 0;
  }

  .navbar-icon-top.navbar-expand-md .navbar-nav .nav-link > .fa {
    display: block;
    width: 48px;
    margin: 2px auto 4px auto;
    top: 0;
    line-height: 24px;
  }

  .navbar-icon-top.navbar-expand-md .navbar-nav .nav-link > .fa > .badge {
    top: -7px;
  }
}

@media (min-width: 992px) {
  .navbar-icon-top.navbar-expand-lg .navbar-nav .nav-link {
    text-align: center;
    display: table-cell;
    height: 70px;
    vertical-align: middle;
    padding-top: 0;
    padding-bottom: 0;
  }

  .navbar-icon-top.navbar-expand-lg .navbar-nav .nav-link > .fa {
    display: block;
    width: 48px;
    margin: 2px auto 4px auto;
    top: 0;
    line-height: 24px;
  }

  .navbar-icon-top.navbar-expand-lg .navbar-nav .nav-link > .fa > .badge {
    top: -7px;
  }
}

@media (min-width: 1200px) {
  .navbar-icon-top.navbar-expand-xl .navbar-nav .nav-link {
    text-align: center;
    display: table-cell;
    height: 70px;
    vertical-align: middle;
    padding-top: 0;
    padding-bottom: 0;
  }

  .navbar-icon-top.navbar-expand-xl .navbar-nav .nav-link > .fa {
    display: block;
    width: 48px;
    margin: 2px auto 4px auto;
    top: 0;
    line-height: 24px;
  }

  .navbar-icon-top.navbar-expand-xl .navbar-nav .nav-link > .fa > .badge {
    top: -7px;
  }
}
</style>

<div class="container-fluid">
     

     <div class="row">
       <div class="col">

           <nav class="navbar navbar-icon-top navbar-expand-lg navbar-dark bg-dark">

  <a class="navbar-brand" href="home.php"> Apsara Apparels design  </a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="home.php">
          <i class="fa fa-home"></i>
          Home
          <span class="sr-only">(current)</span>
          </a>
      </li>
      <li class="nav-item">
        <div class="dropdown">
<button class="btn btn-primary dropdown-toggle" type="button" id="about-us" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
 <i class="fa fa-envelope-o">
            <span class="badge badge-danger" id="cnt">0</span>
          </i>
          Notification
</button>
<div class="dropdown-menu" id="notify" aria-labelledby="about-us">



</div>
</div>
      </li>

      
    </ul>
    <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="text" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form>
  </div>
</nav>




   

         <nav class="navbar navbar-expand-lg navbar-light bg-light header-color">
  <a class="navbar-brand" href="home.php"><!-- something can be written here --></a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      </li>
       <li class="nav-item">
       <a class="nav-link" href="addnew_users.php">Person</a>
      </li>
     
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Product
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
           <a class="dropdown-item" href="category.php">Product Category</a>
           
          <a class="dropdown-item" href="product.php">Add new Product</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="purchase.php">Product Purchase</a>
          <a class="dropdown-item" href="purchase_return.php">Purchase Return</a> 
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="sellproduct.php">Product Order</a>
          <a class="dropdown-item" href="order_management.php">Manage Order</a>
          <a class="dropdown-item" href="sell_return.php">Order Return</a>
        </div>
      </li>

       <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Reports
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          
          <a class="dropdown-item" href="stock-report.php">Stock Report</a>
          <a class="dropdown-item" href="customer-wise-report.php">Customerwise product Report</a>
          <a class="dropdown-item" href="customer-wise-payment-report.php">Customer Payment Report</a>

          
          <div class="dropdown-divider"></div>

          <a class="dropdown-item" href="supplier-product-report.php">Supplierwise Product Report </a>
          <a class="dropdown-item" href="chartreport.php">Chart Report </a>
          
         
        </div>
      </li> 
      <!-- <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li> -->
      <li class="nav-item">
        <a class="nav-link" href="setting.php">Settings</a>
      </li><li class="nav-item">
        <a class="nav-link" href="logout.php">logout</a>
      </li>
     
    </ul>
    
  </div>
</nav>
       </div>
     </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
  $.ajax({
    url: 'ajax/notifications.php'
  })
  .done(function(res) {
    //console.log(res);
    var data =  JSON.parse(res);
    var text = '';
    for (var i = 0; i < data.length; i++) {
      text += '<a class="dropdown-item" href="#"><b>'+data[i].productsid+'</b> has become below <b>'+data[i].proquantity+'</b></a>';
    } 
    $("#notify").html(text);
    $("#cnt").text(data.length);
  })
  .fail(function() {
    console.log("error");
  })
  .always(function() {
    console.log("complete");
  });


  
</script>




