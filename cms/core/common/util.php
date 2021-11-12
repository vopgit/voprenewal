<?php
function _autoloader($className){
	if (file_exists(_CLASS_PATH.'/'.ucwords($className).'.class.php')) {
		include_once _CLASS_PATH.'/'.ucwords($className).'.class.php';
		return;
	 }
}

//모바일 접속여부 체크 (Y = 모바일, N = PC)
function mobileCheck(){ 
	$MobileArray  = array("iphone","lgtelecom","skt","mobile","samsung","nokia","blackberry","android","sony","phone");
	$checkCount = 0; 
	for($i=0; $i<sizeof($MobileArray); $i++){ 
		if(preg_match("/$MobileArray[$i]/", strtolower($_SERVER['HTTP_USER_AGENT']))){ $checkCount++; break; } 
	} 
	return ($checkCount >= 1) ? "Y" : "N"; 
}

//이전경로 체크
function refererCheck(){
	if(strpos($_SERVER['HTTP_REFERER'],$_SERVER['HTTP_HOST']) < 0) msg_replace('잘못된 요청입니다.','/');
}

function msg_err($str){
	set_header();
	echo "<script>
		  alert('".$str."');
		  history.back();
		  </script>";
	exit;
}

function msg_exit($str){
	set_header();
	echo $str;
	exit;
}

//팝업창
function msg_close($str){
	set_header();
	echo "<script>
		  alert('".$str."');
		  self.close();
		  </script>";
	exit;
}


function msg_replace($str, $path = '/'){
	set_header();
	if($str == ""){
		echo "<script>
		  location.replace('".$path."');
		  </script>";
	}else{
		echo "<script>
		  alert('".$str."');
		  location.replace('".$path."');
		  </script>";
	}
	exit;
}

function msg_opener_reload($str){
	set_header();
	echo "<script>
		  alert('".$str."');		  
		  opener.location.reload();	
		  self.close();
		  </script>";
	exit;
}

//json result
function msg_json($code, $msg){
	set_header('json');
	$result = array(
		'code' => $code,
		'msg' => $msg
		);
	echo json_encode($result);
	exit;
}

function set_header($type = ''){
	if (!headers_sent()){
		switch($type){
			case('json'):
				header('Content-Type: application/json; charset=UTF-8');
				break;
			default:
				header('Content-Type: text/html; charset=UTF-8');			
		}
	}
}


//param
function makeParam($data){
	$rtn = array();
	$str = "";
	$nopage = "";  //페이징인 경우 페이지 제외
	foreach($data as $key=>$val) {
		if($val != ""){
			if($key == 'nPage'){
				if($str == ""){
					$str = $key."=".$val;
				}else{
					$str = $str."&".$key."=".$val;
				}
			}else{
				if($str == ""){
					$str = $key."=".$val;
					$nopage = $key."=".$val;
				}else{
					$str = $str."&".$key."=".$val;
					$nopage = $nopage."&".$key."=".$val;
				}
			}
		}
	}

	$rtn['query'] = ($str != "") ? "?".$str : "";
	$rtn['nopage'] = $nopage;

	$rtn = array_filter($rtn);
	return $rtn;
}

//문자열자르기
function str_cut($str, $cutsize){
	$str = strip_tags($str);
	if(strlen($str) > $cutsize){
		$str = iconv_substr($str, 0, $cutsize, "utf-8")."...";
	}
	return $str;
}

//개행문자 제거
function removeEnter($str){
	return preg_replace('/\r\n|\r|\n/', '', $str);
}

function generateRandomString($length=8) {
    global $db;
	$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
   	for ($j = 0; $j < $length; $j++) {
		$randomString .= $characters[rand(0, $charactersLength - 1)];
   	}
	return $randomString;
}

