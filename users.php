<?php
include_once 'template_page.php';
include_once 'controlers.php';
echo $begin_template;
 
?>
<div class='row'>
    <div class='col-lg-12'>
        <div class='toppage objects-align-right'>المستخدمين
        </div>

        <?php 
        if (isset($_GET['saveclient'])){
            if ( $_GET['saveclient']= "ok"  ){
                ?>
        <div id="donne" class="toppage objects-align-right"
            style=" color: white; background-color: #2cabdd; margin: 10px 0px; padding: 10px; "> تم الحفظ بنجاح </div>
        <?php 
            } 
        }     
        if (isset($_GET['deleteclient'])){
            if ( $_GET['deleteclient'] = "ok"  ){
               $result = delete_client($con , $_GET['id'] );
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
                    <th>تعديل</th>
                    <th>اسم المستخدم</th>
                    <th>الاسم</th>
                    <th>الرقم</th>
                </tr>
                <?php
$i = 1;


 $qry = getAllUsers($con);
 

foreach ($qry as $row) {
?>
                <tr>
                    <td>
                        <button class="btn btn-outline-danger btn-sm rounded-0" type="button" data-toggle="tooltip"
                            data-placement="top" title="حذف"
                            onclick="location.href='clients.php?deleteclient=ok&id=<?php echo $row[0]?>'"> حذف
                        </button>
                    </td>
                    <td>
                        <button class="btn btn-outline-success btn-sm rounded-0" type="button" data-toggle="tooltip"
                            data-placement="top" title="تعديل"
                            onclick="location.href='detailclient.php?id=<?php echo $row[0]?>'"> تعديل
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
        <input type="button" class="mybtn" value="اضافة" onclick="location.href = 'detailuser.php';">

    </div>
</div>


<?php




echo $end_template;