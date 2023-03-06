<?php

function createAppointmentRequestVisitor($db,$id,$id_pic,$email,$fullname,$date,$time,$purpose){
    $createdAt = (new \DateTime())->format('Y-m-d g:i:s');
    $sql= "INSERT INTO `visitor-appointment-request`
    (`fullname`, `id_picture`, `date`, `time`, `email`, `approved`, `declined`, `pending`, `deleted`, `visitor_id`,`purpose`,`req_createdAt`) 
    VALUES ('$fullname','$id_pic','$date','$time','$email','0','0','1','0','$id','$purpose','$createdAt')";
    $db->query($sql);
}

function getAllAppointmentRequest($db,$id){
    $sql= "SELECT * FROM `visitor-appointment-request` WHERE `visitor_id` ='$id' AND `deleted`= '0' ";
    $result = $db->query($sql);
    $requestCreated =  $result->fetch_all(MYSQLI_ASSOC);
    return $requestCreated;
}

function getAppointmentRequestById($db,$id){
    $sql= "SELECT * FROM `visitor-appointment-request` WHERE `visitor_req_id` ='$id'";
    $result = $db->query($sql);
    $requestCreated =  $result->fetch_assoc();
    return $requestCreated;
}

function editAppointmentRequestVisitor($db,$id,$email,$fullname,$date,$time,$purpose){
    $sql = "UPDATE `visitor-appointment-request` SET `fullname`='$fullname',`date`='$date',`time`='$time',`purpose`='$purpose' WHERE `visitor_req_id`= '$id'";
    $db->query($sql);
}

function updateProfile($db,$id,$profile){
    $sql = "UPDATE `visitor-appointment-request` SET `id_picture`='$profile' WHERE `visitor_req_id`= '$id'";
    $db->query($sql);
}

function archiverRequestAppointment($db ,$id, $archive){
    $sql = "UPDATE `visitor-appointment-request` SET `deleted`='$archive' WHERE `visitor_req_id`= '$id'";
    $db->query($sql);
}



function visitorSendMessage($db,$message,$from_id){
    $createdAt = time();
    $visitor_sender = '1';
    $seen = "0";
    $sql = "INSERT INTO `inquirers`
    ( `message`, `from_id`, `createdAt`, `visitor_sender`, `seen`) VALUES 
    ('$message','$from_id','$createdAt','$visitor_sender','$seen')";
    $db->query($sql);
}

function staffSendMessage($db,$message,$id,$to_id){
    $createdAt = time();
    $visitor_sender = '1';
    $seen = "0";
    $sql = "INSERT INTO `inquirers`
    ( `message`, `from_id`, `createdAt`, `visitor_sender`, `seen`,`to_id`) VALUES 
    ('$message','$id','$createdAt','$visitor_sender','$seen','$to_id')";
    $db->query($sql);
}

function getAllInquirersModel($db ,$id){
    $sql = "SELECT * FROM `inquirers` inq JOIN `visitor-account` va ON va.visitor_account_id= inq.from_id WHERE inq.from_id = '$id' ORDER BY createdAt DESC
    LIMIT 1 ";
    $result = $db->query($sql);
    $accounts =  $result->fetch_all(MYSQLI_ASSOC);
    return $accounts;
}

function getAllVisitorAccountModel($db){
    $sql = "SELECT * FROM `visitor-account`";
    $result = $db->query($sql);
    $accounts =  $result->fetch_all(MYSQLI_ASSOC);
    return $accounts;
}

function updateSeenFromId($db,$id){
    $sql = "UPDATE `inquirers` SET `seen`='1' WHERE `from_id` = '$id'"; 
    $db->query($sql);
}

function getMyMessage($db,$id){
    $sql = "SELECT * FROM `inquirers` WHERE `from_id` ='$id'";
    $result = $db->query($sql);
    $staffMessage =  $result->fetch_all(MYSQLI_ASSOC);
    return $staffMessage;
}
function getStaffMessage($db,$id){
   $sql = "SELECT inq.*, aea.profile FROM `inquirers` inq JOIN `admin-employe-accounts` aea ON aea.account_id = inq.from_id WHERE inq.to_id ='$id'  ";
   $result = $db->query($sql);
   $staffMessage =  $result->fetch_all(MYSQLI_ASSOC);
   return $staffMessage;
}

function getVisitorMessage($db,$id){
    $sql = "SELECT inq.*, va.profile_link FROM `inquirers` inq LEFT JOIN
     `visitor-account` va ON va.visitor_account_id  = inq.from_id
      WHERE inq.from_id ='$id'  ";
    $result = $db->query($sql);
    $staffMessage =  $result->fetch_all(MYSQLI_ASSOC);
    return $staffMessage;
}
function getMyStaffMessage($db,$id,$staff_id){
    $sql = "SELECT inq.*, aea.profile FROM `inquirers` inq 
    JOIN `admin-employe-accounts` aea ON aea.account_id = inq.from_id  
    WHERE inq.from_id ='$staff_id' AND inq.to_id = '$id'";
    $result = $db->query($sql);
    $staffMessage =  $result->fetch_all(MYSQLI_ASSOC);
    return $staffMessage;
}

//eaffect
function effectVisitorMessage($db){
    $time = time();
    $sql = "SELECT IFNULL(CAST(`createdAt` AS INT),0) FROM `inquirers` WHERE  `createdAt` >='$time' AND `to_id` IS NOT NULL ";
    $result = $db->query($sql);
    return $db->affected_rows;
}



function effectStaffMessage($db){
    $time = time();
    $sql = "SELECT IFNULL(CAST(`createdAt` AS INT),0) FROM `inquirers` WHERE  `createdAt` >='$time' AND `to_id` IS NULL ";
    $result = $db->query($sql);
    return $db->affected_rows;
}

?>