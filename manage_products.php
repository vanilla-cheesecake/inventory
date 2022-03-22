<?php
session_start();
if(!isset($_SESSION['userlogin'])){
    header('location: index.php');
}else{
    include_once ("classes/Product.php");
    $pr = new Product();
    $products = $pr->getAllProduct();
/*    
if(isset($_GET['delpr'])){
    // brand delete from brand tbl
    $delpr = $_GET['delpr'];
    $delPro = $pr->deleteProduct($delpr);    
    // refresh the page,
    echo "<meta http-equiv='refresh' content='0;URL=?id=live'/>";    
}
 * 
 */
    // form_category
    include_once ("templates/category.php");?>
    <?php
    // form_brand
    include_once ("templates/brand.php");?>
    <?php
    // form_product
    include_once ("templates/product.php");?>
    

<!DOCTYPE html>
<html>
    <head>
        <title>Inventory System</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />    
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"/>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        
        <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">       
        <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
      -->
      <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
      <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
      

        <script src="js/manage.js"></script>
        <script src="js/main.js"></script>

        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
        <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.colVis.min.js"></script>

        
        
        
        
        
        
        
        
        
       
     </head>
     <body>
         <?php include_once("templates/header.php");?>
         <br>
         <div class="container">
             
             <div class="row">
                 
                 <div class="col-md-12">
                     <div class="card" style="background-color: whitesmoke;">
                     
                        <br><br>
                         <h3 class="text-center" style="font-family: Consolas">Products Records</h3>
        
                         <div class="card-body">
                    
                         <a href="manage_categories.php" class="btn btn-outline-success">Manage Categories</a>
                         <a href="#" data-toggle="modal" data-target="#form_product" class="btn btn-outline-primary">Add New Product</a>
                         <br><br>
                             <?php
                             /* as we use page refresh,dont need the msg
                             if(isset($delCategory)){
                                 echo $delCategory;
                             } */
                             ?>
                           
            <table class="table table-striped table-bordered table-condensed table-hover text-center" id="example">
             <thead>
                 
                 <tr style="background-color: rgb(0,113,122);" class="badge-info text-center">
                     <th><b>Item #</b></th>
                     <th><b>Product</b></th>
                     <th><b>Category</b></th>
                     <th><b>Retail Price</b></th>
                     <th><b>SRP</b></th>
                     <th><b>Quantity</b></th>  
                     <th><b>Date</b></th>
              <!--  <td><b>Category</b></td>     -->                 
                     <th><b>Status</b></th>
                     <th><b>Action</b></th>
                 </tr>
             </thead>
             <tbody>
             <?php
             if($products){
             $i = 0;
             while ($result = $products->fetch_assoc()) {
             $i++;
             ?>
            <tr class="delete_pro<?php echo $result['pId']; ?>">
                <td><?php echo $result['pId']; ?></td>
                <td><?php echo $result['product_name']; ?></td>
                <td><?php echo $result['category_name']; ?></td>
                <td><?php echo $result['retail_price']; ?></td>
                
                <td><?php echo $result['product_price']; ?></td>
                <td><?php echo $result['product_stock']; ?></td>
                <td><?php echo $result['date']; ?></td>
                <!-- SET STATUS HERE KUNG FAST MOVING OR NOT ANG ITEMMS -->
                <td>
                    <?php if($result['status']==0) {?>
                    <a href="#" class="badge badge-danger">---</a>
                    <?php }else{ ?>
                    <a href="#" class="badge badge-success">Fast Moving</a> 
                    <?php } ?>
                </td>
                <td>
<!-- <a href="#" class="btn btn-danger" id="<?php // echo $result['pId']; ?>">Delete</a>-->
                <!-- ACTIONS DITO EDIT OR DELETE ANG PRODUCT -->
                <a href="#" did="<?php echo $result['pId']; ?>" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash">&nbsp;</i>Delete</a>
                <a href="#" data-toggle="modal" data-target="#update_product" id="<?php echo $result['pId']; ?>" class="btn btn-outline-warning btn-sm edit_pr"><i class="fa fa-edit">&nbsp;</i>Edit</a> 
                </td>                                      
            </tr>
             <?php }} ?>
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
                     <td></td>
                 </tr>
             </tfoot>
         </table>  
                         </div>
                     </div>      
                 </div>
             </div>            
         </div>
      <script type="text/javascript">
    // delete product      
     $(document).ready(function() {
      $('.btn-outline-danger').click(function() {
      var did = $(this).attr("did");    
      if(confirm("Are you sure you want to delete this Product?")){
          $.ajax({
              url: "includes/process.php",
              method: "POST",
              data: {deleteProduct:1,id:did},                    
              cache: false,
              success: function(html) {
              $(".delete_pro" + did).fadeOut('slow');
                  }    
               })
            }else{
            return false;
            }
        })
     })
         </script>
         
         <?php include_once("templates/update_product.php")?>
          <!-- <script>
           $(document).ready(function(){
                 $('#example').DataTable();
           });
          </script> -->

  
                
        <script>
            $(document).ready(function() {
                $('#example').DataTable( {
                    dom: 'Bfrtip',
                    buttons: [
                        {
                            extend: 'copyHtml5',
                            exportOptions: {
                                columns: [ 0, ':visible' ]
                            }
                        },
                        {
                            extend: 'excelHtml5',
                            exportOptions: {
                                columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                            }
                        },
                        {
                            extend: 'pdfHtml5',
                            exportOptions: {
                                columns: [ 0, 1, 2, 5 ]
                            }
                        },
                        'colvis'
                    ]
                } );
            } );
        </script>
   
     </body>
</html>
<?php }?>



