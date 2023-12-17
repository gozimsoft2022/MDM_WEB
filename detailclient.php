<?php
    include_once 'template_page.php';
    include_once 'controlers.php';
    echo $begin_template;
?>

 <?php 

  $id = "";
 if ( isset( $_GET["id"] )  ){
    $id =  $_GET["id"] ;   
 }
 $client = loadclient( $con,$id);


?>


 <div class="toppage">العميل</div>
 <div class="div_btn_return">
     <input type="button" class="btn-reutre btn btn-light" value="رجوع" onclick="location.href = 'clients.php';">
 </div>

 <div class="container">
     <div class="row">
         <div class="col-lg-12">
             <?php      
            if (isset($_GET['saveclient'])){
            if($_GET['saveclient']== "no" )
            { 
                ?>
                <div class="formdetailclient" style="text-align: center; background-color :brown; color :white;">
                يجب اٍكمال البيانات</div>
                <?php  
            } 
            else
            if($_GET['saveclient'] == "error" )
            {
                ?>
                <div class="formdetailclient" style="text-align: center; background-color :brown; color :white;">حدث خطأ في
                    حفظ العميل</div>
                <?php 
            }
           }
         ?>
             <form action="controlers.php" method="POST" class="formdetailclient">
                 <label>اسم العميل</label>
                 <input type="text" name="nameclient" value=" <?php echo $client->name ;  ?>" >
                 <label>رقم الهاتف 1</label>
                 <input type="text" name="phone1client" value="<?php echo $client->phone1 ;  ?>">
                 <label>رقم الهاتف 2</label>
                 <input type="text" name="phone2client" value="<?php echo $client->phone2 ;  ?>">
                 <label>العنوان</label></br>
                 <input type="memo" name="addressclient" value="<?php echo $client->address ;  ?>">
                 <div>
                     <button type="submit" class="btn btn-primary" name="saveclient" value=<?php echo $client->id_client ; ?>> حفظ
                     </button>
                 </div>
             </form>
         </div>
     </div>
 </div>

 <?php
    echo $end_template;
 ?>