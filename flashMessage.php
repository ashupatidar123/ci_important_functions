<?php

if(($this->AdminModel->dynamicDeleteData('certificates',$where))>0){
	$msg = array('message'=>'<strong>Congratulations!</strong> Record successfully deleted.','alert'=>'alert alert-success');			
}else{
	$msg = array('message'=>'<strong>Opps!</strong> Record deletion failed','alert'=>'alert alert-danger');			
}
$this->session->set_flashdata('response',$msg);
redirect($_SERVER['HTTP_REFERER']);



=============HTML SET===========
?>

<div class="container">
    <?php 
        if(!empty($this->session->flashdata('response'))){ ?>
        	<div class="hideFlash <?=$this->session->flashdata('response')['alert'];?>">
           		<strong> <?=$this->session->flashdata('response')['message'];?></strong> 
        	</div>
    <?php }?>
</div>