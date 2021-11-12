<?php include $_SERVER["DOCUMENT_ROOT"].'/include/head.php'; ?>
<style>
    html,body{
        background: none;
    }
</style>

<form action="">
    <div class="popup_box">
        <div class="popup_wrap">
            <div class=" popup_con">
                <div class="popup tit_box row jc_sb ai_c">
                    <span>칼럼 선택</span>
                    <button class="pop_close" type="button">
                        <span class="material-icons" >close</span>
                    </button>
                </div>

                <div class="popup_contents">

					<div style="color:#999; font-size:14px; padding-bottom:7px">* 더블클릭으로 선택해 주세요</div>

                    <div class="pop_scroll">

                        <div class="table_box horizontal t_center border_tb2 mb_5">

							<table>
                                <colgroup>
                                    <col width="14%">
                                    <col width="86%">
                                </colgroup>
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>칼럼명</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php for ($j = 0 ; $j < count($rs); $j++) { ?>
                                    <tr>
                                        <td class="act_tc3"><?=($j+1)?></td>
                                        <td class="act_tc3" style="text-align:left">
                                            <a href="javascript:void(0);" class="column-list" data-id='<?=$rs[$j]['id']?>'>
                                                <div class="table_ellip">
                                                    <span><?php if($rs[$j]['use_tf'] == 'N'){ ?>(휴재/마감) <?php } ?><?=$rs[$j]['description']?></span>
                                                </div>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php  }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- <div class=" mt_30 t_center">
                        <a class="btn_md btn_c2 ">저장</a>
                    </div> -->
                </div>
            </div>
        </div>
        <span class="popbg"></span>
    </div>
</form>
</div>

<script>
     $('.table_box').find('.act_tc3').click(function(){
        $('.act_tc3').removeClass('on');
        $(this).addClass('on');
        $(this).siblings('td').addClass('on');
    })

	$('.column-list').dblclick(function(){
		var id = $(this).data('id');
		var title = $(this).find('span').text().trim();
		console.log(id + " - " + title);
		parent.js_set_column(id, title);
	});

</script>



</body>
</html>
