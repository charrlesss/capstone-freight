<?php
if(isset($dir) ||isset($url) ){
  notAuthenticated($url);
}else{
  include('../../dotenv.php');
  notAuthenticated($url);
}

function notAuthenticated($url){
  if(isset($_SESSION['user'])){
      error_reporting(E_ALL); 
      ini_set("display_errors", 1);
        if($_SERVER['PHP_SELF'] != "$url/admin/administrative/index.php"){
          header("Location: $url/admin/administrative/");
        }
    }
}
?>