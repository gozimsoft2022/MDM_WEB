<?php
    include_once 'template_page.php';
    include_once 'controlers.php';
    echo $begin_template;
 
    $user =  loaduser( $con , $_SESSION['id_user'] ) ;

?>




<div class="toppage">المستخدم</div>

<?php
           
 
           if (isset($_GET['updateuser'])){
           if ( $_GET['updateuser'] == "ok"  )
           {
               ?>
<div id="donne" class="toppage objects-align-right"
    style=" color: white; background-color: #2cabdd; margin: 10px 0px; padding: 10px; ">تم التحديث بنجاح
</div>
<?php 
           } 
           }     
   
          if (isset($_GET['updateuser'])){
                    if($_GET['updateuser']== "no" ){ 
            ?>
<div class="formdetailclient" style="text-align: center; background-color :brown; color :white;">حدث خطأ في
    حفظ المستخدم</div>
<?php  }
          }
        ?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <form action="controlers.php" method="POST" class="formdetailclient">
                <label>اسم المستخدم</label>
                <input type="text" name="name" value=<?php echo $user->name ;   ?>>
                <label>اسم الدخول</label>
                <input type="text" name="username" value=<?php echo $user->username ;  ?>>
                <label>كلمة المرور</label>
                <input type="text" name="password" value=<?php echo $user->password ;  ?>>
                <div>
                    <button type="submit" class="btn btn-primary" name="updateuser"
                        value=<?php echo $user->id_user ; ?>> تحديث
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
    echo $end_template;
 ?>