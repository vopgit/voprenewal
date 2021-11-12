<?php 
$_menu_code = "0801";  //메뉴 default - config.php에 정의
include $_SERVER["DOCUMENT_ROOT"].'/include/header.php'; 
?>
<script type="text/javascript">
function js_write() {
	document.location.href = "write<?=$param['query']?>";
}

//조회
function js_view(no) {	
	var frm = document.frm;
	var param = "<?=$param['query']?>";
	param = param.replace('?', '&');
	href = '/member/modify?no=' + no + param; 
	location.href = href;
	return;
}

// 검색
function js_search() {
	var param = js_make_param();
	if(param != '') param = "?" + param;
	location.href = "/member/list" + param;
}

function js_make_param(){
	var href = "";
	var field = ['grp', 'nm', 'em', 'pm'];
	
	$.each(field, function(index, value){

		if($('#'+value).val() != ''){
			if(href == '') href = value +'=' + js_quot($('#'+value).val()); 
			else href = href + '&' + value + '=' + js_quot($('#'+value).val()); 
		}		
	});

	return href;
}

function js_quot(str){
	str = str.replace(/\'/gi, "");
	str = str.replace(/\"/gi, "");
	str = encodeURIComponent(str);
	return str;
}
</script>

<div class="contain">

    <div class="wrap mb_100">
        <div class="row jc_sb mb_20">
            <h3>계정 관리</h3>
        </div>
        <form  name="frm" id="frm">
			<input type="hidden" name="mode" id="mode" value="">
			<input type="hidden" name="no" id="adm_no" value="" >
			<input type="hidden" name="nPage" value="<?=$nPage?>">
            <div class="row mb_25">
                <div class="col_4 pr_10">
                    <div class="sel_box">
                        <select name="grp" id="grp" class="sel sel_md fm_full placeholder __customUi">
                            <option value="">회원종류</option>
                            <?=getMeberTypeOption($grp)?>
                        </select>
                    </div>
                </div>
                <div class="col_5 pr_10">
                    <input type="text" name="nm" id="nm" value="<?=$nm?>" class="inp fm_full" placeholder="이름" maxlength="20">
                </div>
                <div class="col_8 pr_10">
                    <input type="text" name="em" id="em" value="<?=$em?>" class="inp fm_full" placeholder="이메일" maxlength="30">
                </div>
                <div class="col_7 ">
                    <div class="row">
                        <div class="col_19 t_right">
                            <input type="text" name="pm" id="pm" value="<?=$pm?>" class="inp fm_full" placeholder="휴대전화" maxlength="20">
                        </div>
                        <div class="col_5 t_right">
                            <a href="javascript:;" onclick="js_search()" class="btn btn_c7 btn_sm search">검색</a>
                        </div>
                    </div>

                </div>
            </div>
        </form>

        <form action="">
            <div class="table_box horizontal">
                <table class="t_center">
                <colgroup>
                    <col width="5%">
                    <col width="10%">
                    <col width="7%">
                    <col width="10%">
                    <col width="10%">
                    <col width="10%">
                    <col width="7%">
                    <col width="10%">
                </colgroup>
                    <thead >
                        <tr>
                            <th >No.</th>
                            <th>아이디</th>
                            <th>이름</th>
                            <th>이메일</th>
                            <th>일반전화</th>
                            <th>휴대전화</th>
                            <th>회원종류</th>
                            <th>가입일시</th>
                        </tr>
                    </thead>
                    <tbody >
                    <?php 
					$j = 0;
					foreach($rs['data'] as $data){ ?>
						<tr>
							<td><?=($rs['vNum'] - $j)?></td>
							<td><?=$data['user_id']?></td>
							<td><a href="javascript:;" onclick="js_view('<?=$data['id']?>')"><?=$data['name']?></a></td>
							<td><?=$data['email']?></td>
							<td><?=$data['phone']?></td>
							<td><?=$data['mobile']?></td>
							<td><?=($data['user_type'] == 'editor') ? "편집자" : "기자";?></td>
							<td ><?=str_replace("-", "/", $data['regist_time'])?></td>
						</tr>
						<?php 
						$j++;
					} 
					?>

					<?php if ($rs['total'] < 1){ ?>
						<tr>
							<td colspan="8" style="text-align:center">조회된 계정이 없읍니다</td>
						</tr>
					<?php } ?>
                    </tbody>
                </table>
                
				<?php if ($rs['total'] > 0 && $rs['tot_page'] > 1){ //페이징 ?>
					<div class="page_wrap pt_30 pb_25">
		                <?=$rs['paging']?>
			        </div>
				<?php } ?>
            </div>
        </form>

        <div class="t_right mt_25">
            <a href="javascript:;" onclick="js_write()" class="btn_lg btn_cg"> 등록하기</a>
        </div>
    </div>



</div>
<?php include $_SERVER["DOCUMENT_ROOT"].'/include/footer.php'; ?>
