<?php

const PATH_DB="sqlite:data\data.db";
const SQL_ALLCLIENT="SELECT * FROM tblclient where id_user= :id_user ";
const SQL_ALLUSERS="SELECT * FROM tblusers ";
const SQL_USER="SELECT id_user count FROM tblusers where username = :username and password = :password ";
const SQL_INSERT_CLIENT=" insert into tblclient ( id_client , id_user , name , phone1 , phone2 , address  )".
" values ( :id_client , :id_user, :name , :phone1 , :phone2 , :address )  ";
const SQL_UPADTE_CLIENT=" UPDATE TBLCLIENT SET  name = :name , phone1 = :phone1 , phone2 = :phone2 , address = :address  ".
" id_user = :id_user  WHERE id_client = :id_client ";
const SQL_DELETE_CLIENT=" DELETE FROM  TBLCLIENT WHERE id_client = :id_client  ";
const SQL_LOAD_CLIENT=" SELECT * FROM tblclient WHERE id_client = :id_client ";
const SQL_INSERT_USER=" insert into tblusers ( id_user, name , username , password ,role  )".
" values ( :id_user , :name , :username , :password ,1 ) ";
const SQL_LOAD_USER=" SELECT * FROM tblusers WHERE id_user = :id_user ";
const SQL_UPDATE_USER=" UPDATE TBLUSERS SET  name = :name , username = :username , password = :password ".
"WHERE id_user = :id_user ";
const SQL_ALLCREDIT="  SELECT tblcredit.id_credit , name , datecredit , daycredit ," 
. " pricecredit , typecredit , IFNULL(  sum(TblDeliveryCredit.price) , 0 )  as pricepayment , remark "
 ." FROM tblcredit inner join tblclient on tblcredit.id_client = tblclient.id_client " 
 ." left join TblDeliveryCredit on tblcredit.id_credit = TblDeliveryCredit.id_credit " 
 ."  where tblcredit.id_user = :id_user  "
 ." group by   tblcredit.id_credit , name , datecredit , daycredit ,"
." pricecredit , typecredit , remark  " ;
const SQL_INSERT_CREDIT = " insert into tblcredit ".
"          ( id_credit  ,  id_client ,  id_user ,  typecredit ,   datecredit  ,  daycredit  ,  pricecredit ,remark )  "
." values ( :id_credit  , :id_client  , :id_user , :typecredit , :datecredit  , :daycredit , :pricecredit, :remark  ) " ;
const SQL_UPADTE_CREDIT = " UPDATE tblcredit SET  id_client = :id_client , id_user= :id_user , datecredit = :datecredit ".
" , typecredit = :typecredit , daycredit =:daycredit , pricecredit = :pricecredit , remark = :remark  where id_credit = :id_credit " ;
const SQL_LOAD_CREDIT = " SELECT * FROM tblcredit WHERE id_credit = :id_credit ";
const SQL_DELETE_CREDIT=" DELETE FROM  TBLCREDIT WHERE id_credit = :id_credit  ";
const SQL_ALLPAYMENT_CREDIT="SELECT * FROM TblDeliveryCredit where id_credit = :id_credit ";
const SQL_INSERT_PAYMENT_CREDIT=" insert into TblDeliveryCredit ( id_delivery , datedelivery , price , id_credit   )".
" values ( :id_delivery , :datedelivery , :price , :id_credit  )  ";
const SQL_DELETE_PAYMENT_CREDIT=" DELETE FROM  TblDeliveryCredit WHERE id_delivery = :id_delivery  ";
const SQL_CREDIT_CLIENT= "  SELECT tblcredit.id_credit , name ,  " 
. " ( pricecredit - IFNULL(  sum(TblDeliveryCredit.price) , 0 )   ) as price "
 ." FROM tblcredit inner join tblclient on tblcredit.id_client = tblclient.id_client " 
 ." left join TblDeliveryCredit on tblcredit.id_credit = TblDeliveryCredit.id_credit " 
 ." WHERE tblcredit.id_credit = :id_credit  group by tblcredit.id_credit , name , pricecredit   " ;