//페이징
function pageList($URL, $nPage, $TPage, $PBlock, $Ext) {
	
	$str = "";

	if($Ext != "") $Ext = "&".$Ext;

	if($nPage == "") $nPage = 1;

	$SPage = (int)(($nPage - 1) / $PBlock) * $PBlock + 1;
	$EPage = $SPage + $PBlock - 1;

	if ($TPage > 1 ) {
		$intTemp = (int)(($nPage - 1) / $PBlock) * $PBlock + 1;
		$intLoop = 1;

		if ($TPage < $EPage) $EPage = $TPage;

		$str = '<div class="page">';

		// 이전 블록
		if ($intTemp == 1) {
			$str .= "<a href=\"javascript:;\" class=\"first\"><i class=\"icon_prev2\">이전".$PBlock."개</i></a>";
		} else {
			$str .= "<a href=".$URL."?nPage=".($intTemp - $PBlock).$Ext." class=\"first\"><i class=\"icon_prev2\">이전".$PBlock."개</i></a>";
		}

		// 이전 페이지
		if ($nPage == 1) {
			$str .= "<a href=\"javascript:;\" class=\"prev\"><i class=\"icon_prev\">이전페이지</i></a>";
		} else {
			$str .= "<a href=".$URL."?nPage=".($nPage - 1).$Ext." class=\"prev\"><i class=\"icon_prev\">이전페이지</i></a>";
		}

		// 모바일 블럭
		$str .= "<span class=\"current_m\"><span>".$nPage."</span><span class=\"total\"> / ".$TPage."</span></span>";

		$str .= "<span class=\"page_p\">";

		$Cnt = 1;  # 숫자로 인식시킴 현재 페이지 볼드체 되게 수정
		for ($Cnt = $SPage; $Cnt <= $EPage ; $Cnt++) {
			if ($Cnt == (int)($nPage)) {
				$str .= "<a href=\"".$URL."?nPage=".$Cnt.$Ext."\" class=\"act\">" .$Cnt. "</a>";
			} else {
				$str .= "<a href=\"".$URL."?nPage=".$Cnt.$Ext."\" >" .$Cnt. "</a>";
			}
			$intTemp++;
		}

		$str .= "</span>";

		// 다음 페이지
		if ($nPage >= $TPage) {
			$str .= "<a href=\"javascript:;\" class=\"next\"><i class=\"icon_next\">다음페이지</i></a>";
		} else {
			$str .= "<a href=".$URL."?nPage=" .($nPage + 1).$Ext." class=\"next\"><i class=\"icon_next\">다음페이지</i></a>";
		}

		// 다음 블록
		if ($intTemp > $TPage) {
			$str .= "<a href=\"javascript:;\" class=\"end\"><i class=\"icon_next2\">다음10개</i></a>";
		} else {
			$str .= "<a href=".$URL."?nPage=" .$intTemp.$Ext." class=\"end\"><i class=\"icon_next2\">다음10개</i></a>";
		}

		// 페이지
		$str .= "</div>";

	}
	return $str;
}

