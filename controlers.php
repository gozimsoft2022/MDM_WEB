<?php

include_once 'const.php';
include_once 'connectdb.php';


if (isset($_POST['singup'])){

  header("Location:index.php?singup=ok"); 
 
  $id_user =   NEWGUID();
  $name =  $_POST["name"];
  $username =  $_POST["username"];
  $password =  $_POST["password"];
  $result = singup_user($con,$id_user,$name,$username,$password );
  if($result){
   header("Location:index.php?singup=ok"); 
   exit ;
  }
  else
  {
   header("Location:singup.php?singup=no");  
  }
} 

// session_start();

if(empty($_SESSION['id_user'])){
  header("location:index.php") ;
}
 

class Tuser
{
  public $id;
  public $name;
  public $username;
  public $password;
  public $rol;
  public $login;
}
class Tclient
{
  public $id_client;
  public $name;
  public $phone1;
  public $phone2;
  public $address;
}
class Tcredit
{
  public $id_credit;
  public $typecredit;
  public $pricecredit;
  public $datecredit;
  public $id_client;
  public $id_user;  
  public $daycredit;  
  public $remark;  
}
class Tcredit_client 
{
  public $id_credit;
  public $namecleint;
  public $pricecredit;
}  
 
 $user;
 
if (isset($_POST['delete_client'])){
  delete_client($_POST['delete_client']);
}
 
// log out 
if (isset($_GET['logout'])){
  session_start();
  session_destroy() ; 
  header("Location:index.php");
  }

  if (isset($_POST["login"])) {

  $result=  get_login($con, $_POST['username'], $_POST['password'], $_POST['remember'] );
  if ( $result == true ) {
    header("Location:Credit.php");
  } else {
    header("Location:index.php?empty= error in password or username  ");
    } }

if(isset($_POST['saveclient'])){
 
  $id_client  =   $_POST["saveclient"] ;
  $name =  $_POST["nameclient"];
  $phone1 =  $_POST["phone1client"];
  $phone2 =  $_POST["phone2client"];
  $address  =  $_POST["addressclient"];
  session_start() ;
  $id_user  = $_SESSION['id_user'] ;
 
  if(  trim( $name)  == "" ){
    header("Location:detailclient.php?saveclient=no"); 
    exit ;
  }

   $result = save_client($con,$id_client,$id_user , $name,$phone1,$phone2,$address);
  if($result){
     header("Location:clients.php?saveclient=ok"); 
  }
  else
  {
    header("Location:detailclient.php?saveclient=error");  
  }

 }

 if(isset($_POST['updateuser'])){

  $id_user  =  $_POST["updateuser"] ;
  $name     =  $_POST["name"];
  $username =  $_POST["username"];
  $password =  $_POST["password"];
 
  $path_db = PATH_DB  ;
  $con = new PDO($path_db);
  $result = update_user($con,$id_user,$name,$username,$password );
  if($result){
    header("Location:user.php?updateuser=ok"); 
  }
  else
  {
    header("Location:user.php?updateuser=no");  
  }

 }
 
 function update_user($aCon,$aId_user,$aName,$aUsername,$aPassword ){
      $qry = $aCon->prepare(SQL_UPDATE_USER); 
      $qry->bindValue(":id_user",$aId_user );
      $qry->bindValue(":name", $aName );
      $qry->bindValue(":username", $aUsername  );
      $qry->bindValue(":password",  $aPassword  );
    try { 
    $qry->execute();
        return true ;
    } 
    catch(PDOException $e) {
      echo $qry . "<br>" . $e->getMessage();
        return false ;
    }  
 }
 function singup_user($aCon,$aId_user,$aName,$aUsername,$aPassword ){
    $qry = $aCon->prepare(SQL_INSERT_USER); 
    $qry->bindValue(":id_user",$aId_user );
    $qry->bindValue(":name", $aName );
    $qry->bindValue(":username", $aUsername  );
    $qry->bindValue(":password",  $aPassword  );
   try { 
   $qry->execute();
      return true ;
   } 
   catch(PDOException $e) {
    echo $qry . "<br>" . $e->getMessage();
      return false ;
   }  
 }
  

 function save_client($aCon,$aId_client, $aid_user, $aName,$aPhone1,$aPhone2,$aAddress){
 if ( $aId_client == "" ){
    $qry = $aCon->prepare(SQL_INSERT_CLIENT); 
    $Id_client =   NEWGUID() ;
  }
   else{ 
    $qry = $aCon->prepare(SQL_UPADTE_CLIENT);
    $Id_client = $aId_client;
  }
    $qry->bindValue(":id_client",$Id_client );
    $qry->bindValue(":name", $aName );
    $qry->bindValue(":phone1",  $aPhone1  );
    $qry->bindValue(":phone2",  $aPhone2  );
    $qry->bindValue(":address", $aAddress );
    $qry->bindValue(":id_user", $aid_user );  
   
   try { 
   $qry->execute();
      return TRUE ;
   } 
   catch(PDOException $e) {
    echo $qry . "<br>" . $e->getMessage();
      return false ;
   }  
}
if(isset($_POST["savecredit"])){

  $id_credit =   $_POST["savecredit"] ;
  $id_client =  $_POST["id_client"];
  $typecredit =  $_POST["typecredit"];
  $pricecredit  =  $_POST["pricecredit"];
  $datecredit  =  $_POST["datecredit"];
  $daycredit  =  $_POST["daycredit"];
  $remark =  $_POST["remark"];
  session_start();
  $id_user =  $_SESSION["id_user"]; 

  if( 
   trim($id_client)  == "" 
  || !is_numeric($pricecredit)   
  || !is_numeric($daycredit) 
  || is_Date($date) 
   ){
    header("Location:detailcredit.php?savecredit=no");  
    exit ;
  }

  $result =  save_credit($con,$id_credit,$id_client,$id_user,$typecredit,$pricecredit,$datecredit,$daycredit,$remark);            
if($result){
  header("Location:credit.php?savecredit=ok"); 
} else {
  header("Location:detailcredit.php?savecredit=no");  
}

}
if(isset($_POST["savepaymentcredit"])){
  $id_credit = $_POST["savepaymentcredit"] ;
  $price = $_POST["price"];
  $datedelivery = $_POST["datedelivery"];
  $result =  save_paymentcredit($con,$id_credit,$price,$datedelivery);              
  if($result){
    header("Location:paymentcredit.php?savepaymentcredit=ok&id=".$id_credit ); 
  } else {
    header("Location:paymentdetailcredit.php?savepaymentcredit=no&id=".$id_credit);  
  }

}

