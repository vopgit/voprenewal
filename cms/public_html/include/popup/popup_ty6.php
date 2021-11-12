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
include $_SERVER["DOCUMENT_ROOT"]."/core/popup/popup_ty6.class.php";
?>


<?php include $_SERVER["DOCUMENT_ROOT"].'/include/head.php'; ?>
<style>
    html,body{
        background: none;
    }
</style>

<form  name="frm" id="frm" method="post">
    <div class="popup_box">
        <div class="popup_wrap">
            <div class=" popup_con">
                <div class="popup tit_box row jc_sb ai_c">
                    <span>민소픽 그룹 관리</span>
                    <button class="pop_close" type="button">
                        <span class="material-icons" >close</span>
                    </button>
                </div>

                <div class="popup_contents">
					<div class="row mb_20">
                        <div class="col_20 t_right">
                            <input type="text" name="title" id="title" maxlength="100" class="inp fm_full" placeholder="민소픽 그룹 추가시 입력">
							<input type="hidden" name="sel_column_id" id="sel_column_id">
                        </div>

                        <div class="col_4 t_right">
                            <a href="javascript:;" onclick="js_save()" id="save_btn_id" class="btn btn_c7 btn_sm search">추가</a>
                        </div>
                    </div>


					<!--
                    <div class="row mb_20">
                        <div class="col_24 t_right tc_3 mb_5">
                            <p class="fs_13">* 내용을 변경하신 후 꼭 저장 버튼을 클릭해 주세요.</p>
                        </div>
                        <div class="col_20 t_right">
                            <input type="text" class="inp fm_full" placeholder="컬럼 추가">
                        </div>
                        <div class="col_4 t_right">
                            <a href="" class="btn btn_c7 btn_sm search">추가</a>
                        </div>
                    </div>
					-->

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
                                        <th>민소픽 그룹명</th>
                                    </tr>
                                </thead>

                                <tbody id="column_id">
									<?if(count($rs) > 0){?>
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
												<div class="row ai_c">
													<div class="col_20 t_left">
														<a href="javascript:;" onclick="js_view('<?=$rs[$j]['id']?>','<?=$rs[$j]['title']?>')">
															<div class="table_ellip">
																<span> <?=$rs[$j]['title']?></span>
															</div>
														</a>
														<!--<input type="text" class="inp fm_full" placeholder="컬럼" value="노동자 열전 노동자 열전">-->
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

										<?}?>

									<?}else{?>
										<tr>
											<td class="act_tc3" colspan="3">게시글이 없습니다.</td>
										</tr>

									<?}?>

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class=" mt_30 row">

						
						<div class="col_12">

                        </div>
						
                        <div class=" col_12 t_right">
							<a href="javascript:;" class="btn_md btn " onclick="js_ChangeStatus('SEL_DELETE')">선택 삭제</a>
                        </div>
						
						<!--
                        <div class="col_17">
                            <a class="btn_md btn ">선택 삭제</a>
                        </div>
                        <div class=" col_5">
                            <a class="btn_md btn_c2 ">저장</a>
                        </div>
						-->
                    </div>
                </div>
            </div>
        </div>
        <span class="popbg"></span>
    </div>
</form>
</div>

<script>
    $(function(){
        act_checkBox('.all_ch','.pick_ch');
    });

    function act_checkBox(all_ch,name){
        var $all_ch = $(all_ch);
        var $pick_ch =$(name);

        $all_ch.change(function (){
            $(this).is(':checked') ?  $pick_ch.prop('checked',true) :  $pick_ch.prop('checked', false);
        })

        $pick_ch.change(function (){
           var chLangth = $pick_ch.length;
           var pickLangth = $(name+':checked').length;
           chLangth == pickLangth  ?  $all_ch.prop('checked',true) :  $all_ch.prop('checked', false);
        })
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

		msg = "선택하신 민소픽 그룹을 삭제하시겠습니까?";

		if (chk_cnt == 0) {
			alert("선택하신 민소픽 그룹이 없습니다.");
		} else {
			bDelOK = confirm(msg);

			if (bDelOK==true) {
				$.ajax({
					type: 'post',
					url: '/popup/ajax_getPopMinsopick',
					data : {mode:mode, dataArr:dataArr},
					success: function(msg){
						//console.log(msg);
						js_reset();
						alert("정상 처리됬습니다.");
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
			url: '/popup/ajax_getPopMinsopick',
			data: {mode:'SORT_ORDER', type:tp, nsort:nsort, uid:uid},
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

	function js_view(id, title){

		$('#title').val(title);
		$('#sel_column_id').val(id);
		$('#save_btn_id').text("수정");

	}

	function js_reset(){

		$('#title').val("");
		$('#sel_column_id').val("");
		$('#save_btn_id').text("추가");

	}

	function js_save(){

		var mode="INSERT";

		if($('#sel_column_id').val() != ""){
			mode="UPDATE";
		}

		if(isEmpty($('#title').val())){
			alert("민소픽 그룹명을 입력해 주세요.");
			$('#title').focus();
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
			msg = "입력하신 민소픽 그룹명을 등록하시겠습니까?";
		}else{
			msg = "선택하신 민소픽 그룹명을 수정하시겠습니까?";
		}

		if(confirm(msg)){
			$.ajax({
				type: 'post',
				url: '/popup/ajax_getPopMinsopick',
				data: {mode:mode, title:$('#title').val(), uid:$('#sel_column_id').val()},
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
