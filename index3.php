<?php

	include 'db.class.php';
	$db = new db();
	$sql = "select * from img limit 31";
	$img_list = $db->get_all($sql);
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=gb2312" />
<title>Photo Wall</title>
<link href="./wall/photo style.css" rel="stylesheet" type="text/css" />
</head>

<body>

<?php
	if($img_list){
		$i=1;
		foreach ($img_list as $key => $value) {
			$n = explode(".", $value['path']);
?>
		<div class="pic<?php echo $i;?>" style="text-align: center;padding-left:0px;"><img src="./data/<?php echo $n['0'].'_thumb.jpg' ?>"  height="90%"/></div>
<?php
		$i++;
		}
	}
 ?>
</body>
</html>

