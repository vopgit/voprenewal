<?php
set_time_limit(0);
header('Content-Type: text/html; charset=UTF-8');

exit;

// TBL_CONTENTS 테이블내 column_id 정보 업데이트 (칼럼 그룹아이디 업데이트, 오피니언 페이지 칼럼 그룹별 리스트에 사용)
// [TBL_COLUMN 테이블 기준]
// 1. TBL_COLUMN - id(tag_id), where del_tf=N
// 2. SELECT contents_id, tag_id FROM `contents_tags` WHERE tag_id=id
// 3. UPDATE TBL_CONTENTS SET column_id Value tag_id WHERE id = contents_id

?>
<script  src="/resource/js/jquery-3.4.1.min.js"></script>
<span id="now"></span> / <span id="total">10000</span>

<?php 
$page = ($_GET[page] != '') ? $_GET[page] : 1;
$page_size = 10000;
$start = ($page - 1) * $page_size;

if($page == 1){
	$total = $db->total("select count(*) from TBL_COLUMN where del_tf='N' ");
	//$total = $db->total("select count(*) from TBL_CONTENTS where id > 22 and id<>204993 ");
	$tot_page = ceil($total / $page_size);
	echo $total .",". $tot_page;
} else {
	$tot_page = $_GET[tot_page];
}

$query = "select id, description from TBL_COLUMN where del_tf='N' limit $start, $page_size";
//$query = "select * from TBL_CONTENTS where id > 22 and id<>204993 order by id desc limit $start, $page_size";



$rs = $db->select($query);

$i = 0;
$j = 0;

foreach($rs as $rs) {

	$query = "select id, name from tags where name= '".trim($rs['description'])."'";

	$rs_tag = $db->row($query);

	$query = "select contents_id, tag_id from contents_tags where tag_id= '".$rs_tag['id']."' ";

	$rs_tag_id = $db->select($query);

	foreach($rs_tag_id as $rs_tag_id) {

		$data = array(
		'column_id' => $rs_tag_id['tag_id']
		);

		$where = array('id' => $rs_tag_id['contents_id']);

		$result = $db->update("TBL_CONTENTS", $data, $where);

		//TBL_COLUMN 테이블의 id 값에 문제가 있어서 업데이트 처리함 (2021.11.7)
//		if($result){
//			$data = array(
//			'id' => $rs_tag['id']
//			);
//
//			$where = array('id' => $rs['id']);
//
//			$db->update("TBL_COLUMN", $data, $where);
//
//		}

		$j++;

//		echo "<br>";
//		echo "tag_id :: ".$rs_tag_id['tag_id'];
//		echo "<br>";
//		echo "contents_id :: ".$rs_tag_id['contents_id'];
//		echo "<br>";
//		echo "j :: ".$j;
//		echo "<br>";
	}

	
	$i++;

	//echo "<br>";
	//echo "i :: ".$i;

	if($i % 100 == 0){
		echo "<script>$('#now').html('".$i."');</script>";
		ob_flush();
		flush();
	}

}


if($tot_page > $page){
	sleep(1);		
	echo "<script>location.href = '/migration/kind?tot_page=".$tot_page."&page=".($page+1)."';</script>";
}else{
	echo "<script>$('#now').html('".$i."');alert('done');</script>";
}
exit;
?>