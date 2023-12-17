<?php
include_once 'template_page.php';
 echo $begin_template;

?>

<?php 
         if (isset($_GET['singup'])){
            if ( $_GET['singup'] == "ok"  )
            {
                ?>
<div id="donne" class="toppage objects-align-right"
    style=" color: white; background-color: #2cabdd; margin: 10px 0px; padding: 10px; "> تم التسجيل بنجاح
</div>
<?php 
            } 
        }     
?>

<form action="controlers.php" method="post" class="form_login">
    <div style="text-align: center; background-color: #6bd7b3 ; height: 30px; ">Log in</div>
    <?php  
    if ( isset($_GET['empty']) ){
    ?>
    <div style="text-align: center; background-color: red  ; height: 30px;">
        <?php echo $_GET['empty'] ?>
    </div>
    <?php
    }
    ?>
    <input class="input_login" type="text" placeholder="ادخل اسم المستخدم" name="username" required><br>
    <input class="input_login" type="password" placeholder="ادخل كلمة المرور" name="password" required><br>
    <label class="label_remember">
        <input type="checkbox" checked="checked" name="remember"> تذكرني
    </label>
    <div class="myclass">
        <button class="btn-login btn btn-success btn-sm rounded-0" type="submit" name="login">دخــــول</button>
    </div>
    <a href="singup.php?singup">اٍنشاء حساب جديد</a>
</form>


<?php
echo $end_template; ?>