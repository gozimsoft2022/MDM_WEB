<?php
    include_once 'template_page.php';
    include_once 'controlers.php';
    echo $begin_template;
 
 
    $id = "";
    if ( isset( $_GET["id"] )  ){
       $id =  $_GET["id"] ;   
    }
    $credit = loadcredit( $con,$id);
  
    $client = GetAllClient( $con ) ;
    function  SetAllClient($client , $id_client ){
        $result = "" ; 
         foreach($client as $row){
            if ($id_client == $row[0] ) {
                $str= "selected" ;
            }
            else
            {
                $str= $str= "" ;
            }
            $result .=  " <option value=". $row[0] ." ".$str." >". $row[1]." </option> " ;
        }
        return $result ;
   }
   function  SetAllTypeClient($id_typecredit){
    $str = "" ; 
    $result = "" ; 
        if ($id_typecredit == "0" ) {
            $result .=  " <option value= '0' ".$str." selected >مدين (له)</option>  ";   
        }
        else
        {
            $result .=  " <option value= '0' ".$str." >مدين (له)</option>  ";   
        }
        if ($id_typecredit == "1" ) {
            $result .=  " <option value= '1' ".$str." selected >دائن (عليه)</option> ";   
        }
        else
        {
            $result .=  " <option value= '1' ".$str." >دائن (عليه)</option> "; 
        }
    return $result ;
}


?>

<div class="div_btn_return">
    <div class="toppage"  >الدين</div>
    <input type="button" class="btn-reutre btn btn-light"  style="display: inline-block;" value="رجوع" onclick="location.href = 'credit.php';">
</div>
<?php    
  
          if (isset($_GET['savecredit'])){
                if($_GET['savecredit'] == "no" ){ 
                  ?>
                    <div class="formdetailclient" style="text-align: center; background-color :brown; color :white;">
                      بيانات ناقصة أو غير صحيحة</div>
                    <?php  }
                    else 
                    if($_GET['savecredit'] == "error" ){ 
                        ?>
                          <div class="formdetailclient" style="text-align: center; background-color :brown; color :white;">حدث خطأ في
                              حفظ الدين</div>
                          <?php  }
          }
        ?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <form action="controlers.php" method="post" class="formdetailclient">
                <label>العميل</label>
                <div>
                    <select name="id_client" value=<?php echo $credit->id_client ;  ?> >
                         <?php echo  SetAllClient($client, $credit->id_client ) ?>
                    </select>
                </div>
                <label>نوع الدين</label>
                <div>
                    <select name="typecredit"   value= <?php echo $credit->typecredit ;  ?>  >
                    <?php echo  SetAllTypeClient( $credit->typecredit ) ?> 
                    </select>
                </div>
                <label>المبلغ</label>
                <input type="number" name="pricecredit" value= <?php echo $credit->pricecredit ;  ?>>
                <label>تاريخ الدين</label>
                <input type="date"   name="datecredit" value="<?php echo $credit->datecredit ;   ?>">
                <label>مدة الدين (بالايام)</label>
                <input type="number" name="daycredit" value=<?php echo $credit->daycredit ;  ?>>
                <label>ملاحظة</label> 
                <textarea class ="memo" name="remark" value="<?php echo $credit->remark ;   ?>" ></textarea>
                <div>
                    <button type="submit" class="btn btn-primary" name="savecredit"
                        value=<?php echo  $credit->id_credit ;  ?>> حفظ
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php
     echo $end_template;
 ?>