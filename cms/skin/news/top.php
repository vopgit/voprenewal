<?php
$_menu_code = '0501';
include $_SERVER["DOCUMENT_ROOT"].'/include/header.php';
?>
<div class="contain">

    <div class="wrap">
        <h3 class="mb_20">Top 기사 관리</h3>


        <form name="frm" id="frm" method="post">
			<input type="hidden" name="mode" id="mode" value="">
			<input type="hidden" name="refer" value="top">
			<input type="hidden" name="nPage" value="nPage">

            <div class="table_box horizontal ty_tab act_hov">
                <div class="row tab_wrap">
                    <div class="col_12">
                        <ul class="tab_box">
                            <li class="on"><a href="/news/top">노출대기</a></li>
                            <li><a href="/news/top_rank">Top 순위 조정</a></li>
                        </ul>
                    </div>
                    <div class="col_12 flex ai_c pr_30">
                        <button type="button" class="fs_13 flex ai_c ml_auto" onclick="ranking();">
                            <i class="iconFt_icon20 fs_16 mr_5"></i>
                            순위별 노출 위치
                        </button>
                    </div>
                </div>
                <table class="t_center">
                    <colgroup>
                        <col width="5%">
                        <col width="10%">
                        <col width="35%">
                        <col width="13%">
                        <col width="15%">
                        <col width="22%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>
                                <label class="fm_ch ">
                                    <input type="checkbox" class="all_ch" title="전체 선택"><span class="_icon"></span>
                                </label>
                            </th>
                            <th>시리얼넘버</th>
                            <th>제목</th>
                            <th>작성자</th>
                            <th>편집</th>
                            <th>편집내용</th>
                        </tr>
                    </thead>
                    <tbody>
						<?php
						for ($j = 0 ; $j < count($rs['data']); $j++) {
							$data = $rs['data'][$j];
							//grade : 'TOP','SUB','STANDBY','MINOR'							
							?>
							<tr data-id="<?=$data['contents_id']?>">
								<td>
									<label class="fm_ch ">
										<input type="checkbox" name="chk[<?=$j?>]" class="board_chk" value="<?=$data['id']?>"><span class="_icon"></span>
									</label>
								</td>
								<td><?=$data['serial']?></td>
								<td class="_subj"><a href="javascript:;" class="pv_article"><?=$data['contents_title']?></a></td>
								<td>
									<?=$data['name']?> 기자
									<?php if($data['contributor'] != ""){ //대체명의 ?>
										<br>(<?=$data['contributor']?>) 
									<?php } ?>
								</td>
								<td>
									<div class="flex jc_c">
										<a href="javascript:;" class="btn btn_line_c4 btn_modify" type="button ">기사수정</a>
										<a href="javascript:;" class="btn btn_line_c8 btn_publish" data-id="<?=$data['id']?>" type="button">노출수정</a>
									</div>
								</td>
								<td>
									
									<input type="hidden" name="top_id_<?=$j?>" value="<?=$data['id']?>">
									<input type="hidden" name="old_grade_<?=$j?>" value="<?=$data['grade']?>">
									
									<div class="in_multy_radio j_right">
										<label class="fm_rd ">
											<input name="fm_rd_<?=$j?>" type="radio" value="TOP" title="">
											<span class="fs_13">Top</span>
										</label>
										<label class="fm_rd ">
											<input name="fm_rd_<?=$j?>" type="radio" value="DEL" title="노출삭제">
											<span class="fs_13">노출삭제</span>
										</label>
										<label class="fm_rd ">
											<input name="fm_rd_<?=$j?>" type="radio" value="STANDBY" title="노출대기" checked>
											<span class="fs_13">노출대기</span>
										</label>
									</div>
								</td>
							</tr>
							<?php 
						} 
						?>
						<?php if($rs['total'] < 1){ ?>
						<tr>
							<td colspan="6">조회된 노출대기 기사가 없습니다.</td>
						</tr>
						<?php } ?>
                    </tbody>

                </table>

                <div class="page_wrap pt_30 pb_25">
                     <?=$rs['paging']?>
                </div>
            </div>
        </form>

        <div class="mtb_30 t_right btn_box">
            <button class="btn_lg btn_c7  btn_sel_submit"> 선택 편집 완료</button>
            <button class="btn_lg btn_c2 ml_10  btn_submit"> 전체 편집 완료</button>
        </div>

    </div>

</div>
<script type="text/javascript">
$(document).ready(function() {

	//기사보기
	$('.pv_article').on('click',function(){
		var id = $(this).closest('tr').data('id');
		js_preview('article', id);
	});

	//기사수정
	$('.btn_modify').click(function(){
		var id = $(this).closest('tr').data('id');
		if(id != ''){
			location.href = "/news/input?contents_id=" + id + "&refer=top<?=str_replace('?', '&', $param['query'])?>";
		}		
	});

	//노출수정
	$('.btn_publish').click(function(){
		var id = $(this).data('id');
		if(id != ''){
			location.href = "/news/edit?top_id=" + id + "&refer=top<?=str_replace('?', '&', $param['query'])?>";
		}		
	});

	//선택편집완료
	$('.btn_sel_submit').on('click', function(){
		var cnt = $("input:checkbox[class='board_chk']:checked").length;		
		if(cnt < 1){
			alert("선택된 기사가 없습니다");
		}else if(confirm("선택된 기사를 편집완료 저장을 하시겠습니까?")){
			document.frm.mode.value="sel";
			$('#mode').val('sel');
			$('#frm').attr('action', '/news/dml');
			$('#frm').submit();
		}
	});

	//편집완료
	$('.btn_submit').on('click', function(e){
		if(confirm("편집완료 저장을 하시겠습니까?")){
			$('#mode').val('all');
			$('#frm').attr('action', '/news/dml');
			$('#frm').submit();
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
