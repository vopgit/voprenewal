<?php
$_menu_code = '0302';
include $_SERVER["DOCUMENT_ROOT"].'/include/header.php';
?>
<div class="contain">

    <div class="wrap mb_100">
        <h3 class="mb_20">발행된 사진</h3>

        <form name="frm" id="frm" method="get" action="/photo/list">
            <div class="table_box horizontal ty_tab act_hov">
                <div class="row plr_30 ptb_25 search_box">

                    <div class="col_5 pr_10">
                        <input type="text" name="s_serial" id="s_serial" class="inp fm_full enter" placeholder="시리얼넘버" value="<?=$s_serial?>" maxlength="20">
                    </div>
                    <div class="col_10 pr_10">
                        <input type="text" name="s_title" id="s_title" class="inp fm_full enter" placeholder="제목" value="<?=$s_title?>" maxlength="50">
                    </div>
                    <div class="col_9 ">
                        <div class="row">
                            <div class="col_19 t_right">
                                <input type="text" name="s_name" id="s_name" class="inp fm_full enter" placeholder="작성자" value="<?=$s_name?>" maxlength="20">
                            </div>
                            <div class="col_4 t_right">
								<a href="javascript:;" class="btn btn_c7 btn_sm search btn_search">검색</a>
                            </div>
                        </div>

                    </div>
                </div>

                <table class="t_center">
                    <colgroup>
                        <!-- No -->
                        <col width="7%">
                        <!-- 섬네일 -->
                        <col width="10%">
                        <!-- 저작권자 -->
                        <col width="15%">
                        <!-- 제목 -->
						<col width="*">
                        <!-- 이름 -->
                        <col width="12%">
                        <!-- 편집 -->
                        <col width="20%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>섬네일</th>
                            <th>저작권자</th>
                            <th>제목</th>
                            <th>이름</th>
                            <th>편집</th>
                        </tr>
                    </thead>
                    <tbody>
                       <?php
						for ($j = 0 ; $j < count($rs['data']); $j++) {
							$data = $rs['data'][$j];
							?>
                            <tr>
                                <td><?=($rs['vnum'] - $j)?></td>
                                <td>
                                    <div class="list_thumb">
										<?php if($data['file_name_m'] != ''){ ?>
										<div class="tag">
											반응형
										</div>
										<?php } ?>
                                        <img src="<?=$data['photo']?>" alt="">
                                    </div>
                                </td>
                                <!-- 저작권자 -->
                                <td><?=($data['copyright'] == '') ? '민중의소리' : $data['copyright']?></td>
                                <td class="t_left" onclick="js_preview('<?=$data['id']?>')" >
                                    <div class="_subj " style="cursor: pointer;">
                                       <?=$data['title']?><br />
                                       <span style="display:block; padding-top:10px;"><?=$data['serial']?></span>
                                    </div>
                                </td>
                                <td>
									<?=$data['name']?> 기자
									<?php if($data['contributor'] != ''){ ?>
										<br>(<?=$data['contributor']?>)
									<?php } ?>
								</td>
                                <td data-id='<?=$data['id']?>'>
                                    <?php if($_SESSION['_admin']['role'] == "editor" || $data['member_id'] == $_SESSION['_admin']['no']){ ?>
										<a href="javascript:;" class="btn btn_line_c8 btn_modify">사진수정</a>
	                                    <a href="javascript:;" class="btn btn_line_c4 btn_hold">사진보류</a>
		                                <a href="javascript:;" class="btn btn_line_c5 btn_delete">사진삭제</a>
									<?php }else{ ?>
										-
									<?php } ?>
                                </td>

                            </tr>
							<?php
							}
						?>

						<?php if($rs['total'] < 1){ ?>
						<tr>
							<td colspan="6">조회된 사진이 없습니다.</td>
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
		var id = $(this).closest('td').data('id');
		location.href = "/photo/modify?photo_id="+ id +"<?=str_replace('?', '&', $param['query'])?>";
	});

	//사진보류
	$('.btn_hold').on('click', function(){
		var id = $(this).closest('td').data('id');
		if(confirm('보류 하시겠습니까?')){
			$.ajax({
				type: 'post',
				url: '/photo/dml',
				data: {'mode': 'hold', 'photo_id':id},
				success: function(msg){
					if(msg == "success"){
						alert("보류 되었습니다");
						location.reload();
					}else{
						alert(msg);
					}			
				},
				error: function( jqXHR, textStatus, errorThrown ) { 
					alert( textStatus + ", " + errorThrown ); 
				} 
			});
		}
	});

	//사진삭제
	$('.btn_delete').on('click', function(){
		var id = $(this).closest('td').data('id');
		if(confirm('삭제 하시겠습니까?')){
			$.ajax({
				type: 'post',
				url: '/photo/dml',
				data: {'mode': 'del', 'photo_id':id},
				success: function(msg){
					if(msg == "success"){
						alert("삭제 되었습니다");
						location.reload();
					}else{
						alert(msg);
					}			
				},
				error: function( jqXHR, textStatus, errorThrown ) { 
					alert( textStatus + ", " + errorThrown ); 
				} 
			});
		}
	});
});

function js_preview(id){
	var url = '/photo/view/' + id;
	$('#popup_iframe').attr('src',url);
	$('#popup_iframe').stop().fadeIn().css('visibility','visible');
	$('body,html').css('overflow','hidden');
}
function close_iframe(){
	act_popup_close();
}
</script>

<?php include $_SERVER["DOCUMENT_ROOT"].'/include/footer.php'; ?>
