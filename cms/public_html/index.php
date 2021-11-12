<?php 
error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE & ~E_STRICT); 
//ini_set("memory_limit", "4096M");
ini_set('display_errors', 0);
ini_set('magic_quotes_runtime', 0);

date_default_timezone_set("Asia/Seoul");
session_start();

//header('Content-Type: text/html; charset=UTF-8');

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

define("_WEB_URL", "http://도메인");  //프론트페이지 URL

//기사 저장
define("_ARCHIVE_ROOT", "기사 스태틱 저장경로");  //기사 저장 디렉토리
define("_ARCHIVE_URL", "http://기사도메인/");  //기사 URL

//섹션 저장
define("_SECTION_ROOT", "섹션 스태틱 저장경로");  //섹션별 저장 디렉토리
define("_SECTION_URL", "http://섹션도메인/");  //섹션 URL

//이미지 저장 및 출력
define("_IMAGE_URL", "http://이미지도메인/");  //이미지 출력시 사용
define("_IMAGE_ROOT", "이미지저장경로");  //이미지 저장시 사용
define("_IMAGE_DEFAULT", "/resource/images/logo.png");  //이미지 없는 경우

//파일 업로드 다운로드
define("_FILE_ROOT", "업로드파일 저장 경로");  //파일업로드 디렉토리
define("_DOWNLOAD_URL", "http://다운로드URL/");  //다운로드URL



//기본변수초기화
$_base = $_skin = array();

$_base['postfix'] = '암호SALT';
$_base['today'] = date("Y-m-d");
$_base['time'] = date("Y-m-d H:i:s");

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

//사용자 디렉토리 - 이미지, 포토저장
$_base['user_dir'] = md5($_SESSION['_admin']['id']);

//로그인 필수 처리
if($_SESSION['_admin']['no'] == "" && $_base['path'] != '/member/login' && $_base['path'] != '/login'  && $_base['path'] != '/member/loginCheck'   && $_base['path'] != '/publish/make' ){
	msg_replace('', '/login');
	exit;
}

//모바일 접속여부 확인(Y,N)
$_base['isMobile'] =  mobileCheck();


//기본페이지 정의
$_controller = ($_base['url'][1] == "") ? "main" : $_base['url'][1];
$_action = $_base['url'][2];
$_page = $_base['url'][3];

//core파일과 view파일을 정의합니다.
switch($_controller) {

	case "main":
		if(empty($_action) || $_action == "index") $_action = "main";
		break;

	case "login":
		$_controller = 'member';
		$_action = "login";
		break;
	
	case "logout":
		$_controller = 'member';
		$_action = "logout";
		break;

	case "download":  //파일다운로드
		$_action = "download";
		break;

	case "search":  //전체검색
		$_action = "search";
		break;

	case "contents":	
		
		if($type == 'image'){
			$_skin_action = 'list_image';
		}
		break;

	case "publish":		
		if($_action != 'input' && $_action != 'dml'  && $_action != 'make'){
			$_core_action = 'list';
		}
		break;

	case "preview":  //미리보기
		$_type = $_action;	//'article', 'image', 'video', 'slide'
		switch ($_action) {
			case "main":
			case "article":
			case "image":
			case "minsopick":
				$_core_action = $_skin_action = 'preview_'.$_action;				
				break;

			case "alim":
			case "review":
			case "osmu":
				if($_page == "temp"){  //미저장 미리보기
					$_core_action = $_skin_action = 'preview_'.$_action."_".$_page;	
				}else{
					$_core_action = $_skin_action = 'preview_'.$_action;	
				}				
			default:
		}

		break;
	
	default:

}


//core파일과 skin파일을 정의
if($_core_action != '') $_skin['core'] = _COREDIR."/".$_controller."/".$_core_action.".class.php";
else $_skin['core'] = _COREDIR."/".$_controller."/".$_action.".class.php";
if($_skin_action != '') $_skin['html'] = _SKINDIR."/".$_controller."/".$_skin_action.".php";
else $_skin['html'] = _SKINDIR."/".$_controller."/".$_action.".php";


require_once _CLASS_PATH."/Base.class.php";

//core 로드 - 없는 경우 common.class.php 로드
if(file_exists($_skin['core'])) include_once $_skin['core'];
else include_once _COREDIR."/common/common.class.php";

//skin 출력 
if(file_exists($_skin['html'])) include_once $_skin['html'];
else include_once "404.htm";