function get_login($aCon, $username, $password , $remeber)
{
  $qry = $aCon->prepare(SQL_USER);
  $qry->bindValue(":username",  ($username));
  $qry->bindValue(":password",  ($password));
  $qry->execute();

  foreach ($qry as $rows) 
    {
      if (!empty($rows[0]) ) {
        session_start();
        $_SESSION['id_user'] = $rows[0] ;
        $_SESSION['remeber'] = $remeber ;
        return true ; 
      } 
      else {
        return false ; 
      }
    }
    
}  
function load_credit_client($aCon,$id_credit)
{
  $credit_client = new Tcredit_client ;

  $qry = $aCon->prepare(SQL_CREDIT_CLIENT);
  $qry->bindValue(":id_credit",  ($id_credit));
  $qry->execute();
  foreach( $qry as $rows ){
  $credit_client->id_credit = $rows[0];
  $credit_client->namecleint = $rows[1];
  $credit_client->pricecredit = $rows[2];
  }
  return $credit_client ; 
    
}  

function GetAllClient($aCon)
{
 
  $id_user = $_SESSION['id_user'] ;
  $qry = $aCon->query(SQL_ALLCLIENT);
  $qry->bindValue(":id_user",$id_user ); 
  $qry->execute(); 
  return   $qry;
}
function getAllUsers($aCon)
{
  $qry = $aCon->query(SQL_ALLUSERS);
  return   $qry;
}
function GetAllCredit($aCon)
{

  $id_user = $_SESSION['id_user'] ;
  $qry = $aCon->query(SQL_ALLCREDIT);
  $qry->bindValue(":id_user",$id_user ); 
  $qry->execute(); 
  return   $qry;
}
function GetAllpaymentCredit($aCon , $id_credit )
{
  $qry = $aCon->query(SQL_ALLPAYMENT_CREDIT);
  $qry->bindValue(":id_credit",$id_credit ); 
  $qry->execute(); 
  return   $qry;
}

  
function delete_client($aCon,$aId_client)
{
  $client = new Tclient ;
  if ( !empty($aId_client) ){
            $qry = $aCon->query(SQL_DELETE_CLIENT);
            $qry->bindValue(":id_client",$aId_client ); 
            try {  
                $qry->execute(); 
                 return true ;
            }
            catch(PDOException $e) {
                echo $qry . "<br>" . $e->getMessage();
                return false ;
            } 
}
}
function deletepaymentcredit($acon,$aid_delivery)
{
 
  if ( !empty($aid_delivery) ){
            $qry = $acon->query(SQL_DELETE_PAYMENT_CREDIT);
            $qry->bindValue(":id_delivery",$aid_delivery ); 
            try {  
                $qry->execute(); 
                 return true ;
            }
            catch(PDOException $e) {
                echo $qry . "<br>" . $e->getMessage();
                return false ;
            } 
}
}

