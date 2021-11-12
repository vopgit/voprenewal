<?php 
//원소스검색
include $_SERVER["DOCUMENT_ROOT"].'/include/head.php'; 
?>
<style>
       html,body{
        background: none;
    }
    .popup_wrap {
        overflow-y: visible;
        height: 43.75em;
    }
	.popup_contents .pop_pageing {
		min-height: auto;
	}
    .popup_con{
        padding-top: 14.5rem;
        max-height: 100%;
        position: relative;
    }
    .popup_contents{
        height: auto;
        max-height: 27.75em;
        overflow-y: auto;
        padding: 1.25rem;
    }
    .tit_box{
        top:0;
        position: absolute;
    }
    .serial_wrap {
        margin-right: -1.2rem;
    }
    .serialnum_wrap{
        top:4.25rem;
        padding: 0 1.25rem;
        position: absolute;
        background: #fff;
    }


</style>

<!-- <form name="frm" id="frm" action="/pop/relate"> -->
    <div class="popup_box">
        <div class="popup_wrap">
            <div class=" popup_con">
                <div class="popup tit_box row jc_sb ai_c">
                    <span>원소스검색</span>
                    <button class="pop_close" type="button">
                        <span class="material-icons" >close</span>
                    </button>
                </div>
				
                <div class="serialnum_wrap">
                   
						<input type="hidden" name="relate_id" id="relate_id" value="<?=$relate_id?>">

                        <div class="table_box vertical t_center border_t2 serialnum">
                            <table>
                                <colgroup>
                                    <col width="20%">
                                    <col width="80%">
                                </colgroup>
                                <tbody>
                                    <tr>
                                        <th>시리얼 <br />넘버</th>
                                        <td>

											<ul class="serial_wrap t_left" id="relate">
												<?php foreach($sel  as $sel){ ?>
													<li class="number_item"  data-item='<?=$sel['id']?>'>
														<div class="number_btn">
															<span class="txt"><?=$sel['serial']?></span>
															<button class="num_close"><i class="iconFt_round_close"></i></button>
														</div>
													</li>
												<?php }?>
											</ul>

                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
						<div class="mtb_20 t_center ">
							<a href="javascript:;" class="btn_md btn_c2 " onclick="js_set_data()">확인</a>
						</div>
                </div>

                <div class="popup_contents">

                    <div class="row mb_20">
                        <div class="col_7 t_right">
                            <input type="text" name="s_serial" id="s_serial" class="inp fm_full" placeholder="시리얼 넘버" maxlength="20" value="<?=$s_serial?>">
                        </div>
                        <div class="col_13 t_right pl_10">
                            <input type="text" name="s_title" id="s_title" class="inp fm_full" placeholder="기사제목" maxlength="30" value="<?=$s_title?>">
                        </div>
                        <div class="col_4 t_right">
                            <a href="javascript:;" onclick="js_search()" class="btn btn_c7 btn_sm search">검색</a>
                        </div>
                    </div>



                    <div class="pop_pageing">
                        <div class="table_box horizontal t_center border_t2">
                            <table>
                                <colgroup>
                                    <col width="15%">
                                    <col width="25%">
                                    <col width="60%">
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>시리얼 넘버</th>
                                        <th>기사제목</th>
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php 
								  for ($j = 0 ; $j < count($rs['data']); $j++) {
										$data = $rs['data'][$j];
										?>
										<tr>
											<td class="act_tc3">
												<?=($rs['vnum'] - $j)?>
											</td>
											<td  class="act_tc3"><?=$data['serial']?></td>
											<td  class="act_tc3">
												<a href="javascript:;" onclick="js_set_id('<?=$data['id']?>','<?=$data['serial']?>')">
													<div class="table_ellip t_left">
														<span><?=$data['title']?></span>
													</div>
												</a>
											</td>
										</tr>
										<?php  
									}
									?>

									<?php if($rs['total'] < 1){ ?>
										<tr>
											<td colspan="3">조회된 기사가 없습니다.</td>
										</tr>
									<?php } ?>

                                </tbody>
                            </table>
                        </div>
                    </div>

					<?php if($rs['total'] > 0){ ?>
					<div class="popup_pageing">
                        <div class="page_wrap pt_30 pb_25">
							<?=$rs['paging']?>
						</div>
					</div>
					<?php } ?>
<!-- 					
                    <div class="mt_30 t_center">
                        <a href="javascript:;" class="btn_md btn_c2" onclick="js_set_data()">확인</a>
                    </div> -->
                </div>
				
            </div>
        </div>
        <span class="popbg"></span>
    </div>
</div>
<!-- </form> -->

<script>
	$(function (){
		//serial_drop(".serial_wrap");

		$('#relate').sortable({
			placeholder: "ui-sortable-placeholder",
			update: function(e){
				js_make_id();
			}
	    });
		$('#relate').disableSelection();

		$(document).on('click', '.num_close' ,function(e){
			if(confirm('삭제하시겠습니까?')){
				$(this).closest('li').remove();
				js_make_id();
			}
			return false;
		});

		$('#s_serial, #s_title').keydown(function(e){
			if(e.keyCode == 13) js_search();	
		});
	});

	
	function js_search(){
		js_make_id();

		var s_serial = $('#s_serial').val();
		var s_title = $('#s_title').val();

		if(isEmpty(s_serial) && isEmpty(s_title)){
			alert('검색어를 입력하여 주세요');
			return false;
		}

		var s_serial_qry = (s_serial != '') ? "&s_serial=" + encodeURIComponent(s_serial) : '';
		var s_title_qry = (s_title != '') ? "&s_title=" + encodeURIComponent(s_title) : '';

		location.href = '/pop/onesource?relate_id=' + $('#relate_id').val() + s_serial_qry + s_title_qry;
	}

	function js_go_page(nPage){
		js_make_id();

		var s_serial = $('#s_serial').val();
		var s_title = $('#s_title').val();

		var s_serial_qry = (s_serial != '') ? "&s_serial=" + encodeURIComponent(s_serial) : '';
		var s_title_qry = (s_title != '') ? "&s_title=" + encodeURIComponent(s_title) : '';

		location.href = '/pop/onesource?relate_id=' + $('#relate_id').val() + '&nPage=' + nPage + s_serial_qry + s_title_qry;
	}

	function js_make_id(){
		var param = "";
	    $('#relate').find('li').each(function(){
			if(param == "") param = $(this).data('item');
			else param = param + "|" + $(this).data('item');
		});
		$('#relate_id').val(param);
	}

	function js_set_id(id, serial){
		var check = true;
		$('#relate').find('li').each(function(){
			if($(this).data('item') == id){
				alert('이미 선택된 관련기사입니다.');
				check = false;
				return false;
			}
		});
		
		if(check){
			var html = '<li class="number_item"  data-item=\''+ id +'\'>';
			html    += '<div class="number_btn">';
			html    += '<span class="txt">'+ serial +'</span>';
			html    += '<button class="num_close"><i class="iconFt_round_close"></i></button>';
			html    += '</div>';
			html    += '</li>';			
			$('#relate').append(html);
			js_make_id();
		}
	}

	function js_set_data(){
		var data = [];		
		$('#relate').find('li').each(function(index){
			data.push({
						id: $(this).data('item'), 
			            serial:  $(this).find('.txt').text()
					  });
		});

		parent.js_set_osmu_data(JSON.stringify(data));
		$('.pop_close').click();

	}

</script>

</body>
</html>
