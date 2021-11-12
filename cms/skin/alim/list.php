<?php
$_menu_cede = "0601";
include $_SERVER["DOCUMENT_ROOT"].'/include/header.php';
?>
<div class="contain">

    <div class="wrap mb_100">
        <h3 class="mb_20">알림 관리</h3>

        <form  name="frm" id="frm" method="get" action="/alim/list">

			<input type="hidden" name="mode" id="mode" value="">
			<input type="hidden" name="nPage" value="<?=$nPage?>">

            <div class="table_box horizontal ty_tab act_hov">
                <div class="row plr_30 ptb_25 search_box">
                    <div class="col_11 pr_10">
                        <input type="text" name="s_title" id="s_title" value="<?=$s_title?>" maxlength="30" class="inp fm_full enter" placeholder="제목">
                    </div>
                    <div class="col_13 ">
                        <div class="row">
                            <div class="col_19 t_right">
                                <input type="text" name="s_content" id="s_content" value="<?=$s_content?>" maxlength="50" class="inp fm_full enter" placeholder="내용">
                            </div>
                            <div class="col_4 t_right">
								<a href="javascript:;" class="btn btn_c7 btn_sm search btn_search">검색</a>
                            </div>
                        </div>

                    </div>
                </div>

                <table class="t_center">
                    <colgroup>
                        <!-- 체크박스 -->
                        <col width="4%">
                        <!-- No -->
                        <col width="4%">
                        <!-- 카테고리 -->
                        <col width="7%">
                        <!-- 시리얼넘버 -->
						<col width="12%">
                        <!-- 제목 -->
                        <col width="36%">
                        <!-- 작성자 -->
                        <col width="8%">
                        <!-- 등록일 -->
                        <col width="11%">
                        <!-- 노출여부 -->
                        <col width="8%">
                        <!-- 조회수 -->
                        <col width="10%">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>
                                <label class="fm_ch ">
                                    <input type="checkbox" class="all_ch" title="전체 선택"><span class="_icon"></span>
                                </label>
                            </th>
                            <th>No.</th>
                            <th>카테고리</th>
                            <th>시리얼 넘버</th>
                            <th>제목</th>
                            <th>작성자</th>
                            <th>등록일</th>
                            <th>노출여부</th>
                            <th>조회수<br />(PC/Mobile)</th>
                        </tr>
                    </thead>
                    <tbody>
						<?php
						for ($j = 0 ; $j < count($rs['data']); $j++) {
							$data = $rs['data'][$j];

							switch ($data['top_tf']) {
								case "Y":
									$str_top_tf="공지";
									break;
								case "N":
									$str_top_tf="";
									break;
								default:
									$str_top_tf="";
									break;
							}

							switch ($data['use_tf']) {
								case "Y":
									$str_use_tf="보이기";
									break;
								case "N":
									$str_use_tf="보이지 않기";
									break;
								default:
									$str_use_tf="보이지 않기";
									break;
							}

						?>
							<tr>
								<td>
									<label class="fm_ch">
										<input type="checkbox" name="chk[]" value="<?=$data['id']?>" class="board_chk"><span class="_icon"></span>
									</label>
								</td>
								<td><?=($rs['vnum'] - $j)?></td>
								<td> <?=$data['category']?></td>
								<td>
									<a href="javascript:;" data-id="<?=$data['id']?>" onclick="js_view('<?=$data['id']?>')" class="_subj">
										<?=$data['serial']?>
									</a>
								</td>
								<td class="_subj">
                                    <?php if($data['top_tf'] == 'Y') { ?>
                                        <em class="line_c4">공지</em>&nbsp;
                                    <?php } ?>
									<a href="javascript:;" data-id="<?=$data['id']?>" onclick="js_view('<?=$data['id']?>')" class="_subj">
										<?=$data['title']?>
									</a>
								</td>
								<td>
									<a href="javascript:;" data-id="<?=$data['id']?>" onclick="js_view('<?=$data['id']?>')" class="_subj">
										<?=$data['contributor']?>
									</a>
								</td>
								<td >
									<p><?=$data['reg_date']?></p>
								</td>
								<td >
									<p><?=$str_use_tf?></p>
								</td>

								<td >
									<p><?=$data['search_cnt_pc']?> / <?=$data['search_cnt_mobile']?></p>
								</td>
							</tr>
						<?php
						}
						?>
						<?php if($rs['total'] < 1){ ?>
							<tr>
								<td colspan="9">조회된 게시글이 없습니다.</td>
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

        <div class="mtb_30 t_right btn_box">
            <button type="button" onclick="js_sel_delete()" class="btn_lg btn btn_line_c14"> 선택 삭제</button>
            <a href="/alim/input" class="btn_lg btn_c2 ml_10"> 등록 </a>
        </div>


    </div>

</div>

<script type="text/javascript">

	var dup_submit_flag = 'N';	//중복 처리 체크

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

	});

	function js_preview(id){
		var url = '/preview/alim/' + id;
		$('#popup_iframe').attr('src',url);
		$('#popup_iframe').stop().fadeIn().css('visibility','visible');
		$('body,html').css('overflow','hidden');
	}

	function js_view(id){
		location.href = "/alim/input?mode=modify&notice_id="+ id +"<?=str_replace('?', '&', $param['query'])?>";
	}

	function close_iframe(){
		act_popup_close();
	}

	//선택삭제
	function js_sel_delete(){

		var frm = document.frm;

		var cnt = $("input:checkbox[name='chk[]']:checked").length;
		if(cnt < 1){
			alert('선택내역이 없습니다');
		}else{
			if(confirm('선택하신 항목을 삭제하시겠습니까?')){
				frm.mode.value = "selDelete";
				frm.method = "post";
				frm.target = "";
				frm.action = "/alim/dml";
				frm.submit();
			}
		}
	}

</script>


<?php include $_SERVER["DOCUMENT_ROOT"].'/include/footer.php'; ?>
