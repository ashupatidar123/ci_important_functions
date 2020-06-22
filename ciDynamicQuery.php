<?php

Fetch One query
$catRec = $this->AdminModel->fetchQuery($select,'users','','','',$andWhere,$groupBy='',$orderName,$ascDsc,$sLimit,$eLimit);

public function fetchQuery($select,$tbl,$where=NULL,$joinTbl=NULL,$joinId=NULL,$joinLR=NULL,$groupBy=NULL,$orderName=NULL,$ascDsc=NULL,$sLimit=NULL,$eLimit=NULL)
{
	$this->db->select($select);
	$this->db->from($tbl);
	if(!empty($where)){
		$this->db->where($where);
	}	
	if(!empty($groupBy)){
		$this->db->group_by($groupBy);
	}
	if(!empty($orderName)){
		$this->db->order_by($orderName,$ascDsc);
	}	
	if($eLimit>0){
		$this->db->limit($eLimit,$sLimit);
	}
	if(!empty($joinTbl)){
		$this->db->join($joinTbl, $joinId,$joinLR);
	}
    $query = $this->db->get();
	//echo $this->db->last_query(); die();
	return $query->result_array();
}

==================Count One Query=====================

$totSearch = $this->AdminModel->countQuery('users','','','',$andWhere,$orWhere='',$andLike,$orLike,'');

public function countQuery($tbl,$joinTbl=NULL,$joinId=NULL,$joinLR=NULL,$andWhere=NULL,$orWhere=NULL,$andLike=NULL,$orLike=NULL)
{
	$this->db->select('count(*) as total');
	$this->db->from($tbl);
	if(!empty($andWhere)){
		$this->db->where($andWhere);
	}
	if(!empty($orWhere)){
		$this->db->where($orWhere);
	}
	if(!empty($andLike)){
		$this->db->like($andLike);
	}
	if(!empty($orLike)){
		$this->db->or_like($orLike);
	}
	if(!empty($joinTbl)){
		$this->db->join($joinTbl, $joinId,$joinLR);
	}
    $query = $this->db->get();
	//echo $this->db->last_query(); die();
	$cnt = $query->row_array();
	return $cnt['total'];
}

==================Insert record====
public function dynamicInsertData($tbl,$data)
{		
	$this->db->insert($tbl,$data);
	return $this->db->insert_id();
}

==================Delete record====
public function dynamicDeleteData($tbl,$where)
{		
	if(!empty($where)){
		$this->db->where($where);
	}		
	$this->db->delete($tbl);
	if($this->db->affected_rows()>0)
		return 1;
	else
		return 0;
}

==================Update record====
public function dynamicUpdateData($tbl,$where,$data)
{		
	if(!empty($where)){
		$this->db->where($where);
	}
	$this->db->update($tbl,$data);
	return 1;
}











===============================================================

Get all record query
//Controller call
public function ajaxCatData()
{
	$whereSearch= array('category_id!='=>'');
	$andLike= array('category_name'=>'c');
	$orLike= array('category_desc'=>'t',);
	$orderName='category_id';
	$ascDsc ='DESC';
	$groupBy = 'category_id';
	$sLimit=0;$eLimit=10;

	$catRec = $this->CommonModel->fetchAllLike('*','category',$whereSearch='',$andLike,$orLike,$groupBy,$orderName,$ascDsc,$sLimit,$eLimit);
}

//Output query

'SELECT * FROM `category` WHERE `category_name` LIKE '%c%' ESCAPE '!' OR `category_desc` LIKE '%t%' ESCAPE '!' GROUP BY `category_id` ORDER BY `category_id` DESC LIMIT 10';



//Model call
public function fetchAllLike($select,$tbl,$where,$andLike,$orLike,$groupBy,$orderName,$ascDsc,$sLimit,$eLimit)
{				
	$this->db->select($select);
	if(!empty($where)){
		$this->db->where($where);
	}
	if(!empty($andLike)){
		$this->db->like($andLike);
	}
	if(!empty($orLike)){
		$this->db->or_like($orLike);
	}
	if(!empty($groupBy)){
		$this->db->group_by($groupBy);
	}		
	if(!empty($orderName)){
		$this->db->order_by($orderName,$ascDsc);
	}
	if(!empty($eLimit)){
		$this->db->limit($eLimit,$sLimit);
	}		
	$query = $this->db->get($tbl);
	echo $this->db->last_query();
	//return $query->result_array();
}


===========Model Call====================

count number record query

public function countRecordLike($tbl,$where=NULL,$andLike=NULL,$orLike=NULL,$groupBy=NULL)
{
	$this->db->select('count(*) as total');
	if(!empty($where)){
		$this->db->where($where);
	}
	if(!empty($andLike)){
		$this->db->like($andLike);
	}
	if(!empty($orLike)){
		$this->db->or_like($orLike);
	}
	if(!empty($groupBy)){
		$this->db->group_by($groupBy);
	}
	$query = $this->db->get($tbl);
	$cnt = $query->row_array();
	return $cnt['total'];
}



====================Custom Query=========
public function getBuyPost($where)
{
	$query ="SELECT ap.*,u.userid,u.handle FROM qa_adimvipre ap JOIN qa_users u ON ap.buyer=u.userid $where";
	return $this->CI->db->query($query)->result_array();                 
}	

$where = array('userEmail'=>$userEmail, 'userId!='=>$userId);

public function customCount($tbl,$where=''){
	$qry = "SELECT count(*) as total FROM $tbl $where";
	//echo $qry; die();
	$query = $this->db->query($qry);
	$cnt = $query->row_array();
	return $cnt['total'];
}
	
	
