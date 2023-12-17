<?php
 
include_once 'template_page.php';
include_once 'controlers.php';

echo $begin_template;


$id_credit = "";
$id_delivery = "";
if (isset($_GET['id'])){
    $id_credit = $_GET['id'] ;
}
if (isset($_GET['id_d'])){
    $id_delivery = $_GET['id_d'] ;
}

$credit_client =  load_credit_client($con , $id_credit);
?>
<div class='row'>
    <div class='col-lg-12'>
        <div class='toppage objects-align-right'>مدفوعات  الديون
        </div>
        <div class="div_btn_return">
            <input type="button" class="btn-reutre btn btn-light" value="رجوع" onclick="location.href = 'credit.php';" >
        </div>
        <div class='toppage objects-align-right credit_client' > <?php  echo " العميل "." : ".$credit_client->namecleint ?> 
        </div>
        <div class='toppage objects-align-right credit_client'> <?php  echo " المبلغ المتبقي "." : ".$credit_client->pricecredit ?>  
        </div>
        <?php 
        if (isset($_GET['savepaymentcredit'])){
             if ( $_GET['savepaymentcredit'] = "ok" ){
                ?>
        <div id="donne" class="toppage objects-align-right"
            style=" color: white; background-color: #2cabdd; margin: 10px 0px; padding: 10px; "> تم الحفظ بنجاح </div>
        <?php 
            } 
        }     
        if (isset($_GET['deletepaymentcredit'])){
            if ( $_GET['deletepaymentcredit'] = "ok"  ){
                 $result = deletepaymentcredit($con ,  $id_delivery );
               if ($result){
                        ?>
                        <div id="donne" class="toppage objects-align-right"
                            style="color: white; background-color: #2cabdd ;  margin: 10px 0px; padding: 10px;  "> تم الحذف بنجاح </div>
                        <?php 
                    }
            } 
        }   
        ?>
        <div class='table-responsive'>
            <table class='table'>
                <tr>
                    <th>حذف</th>
                    <th>المبلغ</th>
                    <th>التاريخ</th>
                    <th>الرقم</th>
                </tr>
                <?php
$i = 1;

 $qry = GetAllpaymentCredit($con , $id_credit);

foreach ($qry as $row) {
?>

                <tr>
                    <td>
                        <button class="delete_payment btn btn-outline-danger btn-sm rounded-0" type="button" data-toggle="tooltip"
                            data-placement="top" title="حذف" data-id="<?php echo $row[0] ?>" value="<?php echo $id_credit ?>"   > حذف
                        </button>
                    </td>
                    <td><?php echo $row[2] ; ?></td>
                    <td><?php echo $row[1] ; ?></td>
                    <td><?php echo $i++ ;?></td>
                </tr>
                <?php
}
// end table
?>
            </table>
        </div>
        <input type="button" class="mybtn" value="اضافة" onclick="location.href =
         'detailpaymentcredit.php?id=<?php echo $id_credit ?>';" >
    </div>
</div>
 
<?php

echo $end_template;