//페이징 팝업
function pageListPop($nPage, $TPage, $PBlock) {
	
	$str = "";

	if($Ext != "") $Ext = "&".$Ext;

	if($nPage == "") $nPage = 1;

	$SPage = (int)(($nPage - 1) / $PBlock) * $PBlock + 1;
	$EPage = $SPage + $PBlock - 1;

	if ($TPage > 1 ) {
		$intTemp = (int)(($nPage - 1) / $PBlock) * $PBlock + 1;
		$intLoop = 1;

		if ($TPage < $EPage) $EPage = $TPage;

		$str = '<div class="page">';

		// 이전 블록
		if ($intTemp == 1) {
			$str .= "<a href=\"javascript:;\" class=\"first\"><i class=\"icon_prev2\">이전".$PBlock."개</i></a>";
		} else {
			$str .= "<a href=\"javascript:;\" onclick=\"js_go_page('".($intTemp - $PBlock)."')\" class=\"first\"><i class=\"icon_prev2\">이전".$PBlock."개</i></a>";
		}

		// 이전 페이지
		if ($nPage == 1) {
			$str .= "<a href=\"javascript:;\" class=\"prev\"><i class=\"icon_prev\">이전페이지</i></a>";
		} else {
			$str .= "<a href=\"javascript:;\" onclick=\"js_go_page('".($nPage - 1)."')\" class=\"prev\"><i class=\"icon_prev\">이전페이지</i></a>";
		}

		// 모바일 블럭
		$str .= "<span class=\"current_m\"><span>".$nPage."</span><span class=\"total\"> / ".$TPage."</span></span>";

		$str .= "<span class=\"page_p\">";

		$Cnt = 1;  # 숫자로 인식시킴 현재 페이지 볼드체 되게 수정
		for ($Cnt = $SPage; $Cnt <= $EPage ; $Cnt++) {
			if ($Cnt == (int)($nPage)) {
				$str .= "<a href=\"javascript:;\" onclick=\"js_go_page('".($Cnt)."')\" class=\"act\">" .$Cnt. "</a>";
			} else {
				$str .= "<a href=\"javascript:;\" onclick=\"js_go_page('".($Cnt)."')\">" .$Cnt. "</a>";
			}
			$intTemp++;
		}

		$str .= "</span>";

		// 다음 페이지
		if ($nPage >= $TPage) {
			$str .= "<a href=\"javascript:;\" class=\"next\"><i class=\"icon_next\">다음페이지</i></a>";
		} else {
			$str .= "<a href=\"javascript:;\" onclick=\"js_go_page('".($nPage + 1)."')\" class=\"next\"><i class=\"icon_next\">다음페이지</i></a>";
		}

		// 다음 블록
		if ($intTemp > $TPage) {
			$str .= "<a href=\"javascript:;\" class=\"end\"><i class=\"icon_next2\">다음10개</i></a>";
		} else {
			$str .= "<a href=\"javascript:;\" onclick=\"js_go_page('".($intTemp)."')\" class=\"end\"><i class=\"icon_next2\">다음10개</i></a>";
		}

		// 페이지
		$str .= "</div>";

	}
	return $str;
}

function getUserIP(){
	$ipaddress = '';
	if (getenv('HTTP_CLIENT_IP')) {
		$ipaddress = getenv('HTTP_CLIENT_IP');
	} else if(getenv('HTTP_X_FORWARDED_FOR')) {
		$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
	} else if(getenv('HTTP_X_FORWARDED')) {
		$ipaddress = getenv('HTTP_X_FORWARDED');
	} else if(getenv('HTTP_FORWARDED_FOR')) {
		$ipaddress = getenv('HTTP_FORWARDED_FOR');
	} else if(getenv('HTTP_FORWARDED')) {
		$ipaddress = getenv('HTTP_FORWARDED');
	} else if(getenv('REMOTE_ADDR')) {
		$ipaddress = getenv('REMOTE_ADDR');
	} else {
		$ipaddress = 'unknown';
	} 
	return $ipaddress;
}

function getBrowserInfo(){
  $userAgent = $_SERVER["HTTP_USER_AGENT"]; 
  if(preg_match('/MSIE/i',$userAgent) && !preg_match('/Opera/i',$u_agent)){
    $browser = 'IE';
  }else if(preg_match('/Firefox/i',$userAgent)){
    $browser = 'Firefox';
  }else if (preg_match('/Chrome/i',$userAgent)){
    $browser = 'Chrome';
  }else if(preg_match('/Safari/i',$userAgent)){
    $browser = 'Safari';
  }elseif(preg_match('/Opera/i',$userAgent)){
    $browser = 'Opera';
  }elseif(preg_match('/Netscape/i',$userAgent)){
    $browser = 'Netscape';
  }else{
    $browser = "Other";
  }
  return $browser;
}
function getOsInfo(){
	$userAgent = strtolower($_SERVER["HTTP_USER_AGENT"]); 
	if (preg_match('/android/i', $userAgent)){ 
		$os = 'android';
	}else if (preg_match('/iphone/i', $userAgent)){ 
		$os = 'iphone';
	}else if (preg_match('/linux/i', $userAgent)){ 
		$os = 'linux';
	}elseif(preg_match('/macintosh|mac os x/i', $userAgent)){
		$os = 'mac';
	}elseif (preg_match('/windows|win32/i', $userAgent)){
		$os = 'windows';
	}else {
		$os = 'Other';
	}
	return $os;
}

function remove_quote($value) {
	$value = strip_tags(stripslashes($value));
	$value = str_replace('"',"", $value);
	$value = str_replace("'","", $value);
	return $value;
}

