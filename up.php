<?php 


if(!$_FILES['pic']['name'])die('error');

include './image.class.php';

$options = array(
		"filePath"=>"./upload/",
	);

$Up = new UpFile($options);

$s = $Up->uploadFile($_FILES['pic']);

if($s == 0){
   $str =  "<script> window.parent.document.getElementById('imgurl').setAttribute('value','".$Up->getNewFileName()."');</script>";
   $str.="<script> window.parent.document.getElementById('tag_img').setAttribute('src','"."./upload/".$Up->getNewFileName()."');</script>";

   echo $str .=  "<script> window.parent.document.getElementById('img_c').style.display='block';window.parent.document.getElementById('gj').style.display='block';window.parent.document.getElementById('loading').style.display='none';window.parent.myFunction();</script>";
}else{
   echo "<script> window.parent.alert('上传失败 请重新上传')</script>";
}

die;
?>