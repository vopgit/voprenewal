<?php 
$_menu_code = '0702';
include $_SERVER["DOCUMENT_ROOT"].'/include/header.php'; 
?>
<div class="contain">

    <div class="wrap mb_100">
        <h3 class="mb_20">발행된 기사</h3>

        
            <div class="table_box horizontal ty_tab act_hov">
                
				<form name="frm_s" id="frm_s" method="get" action="/publish/published">

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

                <table class="t_center">
                    <colgroup>
                        <col width="5%">
                        <col width="7%">
                        <col width="7%">
                        <!-- <col width="10%">
                        <col width="20%"> -->
						<col width="30%">
                        <col width="10%">
                        <col width="9%">
                        <col width="8%">
                        <col width="9%">
                        <col width="7%">
                        <col width="18%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>기사종류</th>
                            <th>기사분류</th>
                            <!-- <th>시리얼 넘버</th> -->
                            <th>제목</th>
                            <th>작성자</th>
                            <th>조회수<br />(PC/Mobile)</th>
                            <th>편집</th>
                            <th>발행시간</th>
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
                            <td><?=($rs['vnum'] - $j)?></td>
                            <td><?=$data['kind_name']?></td>
                            <td><?=$data['category_name']?></td>
							<td class="_subj">
								<a href="javascript:;" class="pv_article"><?=$data['title']?></a>
								<br><span style="display:block; padding-top:10px;"><?=$data['serial']?></span>
							</td>
                            <td>
								<?=$data['name']?> 기자
								<?php if($data['contributor'] != ""){ //대체명의 ?>
									<br>(<?=$data['contributor']?>) 
								<?php } ?>
							</td>
                            <!-- 조회수 PC / Mobile-->
                            <td><?=number_format($data['count']['pc'])?>/<?=number_format($data['count']['mobile'])?></td>
                            <td>
                                <!-- 기사 수정 페이지입니다. -->
                                <a href="javascript:;" class="btn btn_line_c4 btn_modify" type="button ">기사수정</a>
                            </td>
                            <!-- 발행시간 -->
                            <td><?=str_replace(" ", "<br>", $data['published_time'])?></td>
                            <!-- 섹션 -->
                            <td>
								<input type="hidden" name="old_top" id="old_top" value="<?=$data['is_top']?>">
                                <label for="chk_m_<?=$j?>" class="fm_ch">
                                    <input type="checkbox" name="top" id="chk_m_<?=$j?>" class="checked" value="Y" <?=($data['is_top'] =='Y') ?"checked":"";?>>
                                    <span class="fs_13">메인</span>
                                </label>
                            </td>
                            <!-- 상태 -->
                            <td>
                                <div class="row flex jc_sb fw_nowrap">
                                    <a href="javascript:;" class="btn btn_line_c9 btn_full btn_done" data-serial="<?=$data['serial']?>">편집완료</a>
                                    <a href="javascript:;" class="btn btn_line_c5 btn_full btn_del" data-serial="<?=$data['serial']?>">기사삭제</a>
                                </div>
                                <a href="javascript:;" class="btn btn_line_c10 btn_full mt_5 btn_static" data-serial="<?=$data['serial']?>">스택틱 만들기</a>
                            </td>
                        </tr>
                       <?php
					}
					?>
					<?php if($rs['total'] < 1){ ?>
						<tr>
							<td colspan="10">발행된 기사가 없습니다.</td>
						</tr>
					<?php } ?>
                    </tbody>

                </table>

                <div class="page_wrap pt_30 pb_25">
                   <?=$rs['paging']?>
                </div>
            </div>
        </form>


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
			location.href = "/publish/input?contents_id=" + id + "&refer=published<?=str_replace('?', '&', $param['query'])?>";
		}		
	});

	//편집완료
	$('.btn_done').on('click',function(){
		var id = $(this).closest('tr').data('id');
		var old_top = $(this).closest('tr').find('#old_top').val();
		var change_top = ($(this).closest('tr').find("input:checkbox[name='top']").is(':checked')) ? 'Y' : 'N';

		if(old_top == change_top){
			alert('변경된 사항이 없습니다');
			return;	
		} 

		if(confirm("변경사항을 적용하시겠습니까?")){
			var serial = $(this).data('serial');
			$.ajax({
				type: 'post',
				url: '/publish/dml',
				data: {'mode':'change_section', 'contents_id': id, 'serial': serial, 'old_top': old_top, 'change_top': change_top},
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

	//기사삭제
	$('.btn_del').on('click',function(){
		var id = $(this).closest('tr').data('id');
		var serial = $(this).data('serial');
	
		if(confirm("기사를 삭제하시겠습니까?")){			
			$.ajax({
				type: 'post',
				url: '/publish/dml',
				data: {'mode':'del_article', 'contents_id': id, 'serial': serial},
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

	//스태틱 만들기
	$('.btn_static').on('click',function(){
		var id = $(this).closest('tr').data('id');
		var serial = $(this).data('serial');
		
		if(confirm("스태틱을 생성하시겠습니까?")){
			$.ajax({
				type: 'post',
				url: '/publish/dml',
				data: {'mode':'make_static', 'contents_id': id},
				success: function(msg){
					if(msg == 'success') alert('스태틱이 발행되었습니다');
					else alert(msg);			
				},
				error: function( jqXHR, textStatus, errorThrown ) { 
					alert( textStatus + ", " + errorThrown ); 
				} 
			});	
		}

	});

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
