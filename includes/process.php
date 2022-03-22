<?php
include_once("../classes/Category.php");
include_once("../classes/Brand.php");
include_once("../classes/Product.php");

$cat = new Category();
$br = new Brand();
$pr = new Product();

if(isset($_POST['category_name'])){
    $category_name = $_POST['category_name'];
    $result = $cat->addCategory($category_name);
    echo $result;
    exit();
}
// EDIT PRODUCT BRAND AND CATEGORY SHOW OPTION
if(isset($_POST['getCategory'])){
    $result = $cat->getAllCategory();
    foreach($result as $row) {
        echo "<option value='" .$row["catId"]."'>".$row["category_name"]."</option>";
    }
    exit();
 
 }



if(isset($_POST['added_date']) AND isset($_POST['product_name'])){
    $date = $_POST['added_date'];
    $product_name = $_POST['product_name'];
    $catId = $_POST['select_cat'];
    $retail_price = $_POST['retail_price'];
    $price = $_POST['product_price'];
    $qty = $_POST['product_qty'];
    $result = $pr->addProduct(  $catId,
                                $product_name,
                                $retail_price,
                                $price,
                                $qty,
                                $date );
    echo $result;
    exit();
    
}
//-------- request receive from manage.js for displaying all categories---------
if(isset($_POST['deleteCategory']) AND isset($_POST['id'])){
    $deleteCat = $_POST['id'];
    $delCategory = $cat->deleteCategory($deleteCat);
    echo $delCategory;
    exit();    

 }
 
 
 
if(isset($_POST['updateCategory']) AND isset($_POST['id'])){
    $catId = $_POST['id'];
    
    $result = $cat->getCategory($catId);
    echo json_encode($result);
    exit();
    
}
// update record after getting data
if(isset($_POST['updt_cat'])){
    $catId = $_POST['catId'];
    $category_name = $_POST['updt_cat'];
    $result = $cat->updtCategory($category_name,$catId);
    echo $result;
    exit();
}
//-------- request receive from manage.js for displaying all brands---------
if(isset($_POST['manageBrand'])){
    $brands = $br->getAllBrand();
       if($brands){
             $i = 0;
             while ($result = $brands->fetch_assoc()) {
             $i++;?>
<tr>
    <td><?php echo $i;?></td>
    <td><?php echo $result['brand_name']; ?></td>
    <td><a href="#" class="btn btn-success btn-sm">Active</a></td>
    <td>
        <a onclick="return confirm('Are you sure to delete')" href="?delbr=<?php echo $result['bId']; ?>"
            class="btn btn-danger btn-sm"><i class="fa fa-trash">&nbsp;</i>Delete</a>
        <a href="#" data-toggle="modal" data-target="#update_brand" eid="<?php echo $result['bId']; ?>"
            class="btn btn-info btn-sm edit_br"><i class="fa fa-edit">&nbsp;</i>Edit</a>
    </td>
</tr>

<?php
        }
    }
 }

if(isset($_POST['deleteBrand']) AND isset($_POST['id'])){
    $deleteBr = $_POST['id'];
    $delBrand = $br->deleteBrand($deleteBr);    
    echo $delBrand;
    exit();    
 }

if(isset($_POST['updateBrand']) AND isset($_POST['id'])){
    $bId = $_POST['id'];
    
    $result = $br->getBrand($bId);
    echo json_encode($result);
    exit();
    
}
if(isset($_POST['deleteProduct']) AND isset($_POST['id'])){
    $delete = $_POST['id'];
    $delPro = $pr->deleteProduct($delete);    
    echo $delPro;
    exit();    

 }

if(isset($_POST['updateProduct']) AND isset($_POST['id'])){
    $pId = $_POST['id'];  
    $result = $pr->getProduct($pId);
    echo json_encode($result);
    exit();
    
}
// update record after getting data
if(isset($_POST['updt_pr'])){
   $pId = $_POST['prId'];
   $cId = $_POST['select_cat'];
//    $bId = $_POST['select_brand'];
   $product_name = $_POST['updt_pr'];
   $retail_price = $_POST['retail_price'];
   $product_price = $_POST['product_price'];
   $product_qty = $_POST['product_qty'];
   $date = $_POST['added_date'];
   $status =$_POST['updt_stat'];
   $result = $pr->updateProduct($pId,$cId,/*$bId*/$product_name,$retail_price,$product_price,$product_qty,$date,$status);
   echo $result;
   exit();
}
//------Order Processing-------------- // 
// GOLEZ LLOYD NEED TO ADD SEARCH FUNCTIONALITY HERE SIR OR ELSE.... //
// SOLVED: FEB 09, 2022 DEBUGGING: NEW PROBLEM UNLOCKED CHANGE OPTION TO TEXT SEARCH SHEESH
if(isset($_POST['getNewOrderForm'])){
   $result = $pr->getAllActiveProduct();
   ?>

<tr>
    <td>
        <input id="items" name="pId[]" required="" list="pId[]" class="form-control form-control-sm pId" />
        <datalist id="pId[]">
            <?php 
                if($result){
                        while($rows = mysqli_fetch_assoc($result)) { ?>
            <option value='<?php echo  $rows['pId'];?>'><?php echo $rows['product_name']; ?></option>
            <?php }} ?>

        </datalist>
        </input>
    </td>

    <td><b class="number">1</b></td>
    <td><input type="text" name="pro_name[]" readonly="" class="form-control form-control-sm pro_name" /></td>
    <td><input type="text" name="tqty[]" readonly="" class="form-control form-control-sm tqty" required="" /></td>
    <td><input type="text" name="qty[]" class="form-control form-control-sm qty" required="" /></td>
    <td><input type="text" name="price[]" readonly="" class="form-control form-control-sm price" required="" />

    <td>₱<span class="amt">0</span></td>
    <br>

</tr>
<?php 
   exit();
}
// Get price and quantity of one item
if(isset($_POST['getPriceAndQty']) AND isset($_POST['id'])){
    $pId = $_POST['id'];
    
    $result = $pr->getProduct($pId);
    echo json_encode($result);
    exit();
}
// Request from order.js for order information
if(isset($_POST['order_date']) AND isset($_POST['cust_name'])){
   $order_date   = $_POST['order_date'];
   $cust_name    = $_POST['cust_name'];
   
   //Now getting Array from order from
   
   $ar_tqty      = $_POST['tqty'];
   $ar_qty       = $_POST['qty'];
   $ar_price     = $_POST['price'];
   $ar_pro_name  = $_POST['pro_name'];
   $ar_pro_id    = $_POST['pId'];
   
   $sub_total    = $_POST['sub_total'];
   $gst          = $_POST['gst'];
   $discount     = $_POST['discount'];
   $net_total    = $_POST['net_total'];
   $paid         = $_POST['paid'];
   $due          = $_POST['due'];
   $payment_type = $_POST['payment_type'];
   
   $result = $pr->storeOrderInvoice($order_date,$cust_name,$ar_tqty,$ar_qty,$ar_price,$ar_pro_name,$ar_pro_id,$sub_total,$gst,$discount,$net_total,$paid,$due,$payment_type); 
   echo $result;
   exit();
   
}