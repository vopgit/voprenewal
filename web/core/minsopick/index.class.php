<?php
if(!defined('_HOME_TITLE')) exit;

//민소픽 상단 3개
$qry = "select A.id, A.serial, A.contributor, A.published_time, B.title, B.description, C.mthumbnail, D.name as writer_name
		from TBL_CONTENTS A 
		left join TBL_CONTENTS_BODY B on A.id = B.contents_id
		left join TBL_CONTENTS_MOBILE C on A.id = C.contents_id 
		left join TBL_MEMBER D on A.member_id = D.id
		where A.kind = 5 and status='published'
		order by published_time desc limit 3";
$rs = $db->select($qry);

//민소픽 그룹별 정렬 및 게시물 수 가져오기
$sql = "select AA.* from 
		(select A.id, A.title, B.cnt from TBL_MINSOPICK A 
		left join (select minsopick_id, count(id) as cnt from TBL_CONTENTS where kind = 5 and status ='published' group by minsopick_id) B on A.id = B.minsopick_id
		where A.del_tf = 'N' order by A.priority) AA order by cnt desc";
$rs2 = $db->select($sql);


for($i=0; $i<count($rs2); $i++) {
	$qry = "select A.id, A.serial, A.contributor, A.published_time, B.title, B.description, C.mthumbnail, D.name as writer_name
			from TBL_CONTENTS A 
			left join TBL_CONTENTS_BODY B on A.id = B.contents_id
			left join TBL_CONTENTS_MOBILE C on A.id = C.contents_id 
		    left join TBL_MEMBER D on A.member_id = D.id
			where A.kind = 5 and A.minsopick_id = '".$rs2[$i]['id']."' and status='published'
			order by published_time desc limit 3";
	$rs2[$i]['data'] = $db->select($qry);	
}

?>