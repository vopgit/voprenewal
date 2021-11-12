<?php 
if(!defined('_HOME_TITLE')) exit;

if($_base['method'] == "POST"){

	$_contents = new Contents();

	$param_data = array(
					's_serial' => urldecode($s_serial),
					's_title' => urldecode($s_title),
					'status' => 'published',
					//'not_in' => $relate_comma,
					'nPage'=> ($nPage == "") ? 1 : $nPage
					);

	$rs = $_contents->get_list($param_data);

	//시작일련번호
	$rs['vnum'] = $rs['total'] - (($nPage - 1) * $nPageSize);

	if($rs['total'] > 0){
		for ($j = 0 ; $j < count($rs['data']); $j++) {
			$data = $rs['data'][$j];			
			$html .='
			<tr>
				<td class="act_tc3">'.($rs['vnum'] - $j).'</td>
				<td  class="act_tc3">'.$data['serial'].'</td>
				<td  class="act_tc3">
					<a href="javascript:;" onclick="js_set_id(\''.$data['id'].'\',\''.$data['serial'].'\')">
						<div class="table_ellip t_left">
							<span>'.$data['title'].'</span>
						</div>
					</a>
				</td>
			</tr>';
		}
	}else{
		$html ='<tr><td colspan="3">조회된 기사가 없습니다.</td></tr>';
	}

	//페이징
	if(empty($nPage)) $nPage = 1;
	$nPageSize = 10;
	$nPageBlock = 10;

	$rs['paging'] = pageList($_base['path'], $nPage, $rs['tot_page'], $nPageBlock, $param['nopage']);
	//$rs['paging'] = pageListPop($nPage, $rs['tot_page'], $nPageSize);

	$result = array('html'=>$html, 'paging'=>$rs['paging']);
	
	set_header('json');
	echo json_encode($result);

	exit;
}
?>