<?php
    include_once 'template_page.php';
    include_once 'controlers.php';
    echo $begin_template;
 
 
    $id_credit = "";
    if ( isset( $_GET["id"] )  ){
       $id_credit =  $_GET["id"] ;   
    }
 
 $todate =date("d/m/Y"); 
  


?>
 
<div class="toppage"></div>

<div class="div_btn_return">
    <input type="button" class="btn btn-light" value="رجوع" onclick="location.href =
     'paymentcredit.php?id=<?php echo $id_credit ?>';">
</div>
<?php    
  
          if (isset($_GET['savecredit'])){
                if($_GET['savecredit'] == "no" ){ 
                  ?>
                    <div class="formdetailclient" style= 
                    "text-align: center; background-color :brown; color :white;">حدث خطأ في
                        حفظ الدين</div>
                    <?php  }
          }
 
        ?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <form action="controlers.php" method="post" class="formdetailclient">
                <label>المبلغ</label>
                <input type="number" name="price" >
                <label>تاريخ الدين</label>
                <input type="date"   name="datedelivery" value= <?php // echo date('Y-m-d',strtotime(date("d/m/Y"))) ; ?>>
                <div>
                    <button type="submit" class="btn btn-primary" name="savepaymentcredit"
                        value=<?php echo  $id_credit ;  ?>> حفظ
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
     echo $end_template;
 ?>