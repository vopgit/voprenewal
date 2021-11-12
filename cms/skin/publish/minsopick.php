<?php
$_menu_code = '0704';
include $_SERVER["DOCUMENT_ROOT"].'/include/header.php';
?>
<div class="contain">

    <div class="wrap">
        <h3 class="mb_20">민소픽 관리</h3>

            <div class="area_box mb_30">
                <div class="area_tit_box">
                    <div class="area_tit t_right">
                        <button type="button" class="btn btn_c2 search"  data-url="popup_ty6" onclick="act_popup(this)"><span>민소픽 그룹 관리</span></button>
                    </div>
                </div>

                <div class="area_con_box ptbl_0">
                    <div class="table_box horizontal ty_tab act_hov t_center">

                        <form name="frm_s" id="frm_s" method="get" action="/publish/minsopick">
						<div class="row plr_30 ptb_25 search_box">
                            <div class="col_5 pr_10">
                                <input type="text" name="s_serial" id="s_serial" class="inp fm_full enter" placeholder="시리얼 넘버" value="<?=$s_serial?>" maxlength="12">
                            </div>
                            <div class="col_5 pr_10">
                                <select name="s_grp" id="s_grp" class="sel sel_md fm_full">
                                    <option value="">민소픽 그룹</option>
                                    <?php foreach($group as $key=>$val) { ?>										
	                                    <option value="<?=$key?>" <?=($key == $s_grp) ? "selected" :"";?>><?=$val?></option>
									<?php } ?>
                                </select>
                            </div>
                            <div class="col_7 pr_10">
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


                        <table>
                            <colgroup>
                                <col data-col-width="70" >
                                <col data-col-width="160">
                                <col data-col-width="*">
                                <col data-col-width="160">
                                <col data-col-width="160">
                                <col data-col-width="160">
                            </colgroup>
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>컬럼명</th>
                                    <th>제목/시리얼넘버</th>
                                    <th>작성자</th>
                                    <th>발행시간</th>
                                    <th>편집</th>
                                </tr>
                            </thead>
                            <tbody>
                               <?php
								for ($j = 0 ; $j < count($rs['data']); $j++) {
									$data = $rs['data'][$j];						
									?>
									<tr data-id="<?=$data['id']?>">
										<td><?=($rs['vnum'] - $j)?></td>
										<td><?=$group[$data['minsopick_id']]?></td>
										<td class="_subj"><a href="javascript:;" class="pv_article"><?=$data['title']?></a></td>
										<td>
											<?=$data['name']?> 기자
											<?php if($data['contributor'] != ""){ //대체명의 ?>
												<br>(<?=$data['contributor']?>) 
											<?php } ?>
										</td>
										<td><?=$data['published_time']?></td>
										<td>
											<a href="javascript:;" class="btn btn_line_c4 btn_modify" type="button ">기사수정</a>
										</td>
									</tr>
                                
									<?php 
								} 
								?>
								<?php if($rs['total'] < 1){ ?>
								<tr>
									<td colspan="6">조회된 민소픽이 없습니다.</td>
								</tr>
								<?php } ?>
                            </tbody>

                        </table>

                        <div class="page_wrap pt_30 pb_25">
                            <?=$rs['paging']?>
                        </div>
                    </div>
                </div>
            </div>

    </div>

</div>

<script type="text/javascript">
$(document).ready(function() {
	$('#s_grp').val("<?=$s_grp?>");
	
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
		js_preview('minsopick', id);
	});

	//기사수정
	$('.btn_modify').click(function(){
		var id = $(this).closest('tr').data('id');
		if(id != ''){
			location.href = "/publish/input?contents_id=" + id + "&refer=minsopick<?=str_replace('?', '&', $param['query'])?>";
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