//재귀호출을 통한 extract
function extractData($data, $method) {
	global $db;

	if($method == 'post'){
		if(isset($_GET)) unset($_GET);
	}else{
		if(isset($_POST)) unset($_POST);
	}

	$except = array('contents', 'content');
	
	foreach($data as $key => $val) {
		if (is_array($val)){
			extractData($key);
		}else{
			global ${$key};
			$val = removeXss($val);	
			if(!in_array($key, $except)) $val = decodeHtml($val);
			${$key} = $db->filter($val);	
		}
	}
}

function removeXss($value){

	if (get_magic_quotes_gpc()) $value = stripslashes($value);
	
	//$value = preg_replace("!<iframe(.*?)<\/iframe>!is", '', $value);
	
	$value = preg_replace("!<script(.*?)<\/script>!is", '', $value);
	$value = preg_replace("!<style(.*?)<\/style>!is", '', $value);
	
	/*
	$value = str_replace('"', '&quot;', $value);
	$value = str_replace("'", '&#039;', $value);
	$value = str_replace('<', '&lt;', $value);
	$value = str_replace('>', '&gt;', $value);
	*/

	return $value;
}

//파일명 공백/특수문자 제거
function fileRename($value){
	$value = strip_tags(urldecode($value));
	$value = str_replace(' ', '', $value);
	$value = str_replace('"', '', $value);
	$value = str_replace("'", '', $value);
	$value = str_replace('<', '', $value);
	$value = str_replace('>', '', $value);
	return $value;
}


//미리보기시 html decode
function decodeHtml($str){
	$value = stripslashes($str);
	$value = str_replace('"', '&quot;', $value);
	$value = str_replace("'", '&#039;', $value);
	$value = str_replace('<', '&lt;', $value);
	$value = str_replace('>', '&gt;', $value);
	return $value;
}

function uploadSingle($f_name, $f_tmp, $f_zise,  $targetdir, $max_size = 10, $allowext = 'image') {

	if($allowext == 'image') $allowext = array('gif', 'jpeg', 'jpg','png');
	else $allowext = array('gif', 'jpeg', 'jpg','png','xls', 'xlsx', 'doc','docx','ppt','pptx','hwp','hwpx','zip','rar','pdf','mp3','mp4','avi','wmv','txt','wav','mid');
	
	$notAllowExt = array('exe', 'bat', 'sh', 'java', 'jsp', 'html', 'htm', 'cgi', 'php', 'asp', 'js', 'css', 'xml');

	$max_size = $max_size * 1024 * 1024;    // mega

	if (!is_dir($targetdir)) mkdir($targetdir, 0777);

	if($f_zise > $max_size){
		return "error|등록가능 용량을 초과하였습니다.";	
	}else {
		$file_ext = end(explode('.', $f_name));
		$file_real_name = $f_name;
		
		if (!in_array(strtolower($file_ext), $allowext)) return 'error|허용되지 않는 파일타입니다.';
		
		$temp_file_name = time()."_".generateRandomString()."_".rand(0,9999).".".$file_ext;
		$file_name = get_filename_check($targetdir, $temp_file_name);
		
		$path = $targetdir.'/'.$file_name;

		if(move_uploaded_file($f_tmp, $path)){
			@chmod($path, 0777);			
			return $path;
		}else{
			return 'error|업로드에 실패하였습니다.';
		}
	}
}

function uploadMulti($filearray, $i, $targetdir, $max_size = 10, $allowext = 'image') {

	if($allowext == 'image') $allowext = array('gif', 'jpeg', 'jpg','png');
	else $allowext = array('gif', 'jpeg', 'jpg','png','xls', 'xlsx', 'doc','docx','ppt','pptx','hwp','hwpx','zip','rar','pdf','mp3','mp4','avi','wmv','txt','wav','mid');
	
	$notAllowExt = array('exe', 'bat', 'sh', 'java', 'jsp', 'html', 'htm', 'cgi', 'php', 'asp', 'js', 'css', 'xml');

	$max_size = $max_size * 1024 * 1024;    // mega

	if (!file_exists($targetdir)){
		@mkdir($targetdir, 0777);
		@chmod($targetdir, 0777);
	}

	if($filearray['size'][$i] > $max_size){
		return "error|등록가능 용량을 초과하였습니다.";
	}else {
		
		$file_ext = end(explode('.', $filearray['name'][$i]));
					
		if (!in_array(strtolower($file_ext), $allowext)) return 'error|허용되지 않는 파일타입니다.';

		$temp_file_name = time()."_".$i."_".rand(1111,9999).".".$file_ext;
		$file_name = get_filename_check($targetdir, $temp_file_name);
		
		$path = $targetdir.'/'.$file_name;

		if(move_uploaded_file($filearray['tmp_name'][$i], $path)){
			@chmod($path, 0777);			
			return $path;
		}else{
			return 'error|업로드에 실패하였습니다.';
		}
	}
}

