<?php
if(!defined('_HOME_TITLE')) exit;


$_contents = new Category();



//신규등록

if( $_base['method'] == 'POST' && $mode == "insert"){

	if($adm_no == "" || $news_kind_name == "" || $str_category == "") msg_err("주요 등록 항목이 누락되었습니다.");

	$add_data = array(
			'category_id' => $str_category,
			'name' => $news_kind_name,
			'reg_adm' => $adm_no,
			'reg_ip' => $_SERVER["REMOTE_ADDR"],
			'reg_date' => date("Y-m-d H:i:s")
			);
	//$data = array_merge($data, $add_data);

	$result = $_contents->add($add_data);

	//msg_err("등록에 실패하였습니다bbbb".$result);


	if($result) msg_replace("등록되었습니다", 'list_news_kind');
	else msg_err("등록에 실패하였습니다");

	exit;

}

//정보수정
if($_base['method'] == 'POST' && $mode == "modify"){

	$param_data = array(
		'name'=>$name,
		'nPage'=>$nPage
		);

	$param = makeParam($param_data);

	if(empty($seq)) msg_err("대상이 없습니다");

	if($adm_no == "" || $news_kind_name == "" || $str_category == "") msg_err("주요 등록 항목이 누락되었습니다.");


	$add_data = array(
			'category_id' => $str_category,
			'name' => $news_kind_name,
			'modi_adm' => $adm_no,
			'modi_ip' => $_SERVER["REMOTE_ADDR"],
			'modi_date' => date("Y-m-d H:i:s")
			);

	$where = array('id' => $seq);

	$result = $_contents->update($add_data, $where);

	if($result) msg_replace("수정되었습니다", 'list_news_kind'.$param['query']);
	else msg_err("수정에 실패하였습니다");

	exit;
}

//정보수정
if($_base['method'] == 'POST' && $mode == "use_tf_modify"){

	$param_data = array(
		'nPage'=>$nPage
		);

	$param = makeParam($param_data);

	if(empty($seq)) msg_err("대상이 없습니다");

	if($adm_no == "" || $use_tf == "") msg_err("주요 등록 항목이 누락되었습니다.");


	$add_data = array(
			'use_tf' => $use_tf,
			'modi_adm' => $adm_no,
			'modi_ip' => $_SERVER["REMOTE_ADDR"],
			'modi_date' => date("Y-m-d H:i:s")
			);

	$where = array('id' => $seq);

	$result = $_contents->update($add_data, $where);

	if($result) msg_replace("수정되었습니다", 'list_news_kind'.$param['query']);
	else msg_err("수정에 실패하였습니다");

	exit;
	
}



//선택삭제
if($_base['method'] == 'POST' && $mode == "selDelete"){

	$param_data = array(
		'nPage'=>$nPage
		);

	$param = makeParam($param_data);

	if(count($chk) < 1) msg_err("대상이 없습니다");

	if($adm_no == "") msg_err("주요 등록 항목이 누락되었습니다.");

	if($db->query("update TBL_NEWS_KIND set del_tf = 'Y', del_adm = '".$adm_no."', del_date = now(), del_ip = '".$_SERVER["REMOTE_ADDR"]."' where id in (".implode(',', $chk).")")) msg_replace("삭제되었습니다", 'list_news_kind'.$param['query']);
	else msg_err("삭제에 실패하였습니다");
	exit;

}

//정보삭제
if($_base['method'] == 'POST' && $mode == "Delete"){

	$param_data = array(
		'nPage'=>$nPage
		);

	$param = makeParam($param_data);

	if(empty($seq)) msg_err("대상이 없습니다");

	if($adm_no == "") msg_err("주요 등록 항목이 누락되었습니다.");

	$add_data = array(
			'del_tf' => 'Y',
			'del_adm' => $adm_no,
			'del_ip' => $_SERVER["REMOTE_ADDR"],
			'del_date' => date("Y-m-d H:i:s")
			);

	$where = array('id' => $seq);

	$result = $_contents->update($add_data, $where);

	if($result) msg_replace("삭제되었습니다", 'list_news_kind'.$param['query']);
	else msg_err("삭제에 실패하였습니다");

	exit;
	
}



exit;