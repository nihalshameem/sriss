<?php 

include ('connection.php');

if(isset($_REQUEST)){
    $time=date ('Y-m-d H:i:s', strtotime($_REQUEST['receive_time']));
$sql = "INSERT INTO `missed_call_numbers` (`mobile_no`, `mvn`, `created_at`) VALUES ('{$_REQUEST['from']}','{$_REQUEST['did']}','{$time}')";
    if (mysqli_query($mysqli,$sql)){
        success_response(200, "Registered Successfully.", NULL);
    }
    else
    {
        failure_response(400, "Registeration Failed.", NULL);
    }
}else{
    failure_response(400, "No Response.", NULL);
}
    
    function success_response($status, $status_message, $data)
    {
        header("HTTP/1.1 " . $status);
    
        $response['statusCode'] = $status;
        $response['message'] = $status_message;
        $response['results'] = $data;
        $json_response = json_encode($response,JSON_NUMERIC_CHECK);
        echo $json_response;
    }
    function failure_response($status, $status_message,$data)
    {
        header("HTTP/1.1 " . $status);
    
        $response['statusCode'] = $status;
        $response['message'] = $status_message;
        $response['results'] = $data;
        $json_response = json_encode($response);
        echo $json_response;
    }


?>