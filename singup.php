<?php
    include_once 'template_page.php';
    echo $begin_template;
?>
 <div class="toppage">انشاء حساب جديد</div>
 <div class="div_btn_return">
     <input type="button" class="btn-reutre btn btn-light" value="رجوع" onclick="location.href = 'index.php';">
 </div>

 <div class="container">
     <div class="row">
         <div class="col-lg-12">
              <form action="controlers.php" method="POST" class="formdetailclient">
                 <label>اسم المستخدم</label>
                 <input type="text" name="name"   value= "" >
                 <label>اسم الدخول</label>
                 <input type="text" name="username" value= "" >
                 <label>كلمة المرور</label>
                 <input type="text" name="password" value= "" >
                 <div>
                     <button type="submit" class="btn btn-primary" name="singup" value= "ok" > تسجيل
                     </button>
                 </div>
             </form>
         </div>
     </div>
 </div>

 <?php
    echo $end_template;
 ?>