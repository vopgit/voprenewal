<?php 
if(!defined('_HOME_TITLE')) header('Location: /');

if($_REQUEST['fromDate'] && $_REQUEST['toDate']) {
	$fromDate = $_REQUEST['fromDate'];
	$toDate = $_REQUEST['toDate'];
} else {
	$fromDate = trim($_REQUEST['Fy']).'-'.trim($_REQUEST['Fm']).'-'.trim($_REQUEST['Fd']);
	$toDate = trim($_REQUEST['Ty']).'-'.trim($_REQUEST['Tm']).'-'.trim($_REQUEST['Td']);

	if($fromDate == '--') {
		$fromDate = '';
	} else {
		if(!ereg("([0-9]{4})-([0-9]{2})-([0-9]{2})", $fromDate)){
			echo("
			<script language='javascript'>
				alert('날짜형식이 잘못되었습니다.년 4자리/월 2자리/일 2자리');
				history.back();
			</script>
			");
			exit;
		}
	}

	if($toDate == '--') {
		$toDate = '';
	} else {
		if(!ereg("([0-9]{4})-([0-9]{2})-([0-9]{2})", $toDate)){
			echo("
			<script language='javascript'>
				alert('날짜형식이 잘못되었습니다.년 4자리/월 2자리/일 2자리');
				history.back();
			</script>
			");
			exit;	
		}
	}
}

$num_per_page = 20;
$page_per_block = 5;

if($_REQUEST['nPage']) $nPage = $_REQUEST['nPage'];
else $nPage = 1;

$start = $num_per_page * ($nPage-1) ;

$search_q = trim($_REQUEST['search_q']);
$q_arr = split("[[:space:]]+", $search_q);
for($i = 0; $i < sizeof($q_arr); $i++) {
        if($i == 0) {
                $query = $q_arr[$i];
        } else {
                $query2 = '+'.$q_arr[$i];
                $query .= $query2;
        }
}

if(strchr($query,"연합뉴스")) {
        $q_y = $query;
        $query = '';
}

if(!$_REQUEST['category']) {
	$category = '전체';
} else {
	$category = $_REQUEST['category'];
}

if($query != '') {

	$query_encode = urlencode($query);
	$category_encode = urlencode($category);
	$option = $_REQUEST['option'];

	if($option == 2) { //전체
		$fromDate = '';
		$toDate = '';
	} else if($option == 3) { //1일
		$fromDate = date('Y-m-d',time()-86400);
		$toDate = date('Y-m-d',time());
	} else if($option == 4) { //1주
		$fromDate = date('Y-m-d',time()-604800);
		$toDate = date('Y-m-d',time());
	} else if($option == 5) { //1개월
		$fromDate = date('Y-m-d',time()-2592000);
		$toDate = date('Y-m-d',time());
	} else if($option == 6) { //1년
		$fromDate = date('Y-m-d',time()-31536000);
		$toDate = date('Y-m-d',time());
	}


	if($fromDate && $toDate) {
			$Date_q = urlencode("last_modified:[".$fromDate."T00:00:00Z TO ".$toDate."T23:59:59Z]");
			if($category == '전체') {
					$url = "http://49.247.205.56:8983/solr/collection1/select/?q=".$query_encode."+".$Date_q."&fq=genres:PressRelease&sort=last_modified+desc%2Cscore+desc&start=".$start."&rows=".$num_per_page."&wt=json";
			} else {
					$url = "http://49.247.205.56:8983/solr/collection1/select/?q=".$query_encode."+".$Date_q."&fq=genres:PressRelease+category:".$category_encode."&sort=last_modified+desc%2Cscore+desc&start=".$start."&rows=".$num_per_page."&wt=json";
			}
	} else {
			if($category == '전체') {
					$url = "http://49.247.205.56:8983/solr/collection1/select/?q=".$query_encode."&fq=genres:PressRelease&sort=last_modified+desc%2Cscore+desc&start=".$start."&rows=".$num_per_page."&wt=json";
			} else {
					$url = "http://49.247.205.56:8983/solr/collection1/select/?q=".$query_encode."&fq=genres:PressRelease+category:".$category_encode."&sort=last_modified+desc%2Cscore+desc&start=".$start."&rows=".$num_per_page."&wt=json";
			}
	}

	$content = file_get_contents($url);

	$result = json_decode($content);
}