//파일 중복 체크
function get_filename_check($filepath, $filename) {

	if (!preg_match("'/$'", $filepath)) $filepath .= '/';
	if (is_file($filepath . $filename)) {

		preg_match("'^([^.]+)(\[([0-9]+)\])(\.[^.]+)$'", $filename, $match);

		if (empty($match)) {
			$filename = preg_replace("`^([^.]+)(\.[^.]+)$`", "\\1[1]\\2", $filename);
		}else{
			$filename = $match[1] . '[' . ($match[3] + 1) . ']' . $match[4];
		}

		return get_filename_check($filepath, $filename);

	}else{
		return $filename;
	}
}


function getListImage($uid, $type, $filepath, $noimage){
	global $db;
	$image = "";

	$filename = substr(strrchr($filepath, '/'), 1); 

	if($filepath != "" && $filepath != null){
		if(file_exists(_ROOT.str_replace($filename, "s_".$filename, $filepath))) $image = str_replace($filename, "s_".$filename, $filepath);
		else if(file_exists(_ROOT.str_replace($filename, "m_".$filename, $filepath))) $image = str_replace($filename, "m_".$filename, $filepath);
		else if(file_exists(_ROOT.$filepath)) $image = $filepath;
	}

	if($image == ""){
		$row2 = $db->selectOne("select FILE_PATH, FILE_NAME from TBL_FILE where POOL_UID = '".$uid."' and GUBUN = '".$type."' order by uid limit 1");
		if($row2['FILE_NAME'] != ""){
			$image = getListImage($uid, $type, $row2['FILE_PATH']."/".$row2['FILE_NAME'], $noimage);			
		}else{
			$image = $noimage;
		}
	}
	return $image;
}

function getReadImage($filepath, $filename){
	$image = "";
	if(file_exists(_ROOT.$filepath."/s_".$filename)) $image = $filepath."/m_".$filename;
	else if(file_exists(_ROOT.$filepath."/m_".$filename)) $image = $filepath."/s_".$filename;
	else if(file_exists(_ROOT.$filepath."/".$filename)) $image = $filepath."/".$filename;

	return $image;
}

function getPopImage($filepath, $filename){
	$image = "";
	if(file_exists(_ROOT.$filepath."/m_".$filename)) $image = $filepath."/m_".$filename;
	else if(file_exists(_ROOT.$filepath."/s_".$filename)) $image = $filepath."/s_".$filename;
	else if(file_exists(_ROOT.$filepath."/".$filename)) $image = $filepath."/".$filename;

	return $image;
}

function makeSelectBox($pcode, $objname, $size, $val, $class = '', $title = ''){
	global $db;
	$rs_s = $db->select("SELECT DCODE, DCODE_NM FROM TBL_CODE_DETAIL WHERE PCODE = '".$pcode."' and USE_TF = 'Y' AND DEL_TF = 'N' order by DCODE_SORT asc");

	$tmp_str = "<select name='".$objname."' id='".$objname."' class='".$class."' style='width:".$size."px;' title='".$title."'>";
	$tmp_str .= "<option value=''>선택</option>";

	for($i=0 ; $i< count($rs_s); $i++) {
		$selected = ($rs_s[$i]['DCODE'] == $val) ? "selected" : "";
		$tmp_str .= "<option value='".$rs_s[$i]['DCODE']."' ".$selected.">".$rs_s[$i]['DCODE_NM']."</option>";
	}
	$tmp_str .= "</select>";
	return $tmp_str;
}

