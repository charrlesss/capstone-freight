<?php
$controller_filename =basename(__FILE__);
$controller_request = $_SERVER['REQUEST_URI'];
include("../../dotenv.php");
include("$dir/controller/index.php");
use Ramsey\Uuid\Uuid;



function logout_visitor_account(){
    session_destroy();
    $response = array(
        "logout"=>"Logout Successfully",
        "success"=>true
    );
    echo json_encode($response);
}

function get_all_appointment_request($id){
    include("../../dotenv.php");
    include("$dir/model/index.php");
    include("$dir/model/administrative/visitor-management.php");
    $response = array(
        "appoint_req"=>getAllAppointmentRequest($db ,$id),
        "success"=>$id
    );
    echo json_encode($response);
}


function visitor_create_appointment_request(){
        include("../../dotenv.php");
        include("$dir/model/index.php");
        include("$dir/model/administrative/visitor-management.php");

        $id_picture = $_FILES['file'];
        $uuid = Uuid::uuid4();
        $fileNameParts = explode('.',$id_picture['name']);
        $ext = end($fileNameParts);
        $secretname =$uuid->toString();
        $filename = "$secretname.$ext";
        $uploaddir = $dir."/assets/request-appointment-id-picture/";
        $uploadfile = $uploaddir . basename($filename);

        if(!move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)){
            $response = array(
                "message"=>"Server Error",
                "success"=>$_POST['visitor_id']
            );
            header('Content-Type: application/json; charset=utf-8');
            echo   json_encode($response);
            return;
        }

    createAppointmentRequestVisitor($db,
    $_POST['visitor_id'],
    $filename,
    $_POST['email'],
    $_POST['fullname'],
    $_POST['date'],
    $_POST['time'],
    $_POST['purpose']);

    $response = array(
        "message"=>"Create Request Appointment Successfully",
        "success"=>true 
    );
    echo json_encode($response);
}


function visitor_edit_appointment_request(){
    include("../../dotenv.php");
    include("$dir/model/index.php");
    include("$dir/model/administrative/visitor-management.php");

    $prev_req = getAppointmentRequestById($db,$_POST['req_id']);
    $prev_req['id_picture'];

    $id_picture = $_FILES['file'];
    $uuid = Uuid::uuid4();
    $fileNameParts = explode('.',$id_picture['name']);
    $ext = end($fileNameParts);
    $secretname =$uuid->toString();
    $filename = "$secretname.$ext";
    $uploaddir = $dir."/assets/request-appointment-id-picture/";
    $uploadfile = $uploaddir . basename($filename);

    if($id_picture['name'] != $prev_req['id_picture']){
        if(!move_uploaded_file($_FILES['file']['tmp_name'], $uploadfile)){
            $response = array(
                "message"=>"Server Error",
                "success"=>false
            );
            header('Content-Type: application/json; charset=utf-8');
            echo   json_encode($response);
            return;
        }
        updateProfile($db , $_POST['req_id'],$filename);
    }
  

    editAppointmentRequestVisitor($db,
        $_POST['req_id'],
        $_POST['email'],
        $_POST['fullname'],
        $_POST['date'],
        $_POST['time'],
        $_POST['purpose']);

        $response = array(
            "message"=>"Update Request Appointment Successfully",
            "success"=>true
        );
        echo json_encode($response);
}

function visitor_remove_appointment_request($id){
    include("../../dotenv.php");
    include("$dir/model/index.php");
    include("$dir/model/administrative/visitor-management.php");

    archiverRequestAppointment($db ,$id,"1");
    $response = array(
        "message"=>"Delete Request Appointment Successfully",
        "success"=>true
    );
    echo json_encode($response);
}


function visitor_send_message($id){
    include("../../dotenv.php");
    include("$dir/model/index.php");
    include("$dir/model/administrative/visitor-management.php");
    visitorSendMessage($db,$_POST['visitor-message'],$id);
    $response = array(
        "message"=>"Sent Message Successfully",
        "success"=>true
    );
    echo json_encode($response);
    
}

function staff_send_message($id,$to_id){
    include("../../dotenv.php");
    include("$dir/model/index.php");
    include("$dir/model/administrative/visitor-management.php");
    staffSendMessage($db,$_POST['staff-message'],$id,$to_id);
    $response = array(
        "message"=>"Sent Message Successfully",
        "success"=>true
    );
    echo json_encode($response);
    
}

function get_all_inquirers(){
    include("../../dotenv.php");
    include("$dir/model/index.php");
    include("$dir/model/administrative/visitor-management.php");
    
    $participants = [];
    $visitor_acc  = getAllVisitorAccountModel($db);
    foreach ($visitor_acc as $value) {
        $user =  getAllInquirersModel($db,$value['visitor_account_id']);
        if(!empty($user[0])){
            array_push( $participants, $user[0]);
        }
    }
    $response = array(
        "participants"=> $participants,
        "success"=>true
    );
    echo json_encode($response);
}

function redirect_to_user_chat($id){
    include("../../dotenv.php");
    include("$dir/model/index.php");
    include("$dir/model/administrative/visitor-management.php");

    $_SESSION['visitor_chat_id'] = $id;
    $response = array(
        "redirect"=>"redirect to user chat",
        "success"=>true
    );
    echo json_encode($response);
}

function redirect_to_user_chat_update_seen($id){
    include("../../dotenv.php");
    include("$dir/model/index.php");
    include("$dir/model/administrative/visitor-management.php");

    updateSeenFromId($db,$id);
    $_SESSION['visitor_chat_id'] = $id;
    $response = array(
        "redirect"=>"redirect to user chat",
        "success"=>true
    );
    echo json_encode($response);
}


function fetchVisitorConvo($id){
    include("../../dotenv.php");
    include("$dir/model/index.php");
    include("$dir/model/administrative/visitor-management.php");

    $response = array(
        "my_message"=>getMyMessage($db,$id),
        "staff_message"=>getStaffMessage($db,$id),
        "affect"=>effectVisitorMessage($db)
    );
    echo json_encode($response);
}

function fetchStaffConvo($id,$staff_id){
    include("../../dotenv.php");
    include("$dir/model/index.php");
    include("$dir/model/administrative/visitor-management.php");

    $response = array(
        "my_message"=>getMyStaffMessage($db,$id,$staff_id),
        "visitor_message"=>getVisitorMessage($db,$id),
        "affect"=>effectStaffMessage($db)
    );
    echo json_encode($response);
}

call_user_func_array($function_name,$slice_function_params);
exit();
?>