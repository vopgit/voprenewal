<?php 
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE & ~E_STRICT); 
//ini_set("memory_limit", "4096M");
ini_set('display_errors', 1);
ini_set('magic_quotes_runtime', 0);

date_default_timezone_set("Asia/Seoul");
header('Content-Type: text/html; charset=UTF-8');

//POST 및 GET 외 허용하지 않음 
$_base['method'] =  $_SERVER['REQUEST_METHOD'];

if(!in_array($_base['method'], array('GET', 'POST'))){
	header("HTTP/1.0 405 Method Not Allowed");
	echo "<h1>HTTP/1.0 405 Method Not Allowed</h1>";
    exit;
}

//https 리다이렉트 - 사용시 주석 제거해 주세요
/*
if($_SERVER[HTTPS] != "on"){
	$redirect_url = "https://"._HOST.$_SERVER['REQUEST_URI'];
	header( 'HTTP/1.1 301 Moved Permanently' );
	header( 'Location: '.$redirect_url);
	exit;
}
*/


define('_HOME_TITLE', true);
define("_HOST",$_SERVER['HTTP_HOST']);

define('__DIR__',dirname(__FILE__));  //php5.3 이하 사용
define("_ROOT", rtrim(__DIR__, '/'));

if( (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443 ) define("_HTTP","https://");
else define("_HTTP","http://");

define("_COREDIR",_ROOT."/../core");
define("_SKINDIR",_ROOT."/../skin");
define("_DOMAIN",_HTTP._HOST);
define("_CLASS_PATH",_ROOT."/../core/classes");

//기사
define("_ARCHIVE_ROOT", _ROOT."/../VOP_Real2/news_archive/");  //기사 저장 디렉토리
define("_ARCHIVE_URL", "http://vop.giringrim.co.kr/");  //기사 URL

//섹션
define("_SECTION_ROOT", _ROOT."/../VOP_Real2/archive/");  //섹션별 저장 디렉토리
define("_SECTION_URL", "http://vop.giringrim.co.kr/");  //섹션 URL

//이미지
define("_IMAGE_URL", "http://photo.vop.giringrim.co.kr/images/");  //이미지 출력시 사용
define("_IMAGE_ROOT", _ROOT."/../VOP_Real/images/");  //이미지 저장시 사용
define("_IMAGE_DEFAULT", "/resource/images/logo.png");  //이미지 없는 경우

//파일
define("_FILE_ROOT", _ROOT."/../VOP_Real/upload_file");  //파일업로드 디렉토리
define("_DOWNLOAD_URL", "http://photo.vop.giringrim.co.kr/download/");  //파일업로드 디렉토리



//기본변수초기화
$_base = $_skin = array();

//debug 설정
$_base['debug'] = true; 

//DB 로드
require_once _COREDIR."/common/db.class.php";
$db = new DB();
$db2 = new DB('counter');  //카운터DB

//설정파일 및 기본 라이브러리 로드
require_once _COREDIR."/common/config.php";
require_once _COREDIR."/common/util.php";

//class auto loader
spl_autoload_register('_autoloader');


//POST, GET extract
if($_base['method'] == 'GET') extractData($_GET, 'get');
else if($_base['method'] == 'POST') extractData($_POST, 'post');

//URL 파싱
$_base['urls'] = parse_url($_SERVER['REQUEST_URI']);
$_base['path'] = $_base['urls']['path'];  //현재경로
$_base['qstring'] = $_base['urls']['query'];  //QUERY_STRING
$_base['url'] = explode('/',$_base['path']);
$_base['fullurl'] = _DOMAIN.$_SERVER['REQUEST_URI'];

//모바일 접속여부 확인(Y,N)
$_base['isMobile'] =  mobileCheck();

//기본페이지 정의
$_controller = ($_base['url'][1] == "") ? "main" : $_base['url'][1];
$_action = $_base['url'][2];
$_page = $_base['url'][3];


//기사바로보기
if(preg_match('/^([A-Z][0-9]+)\.html$/', $_base['url'][1], $matches)){

	if(strlen($_base['url'][1]) == 17){

		$Ntype = substr($_base['url'][1], 0, 1);

		switch($Ntype) {

			case "R":
				$article_folder = substr(substr($_base['url'][1], 1, 11), -7, 4);
				$file = _ARCHIVE_ROOT."review/".$_base['url'][1];
				//$file = _ARCHIVE_ROOT."review/".$article_folder."/".$_base['url'][1];
				break;
			
			
			default:
				$article_folder = (int)substr(substr($_base['url'][1], 1, 11), 0, -3);
				$file = _ARCHIVE_ROOT.$article_folder."/".$_base['url'][1];
				
		}
		
		if(file_exists($file)){
			
			//***** 조회수 증가 - 이관 후 삭제할 것 ====
			$cnt_id = (int)substr($_base['url'][1], 1, 11);
			$cnt_yn = $db2->total("select count(*) from contents_viewcount where contents_id = '".$cnt_id."' and contents_kind ='".$Ntype."'");

			$cnt_filed = ($_base['isMobile'] == 'Y') ? "mobile_count" : "normal_count";

			if($cnt_yn > 0){								
				$db2->query("update contents_viewcount set ".$cnt_filed." = ".$cnt_filed." + 1 where contents_id = '".$cnt_id."' and contents_kind ='".$Ntype."'");

			}else{
				$db2->query("insert into contents_viewcount (contents_id, contents_kind, ".$cnt_filed.") values ('".$cnt_id."', '".$Ntype."', '1')");
			}
			//***** 조회수 증가 끝

			include $file;
			
		}else{
			include "404.htm";
		}
		exit;
	}
}


//기사바로보기가 아닌경우 core파일과 view파일을 정의합니다.
switch($_controller) {

	case "main":
		//if(empty($_action) || $_action == "index") $_action = "main";
		include _SECTION_ROOT."main/main-last.html";
		exit;
		
		break;

	//기자별 기사 검색 - 링크수정으로 인한 기발행 기사 redirect 처리
	case 'article':
		if($_action == "list" && ($_GET['author'] != "" || $_GET['contributor'] != '')){ 
			
			if($_GET['author'] != "") $redirect_url = _DOMAIN."/journalist/".$_GET['author'];
			
			//contributor가 있으면 $redirect_url을 재정의 합니다.
			if($_GET['contributor'] != "") $redirect_url = _DOMAIN."/journalist/".urlencode(urldecode($_GET['contributor']));
			
			header('HTTP/1.1 301 Moved Permanently');
			header('Location: '.$redirect_url);
			exit;
		}
		break;

	//수정된 기자별 기사 검색
	case "journalist":
		 $_page_title = "기자별 기사모음";
		 $_controller = "journalist";
		 $_action = "list";
		 break;

	
	case "alim":
		 $_page_title = "알림";
		 if($_action == "") $_action = "list";
		 else $_action = "read";
		 break;	
	
	case "opinion":
		 $_page_title = "오피니언";
		 $_controller = "opinion";
		if($_action == "" || $_action == "index"){
			 include _SECTION_ROOT."opinion/opinion-last.html";
			 exit;
			//$_action = "index";
		}
		 break;
	case "editorial":
		 $_page_title = "오피니언-사설";
		 $_controller = "opinion";
		if($_action == ""){
			$_action = "list";
		}
		
		 break;

	case "column":
		 $_page_title = "오피니언-칼럼";
		 $_controller = "opinion";
		if($_action == ""){
			$_action = "list_tag";
		}
		 break;
	
	case "minsopick":
		 $_page_title = "민소픽";
		 $_controller = "minsopick";
		  if($_action == ""){
			 include _SECTION_ROOT."minsopick/minsopick-last.html";
			 exit;
		  }
		 break;
	
	case "academy":
		 $_page_title = "이산아카데미";
		 $_controller = "academy";
		 $_action = "list";
		 break;
	
	case "onesource":
		 $_page_title = "원소스";
		 $_controller = "onesource";
		 $_action = "list";
		 break;

	case "review":		
		 $_page_title = "리뷰";
		 $_controller = "review";
		 
		 if($_action == "article"){ //원글별 리뷰보기
			 $_action = "list_article";	
		 }else{
			 $_action = "list";
		 }
		 break;

	case "notice":
		 $_page_title = "알림";
		 $_controller = "alim";
		 $_action = "list";
		 break;

	case "politics":
		 $_page_title = "정치";
		 $_category = "2";
		 $_controller = "contents";
		 $_action = "list";
		 break;
	
	case "economy":
		 $_page_title = "경제";
		 $_category = "3";
		 $_controller = "contents";
		 $_action = "list";
		 break;
	
	case "society":
		 $_page_title = "사회";
		 $_category = "4";
		 $_controller = "contents";
		 $_action = "list";
		 break;
	
	case "international":
		 $_page_title = "국제";
		 $_category = "6";
		 $_controller = "contents";
		 $_action = "list";
		 break;

	case "culture":
		 $_page_title = "문화";
		 $_category = "7";
		 $_controller = "contents";
		 $_action = "list";
		 break;

	case "entertainment":
		 $_page_title = "연예";
		 $_category = "36";
		 $_controller = "contents";
		 $_action = "list";
		 break;

	case "sports":
		 $_page_title = "스포츠";
		 $_category = "19";
		 $_controller = "contents";
		 $_action = "list";
		 break;
	
	case "science":
		 $_page_title = "IT/과학";
		 $_category = "9";
		 $_controller = "contents";
		 $_action = "list";
		 break;
	
	case "column":
		 $_page_title = "사설/칼럼";
		 $_category = "10";
		 $_controller = "opinion";
		 $_action = "list";
		 break;

	case "cartoon":
		 $_page_title = "만평";
		 $_category = "26";
		 $_controller = "cartoon";
		 $_action = "list";
		 break;


	case "download":  //파일다운로드
		$_action = "download";
		break;

	case "search":  //전체검색
		$_action = "search";
		break;

	default:

}

//core파일과 skin파일을 정의
if($_core_action != '') $_skin['core'] = _COREDIR."/".$_controller."/".$_core_action.".class.php";
else $_skin['core'] = _COREDIR."/".$_controller."/".$_action.".class.php";
if($_skin_action != '') $_skin['html'] = _SKINDIR."/".$_controller."/".$_skin_action.".php";
else $_skin['html'] = _SKINDIR."/".$_controller."/".$_action.".php";

require_once _COREDIR."/classes/Base.class.php";

//core 로드 - 없는 경우 common.class.php 로드
if(file_exists($_skin['core'])) include_once $_skin['core'];
else include_once _COREDIR."/common/common.class.php";

//skin 출력 
if(file_exists($_skin['html'])) include_once $_skin['html'];
else include_once "404.htm";