function deletecredit($aCon,$aId_credit)
{
  $client = new Tclient ;
  if ( !empty($aId_credit) ){
            $qry = $aCon->query(SQL_DELETE_CREDIT);
            $qry->bindValue(":id_credit",$aId_credit ); 
            try {  
                $qry->execute(); 
                 return true ;
            }
            catch(PDOException $e) {
                echo $qry . "<br>" . $e->getMessage();
                return false ;
            } 
}
}

function Loaduser($aCon,$aId_user){
  $user = new Tuser ;
  if ( !empty($aId_user) ){
            $qry = $aCon->query(SQL_LOAD_USER);
            $qry->bindValue(":id_user",$aId_user ); 
            try {  
                $qry->execute();
                foreach( $qry as $row ){
                  $user->id_user =  $row[0] ;
                  $user->name =     $row[1] ;
                  $user->username =  $row[2] ;
                  $user->password  =  $row[3] ; 
                }
            } 
            catch(PDOException $e) {
                echo $qry . "<br>" . $e->getMessage();
            } 
}
  return $user ;
}
function Loadclient($aCon,$aId_client){
      $client = new Tclient ;
      if ( !empty($aId_client) ){
                $qry = $aCon->query(SQL_LOAD_CLIENT);
                $qry->bindValue(":id_client",$aId_client ); 
                try {  
                    $qry->execute();
                    foreach( $qry as $row ){
                      $client->id_client =  $row[0] ;
                      $client->name =  $row[1] ;
                      $client->address =  $row[2] ;
                      $client->phone1  =  $row[3] ;
                      $client->phone2 =  $row[4] ;    
                    }
                } 
                catch(PDOException $e) {
                    echo $qry . "<br>" . $e->getMessage();
                } 
    }
      return $client ;
}
function loadcredit($aCon,$aId_credit){ 
  $credit = new Tcredit ;
  if ( !empty($aId_credit) ){
            $qry = $aCon->query(SQL_LOAD_CREDIT);
            $qry->bindValue(":id_credit",$aId_credit ); 
            try {  
                $qry->execute();
                foreach( $qry as $row ){
                  $credit->id_credit=  $row[0] ;
                  $credit->id_client =  $row[1] ;
                  $credit->id_user =  $row[2] ;
                  $credit->datecredit  =  $row[3] ;
                  $credit->pricecredit =  $row[4] ;
                  $credit->daycredit =  $row[5] ;    
                  $credit->typecredit =  $row[6] ;  
                  $credit->remark =  $row[7] ;                       
                }
            } 
            catch(PDOException $e) {
                echo $qry . "<br>" . $e->getMessage();
            } 
}
  return $credit ;
}

function save_credit($acon,$aid_credit,$aid_client,$aid_user,$atypecredit,$apricecredit,$adatecredit,$adaycredit,$aremark){
  try { 

    if ( $aid_credit == "" ){
      $qry = $acon->prepare(SQL_INSERT_CREDIT); 
      $id_credit =   NEWGUID() ;
    }
      else{ 
      $qry = $acon->prepare(SQL_UPADTE_CREDIT);
      $id_credit = $aid_credit;  
    }
    
    $qry->bindValue(":id_credit",$id_credit );
    $qry->bindValue(":id_client", $aid_client );
    $qry->bindValue(":id_user",$aid_user );
    $qry->bindValue(":typecredit",  $atypecredit  );
    $qry->bindValue(":pricecredit",  $apricecredit  );
    $qry->bindValue(":datecredit", $adatecredit );
    $qry->bindValue(":daycredit", $adaycredit );
    $qry->bindValue(":remark", $aremark );

   $qry->execute();
      return TRUE ;
   } 
   catch(PDOException $e) {
   echo $qry . "<br>" . $e->getMessage();
      return false ;
   }  

}
function save_paymentcredit($acon,$aid_credit,$aprice,$adatedelivery){    

  try { 
    $qry = $acon->prepare(SQL_INSERT_PAYMENT_CREDIT); 
    $id_delivery =   NEWGUID() ;
    $qry->bindValue(":id_delivery",$id_delivery );
    $qry->bindValue(":id_credit", $aid_credit );
    $qry->bindValue(":price",$aprice );
    $qry->bindValue(":datedelivery",  $adatedelivery  );
    $qry->execute(); 
      return TRUE ;
   } 
   catch(PDOException $e) {
   echo $qry . "<br>" . $e->getMessage();
      return false ;
   }  

}

function NEWGUID()
{
    if (function_exists('com_create_guid') === true)
    {
        return trim(com_create_guid(), '{}');
    }
    return sprintf('{%04X%04X-%04X-%04X-%04X-%04X%04X%04X}',
     mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535),
      mt_rand(16384, 20479), mt_rand(32768, 49151), 
      mt_rand(0, 65535), mt_rand(0, 65535), mt_rand(0, 65535));
}

function is_Date($date) { 




  if (true == strtotime($date)) { 
      return true;
  } 
  else {  return false; }
}



 