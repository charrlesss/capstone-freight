<?php
    function getAccountByEmployeeId($db,$employee_id){
        $sql = "SELECT * FROM `admin-employe-accounts` 
        WHERE `employee_id`='$employee_id'";
        $result = $db->query($sql);
       return $result -> fetch_assoc();
    }



    function log_account($db,$id,$action){
        $log_history = (new \DateTime())->format('Y-m-d g:i:s');
        $sql = "INSERT INTO `log_history_admin`(`log_action`, `log_time`, `account_id`) 
        VALUES ('$action','$log_history','$id')";
        $db->query($sql);
    }

?>