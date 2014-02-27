<?php


if($_POST['data']){
	convert_data($_POST['data']);
}
function convert_data($data){
	
	$s = substr($data, 0,23);
	
	
	if(strstr($s, 'jpeg')){
		$image=base64_decode(str_replace('data:image/jpeg;base64,',"",$data));
	}else{
		$image=base64_decode(str_replace('data:image/png;base64,',"",$data));
	}

	if(!$image){
		die('error');
	}
	$rn = proRandName();
	$filename = $rn.".jpg";
	file_put_contents("./data/".$filename, $image);
	include 'size.class.php';

	$thumb = new Thumbnail(150, 150);
	$thumb->loadData($image, 'image/jpeg');
	$thumb->buildThumb("./data/".$rn.'_thumb.jpg');

	include 'db.class.php';
	$db = new db();
	$data = array(
		'isshow'=>0,
		'path'=>$filename
		);
	$r = $db->insert('img',$data);
	die('1');
}


function proRandName(){
    $tmpStr= "abcdefghijklmnopqrstuvwxyz0123456789";
    $str="";
    for ($i=0;$i<8;$i++){
        $num=rand(0,strlen($tmpStr));
        $str.=$tmpStr[$num];
    }
    return $str.time();
}  




?>