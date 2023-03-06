<?php
if(isset($dir) ||isset($url) ){
  authenticated($url);
}else{
  include('../../dotenv.php');
  authenticated($url);
}

function authenticated($url){
  if(!isset($_SESSION['user'])){
      error_reporting(E_ALL); 
      ini_set("display_errors", 1);
        if($_SERVER['PHP_SELF'] != "$url/admin/index.php"){
          header("Location: $url/admin/");
        }
    }
}
?>