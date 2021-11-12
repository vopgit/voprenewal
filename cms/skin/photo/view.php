<?php include $_SERVER["DOCUMENT_ROOT"].'/include/head.php'; ?>
<style>
    html,body{
        background: none;
    }
	.popup_wrap{
		max-height:100%;
	}
	.popup_contents{
		height: 75vh;
    	overflow-y: auto;
	}
	.img_view_box{
		display:inline-block;
		position: relative;
	}
	.img_view_box + hr{
		opacity: 0; margin:0;
	}
	.img_tit{
		position: absolute;
		bottom: 0;
		right: 0;
		display:inline-block;
		background:#222;
		color:#fff;
		opacity: 0.75;
		padding:0.25em 1em;
		font-size:0.95em;
	}
</style>

<form action="">
    <div class="popup_box">
        <div class="popup_wrap wrap1300">
            <div class=" popup_con ">
                <div class="popup tit_box row jc_sb ai_c">
                    <span>사진미리보기</span>
                    <button class="pop_close" type="button">
                        <span class="material-icons" >close</span>
                    </button>
                </div>
                <div class="popup_contents ">

					<div class="table_box vertical t_left">
						<table>
						<colgroup>
							<col width="16.666%">
							<col width="16.666%">
							<col width="16.666%">
							<col width="16.666%">
						</colgroup>
							<tbody>
								<tr>
									<th>제목</th>
									<td  colspan="5"><?=$rs['title']?></td>
								</tr>

								<tr>
									<th>설명</th>
									<td  colspan="5"><?=$rs['description']?></td>
								</tr>

								<tr>
									<th>입력</th>
									<td><?=$rs['writer_print']?></td>

									<th>저작권</th>
									<td><?=($rs['copyright'] != '') ? $rs['copyright'] : '민중의소리'; ?></td>

									<th>크기</th>
									<td><?=$rs['width']?>*<?=$rs['height']?></td>
								</tr>

								<tr>
									<td  colspan="6" style="text-align:center">
										<?php if($rs['photo'] != ''){?>
											<div class="img_view_box mb_10">
												<img src="<?=$rs['photo']?>" style="max-width: 100%; display:block; margin:0 auto;" title="PC 미리보기 이미지 입니다.">
												<span class="img_tit">PC 미리보기 이미지 입니다.</span>
											</div>
										<?php } ?>
										<hr>
										<?php if($rs['photo_m'] != ''){?>
											<div class="img_view_box mb_10">
												<img src="<?=$rs['photo_m']?>" style="max-width: 100%; display:block; margin:0 auto;" title="모바일 미리보기 이미지 입니다.">
												<span class="img_tit">모바일 미리보기 이미지 입니다.</span>
											</div>
										<?php } ?>
									</td>
								</tr>
							</tbody>
						</table>
					</div>
                
                </div>

            </div>
        </div>
        <span class="popbg"></span>
    </div>
</form>
</div>