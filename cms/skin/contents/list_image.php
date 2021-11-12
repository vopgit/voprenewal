<?php include $_SERVER["DOCUMENT_ROOT"].'/include/header.php'; ?>
<div class="contain">

    <div class="wrap">
        <!--내가입력한 사진-->
        <div class="row ai_c mb_20">
            <h3>내가 입력한 사진</h3>
            <div class=" top_tab_btns">
                <button type="button" class="top_tab_btn on" onclick="photoBox.simpleEvt(this, '#eaditPhoto')"><span>사진 간단히</span></button>
                <button type="button" class="top_tab_btn"    onclick="photoBox.detailEvt(this, '#eaditPhoto')"><span>사진 자세히</span></button>
            </div>

            <div class="ml_auto col_3">
                <div class="sel_box">
                    <select name="status" id="status" class="sel fm_full">
                        <option value="">전체</option>                        
                        <option value="published">발행중</option>
                        <option value="reserved">보류중</option>
                        <option value="deleted">삭제됨</option>
                    </select>
                </div>
            </div>
        </div>

        <!--사진 간단히 .eadit_photo_box .simple-->
        <!--사진 자세히 .eadit_photo_box -->

        <div class="row wp_10 mb_30 eadit_photo_box simple" id="eaditPhoto">
            <?php
			//$_post_status - config 정의		
			for ($j = 0 ; $j < count($rs['data']); $j++) {
				$data = $rs['data'][$j];
				?>
				<div class="col_12 eadit_photo_col">
					<div class="eadit_photo">
						<div class="ph_wrap">
							<div class="ph_thumbnail">
							<div class="thum_img" onclick="js_preview('image','<?=$data['id']?>')">
									<img src="<?=$data['photo']?>" alt="<?=$data['title']?>">
								</div>
								<div class="thum_txt">
									<div class="fs_14">
										<p class="fw_700 num_code"><?=$data['serial']?></p>
										<p class="<?=$_post_status[$data['status']]['color']?>"><?=$_post_status[$data['status']]['title']?></p>
									</div>
									<?php if($data['status'] == "published"){ ?>
										<button type="button" class="btn btn_line_cg" onclick="js_modify('<?=$data['id']?>')"><span>사진수정</span></button>
									<?php } ?>
								</div>
							</div>
							<div class="ph_text">
								<div class="table_box vertical ">
									<table>
										<colgroup>
											<col width="130" data-simple="none" />
											<col />
										</colgroup>
										<tbody>
											<tr data-simple="none">
												<th class="t_left">입력자/저작권자</th>
												<td><?=$data['name']?> / <?=$data['copyright']?></td>
											</tr>
											<tr>
												<th class="t_left" data-simple="none">제목</th>
												<td>
												  <div class="t_left ellip_1 fs_14">
												   <span><?=$data['title']?></span>
												  </div>
												</td>
											</tr>
											<tr>
												<th class="t_left" data-simple="none">태그</th>
												<td><?=$data['tags_print']?></td>
											</tr>
											<tr data-simple="none">
												<th class="t_left">입력시간</th>
												<td><?=$data['regist_time']?></td>
											</tr>
											<tr data-simple="none">
												<th class="t_left">수정시간</th>
												<td><?=$data['update_time']?></td>
											</tr>
											<tr data-simple="none">
												<th class="t_left">설명</th>
												<td><?=($data['description'] != "") ? $data['description'] : '설명없슴'; ?></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php
			}
			?>

			<?php if($rs['total'] < 1){ ?>
				<div class="col_12 eadit_photo_col" style="width: 100% !important; text-align:center;">
					<div class="eadit_photo">
						<div class="ph_wrap">조회된 사진이 없습니다.</div>
					</div>
				</div>
			<?php } ?>
        </div>
        <!--내가입력한 사진//-->


        <div class="row ai_c mb_30">
            <div class="col_4">
                <!-- <div class="btn_box">
                    <div class="col_4">
                        <button class="btn_lg btn"> 목록으로</button>
                    </div>
                </div> -->
            </div>
            <div class="col_16">
                <div class="page_wrap">
                    <?=$rs['paging']?>
                </div>
            </div>
        </div>


    </div>

</div>

<script type="text/javascript">
$(function(){
	$('#status').change(function(){
		var status = ($(this).val() == "") ? "" : "&status=" + $(this).val();
		location.href = "/contents/list?type=<?=$type?>" + status;
	});
});
$(document).ready(function() {
	$('#status').val("<?=$status?>");
});

function js_modify(id){
	location.href = '/photo/modify?photo_id=' + id;
}
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
