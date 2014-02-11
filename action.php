<?php
ob_start();
	session_start();
	if(!$_SESSION['admin_log'])
        header("location:./login.php");

    if(!$_GET['act']){
    	die('error');
    }
    if(!$_POST['id']){
    	die('error');
    }
    $id = $_POST['id'];
    $act = $_GET['act'];
    include 'db.class.php';
	$db = new db();


    if($act == 'del'){
    	if($db->delete('img','id='.$id)){
    		die('1');
    	}else{
    		die('0');
    	}
    }elseif($act == 'tongg'){
    	$data = array('isshow' =>1 );
    	if($db->update('img',$data,'id='.$id)){
    		die('1');
    	}else{
    		die('0');
    	}
    }elseif($act == 'tonggall'){
    	$arr = explode(",", $id);
    	if(!$arr){
    		die('0');
    	}
    	$where = "id in (";
    	foreach ($arr as $key => $value) {
    		$where .=$value.",";
    	}
    		$where .="0)";

    	$data = array('isshow' =>1 );
    	if($db->update('img',$data,$where)){
    		die('1');
    	}else{
    		die('0');
    	}
    }elseif($act == 'delall'){
    	$arr = explode(",", $id);
    	if(!$arr){
    		die('0');
    	}
    	$where = "id in (";
    	foreach ($arr as $key => $value) {
    		$where .=$value.",";
    	}
    		$where .="0)";

    	$data = array('isshow' =>1 );
    	if($db->delete('img',$where)){
    		die('1');
    	}else{
    		die('0');
    	}
    }
?>