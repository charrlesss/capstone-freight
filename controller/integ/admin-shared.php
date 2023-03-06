<?php
$controller_filename =basename(__FILE__);
$controller_request = $_SERVER['REQUEST_URI'];
include("../../dotenv.php");
include("$dir/controller/index.php");

    function loginAdmin(){
        include("../../dotenv.php");
        include("$dir/model/index.php");
        include("$dir/model/shared/login-admin_emloyee.php");

        $user = getAccountByEmployeeId($db,$_POST['employee_id']);
        if(empty($user)){
            $response = array(
                "message"=>'No account found in this id',
                "success"=>false
            );
            echo json_encode($response);
            return;
        }

        if($user['archive']){
            $response = array(
                "message"=>'This account its not being available.',
                "success"=>false
            );
            echo json_encode($response);
            return;
        }

        if(!password_verify($_POST['password'] , $user['password'])){
            $response = array(
                "message"=>'Password do not match',
                "success"=>false
            );
            echo json_encode($response);
            return;
        }
        
        $_SESSION['user'] = array(
            "profile"=>  $user['profile'],
            "email"=>  $user['email'],
            "firstname"=>  $user['firstname'],
            "lastname"=>  $user['lastname'],
            "middlename"=>  $user['middlename'],
            "gender"=>  $user['gender'],
            "address"=>  $user['address'],
            "birthdate"=>  $user['birthdate'],
            "contact_number"=>  $user['contact_number'],
            "position_id"=>  $user['position_id'],
            "department_id"=>  $user['department_id'],
            "account_id"=>  $user['account_id']
        );

        log_account($db,$user['account_id'],'login');

        $response = array(
            "message"=>'Successfully Login',
            "success"=>true
        );
        echo json_encode($response);
    }

    function logout_account(){
        include("../../dotenv.php");
        include("$dir/model/index.php");
        include("$dir/model/shared/login-admin_emloyee.php");
        session_destroy();
        log_account($db,$_SESSION['user']['account_id'],'logout');
        $response = array(
            "message"=>'Successfully Logout',
            "success"=>true
        );
        echo json_encode($response);
    }







call_user_func_array($function_name,$slice_function_params);
?>