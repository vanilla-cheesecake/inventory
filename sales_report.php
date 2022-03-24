<?php 
session_start();
if(!isset($_SESSION['userlogin'])){
    header('location: index.php');
}else{
    include_once("classes/Product.php");
    $pr = new Product();
    $sales =$pr->getSales();     
?>
<!DOCTYPE html>
<html>

<head>
    <title>Inventory System</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
   <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script> 


    <script src="js/order.js"></script>

  
      <!-- <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
       -->

        <script src="js/manage.js"></script>
        <script src="js/main.js"></script>

        <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.colVis.min.js"></script> -->


<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.1.2/css/dataTables.dateTime.min.css"> 

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script src="https://cdn.datatables.net/datetime/1.1.2/js/dataTables.dateTime.min.js"></script>

<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/datetime/1.1.2/css/dataTables.dateTime.min.css.css">



</head>

<body>
    <?php include_once("templates/header.php");?>
    <br>


    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card" style="background-color: whitesmoke;">
                    <br>
                    <h3 class="text-center" style="font-family: cursive">Sales Report</h3>

                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="row">
                                <div class="col">
                                    <label for=""></label>
                                    <input type="date" name="" id="">

                                    <label for=""></label>
                                    <input type="date" name="" id="">
                                    <button class="btn btn-outline-success">generate report</button>
                                </div>
                        </form>
                    </div>
                    <br>
                    <table border="0" cellspacing="5" cellpadding="5">
        <tbody><tr>
            <td>Minimum date:</td>
            <td><input type="text" id="min" name="min"></td>
        </tr>
        <tr>
            <td>Maximum date:</td>
            <td><input type="text" id="max" name="max"></td>
        </tr>
    </tbody></table>
                    <table class="table table-striped table-bordered table-condensed table-hover text-center"
                        id="example">

                        <thead>
                            <tr class="badge-info text-center" style="background-color: rgb(0,113,122);">
                                <td><b>ID</b></td>
                                <td><b>Invoice No</b></td>
                                <td><b>Product ID</b></td>
                                <td><b>Product Name</b></td>
                                <td><b>Price</b></td>
                                <td><b>Date</b></td>
                                <td><b>Total QTY</b></td>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                 if($sales){
                     $i=0;
                     while ($result = $sales->fetch_assoc()){   
                       $i++;
                 ?>
                            <tr>
                                <td><?php echo $i;?></td>
                                <td><?php echo $result['invoice_no'];?></td>
                                <td><?php echo $result['pId'];?></td>
                                <td><?php echo $result['product_name'];?></td>
                                <td><?php echo $result['price'];?></td>
                                <td><?php echo $result['order_date'];?></td>
                                <td><?php echo $result['total_qty'];?></td>



                            </tr>
                            <?php }}?>
                        </tbody>
                        <tfoot>
                            <tr style="background-color: rgb(0,113,122);" class="badge-info text-center">
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script>
  var minDate, maxDate;
 
 // Custom filtering function which will search data in column four between two values
 $.fn.dataTable.ext.search.push(
     function( settings, data, dataIndex ) {
         var min = minDate.val();
         var max = maxDate.val();
         var date = new Date( data[4] );
  
         if (
             ( min === null && max === null ) ||
             ( min === null && date <= max ) ||
             ( min <= date   && max === null ) ||
             ( min <= date   && date <= max )
         ) {
             return true;
         }
         return false;
     }
 );
  
 $(document).ready(function() {
     // Create date inputs
     minDate = new DateTime($('#min'), {
         format: 'MMMM Do YYYY'
     });
     maxDate = new DateTime($('#max'), {
         format: 'MMMM Do YYYY'
     });
  
     // DataTables initialisation
     var table = $('#example').DataTable();
  
     // Refilter the table
     $('#min, #max').on('change', function () {
         table.draw();
     });
 });
        </script>

</body>

</html>
<?php }?>