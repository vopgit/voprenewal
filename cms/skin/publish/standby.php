<?php 
$_menu_code = '0701';
include $_SERVER["DOCUMENT_ROOT"].'/include/header.php'; 
?>
<div class="contain">

    <div class="wrap">
        <h3 class="mb_20">편집 대기</h3>

            <div class="table_box horizontal ty_tab act_hov">
                <ul class="tab_box">
                    <li <?php if($s_kind != '1' && $s_kind != '6'){ ?>class="on"<?php } ?>><a href="/publish/standby">전체</a></li>
                    <li <?php if($s_kind == "1"){ ?>class="on"<?php } ?>><a href="/publish/standby?s_kind=1">일반</a></li>
                    <li <?php if($s_kind == '6'){ ?>class="on"<?php } ?>><a href="/publish/standby?s_kind=6">포토뉴스</a></li>
                </ul>

                <form name="frm_s" id="frm_s" method="get" action="/publish/standby">
				<div class="row plr_30 ptb_25 search_box">
                    <div class="col_4 pr_10">
                        <div class="sel_box">
                            <select name="s_kind" id="s_kind" class="sel sel_md fm_full placeholder __customUi">
                                <option value="">기사종류</option>
								<?php for ($j = 0 ; $j < count($rs_newsKind); $j++) { ?>
									<option value="<?=$rs_newsKind[$j]['id']?>"><?=$rs_newsKind[$j]['name']?></option>
								<?php  } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col_5 pr_10">
                        <input type="text" name="s_serial" id="s_serial" class="inp fm_full enter" placeholder="시리얼 넘버" value="<?=$s_serial?>" maxlength="12">
                    </div>
                    <div class="col_8 pr_10">
                        <input type="text" name="s_title" id="s_title" class="inp fm_full enter" placeholder="제목" value="<?=$s_title?>" maxlength="50">
                    </div>
                    <div class="col_7 ">
                        <div class="row">
                            <div class="col_19 t_right">
                                <input type="text" name="s_name" id="s_name" class="inp fm_full enter" placeholder="작성자" value="<?=$s_name?>" maxlength="20">
                            </div>
                            <div class="col_5 t_right">
                                <a href="javascript:;" class="btn btn_c7 btn_sm search btn_search">검색</a>
                            </div>
                        </div>

                    </div>
                </div>
				</form>

                <form name="frm" id="frm" method="post" action="/publish/dml">
				<input type="hidden" name="mode" id="mode">
				<input type="hidden" name="returnUrl" value="<?=urldecode($_SERVER['REQUEST_URI'])?>">

				<table class="t_center">
                    <colgroup>
                        <col width="4%">
                        <col width="5%">
                        <col width="8%">
                        <col width="7%">
                        <col width="29%">
                        <col width="14%">
                        <col width="9%">
                        <col width="9%">
                        <col width="7%">
                        <col width="20%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>
                                <label class="fm_ch ">
                                    <input type="checkbox" class="all_ch" title="전체 선택"><span class="_icon"></span>
                                </label>
                            </th>
                            <th>No.</th>
                            <th>기사종류</th>
                            <th>기사분류</th>
                            <th>제목</th>
                            <th>작성자</th>
                            <th>편집</th>
                            <th>입력시간</th>
                            <th>섹션</th>
                            <th>상태</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
					for ($j = 0 ; $j < count($rs['data']); $j++) {
						$data = $rs['data'][$j];						
						?>
                         <tr data-id="<?=$data['id']?>">
                            <td>
                                <label class="fm_ch ">
                                    <input type="checkbox" name="chk[]" id="chk[]" class="board_chk" value="<?=$data['id']?>"><span class="_icon"></span>
                                </label>
                            </td>
                            <td><?=($rs['vnum'] - $j)?></td>
                            <td><?=$data['kind_name']?></td>
                            <td><?=$data['category_name']?></td>
                            <td class="_subj"><a href="javascript:;" class="pv_article"><?=$data['title']?></a></td>
                            <td>
								<?=$data['name']?> 기자
								<?php if($data['contributor'] != ""){ //대체명의 ?>
									<br>(<?=$data['contributor']?>) 
								<?php } ?>
							</td>
                            <td>
                                <!-- 기사 수정 페이지입니다. -->
                                <a href="javascript:;" class="btn btn_line_c4 btn_modify" type="button ">기사수정</a>
                            </td>
                            <td><?=str_replace(" ", "<br>", $data['regist_time'])?></td>
                            <td>
                                <label for="chk_m_<?=$j?>" class="fm_ch">
                                    <input type="checkbox" name="is_main_<?=$j?>" id="chk_m_<?=$j?>" class="check" value="Y" <?=($data['is_main'] == 'Y') ? "checked" : "";?>>
                                    <span class="fs_13">메인</span>
                                </label>
                            </td>
                            <td>
                                <input type="hidden" name="c_id_<?=$j?>" id="c_id_<?=$j?>]" value= "<?=$data['id']?>">
								<input type="hidden" name="old_status_<?=$j?>" id="old_status_<?=$j?>" value= "<?=$data['status']?>">								
								
								<div class="in_multy_radio j_right">
                                    <label class="fm_rd ">
                                        <input name="status_<?=$j?>" id="fm_rd_<?=$j?>" class="radio" type="radio" value="published">
                                        <span class="fs_13">발행</span>
                                    </label>
                                    <label class="fm_rd ">
                                        <input name="status_<?=$j?>" id="fm_rd_<?=$j?>" class="radio" type="radio" value="reserved1" <?=($data['status'] == 'reserved1' || $data['status'] == 'reserved2') ? "checked" : "";?>>
                                        <span class="fs_13">보류</span>
                                    </label>
                                    <label class="fm_rd ">
                                        <input name="status_<?=$j?>" id="fm_rd_<?=$j?>" class="radio" type="radio" value="standby" <?=($data['status'] == 'standby') ? "checked" : "";?>>
                                        <span class="fs_13">대기</span>
                                    </label>
                                </div>
                            </td>
                        </tr>
                        <?php 
						} 
					?>
					<?php if($rs['total'] < 1){ ?>
						<tr>
							<td colspan="10">편집 대기중인 기사가 없습니다.</td>
						</tr>
					<?php } ?>
                    </tbody>

                </table>
				</form>

                <div class="page_wrap pt_30 pb_25">
                    <?=$rs['paging']?>
                </div>
            </div>
        

        <div class="mtb_30 t_right btn_box">
            <button class="btn_lg btn btn_line_c14 btn_sel_del">선택삭제</button>
            <button class="btn_lg btn_c2 ml_10 btn_submit"> 전체 편집 완료</button>
        </div>

    </div>

