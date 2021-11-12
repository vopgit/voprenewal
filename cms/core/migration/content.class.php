<?php
set_time_limit(0);
header('Content-Type: text/html; charset=UTF-8');

exit;

function make_serial($id, $type='article'){
	switch ($type) {
			case 'image':
			case 'I':
			case 'photo':
			case 'P':
				$prefix = 'P'; break;
			case 'article':
			case 'A':
				$prefix = 'A'; break;
			case 'slide':
			case 'S':
				$prefix = 'S'; break;
			case 'video':
			case 'V':
				$prefix = 'V'; break;
			case 'post':
			case 'R':
				$prefix = 'R'; break;
			default:
				$prefix = 'O'; break;
		}
	return sprintf('%s%011d', $prefix, $id);		
}
?>
<script  src="/resource/js/jquery-3.4.1.min.js"></script>
<span id="now"></span> / <span id="total">10000</span>

<?php 
$page = ($_GET[page] != '') ? $_GET[page] : 1;
$page_size = 10000;
$start = ($page - 1) * $page_size;

if($page == 1){
	$total = $db->total("select count(*) from contents where type != 'image'");
	$tot_page = ceil($total / $page_size);
	echo $total .",". $tot_page;
} else {
	$tot_page = $_GET[tot_page];
}

$query = "select * from contents where type != 'image' order by id desc limit $start, $page_size";
$rs = $db->select($query);

$i = 0;

foreach($rs as $rs) {

	//카테고리
	$cate = $db->rowone("select group_concat(distinct(category_id)) from contents_category where contents_id = '".$rs[id]."' group by contents_id");
	$tags = $db->rowone("select group_concat(distinct(tag_id)) from contents_tags where contents_id='".$rs[id]."' group by contents_id");
	$contents = $db->row("select body, comment, is_locked from contents_history where contents_id= '".$rs[id]."' order by regist_time desc limit 1");
	$related = $db->rowone("select group_concat(distinct(related_contents_id)) from contents_related_contents where contents_id='".$rs[id]."' group by contents_id");
	$cnt = $db->total("select count(*) from contents_history where contents_id='".$rs[id]."'");
	
	$data = array(
		'id' => $rs[id],
		'sorder' => ($rs[id] * -1),
		'serial' => make_serial($rs[id], $rs[type]),
		'member_id' => $rs[member_id],
		'type' => $rs[type],
		'kind' => $rs[kind],
		'category_id' => $cate,
		//'onesource' => '',
		'media_id' => $rs[media_id],
		//'title' => $rs[title],
		//'description' => $rs[description],
		//'contents' => $contents['body'],
		'comment' => $contents['comment'],
		'is_locked' => $contents['is_locked'],
		'request_to' => $rs[request_to],
		'request_from' => $rs[request_from],
		'contributor' => $rs[contributor],
		'mod_cnt' => $cnt,
		'related' => $related,
		'tags' => $tags,
		'status' => $rs[status],
		'regist_time' => $rs[regist_time],
		'update_time' => $rs[update_time],
		'published_time' => ($rs[published_time] != "") ? $rs[published_time] : NULL,
		'order_id' => $rs[order_id]  //<- 삭제요망
		);

	$db->insert('TBL_CONTENTS', $data);

	$data2 = array(
		'contents_id' => $rs[id],
		'title' => $rs[title],
		'description' => $rs[description],
		'content' => $contents['body'],
		);

	$db->insert('TBL_CONTENTS_BODY', $data2);

	
	$i++;

	if($i % 100 == 0){
		echo "<script>$('#now').html('".$i."');</script>";
		ob_flush();
		flush();
	}

}
if($tot_page > $page){
	sleep(1);		
	echo "<script>location.href = '/migration/content?tot_page=".$tot_page."&page=".($page+1)."';</script>";
}else{
	echo "<script>$('#now').html('".$i."');alert('done');</script>";
}
exit;
?>