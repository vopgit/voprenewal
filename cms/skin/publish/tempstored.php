<?php
$_menu_code = '0703';
include $_SERVER["DOCUMENT_ROOT"].'/include/header.php';
?>
<div class="contain">

    <div class="wrap mb_100">
        <h3 class="mb_20">작성 중 기사</h3>


        <form name="frm" id="frm" method="get" action="/publish/tempstored">
			<input type="hidden" name="nPage" value="<?=$nPage?>">

            <div class="table_box horizontal ty_tab act_hov t_center">
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
                    <div class="col_13 pr_10">
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

                <table>
                    <colgroup>
                        <col data-col-width="70" >
                        <col data-col-width="90" >
                        <col data-col-width="90">
                        <col data-col-width="">
                        <col data-col-width="115">
                        <col data-col-width="160">
                        <col data-col-width="220">
                    </colgroup>
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>기사종류</th>
                            <th>기사분류</th>
                            <th>제목</th>
                            <th>작성자</th>
                            <th>최종수정시간</th>
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
                            <td><?=$data['kind_name']?></td>
                            <td><?=$data['category_name']?></td>
                            <td class="_subj">
								
								<a href="javascript:;" class="pv_article"><?=$data['title']?></a>
								<?php if($data['status'] == 'reserved1' || $data['status'] == 'reserved2'){ ?>
									<span>(<?=$data['mod_cnt']?>차 보류)</span>
								<?php } ?>
							</td>
                            <td>
								<?=$data['name']?> 기자
								<?php if($data['contributor'] != ""){ //대체명의 ?>
									<br>(<?=$data['contributor']?>) 
								<?php } ?>
							</td>
                            <td><?=$data['regist_time']?></td>
                            <td>
                                <a href="javascript:;" class="btn btn_line_c11 btn_change_status" data-status="standby" type="button">편집대기로</a>
                                <a href="javascript:;" class="btn btn_line_c5 btn_change_status" data-status="deleted" type="button">기사삭제</a>
                            </td>
                        </tr>
                        <?php
						}
					?>
                    </tbody>

                </table>

                <div class="page_wrap pt_30 pb_25 ">
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
		$('#frm').submit();
	});

	//검색 엔터 처리
	$('.enter').on('keydown', function(e){
		if(e.keyCode == 13){
			$('#frm').submit();
		}
	});

	//기사보기
	$('.pv_article').on('click',function(){
		var id = $(this).closest('tr').data('id');
		js_preview('article', id);
	});

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
