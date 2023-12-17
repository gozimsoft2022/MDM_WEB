
 $(document).ready( 
 function(){
  $("#donne").hide() ;
  $("#donne").show(1000) ;
  $("#donne").hide(5000) ; 
}
);  

$(".delete_credit").click(function(){
 var result =  confirm("متاكد من عملية الحذف ؟ ");
 if (result ){
 window.location.href = "credit.php?deletecredit=ok&id="+ $(this).attr("data-id");
 }
});
$(".delete_client").click(function(){
  var result =  confirm("متاكد من عملية الحذف ؟ ");
  if (result ){
  window.location.href = "clients.php?deleteclient=ok&id="+ $(this).attr("data-id");
  }
 });
 
 
 $(".delete_payment").click(function(){
  var result =  confirm("متاكد من عملية الحذف ؟ ");
  if (result ){
  window.location.href = "paymentcredit.php?deletepaymentcredit=ok&id_d="+ $(this).attr("data-id")+
  "&id="+ $(this).attr("value");  
  }
 });






 