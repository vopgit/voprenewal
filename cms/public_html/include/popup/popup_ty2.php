<?

error_reporting(E_ALL & ~E_WARNING & ~E_NOTICE & ~E_STRICT);
//ini_set("memory_limit", "4096M");
ini_set('display_errors', 1);
ini_set('magic_quotes_runtime', 0);

date_default_timezone_set("Asia/Seoul");
session_start();

header('Content-Type: text/html; charset=UTF-8');


define('_HOME_TITLE', true);
define("_HOST",$_SERVER['HTTP_HOST']);

//define('_DEBUGING', true); //debuging
//define( 'DISPLAY_DB_DEBUG', true);

define('__DIR__',dirname(__FILE__));  //php5.3 이하 사용
define("_ROOT", rtrim(__DIR__, '/'));

if( (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443 ) define("_HTTP","https://");
else define("_HTTP","http://");

define("_COREDIR",_ROOT."/core");
define("_SKINDIR",_ROOT."/skin");
define("_DOMAIN",_HTTP._HOST);
define("_CLASS_PATH",_ROOT."/core/classes");

$status = "Y"; //Y:연재, N:휴재/마감

define("_WEB_URL", "http://vop.giringrim.co.kr/");  //프론트페이지 URL
define("_IMAGE_URL", "http://photo.vop.giringrim.co.kr/images/");  //이미지 출력시 사용
define("_IMAGE_ROOT", _ROOT."/VOP_Real/images/");  //이미지 저장시 사용
define("_IMAGE_DEFAULT", "/resource/images/logo.png");  //이미지 없는 경우





include $_SERVER["DOCUMENT_ROOT"].'/core/common/db.class.php';
include $_SERVER["DOCUMENT_ROOT"].'/core/common/util.php';

$db = new DB();
$db2 = new DB('counter');  //카운터DB

include $_SERVER["DOCUMENT_ROOT"]."/core/classes/Base.class.php";

include $_SERVER["DOCUMENT_ROOT"]."/core/classes/Popup.class.php";

include $_SERVER["DOCUMENT_ROOT"]."/core/popup/popup_ty2.class.php";


?>
<?php include $_SERVER["DOCUMENT_ROOT"].'/include/head.php'; ?>
<style>
    html,body{
        background: none;
    }
</style>

<form  name="frm" id="frm" method="post">
	<input type="hidden" name="status" id="status" value="<?=$status?>">

    <div class="popup_box">
        <div class="popup_wrap">
            <div class=" popup_con">
                <div class="popup tit_box row jc_sb ai_c">
                    <span>칼럼명 관리</span>
                    <button class="pop_close" type="button">
                        <span class="material-icons" >close</span>
                    </button>
                </div>

                <div class="popup_contents">
                    <ul class="tab_box mb_20">
                        <li class="on"><a href="javascript:;" onclick="js_ChangeStatusView(this, 'Y')">연재</a></li>
                        <li><a href="javascript:;" onclick="js_ChangeStatusView(this, 'N')">휴재/마감</a></li>
                    </ul>

                    <div class="row mb_20">
						<!--
                        <div class="col_24 t_right tc_3 mb_5">
                            <p class="fs_13">* 내용을 변경하신 후 꼭 저장 버튼을 클릭해 주세요.</p>
                        </div>
						-->

                        <div class="col_20 t_right">
                            <input type="text" name="description" id="description" maxlength="100" class="inp fm_full" placeholder="컬럼명 추가시 입력">
							<input type="hidden" name="sel_column_id" id="sel_column_id">
                        </div>

                        <div class="col_4 t_right">
                            <a href="javascript:;" onclick="js_save()" id="save_btn_id" class="btn btn_c7 btn_sm search">추가</a>
                        </div>
                    </div>
                    <div class="pop_scroll">
                        <div class="table_box horizontal t_center border_tb2 mb_5">
                            <table>
                                <colgroup>
                                    <col width="7%">
                                    <col width="13%">
                                    <col width="80%">
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th>
                                        <label class="fm_ch "  >
                                            <input type="checkbox" class="all_ch" >
                                        </label>
                                        </th>
                                        <th>No.</th>
                                        <th>칼럼명</th>
                                    </tr>
                                </thead>
                                <tbody id="column_id">
                                    <?
									for ($j = 0 ; $j < count($rs); $j++) {
                                    ?>

                                    <tr>
                                        <td class="act_tc3">
                                            <label class="fm_ch ">
                                                <input type="checkbox" name="pick_ch[]" value="<?=$rs[$j]['id']?>" class="pick_ch"> 
                                            </label>
                                        </td>
                                        <td class="act_tc3"><?=$j+1?></td>
                                        <td class="act_tc3">
                                            <div class="row">
                                                <div class="col_20 t_left">
                                                    <a href="javascript:;" onclick="js_view('<?=$rs[$j]['id']?>','<?=$rs[$j]['description']?>')">
                                                        <div class="table_ellip">
                                                            <span><?=$rs[$j]['description']?> </span>
                                                        </div>
                                                    </a>
                                                </div>
                                                <div class="col_4 t_right ">
                                                    <div class="arrow_btn row ai_c jc_fe t_right">
                                                        <button type="button" class="btn act_down arrow" onclick="js_updown('plus','<?=$rs[$j]['priority']?>','<?=$rs[$j]['id']?>')"> <i class="iconFt_arrow_down"></i></button>
                                                        <button type="button" class="btn act_up arrow" onclick="js_updown('minus','<?=$rs[$j]['priority']?>','<?=$rs[$j]['id']?>')"> <i class="iconFt_arrow_up"></i></button>
                                                    </div>
                                                </div>

                                            </div>
                                        </td>
                                    </tr>

                                    <?php  }?>

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class=" mt_30 row">
                        <div class="col_12">
                            <a href="javascript:;" class="btn_md btn " onclick="js_ChangeStatus('SEL_DELETE')">선택 삭제</a>
                        </div>
                        <div class=" col_12 t_right">
							<a href="javascript:;" class="btn_md btn_c2 " onclick="js_ChangeStatus('UPDATE_STATUS')">선택 휴재/마감처리</a>
                            <!--<a class="btn_md btn_c2 ">저장</a>-->
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <span class="popbg"></span>
    </div>
</form>
</div>

<script>


	function js_ChangeStatusView(e, s){
		$(e).closest("ul").children().removeClass("on");
		//$(e).closest("li").removeClass("on");
		$(e).closest("li").addClass("on");

		$('#status').val(s);

		js_reset();

		$.ajax({
			type: 'post',
			url: '/popup/ajax_getPopColumn',
			data : {mode:'CHANGE_STATUS_VIEW', 'status' : s},
			success: function(msg){
				//console.log(msg);
				$(".all_ch").prop("checked", false);
				$('#column_id').html(msg);
				//act_checkBox('.all_ch','.pick_ch .board_chk');
			},
			error: function( jqXHR, textStatus, errorThrown ) {
				alert( textStatus + ", " + errorThrown );
			}
		});
	}

	function js_ChangeStatus(s){

		var chk_cnt = 0;
		var mode = s;
		var dataArr = new Array();

		check=document.getElementsByName("pick_ch[]");

		for (i=0;i<check.length;i++) {
			if(check.item(i).checked==true) {

				dataArr[chk_cnt] = check.item(i).value;

				chk_cnt++;
			}
		}

		var msg = "";

		if(mode == "UPDATE_STATUS"){
			msg = "선택하신 칼럼의 상태를 변경하시겠습니까?";
		}else{
			msg = "선택하신 칼럼을 삭제하시겠습니까?";
		}

		if (chk_cnt == 0) {
			alert("선택 하신 칼럼이 없습니다.");
		} else {
			bDelOK = confirm(msg);

			if (bDelOK==true) {
				$.ajax({
					type: 'post',
					url: '/popup/ajax_getPopColumn',
					data : {mode:mode, dataArr:dataArr, status:$('#status').val()},
					success: function(msg){
						//console.log(msg);
						$('#column_id').html(msg);
					},
					error: function( jqXHR, textStatus, errorThrown ) {
						alert( textStatus + ", " + errorThrown );
					}
				});
			}
		}
	}


	function js_updown(tp, nsort, uid){

		//위로이동 : minus
		//아래이동 : plus

		$.ajax({
			type: 'post',
			url: '/popup/ajax_getPopColumn',
			data: {mode:'SORT_ORDER', type:tp, nsort:nsort, uid:uid, status : $('#status').val()},
			success: function(msg){

				if(msg == "MIN"){
					alert("최하위 입니다.");
				}else if(msg == "MAX"){
					alert("최상위 입니다.");
				}else{
					js_reset();
					$('#column_id').html(msg);
				}
			},
			error: function( jqXHR, textStatus, errorThrown ) {
				alert( textStatus + ", " + errorThrown );
			}
		});
	}

	function js_view(id, desc){

		$('#description').val(desc);
		$('#sel_column_id').val(id);
		$('#save_btn_id').text("수정");

	}

	function js_reset(){

		$('#description').val("");
		$('#sel_column_id').val("");
		$('#save_btn_id').text("추가");

	}

	function js_save(){

		var mode="INSERT";

		if($('#sel_column_id').val() != ""){
			mode="UPDATE";
		}

		if(isEmpty($('#description').val())){
			alert("칼럼명을 입력해 주세요.");
			$('#description').focus();
			return false;
		}

		if(mode == "UPDATE"){
			if(isEmpty($('#sel_column_id').val())){
				alert("필수 항목이 누락되었습니다.");
				return false;
			}
		}

		var msg = "";

		if(mode == "INSERT"){
			msg = "입력하신 칼럼명을 등록하시겠습니까?";
		}else{
			msg = "선택하신 칼럼명을 수정하시겠습니까?";
		}

		if(confirm(msg)){
			$.ajax({
				type: 'post',
				url: '/popup/ajax_getPopColumn',
				data: {mode:mode, desc:$('#description').val(), uid:$('#sel_column_id').val(), status : $('#status').val()},
				success: function(msg){

					if(msg == "FAIL"){
						alert("처리중 오류가 발생했습니다.\n다시 시도해 주세요.\n계속 동일 오류 발생시 관리자에게 문의해 주세요.");
					}else{
						js_reset();
						alert("정상 처리됬습니다.");
						$('#column_id').html(msg);
					}
				},
				error: function( jqXHR, textStatus, errorThrown ) {
					alert( textStatus + ", " + errorThrown );
				}
			});
		}

	}


</script>


</body>
</html>