function getCodeToArray($pcode){
	global $db;
	$tmp_code = array();
	$rs_s = $db->select("SELECT DCODE, DCODE_NM FROM TBL_CODE_DETAIL WHERE PCODE = '".$pcode."' and USE_TF = 'Y' AND DEL_TF = 'N' order by DCODE_SORT asc");

	for($i=0; $i<count($rs_s); $i++) {
		$key = $rs_s[$i]['DCODE'];
		$tmp_code[$key] = $rs_s[$i]['DCODE_NM'];
	}
	return $tmp_code;
}


//템플릿치환 #{예약어} -> 변환값 $data = array('0','1') 
function changeTemplate($text, $data){
	$matches = NULL;
	preg_match_all('/\#\{.+?\}/', $text, $matches);
	$matches = $matches[0];
	for ($i = 0; $i < count($matches); $i++){
		$text = preg_replace('/\#\{.+?\}/', $data[$i], $text, 1);
	}
	return $text;
}

function debug($data){
	echo "<pre>";
	print_r($data);
	echo "</pre>";
}

function make_dir($dir){
	if(!file_exists($dir)){
		@mkdir($dir, 0777, true);
		@chmod($dir, 0777);
	}
}

function save_file($filepath, $data){
	$fp = @fopen($filepath, 'w+');
	if($fp) {
		fwrite($fp, $data);
		fclose($fp);
	}else{
		return false;
	}
	@chmod($filepath, 0777);
	return true;
}

function saveLog($contents_id, $task, $con){
	global $db;
	$db->query("insert into TBL_LOG (contents_id, log_task, log_content, log_admin, log_ip, log_date) values ('".$contents_id."', '".$task."', '".$con."', '".$_SESSION['_admin']['no']."', '".getRealIp()."', now())");
}

function staticLog($serial, $task, $con){
	global $db;
	$db->query("insert into TBL_LOG_STATIC (serial, log_task, log_content, log_admin, log_ip, log_date) values ('".$serial."', '".$task."', '".$con."', '".$_SESSION['_admin']['no']."', '".getRealIp()."', now())");
}

function getParentCategory($cate, $mode = ''){

	global $db;

	if($mode != "") $cate = substr($cate, 0, strlen($cate) -2);

	$bcate = substr($cate, 0,2);
	if(strlen($cate) >= 4) $mcate = substr($cate, 0,4);
	if(strlen($cate) >= 6) $ccate = substr($cate, 0,6);

	$str = "";
	if($bcate == ""){
		$str = "최상위";
	}else{
		if($bcate != ""){
			$rs = $db->row("select PAGE_NAME from TBL_PAGES where PAGE_CD = '".$bcate."' and DEL_TF = 'N'");
			$str = $rs['PAGE_NAME'];
		}
		if($mcate != ""){
			$rs = $db->row("select PAGE_NAME from TBL_PAGES where PAGE_CD = '".$mcate."' and DEL_TF = 'N'");
			$str = $str." > ".$rs['PAGE_NAME'];
		}
		if($ccate != ""){
			$rs = $db->row("select PAGE_NAME from TBL_PAGES where PAGE_CD = '".$ccate."' and DEL_TF = 'N'");
			$str = $str." > ".$rs['PAGE_NAME'];
		}
	}
	return $str;
}

//암호화-복호화
function hex2bin($hexdata) {  //PHP 5.4.0이상 기본 내장함수이니 주의!
	$bindata = "";
	for ($i=0;$i < strlen($hexdata);$i+=2) {
		$bindata .= chr(hexdec(substr($hexdata,$i,2)));
	}
	return $bindata;
}
function encrypt($str){
	return bin2hex(base64_encode($str));

}
function decrypt($str){
	return base64_decode(hex2bin($str));
}

//stripslashes 재귀함수
function stripslashes_deep($value){
    $value = is_array($value) ?
                array_map('stripslashes_deep', $value) :
                stripslashes($value);

    return $value;
}

