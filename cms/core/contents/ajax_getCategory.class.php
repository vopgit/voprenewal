<?php
if(!defined('_HOME_TITLE')) exit;

$_contents = new Contents();

?>
	<option value="">- 선택 -</option>
<?

if($_POST['seq'] == "") exit;

$param_data = array(
				'id'=>$seq
				);
$param_data = array_filter($param_data);

$rs_news_kind = $_contents->getSelectNewsKind($param_data);

if($rs_news_kind["id"] != ""){

	$str_category ="";

	$arr_category = explode("|", $rs_news_kind["category_id"]);

	if(count($arr_category) > 0){
		for($j=0; $j<count($arr_category); $j++) {
			if($arr_category[$j] != ""){

				$param_data = array(
				'id'=>$arr_category[$j]
				);
				$param_data = array_filter($param_data);

				$rs_category = $_contents->getSelectCategory($param_data);

				$selected = ($rs_category["id"] == $default) ? " selected" : "";
?>
				<option value="<?=$rs_category["id"]?>"<?=$selected?>><?=$rs_category["name"]?></option>
<?
			}
		}
	}
}

exit;

?>