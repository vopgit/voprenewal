<?php
set_time_limit(0);
header('Content-Type: text/html; charset=UTF-8');

exit;

?>
<script  src="/resource/js/jquery-3.4.1.min.js"></script>
<span id="now"></span> / <span id="total">10000</span>

<?php 
$page = ($_GET[page] != '') ? $_GET[page] : 1;
$page_size = 10000;
$start = ($page - 1) * $page_size;

if($page == 1){
	$total = $db->total("select count(*) from TBL_CONTENTS");
	//$total = $db->total("select count(*) from TBL_CONTENTS where id > 22 and id<>204993 ");
	$tot_page = ceil($total / $page_size);
	echo $total .",". $tot_page;
} else {
	$tot_page = $_GET[tot_page];
}

$query = "select * from TBL_CONTENTS where 1=1 order by id desc limit $start, $page_size";
//$query = "select * from TBL_CONTENTS where id > 22 and id<>204993 order by id desc limit $start, $page_size";
$rs = $db->select($query);

$i = 0;

foreach($rs as $rs) {

	$contents = $db->row("select id, kind, category_id, media_id, contributor from TBL_CONTENTS where id= '".$rs[id]."' order by id desc limit 1");

	//$category_id = $db->rowone("select group_concat(distinct(category_id)) from TBL_CONTENTS where contents_id = '".$rs[id]."' group by contents_id");

	//카테고리
	//$cate = $db->rowone("select group_concat(distinct(category_id)) from contents_category where contents_id = '".$rs[id]."' group by contents_id");
//	$tags = $db->rowone("select group_concat(distinct(tag_id)) from contents_tags where contents_id='".$rs[id]."' group by contents_id");
//	$contents = $db->row("select body, comment, is_locked from contents_history where contents_id= '".$rs[id]."' order by regist_time desc limit 1");
//	$related = $db->rowone("select group_concat(distinct(related_contents_id)) from contents_related_contents where contents_id='".$rs[id]."' group by contents_id");
//	$cnt = $db->total("select count(*) from contents_history where contents_id='".$rs[id]."'");

	
	$data = array(
		'kind_old' => $contents['kind'],
		'category_id_old' => $contents['category_id']
		);

	$where = array('id' => $rs[id]);

	$result = $db->update("TBL_CONTENTS", $data, $where);

	if($result){

		//$kind_id = $db->row("select id, name from TBL_NEWS_KIND where use_tf='Y' and del_tf='N' and name= '".$rs[kind]."' limit 1");
		//$category_id = $db->row("select id, name from TBL_CATEGORIES where use_tf='Y' and del_tf='N' and name= '".$rs[category_id]."' limit 1");

		$str_kind_id = "";
		$str_category_id = "";

		switch ($contents['kind']) {
			case "인포그래픽":
			case "만민보":
			case "시/문학":
			case "일반기사":
				$kind_id = $db->row("select id, name from TBL_NEWS_KIND where use_tf='Y' and del_tf='N' and name= '일반기사' limit 1");

				$str_kind_id = $kind_id["id"];
				break;

			case "포토":
				$kind_id = $db->row("select id, name from TBL_NEWS_KIND where use_tf='Y' and del_tf='N' and name= '포토뉴스' limit 1");

				$str_kind_id = $kind_id["id"];
				break;

			case "만평":
				$kind_id = $db->row("select id, name from TBL_NEWS_KIND where use_tf='Y' and del_tf='N' and name= '만평' limit 1");

				$str_kind_id = $kind_id["id"];
				break;

			case "기고/칼럼":
				if($contents['contributor']=="민중의소리"){
					$kind_id = $db->row("select id, name from TBL_NEWS_KIND where use_tf='Y' and del_tf='N' and name= '사설' limit 1");
				}else{
					$kind_id = $db->row("select id, name from TBL_NEWS_KIND where use_tf='Y' and del_tf='N' and name= '칼럼' limit 1");
				}

				$str_kind_id = $kind_id["id"];
				break;
		}

		if($contents['category_id'] != ""){

			$arr_category_id = explode(',' , $contents['category_id']);

			

			if(count($arr_category_id) > 1){

				sort($arr_category_id);	//오름차순 재정렬

				for ( $j=0; $j < count($arr_category_id) ; $j++) {

					$result_category_id = $db->row("select id, name from TBL_CATEGORIES where use_tf='Y' and del_tf='N' and id= '".$arr_category_id[$j]."' limit 1");

					if($result_category_id["id"] != ""){
						//제일 작은 id값으로 기사분류명을 지정함 (이전 기사들의 복수 기사분류명 사용 정보들의 기사분류명 처리 정책 적용)
						$str_category_id = $result_category_id["id"];
						break;
					}
				}

				//echo "bbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbbb :: ".$str_category_id;
				//exit;

			}else{

				$qry = "select id, name from TBL_CATEGORIES where use_tf='Y' and del_tf='N' and id= '".$contents['category_id']."' limit 1";

				$result_category_id = $db->row($qry);

				$str_category_id = $result_category_id["id"];

				//echo "eeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeee :: ".$qry;
				//exit;
			}
		}


		// 미디어 카테고리의 처리 : '카드(12)', '인터랙티브(14)', '뉴스타임라인(15)', '뉴스톡(16)'
		// 위에 나열한 미디어 카테고리는 kind 값과 상관없이 동일명칭의 기사종류로 변경 (조회 용도로만 사용됨)
		if(($contents['media_id']=="12")||($contents['media_id']=="14")||($contents['media_id']=="15")||($contents['media_id']=="16")){

			switch ($contents['media_id']) {
				case "12":
					$kind_id = $db->row("select id, name from TBL_NEWS_KIND where use_tf='Y' and del_tf='N' and name= '카드' limit 1");

					$str_kind_id = $kind_id["id"];
					break;

				case "14":
					$kind_id = $db->row("select id, name from TBL_NEWS_KIND where use_tf='Y' and del_tf='N' and name= '인터랙티브' limit 1");

					$str_kind_id = $kind_id["id"];
					break;

				case "15":
					$kind_id = $db->row("select id, name from TBL_NEWS_KIND where use_tf='Y' and del_tf='N' and name= '뉴스타임라인' limit 1");

					$str_kind_id = $kind_id["id"];
					break;

				case "16":
					$kind_id = $db->row("select id, name from TBL_NEWS_KIND where use_tf='Y' and del_tf='N' and name= '뉴스톡' limit 1");

					$str_kind_id = $kind_id["id"];
					break;
			}

		}



		$data = array(
		'kind' => $str_kind_id,
		'category_id' => $str_category_id
		);

		$where = array('id' => $rs[id]);

		$result2 = $db->update("TBL_CONTENTS", $data, $where);

	}

	//$db->insert('TBL_CONTENTS', $data);

	
	$i++;

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