//curl request 
function send_curl_post($url, $data){
	$post_field_string = http_build_query($data, '', '&');
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url); 
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_POSTFIELDS, $post_field_string);
	curl_setopt($ch, CURLOPT_POST, true);
	$response = curl_exec($ch);
	curl_close ($ch);
	return $response;
}

//메일발송
function sendMail($reciever, $subject, $content, $sender_email, $sender_name){ 
	$returnPath = "-f".$sender_email;
	$header	= "Return-Path: ".$sender_email."\n";
	$header	.= "From: =?utf-8?B?".base64_encode($sender_name)."?= <".$sender_email.">\n";
	$header	.= "MIME-Version: 1.0\n";
	$header	.= "X-Priority: 3\n";
	$header	.= "X-MSMail-Priority: Normal\n";
	$header	.= "X-Mailer: FormMailer\n";
	$header	.= "Content-Transfer-Encoding: base64\n";
	$header	.= "Content-Type: text/html;\n \tcharset=utf-8\n";	
	$subject = "=?utf-8?B?".base64_encode($subject)."?=\n";
	$message = base64_encode($content);
	flush();
	if(@mail($reciever, $subject, $message, $header, $returnPath)) return true;
	else return false;
}

//파일사이즈 출력 (파일크기(byte), 소수점자리수)
function formatFileSize($bytes, $decimals = 1) { 
    $size = array('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');
    $factor = floor((strlen($bytes) - 1) / 3);
    return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$size[$factor];
}

function remainTime($date){ //Y-m-d H:i:s

	$rday = "";

	$etime = strtotime($date);
	$ntime = time();

	$diff = $etime - $ntime;

	if($diff < 1){
		$rday = "종료";
	}else{
		$days = floor($diff / 86400);

		$diff = $diff - ($days * 86400);
		$hours = floor($diff/3600);

		$diff = $diff - ($hours * 3600);
		$min = floor($diff / 60);
		$sec = $diff - ($min * 60);


		if($days > 0) $rday = $days."일 ".$hours."시간 남았습니다.";
		else $rday = $hours."시간 남았습니다.";
	}
	return $rday;
}


//회원종류 select 옵션으로 가져오기
function getMeberTypeOption($selstr){
	global $_member_type;  //config정의
	$_member_type_option = "";
	foreach($_member_type as $key=>$val) {
		$_member_type_option_selected = ($key == $selstr) ? "selected" : "";
		$_member_type_option .= '<option value="'.$key.'" '.$_member_type_option_selected.'>'.$val.'</option>';		
	}
	return $_member_type_option;
}

//포토 이미지 가져오기
function getListThumbnail($fpath = ''){

	if($fpath == ''){
		$p_url = _IMAGE_DEFAULT;
	}else{
		$p_o_name = basename($fpath);
		$p_name = str_replace($p_o_name, "thumb/".$p_o_name, $fpath);
		if(file_exists(_IMAGE_ROOT.$p_name)) $p_url = _IMAGE_URL.$p_name;
		else if(file_exists(_IMAGE_ROOT.$p_o_name)) $p_url = _IMAGE_URL.$p_o_name;
		else $p_url = _IMAGE_DEFAULT;
	}

	return $p_url;
}

//===============================================================

function stripSlashesDeep($value) {
	$value = is_array($value) ? array_map('stripSlashesDeep', $value) : stripslashes($value);
	return $value;
}

function removeMagicQuotes() {
	if (get_magic_quotes_gpc()) {
		$_GET    = stripSlashesDeep($_GET);
		$_POST   = stripSlashesDeep($_POST);
		$_COOKIE = stripSlashesDeep($_COOKIE);
	}
}

function getRealIp(){
	$ipaddress = '';
	if (getenv('HTTP_CLIENT_IP')) {
		$ipaddress = getenv('HTTP_CLIENT_IP');
	} else if(getenv('HTTP_X_FORWARDED_FOR')) {
		$ipaddress = getenv('HTTP_X_FORWARDED_FOR');
	} else if(getenv('HTTP_X_FORWARDED')) {
		$ipaddress = getenv('HTTP_X_FORWARDED');
	} else if(getenv('HTTP_FORWARDED_FOR')) {
		$ipaddress = getenv('HTTP_FORWARDED_FOR');
	} else if(getenv('HTTP_FORWARDED')) {
		$ipaddress = getenv('HTTP_FORWARDED');
	} else if(getenv('REMOTE_ADDR')) {
		$ipaddress = getenv('REMOTE_ADDR');
	} else {
		$ipaddress = 'unknown';
	} 
	return $ipaddress;
}

