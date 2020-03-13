<?php

public function singleImage($name,$path,$url='')
{
    $config['allowed_types'] = '*';
    $config['upload_path']   = $path;        

    $this->load->library('upload', $config);
    $this->upload->initialize($config);

    if($this->upload->do_upload($name)){
        $data = $this->upload->data();
        return $data['file_name'];
        //return array('error'=>0,'name'=>$data['file_name']);            
    }
    else
    {
        $error = $this->upload->display_errors();
        $msg = array('message'=>$error,'alert'=>'alert alert-danger'); 
        $this->session->set_flashdata('self_message',$msg);            
        if($url==""){                                
            redirect($_SERVER['HTTP_REFERER']);
        }else{
            redirect(base_url($url));
        }
        //return array('error'=>1,'msg'=>$error);           
    }
}
================================

public function dynamicImageUploadMultiple($name,$folder)
{         
    $imageArray = array();
    $ImageCount = count($_FILES[$name]['name']);

    for($i=0;$i<$ImageCount; $i++)
    {
        $_FILES['file']['name']       = $_FILES[$name]['name'][$i];
        $_FILES['file']['type']       = $_FILES[$name]['type'][$i];
        $_FILES['file']['tmp_name']   = $_FILES[$name]['tmp_name'][$i];
        $_FILES['file']['error']      = $_FILES[$name]['error'][$i];
        $_FILES['file']['size']       = $_FILES[$name]['size'][$i];

        $config['allowed_types']  = '*';
        $config['upload_path'] = $folder;

        $this->load->library('upload',$config);
        $this->upload->initialize($config);

        if($this->upload->do_upload('file'))
        {                
            $data = $this->upload->data();                
            $uploadImgData[$i][$name] = $data['file_name'];

            $imageArray[] = $uploadImgData[$i][$name];
        }else{
            $error = $this->upload->display_errors();
            $resp = array('success' => 0, 'message' => $error); 
            @$this->response($resp);
            exit;
        }
    }
    return $imageArray;

}

if(!empty($_FILES['profile_image']['name'])){
    $fileName = $this->dynamicImageUploadMultiple('profile_image','uploads/profile/');
}
else{
    $fileName = '';
}

=====================Blob Image===============

public function imageBlob($name)
{
    is_uploaded_file($_FILES[$name]['tmp_name']);
    $blobImage = addslashes(file_get_contents($_FILES[$name]['tmp_name']));
    $imageProperties = getimageSize($_FILES[$name]['tmp_name']);

    $width = $imageProperties[0];
    $height = $imageProperties[1];
    $imageType = str_replace('image/',"",$imageProperties['mime']);

    $data = array('width'=>$width,'height'=>$height,'imageType'=>$imageType,'blobImage'=>$blobImage);
    return $data;
}

if(!empty($_FILES['profileImage']['tmp_name']))
{
    $prf = $this->imageBlob('profileImage');
    
    $profileImageWidth  = $prf['width'];
    $profileImageHeight = $prf['height'];
    $profileImageType   = $prf['type'];
    $profileImageBlob   = $prf['blob']; 

    $whereBlob = array('userid'=>$user_id,'blobid'=>$userData['avatarblobid']);
    $this->model->deleteQuery('qa_blobs',$whereBlob);

    $profileData = array('blobid'=>$avatarblobid,'format'=>$profileImageType,'content'=>$profileImageBlob,'userid'=>$user_id,'created'=>$created);
    $this->model->insertQuery1('qa_blobs',$profileData);
}
