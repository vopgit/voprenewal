<?php
if(!defined('_HOME_TITLE')) exit;

$_contents = new Contents();

$filters = array(
			'type'=>$_type, 
			'id'=>$_page, 
			);

$rs = $_contents->getRead($filters);

echo "type :: ".$_type;
echo "<br>";
echo "page :: ".$_page;

?>
