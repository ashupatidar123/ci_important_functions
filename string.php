<?php
referance admin Api.php=========
=======Create helper in CI===============

function tagRemove($data=''){

    $tags = array("p","img","table","tr","td","h","&nbsp;","div","strong","span","div","bold","a");

    foreach($tags as $tag){
        return preg_replace("/<\\/?" . $tag . "(.|\\s)*?>/", $replace_with='', $data);
    }
}

=========================

function stringReplace($data=''){
    $str = array("<p>","</p>","\"","\r\n","&nbsp;","<",">");
    return str_replace($str,'',$data);
}

=============================Image Path check==========
function getImagePath($content,$type='')
{
    //preg_match('%<img.*?src=["\'](.*?)["\'].*?/>%i', $content , $result);
    //print_r($result); die();//return $result[1]; 
    if($type=='PostReadMore')
    {
        preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $content, $match);
        if(!empty($match[0][0])){
            return $match[0];
        }else{
            return '';
        }
    }else{
        preg_match_all('#\bhttps?://[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|/))#', $content, $match);
        if(!empty($match[0][0])){
            return $match[0][0];
        }else{
            return '';
        }
    }
}

$image_path = $this->getImagePath($post_description,'PostReadMore');
if(!empty($image_path)){
                    
    foreach($image_path as $key=>$img)
    {
        if((strpos($img,'youtu') == true) || (strpos($img,'youtube')==true)){
            $status='2';
        }else{
            $status='1';
        }
        $desc[] = array('img'=>$img,'status'=>$status);
    }
}

====================================================================================================








