<?php
public function check_required_value($chk_params, $converted_array)
{
    foreach ($chk_params as $param)
    {
        if(array_key_exists($param, $converted_array) && ($converted_array[$param] !='')){
            $check_error = 0;
        } 
        else{
            $check_error=array('check_error'=>1,'param'=>$param);
            break;
        }
    }
    return $check_error;
}



public function getFollowers_post()
{
    $userid = $this->input->post('userid');
    $checkData = array('userid' => $userid);
    $required_parameter = array('userid');
    $chk_error = $this->check_required_value($required_parameter,$checkData);
    if ($chk_error) {
        $resp = array('code'=>'501','message'=>'Missing '.ucwords($chk_error['param']));
        @$this->response($resp); exit;
    }
}
=============================================OR=====Error show same page===================================================
    

function check_required_value($chk_params,$converted_array)
{
    foreach ($chk_params as $param)
    {
        if(array_key_exists($param, $converted_array) && ($converted_array[$param] !='')){
            $check_error = 0;
        } 
        else{
            $check_error=array('error'=>1,'param'=>$param);
            break;
        }
    }
    
    if($check_error['error']>0){
    	$resp = array('code'=>'501','message'=>'Missing '.ucwords($check_error['param']));
	    print_r(json_encode(($resp))); dd();
    }
}    
    
