<?php
$_menu_code = '0202';
include $_SERVER["DOCUMENT_ROOT"].'/include/header.php';
?>

<div class="contain">

    <div class="wrap">
        <h3 class="mb_20">발행된 원소스</h3>


        <form name="frm" id="frm" method="get" action="/osmu/list">

			<input type="hidden" name="nPage" value="<?=$nPage?>">

            <div class="area_box mb_30">

                <div class="area_con_box ptbl_0">
                    <div class="table_box horizontal ty_tab act_hov t_center">

                        <div class="row plr_30 ptb_25 search_box">
                            <div class="col_7 pr_10">
                                <input type="text" name="s_serial" id="s_serial" class="inp fm_full enter" placeholder="시리얼넘버" value="<?=$s_serial?>" maxlength="20">
                            </div>
                            <div class="col_10 pr_10">
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


                        <table class="t_center">

                            <colgroup>
                                <col data-col-width="70"  />
								<col data-col-width="100"  />
                                <col data-col-width="" />
                                <col data-col-width="160" />
                                <col data-col-width="80" />
                                <col data-col-width="155" />
                            </colgroup>
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>시리얼넘버</th>
									<th>제목</th>
                                    <th>작성자</th>
                                    <th>편집</th>
                                    <th>입력시간</th>
                                </tr>
                            </thead>
                            <tbody>
                               <?php
								for ($j = 0 ; $j < count($rs['data']); $j++) {
									$data = $rs['data'][$j];
									?>
									<tr>
										<td><?=($rs['vnum'] - $j)?></td>
										<td><?=$data['serial']?></td>
										<td class="t_left">
											<div class="_subj" onclick="js_preview('<?=$data['id']?>')" style="cursor:pointer">
												<?=$data['title']?>
											</div>
										</td>
										<td>
											<?=$data['name']?>
											<?php if($data['contributor'] != ''){ ?>
												(<?=$data['contributor']?>)
											<?php } ?>
										</td>
										<td>
											<?php if($data['member_id'] == $_SESSION['_admin']['no']){ ?>
												<a href="javascript:;" data-id="<?=$data['id']?>" class="btn btn_line_c4 btn_modify">수정</a>
											<?php }else{ ?>
												-
											<?php } ?>
										</td>
										<td >
											<p><?=$data['regist_time']?></p>
										</td>
									</tr>
									<?php 
								} 
								?>
								<?php if($rs['total'] < 1){ ?>
									<tr>
										<td colspan="6">조회된 원소스가 없습니다.</td>
									</tr>
								<?php } ?>
                            </tbody>
                        </table>

						<?php if($rs['total'] > 0){ ?>
							<div class="page_wrap pt_30 pb_25">
								<?=$rs['paging']?>
							</div>
						<?php } ?>
                       
                    </div>
                </div>
            </div>


        </form>

    </div>

</div>
<script type="text/javascript">
$(document).ready(function() {
	//검색
	$('.btn_search').on('click', function(){
		$('#frm').submit();
	});

	//검색 엔터 처리
	$('.enter').on('keydown', function(e){
		if(e.keyCode == 13){
			$('#frm').submit();
		}
	});

	//수정
	$('.btn_modify').on('click', function(){
		var id = $(this).data('id');
		location.href = "/osmu/input?mode=modify&osmu_id="+ id +"<?=str_replace('?', '&', $param['query'])?>";
	});
});

function js_preview(id){		
	var url = '/preview/osmu/' + id;
	$('#popup_iframe').attr('src',url);
	$('#popup_iframe').stop().fadeIn().css('visibility','visible');
	$('body,html').css('overflow','hidden');
}    
function close_iframe(){
	act_popup_close();
}
</script>

<?php include $_SERVER["DOCUMENT_ROOT"].'/include/footer.php'; ?>
