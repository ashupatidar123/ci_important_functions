<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class My_encryption{

	public function encode_id($id=''){
		if($id==''){
			redirect($_SERVER['HTTP_REFERER']);
		}
		$str1 = str_shuffle("AB3q1r6g8a2j8l0n8l5h4LM25");
		$str2 = str_shuffle("28d8F7c74Rd21a8HO09p3Sxl3N7");
		$id   = base64_encode($id);
		$id   = bin2hex($id);
		$id   = str_replace('=','rm7t',$id);
		return $str1.$id.$str2;		
	}

	public function decode_id($id='',$url=''){
		if($id==''){
			redirect($_SERVER['HTTP_REFERER']);
		}
		$id   = substr($id,25,-31);
		$id   = hex2bin($id);
		return base64_decode($id);
	}
}