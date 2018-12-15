



<?php include 'files/header.php'; ?>
<?php include 'files/menu.php'; ?>

   <style type="text/css">
     @import url(https://fonts.googleapis.com/css?family=Exo+2:400,900);
body{
  font-family: 'Exo 2', sans-serif;
  background:#eceff1;
}


h1{
  color:white;
  font-weight:900;
  margin-top: 0;
}
h4{
  color:white;
}
.winnersgraph{
  width: 90%;
  position: relative;
  margin: 10px auto;
  padding: 0;
}
#winners{
  width: 100%;  
}
.winners-list{
  margin-bottom: 0;
  padding: 40px 0;
}
.winners-list dt, .winners-list dd{
  margin: 0;
}
.winners-list dt{
  color:white;
  font-size:1.2em;
  font-weight:400;
  letter-spacing:0.05em;
}
.winners-list dd{
  color:#78909c;
  font-size:0.90em;
}
   </style>

   <?php
          function getQuantityTotal($pid)
          {
             $pq = $GLOBALS['db']->joinQuery('SELECT SUM(`quantity`) as total FROM `sell` WHERE `productid`="'.$pid.'"')->fetch(PDO::FETCH_ASSOC);
             return $pq['total'];
          }

        $products = $db->joinQuery('SELECT DISTINCT `productid` FROM `sell`')->fetchAll();

          $darray = array();
         for ($i=0; $i <count($products); $i++) { 
            $darray[$products[$i][0]] = getQuantityTotal($products[$i][0]);
         }
          
  ?>
  <div class="container-fluid">
  	<div class="row">
      <div class="col"></div>

  		<div class="col">
        
  		<div id="piechart"></div>
      </div>
       <div class="col"></div>

  		
  		
  	</div>

    <div class="row" style="margin-top: 45px">
       <div class="col"></div>
      <div class="col">
        <div id="columnchart_values" style="width: 900px; height: 300px;"></div>
      </div>
       <div class="col"></div>
      
    </div>
  </div>




<?php include 'files/footer.php'; ?>
<!-- <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script> -->
<script type="text/javascript" src="assets/js/jquery.js"></script>
<script type="text/javascript" src="assets/js/chartloader.js"></script>
<!-- <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script> -->
<script type="text/javascript">

  <?php 
      $pro = $db->selectAll("product_info");
       $products =  [];
       $productstock = [];
      while ($prlist = $pro->fetch(PDO::FETCH_ASSOC)) {                 
       $products[$prlist['pro_id']] = $prlist['pro_name'];
       $productstock[$prlist['pro_id']] = $fn->myQuantity($prlist['pro_id']);

      }
      ?>
   
   var prod = <?php echo json_encode($products);?>;
   

      //pie chart code starts here

    var da = <?=json_encode($darray);?>;
     //console.log(da);
       var myvalue=[];
      for(var key in da)  myvalue.push([key, parseInt(da[key])] );
      myvalue.sort(function(a, b) {
   return a[1] > b[1] ? 1 : a[1] < b[1] ? -1 : 0 ;
  });
      //console.log(myvalue);

    /*console.log(Object.keys(da));
    console.log(Object.values(da));*/
    var dakey = Object.keys(da);
    var daval = Object.values(da);

    var x = [];
    for (var i=0; i<myvalue.length; i++) {
        x.push([prod[myvalue[i][0]], Math.floor(myvalue[i][1])]);
    }
    x.reverse();
    var chartdata = [];
    chartdata.push(['product', 'sell per year']);
    for (var i = 0; i <=2; i++) {
      chartdata.push(x[i]);
    }
    //pie chart code ends here

    //console.log(chartdata);


// Load google charts
google.charts.load('current', {'packages':['corechart']});
google.charts.setOnLoadCallback(drawChart);


// Draw the chart and set the chart values
function drawChart() {
  var data = google.visualization.arrayToDataTable(chartdata);

  // Optional; add a title and set the width and height of the chart
  var options = {
    'title':'Top 3 sold product this year',
    'width':800,
    'height':400,
     is3D: true
    };

  // Display the chart inside the <div> element with id="piechart"
  var chart = new google.visualization.PieChart(document.getElementById('piechart'));
  chart.draw(data, options);
}


     
     //column chart starts here
     var prodquantity = <?php echo json_encode($productstock);?>;
     console.log(prodquantity);
     var turntoarray = [];
     for(var ke in prodquantity) turntoarray.push([prod[ke],prodquantity[ke]]);

      var colchart = [];
      colchart.push(["Product", "Quantity"]);
      for (var i = 0; i < turntoarray.length; i++) {
        colchart.push([turntoarray[i][0],turntoarray[i][1]]);
      }
      //colchart.push(turntoarray);
      console.log(colchart);
  
    google.charts.load("current", {packages:['corechart']});
    google.charts.setOnLoadCallback(drawChart1);
    function drawChart1() {
      var data = google.visualization.arrayToDataTable(colchart);

      var view = new google.visualization.DataView(data);
      view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" }]);

      var options = {
        title: "Product Stock chart",
        width: 800,
        height: 400,
        bar: {groupWidth: "90%"},
        legend: { position: "none" },
      };
      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
      chart.draw(view, options);
  }
  

</script>