</div>

<script type="text/javascript">
$(document).ready(function() {
	$('#s_kind').val("<?=$s_kind?>");
	
	//검색
	$('.btn_search').on('click', function(){
		$('#frm_s').submit();
	});

	//검색 엔터 처리
	$('.enter').on('keydown', function(e){
		if(e.keyCode == 13){
			$('#frm_s').submit();
		}
	});

	//기사보기
	$('.pv_article').on('click',function(){
		var id = $(this).closest('tr').data('id');
		js_preview('article', id);
	});

	//기사수정
	$('.btn_modify').click(function(){
		var id = $(this).closest('tr').data('id');
		if(id != ''){
			location.href = "/publish/input?contents_id=" + id + "&refer=standby<?=str_replace('?', '&', $param['query'])?>";
		}		
	});

	//섹션 메인 선택시 상태 체크
	$('.check').on('click', function(){		
		var n = $(this).attr('name').replace('is_main_', '');
		var s = $("input:radio[name='status_"+n+"']:checked").val();

		if(s != 'published'){
			alert('발행 선택 후 체크하여 주세요');
			$(this).attr("checked", false);
			return false;
		}
	});

	//status 선택시 발행이 아닌 경우 메인 체크 해제
	$('.radio').on('click', function(){		
		var n = $(this).attr('name').replace('status_', '');
		$("input:checkbox[name='is_main_"+n+"']").prop("checked", false);
	});

	//선택삭제
	$('.btn_sel_del').on('click', function(){
		var cnt = $("input:checkbox[name='chk[]']:checked").length;		
		if(cnt < 1){
			alert("선택된 기사가 없습니다");
		}else if(confirm("선택 기사를 삭제하시겠습니까?")){
		
			document.frm.mode.value="sel_del";
			var datas = $("#frm").serialize();

			$.ajax({
				type: 'post',
				url: '/publish/dml',
				data: datas,
				success: function(msg){
					if(msg == "success"){
						alert("삭제되었습니다");
						location.reload();
					}else{
						alert(msg);
					}
				},
				error: function( jqXHR, textStatus, errorThrown ) { 
					alert( textStatus + ", " + errorThrown ); 
				} 
			});
			document.frmSearch.mode.value="";
		}
	});

	//편집완료
	$('.btn_submit').on('click', function(e){
		if(confirm('저장하시겠습니까?')){
			document.frm.mode.value="edit";	
			document.frm.submit();
		}
	});

	/*
	//편집대기, 기사삭제
	$('.btn_change_status').on('click',function(){
		var id = $(this).closest('tr').data('id');
		var status = $(this).data('status');

		var str = (status == 'standby') ? '편집대기로 변경하시겠습니까?' : '기사를 삭제하시겠습니까?';
		if(confirm(str)){
			console.log(id +','+ status);
			$.ajax({
				type: 'post',
				url: '/contents/dml',
				data: {'mode':'change_status', 'contents_id': id, 'status':status, 'old_status':'tempstored'},
				success: function(msg){
					if(msg == 'success') location.reload();
					else alert(msg);			
				},
				error: function( jqXHR, textStatus, errorThrown ) { 
					alert( textStatus + ", " + errorThrown ); 
				} 
			});	
		}

	});
	*/
});

function js_preview(type, id){		
	var url = '/preview/'+type+'/' + id;
	$('#popup_iframe').attr('src',url);
	$('#popup_iframe').stop().fadeIn().css('visibility','visible');
	$('body,html').css('overflow','hidden');
}    
function close_iframe(){
	act_popup_close();
}
</script>

<?php include $_SERVER["DOCUMENT_ROOT"].'/include/footer.php'; ?>