// 태그명을 태그코드로
function make_tags($str){
	global $db;
	$tag = "";
	$st = explode(",", $str);
	if(count($st) > 0){
		for($i=0; $i<count($st); $i++) {
			$st[$i] = remove_quote(trim($st[$i]));
			if($st[$i] != ""){
				$tid = $db->rowone("select id from TBL_TAGS where lower(name) = lower('".$st[$i]."') limit 1");
				if($tid == ''){
					$db->query("insert into TBL_TAGS (name) values ('".$st[$i]."')");
					$tid = $db->lastid();
				}
				$tag = ($tag == "") ? $tid : $tag.",".$tid;
			}
		}
	}
	return $tag;
}

//태그코드를 태그명으로
function restore_tags($str){	
	global $db;
	if($str != ''){		
		$tags = $db->rowone("SELECT group_concat(name separator ', ') FROM TBL_TAGS WHERE id in (".$str.")");
	}
	return $tags;
}

//태그코드를 태그명으로
function getContentsData($table, $field, $where = '1'){	
	global $db;
	$rs = $db->rowone("SELECT ".$field." FROM ".$table." where ".$where." limit 1");
	return $rs;
}

//리스트 이미지 가져오기
function getListPhoto($root_path, $fpath, $marked = ''){

	$img = '/resource/images/no_image.jpg';

	if($root_path != '' && $fpath != ''){
		
		$root_path = rtrim($root_path, '/');
		$fpath = ltrim($fpath, '/');				

		$filename = end(explode("/", $fpath));

		$thumb_path = str_replace($filename, "thumb/".$filename, $fpath);		

		if(file_exists($root_path."/".$thumb_path)){
			return rtrim(_IMAGE_URL, '/')."/".$thumb_path;
		}else if(file_exists($root_path."/".$fpath)){
			return rtrim(_IMAGE_URL, '/')."/".$fpath;
		}	
	}

	return $img;
}

//본 이미지 가져오기
function getPhoto($root_path, $fpath, $marked = ''){

	$root_path = rtrim($root_path, '/');
	$fpath = ltrim($fpath, '/');
	
	if($root_path != '' && $fpath != ''){

		$filename = end(explode("/", $fpath));		
		
		$marked_path = str_replace($filename, "marked/".$filename, $fpath);		
		
		if($marked == 'Y'){
			if(file_exists($root_path."/".$marked_path)){
				return rtrim(_IMAGE_URL, '/')."/".$marked_path;
			}else if(file_exists($root_path."/".$fpath)){
				return rtrim(_IMAGE_URL, '/')."/".$fpath;
			}				
		}else if(file_exists($root_path."/".$fpath)){
			return rtrim(_IMAGE_URL, '/')."/".$fpath;
		}		
		
	}
}

function removeOldPhotos($fpath){
	$img_root = rtrim(_IMAGE_URL, '/');
	$fpath = ltrim($fpath, '/');
	
	@unlink($img_root."/".$fpath);

	$filename = end(explode("/", $fpath));
	$thumb_path = str_replace($filename, "thumb/".$filename, $fpath);	
	@unlink($img_root."/".$thumb_path);

	$marked_path = str_replace($filename, "marked/".$filename, $fpath);		
	@unlink($img_root."/".$marked_path);
}

//php 5.4이하 JSON_UNESCAPED_UNICODE 미지원
function han($str) { 
	return reset(json_decode('{"s":"'.$str.'"}')); 
}
function json_encode_han($str){ 
	return preg_replace('/(\\\u[a-f0-9]+)+/e','han("$0")',json_encode($str)); 
}

//필요없는 스택틱 파일 삭제 (2021.11.10 추가)
function del_file($filepath, $data){

	if(file_exists($filepath."/".$data)) {
		@unlink($filepath."/".$data);
	}
}

?>